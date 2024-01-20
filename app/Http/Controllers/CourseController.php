<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\PostLike;
use App\Models\SCR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\AllPost;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        $data = [
            'courses' => $courses,
        ];
        return view('front.pages.courses.courses', $data);
    }

    public function createCourse(Request $request)
    {
        if ($request->role == 'teacher') {
            $course = new Course();

            $course->code = Str::random(3) . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $course->name = $request->name;
            $course->teacher_id = Auth::user()->id;

            $result = $course->save();

            if ($result) {
                return back()->with('success', 'Course created.');
            } else {
                return back()->with('error', 'Unsuccessful');
            }
        }
        if ($request->role == 'student') {
            $student = new SCR();

            $student->student_id = Auth::user()->id;
            $student->course_id = Course::where('code', $request->code)->first()->id;

            $result = $student->save();

            if ($result) {
                return back()->with('success', 'Joined');
            } else {
                return back()->with('error', 'Unsuccessful');
            }
        }
    }

    public function singleCoursePage($id) {
        $course = Course::find($id);

        $posts = AllPost::where('course_id',$id)->with(['post', 'assignment', 'quiz', 'user', 'likes'])->get();

        foreach ($posts as $post) {
            $post->like_count = count($post->likes);
            if (PostLike::where([['user_id', Auth::user()->id], ['post_id', $post->id]])->first()) {
                $post->is_liked = 1;
            } else {
                $post->is_liked = 0;
            }
        }

        $data = [
            'course' => $course,
            'posts' => $posts,
        ];

        return view('front.pages.courses.single_course', $data);
    }
}
