<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\InstituteSession;
use App\Models\Status;
use App\Models\Student;
use App\Models\StudentSession;
use Auth;
use DB;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\QueryBuilder;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

//        DB::enableQueryLog();
        $students = QueryBuilder::for(Student::class)
            ->allowedFilters([
                AllowedFilter::exact('gender'),
                AllowedFilter::scope('age_between', 'ageBetween'),
                AllowedFilter::exact('admission_date'),
                AllowedFilter::partial('admission_no'),
                AllowedFilter::partial('roll_no'),
                AllowedFilter::partial('firstname'),
                AllowedFilter::partial('lastname'),
                AllowedFilter::partial('mobile_no'),
                AllowedFilter::partial('email'),
                AllowedFilter::exact('bloodGroup.id'),
                AllowedFilter::exact('instituteClass.id'),
                AllowedFilter::exact('latestStatus.name'),
                'guardian.father_name',
                'guardian.father_phone',
                'guardian.father_occupation',
                'guardian.mother_name',
                'guardian.mother_phone',
                'guardian.guardian_name',
                'guardian.guardian_relation',
                'guardian.guardian_phone',
                'guardian.guardian_email',
                'section.id',
                'category.id',
                'dob', 'religion', 'cast', 'house', 'height', 'weight', 'measure_date', 'fees_discount',
            ])
            ->allowedSorts([
                'firstname',
                'lastname',
                'dob',
                'admission_date',
                // Add more sortable fields as needed
            ])
            ->defaultSort('firstname')
            ->with('guardian', 'emergencyContact', 'instituteClass', 'bloodGroup', 'section', 'category', 'instituteMigratedStudent', 'latestStatus')
            ->paginate(10);


//        dd(DB::getQueryLog($students));

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $user = Auth::user();

        $studentPic = null;
        // Process and store the uploaded images if provided
        if ($request->hasFile('student_pic_1')) {
            $studentPic = $request->file('student_pic_1')->store('student_pics', 'public');
            $request->merge(['student_pic' => $studentPic]);
        }
        $request->merge(['user_id' => $user->id]);

        // Create a new student record
        $student = Student::create($request->all());


        $status = Status::create([
            'user_id' => $user->id,
            'student_id' => $student->id,
            'name' => 'In-Process',
        ]);


        $student_sessions = StudentSession::create([
            'user_id' => $user->id,
            'student_id' => $student->id,
            'institute_session_id' => $request->institute_session_id,
        ]);

        $student->admission_no = 'AJKGC-' . $student->id;
        $student->institute_session_id = $student_sessions->institute_session_id;
        $student->save();

        session()->flash('success', 'Student record created successfully.');
        return to_route('student.guardians', $student->id);

    }

    /**
     * Display the specified resource.
     */
    public function print(Student $student)
    {
        return view('student-information-print.student-admision-print', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $user = Auth::user();
        $request->validate([
            'admission_no' => 'required|unique:students,admission_no,' . $student->id,
            'roll_no' => 'required|unique:students,roll_no,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'institute_class_id' => 'nullable|exists:institute_classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'category_id' => 'nullable|exists:categories,id',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required|in:Male,Female,Other',
            'dob' => 'required|date',
            'religion' => 'nullable',
            'cast' => 'nullable',
            'mobile_no' => 'required',
            'admission_date' => 'nullable|date',
            'blood_group_id' => 'nullable|exists:blood_groups,id',
            'house' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
            'measure_date' => 'nullable|date',
            'fees_discount' => 'nullable|integer',
            'medical_history' => 'nullable',
            'status_name' => 'required',
        ]);


        // Process and store the uploaded images if provided
        if ($request->hasFile('student_pic_1')) {
            $fatherPicPath = $request->file('student_pic_1')->store('student_pics', 'public');
            $request->merge(['student_pic' => $fatherPicPath]);
        }
//
//        $status = Status::create([
//            'user_id' => $user->id,
//            'student_id' => $student->id,
//            'name' => $request->status_name,
//        ]);

        $status_latest_of_many = $student->latestStatus;

        if (empty($status_latest_of_many)) {
            $status = Status::create([
                'user_id' => $user->id,
                'student_id' => $student->id,
                'name' => $request->status_name,
            ]);
        } elseif ($status_latest_of_many->name != $request->status_name) {
            $status = Status::create([
                'user_id' => $user->id,
                'student_id' => $student->id,
                'name' => $request->status_name,
            ]);
        }




        $institute_session_id = $student->institute_session_id;
        if (empty($institute_session_id)) {
            $student_sessions = StudentSession::create([
                'user_id' => $user->id,
                'student_id' => $student->id,
                'institute_session_id' => $request->institute_session_id,
            ]);
            $request->merge(['institute_session_id' => $student_sessions->institute_session_id]);
        } elseif ($institute_session_id != $request->institute_session_id) {
            $student_sessions = StudentSession::create([
                'user_id' => $user->id,
                'student_id' => $student->id,
                'institute_session_id' => $request->institute_session_id,
            ]);
            $request->merge(['institute_session_id' => $student_sessions->institute_session_id]);
        }





        $student->update($request->all());
        // Create a new student record
        session()->flash('success', 'Student record updated successfully.');
        return to_route('student.show', $student->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
