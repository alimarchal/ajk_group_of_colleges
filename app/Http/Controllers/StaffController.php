<?php

namespace App\Http\Controllers;

use App\Models\TeachingSubject;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('staff-information.index');
    }

    public function teachers(Request $request)
    {
        if ($request->has('accountant')) {
            $users = User::role('accountant')->get();
        } else if ($request->has('receptionist')) {
            $users = User::role('receptionist')->get();
        } else {
            $users = User::role('teacher')->get();
        }
        return view('staff-information.teachers.index', compact('users'));
    }


    public function edit(User $user, Request $request)
    {
        return view('staff-information.teachers.edit', compact('user'));
    }


    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if ($user->role('teacher')) {
            try {
                DB::beginTransaction();

                // Update the user's attributes
                $user->update($request->only(['name', 'email', 'gender', 'dob', 'phone_network_id', 'mobile']));

                // Sync user permissions
                $user->syncPermissions($request->input('permissions', []));

                // Get the current teaching subjects
                $currentSubjects = TeachingSubject::where('user_id', $user->id)->pluck('subject_id')->toArray();

                // Get the submitted teaching subjects
                $submittedSubjects = $request->input('subjects', []);

                // Find subjects to update and create new subjects
                $subjectsToUpdate = array_intersect($currentSubjects, $submittedSubjects);
                $subjectsToCreate = array_diff($submittedSubjects, $currentSubjects);

                // Update existing teaching subjects
                TeachingSubject::where('user_id', $user->id)->whereIn('subject_id', $subjectsToUpdate)->update(['updated_at' => now()]);

                // Delete teaching subjects that are not in the submitted data
                $subjectsToDelete = array_diff($currentSubjects, $submittedSubjects);
                TeachingSubject::where('user_id', $user->id)->whereIn('subject_id', $subjectsToDelete)->delete();

                // Create new teaching subjects
                foreach ($subjectsToCreate as $subjectId) {
                    TeachingSubject::create(['user_id' => $user->id, 'subject_id' => $subjectId]);
                }

                DB::commit();

                session()->flash('status', 'Teacher has been updated successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                session()->flash('status', 'Teacher update failed.');
                // Log the error or handle it as needed.
            }
        } else {
            try {
                DB::beginTransaction();

                // Update the user's attributes
                $user->update($request->only(['name', 'email', 'gender', 'dob', 'phone_network_id', 'mobile']));

                // Sync user permissions
                $user->syncPermissions($request->input('permissions', []));

                DB::commit();

                session()->flash('status', 'Data has been updated successfully.');
            } catch (\Exception $e) {
                DB::rollback();
                session()->flash('status', 'update failed.');
                // Log the error or handle it as needed.
            }
        }

        return redirect()->route('staff-information.teachers.edit', compact('user'));
    }

}
