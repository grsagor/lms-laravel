<?php

namespace App\Http\Controllers;

use App\Models\AssignmentSubmission;
use App\Models\Course;
use App\Models\PostLike;
use App\Models\QuizSubmission;
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

        $requests = SCR::where([['course_id', $id], ['verified', 0]])->get();

        $assingment_histories = AssignmentSubmission::with('assignment')->where('student_id', Auth::user()->id)
        ->whereHas('assignment', function($query) use ($id) {
            $query->where('course_id', $id);
        })->get()->toArray();

        $totalMarks = array_sum(array_column(array_column($assingment_histories, 'assignment'), 'total_marks'));
        $sumOfMarks = array_sum(array_column($assingment_histories, 'marks'));
        $assignment_percentage = $totalMarks ? ( $sumOfMarks * 100 ) / $totalMarks : 0;


        $assignment_stats = [
            "count" => count($assingment_histories),
            "totalMarks" => $totalMarks,
            "sumOfMarks" => $sumOfMarks,
            "percentage" => $assignment_percentage,
        ];

        $quiz_histories = QuizSubmission::with('quiz')->where('student_id', Auth::user()->id)
        ->whereHas('quiz.post', function($query) use ($id) {
            $query->where('course_id', $id);
        })->get()->toArray();

        // return $quiz_histories;

        $totalMarks = array_sum(array_column(array_column($quiz_histories, 'quiz'), 'total_marks'));
        $sumOfMarks = array_sum(array_column($quiz_histories, 'marks'));
        $quiz_percentage = $totalMarks ? ( $sumOfMarks * 100 ) / $totalMarks : 0;


        $quiz_stats = [
            "count" => count($quiz_histories),
            "totalMarks" => $totalMarks,
            "sumOfMarks" => $sumOfMarks,
            "percentage" => $quiz_percentage,
        ];

        $data = [
            'course' => $course,
            'posts' => $posts,
            'requests' => $requests,
            'assignment_stats' => $assignment_stats,
            'quiz_stats' => $quiz_stats,
        ];

        return view('front.pages.courses.single_course', $data);
    }

    public function joiningRequestAction(Request $request) {
        $id = $request->id;
        $type = $request->type;

        if ($type == 1) {
            $scr = SCR::find($id);
            $scr->verified = 1;
            $scr->save();
            $response["message"] = "Accepted";
        } else {
            SCR::find($id)->delete();
            $response["message"] = "Canceled";
        }
        return response()->json($response);
    }
}
