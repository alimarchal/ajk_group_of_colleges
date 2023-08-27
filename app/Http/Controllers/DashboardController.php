<?php

namespace App\Http\Controllers;

use App\Models\InstituteClass;
use App\Models\Student;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalApprovedStudents = DB::table('students')
            ->whereIn('id', function ($query) {
                $query->select('s.student_id')
                    ->from('statuses as s')
                    ->join(DB::raw('(SELECT student_id, MAX(created_at) AS max_created_at FROM statuses GROUP BY student_id) as max_dates'), function ($join) {
                        $join->on('s.student_id', '=', 'max_dates.student_id')
                            ->on('s.created_at', '=', 'max_dates.max_created_at');
                    })
                    ->where('s.name', '=', 'Approved');
            })
            ->count('id');

        $inProcessStudentCount = DB::table('students')
            ->whereIn('id', function ($query) {
                $query->select('s.student_id')
                    ->from('statuses as s')
                    ->join(DB::raw('(SELECT student_id, MAX(created_at) AS max_created_at FROM statuses GROUP BY student_id) as max_dates'), function ($join) {
                        $join->on('s.student_id', '=', 'max_dates.student_id')
                            ->on('s.created_at', '=', 'max_dates.max_created_at');
                    })
                    ->where('s.name', '=', 'In-Process');
            })
            ->count('id');

        $rusticatedStudentCount = DB::table('students')
            ->whereIn('id', function ($query) {
                $query->select('s.student_id')
                    ->from('statuses as s')
                    ->join(DB::raw('(SELECT student_id, MAX(created_at) AS max_created_at FROM statuses GROUP BY student_id) as max_dates'), function ($join) {
                        $join->on('s.student_id', '=', 'max_dates.student_id')
                            ->on('s.created_at', '=', 'max_dates.max_created_at');
                    })
                    ->where('s.name', '=', 'Rusticated');
            })
            ->count('id');

        $leavedStudentCount = DB::table('students')
            ->whereIn('id', function ($query) {
                $query->select('s.student_id')
                    ->from('statuses as s')
                    ->join(DB::raw('(SELECT student_id, MAX(created_at) AS max_created_at FROM statuses GROUP BY student_id) as max_dates'), function ($join) {
                        $join->on('s.student_id', '=', 'max_dates.student_id')
                            ->on('s.created_at', '=', 'max_dates.max_created_at');
                    })
                    ->where('s.name', '=', 'Leaved');
            })
            ->count('id');

        $approvedStudentsByClass = [];
        foreach (InstituteClass::all() as $ic) {
            $approvedStudentsByClass[$ic->name] = 0;
        }

        $class_students = DB::table('institute_classes AS ic') ->select('ic.name AS institute_class_name', DB::raw('COUNT(s.id) AS approved_student_count')) ->join('students AS s', 'ic.id', '=', 's.institute_class_id') ->whereIn('s.id', function ($query) { $query->select('st.student_id') ->from('statuses AS st') ->join(DB::raw('(SELECT student_id, MAX(created_at) AS max_created_at FROM statuses GROUP BY student_id) AS max_dates'), function ($join) { $join->on('st.student_id', '=', 'max_dates.student_id') ->on('st.created_at', '=', 'max_dates.max_created_at'); }) ->where('st.name', '=', 'Approved'); }) ->groupBy('ic.id', 'ic.name') ->get();

        foreach ($class_students as $ic) {
            $approvedStudentsByClass[$ic->institute_class_name] = $ic->approved_student_count;
        }

        return view('dashboard', compact('totalApprovedStudents', 'inProcessStudentCount', 'rusticatedStudentCount', 'leavedStudentCount','approvedStudentsByClass'));
    }
}
