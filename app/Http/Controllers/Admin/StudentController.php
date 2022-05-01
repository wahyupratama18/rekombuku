<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\{StoreStudentRequest, UpdateStudentRequest};
use App\Models\Major;
use App\Models\MajorStudent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('admin.students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.students.create', [
            'majors' => Major::select('id', 'name')->get()
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $student = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $student->majorStudent()->create(['major_id' => $request->major]);
            
            /* MajorStudent::create([
                'user_id' => $student,
                'major_id' => $request->major
            ]); */
        });
        
        return redirect()->route('students.index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        return view('admin.students.edit', [
            'majors' => Major::select('id', 'name')->get(),
            'student' => $student->load('major')
        ]);
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, User $student)
    {
        DB::transaction(function () use ($request, $student) {
            $student->update($request->safe(['name', 'email']));
            
            $student->majorStudent()->update(['major_id' => $request->major]);
        });
        
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        $this->authorize('isAdmin');

        $student->delete();

        return redirect()->route('students.index');
    }
}
