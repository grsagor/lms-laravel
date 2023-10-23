<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('front.pages.courses.courses');
    }

    public function createCourse(Request $request)
    {
        if ($request->role == 'teacher') {
            $course = new Course();

            $course->course_code = Str::random(3) . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $course->course_name = $request->course_name;
            $course->teacher_id = Auth::user()->id;

            $result = $course->save();

            if ($result) {
                return back()->with('success', 'Course created.');
            } else {
                return back()->with('error', 'Unsuccessful');
            }
        }
        if ($request->role == 'student') {
            $course = Course::where('course_code',$request->course_code)->first();



            $result = $course->save();

            if ($result) {
                return back()->with('success', 'Course created.');
            } else {
                return back()->with('error', 'Unsuccessful');
            }
        }
    }
}
