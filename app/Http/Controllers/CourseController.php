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
        $user = Auth::user();
        if ($user->role == 'teacher') {
            $courses = Course::where('teacher_id', $user->id)->get();
        } else {
            $courses = Course::whereHas('scr', function($query) use ($user) {
                $query->where([['student_id', $user->id], ['verified', 1]]);
            })
            ->get();
        }

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
            $course = Course::where('code', $request->code)->first();
            if ($course) {
                $student->course_id = $course->id;
            } else {
                return back()->with('error', 'No course found.');
            }

            $result = $student->save();

            if ($result) {
                return back()->with('success', 'Request has sent');
            } else {
                return back()->with('error', 'Unsuccessful');
            }
        }
    }

    public function singleCoursePage($id) {
        $course = Course::find($id);

        $students = SCR::where([['course_id', $id], ['verified', 1]])->get();

        $posts = AllPost::where('course_id',$id)->with(['post', 'assignment', 'quiz', 'user', 'likes'])->orderBy('created_at', 'desc')->get();

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
            'students' => $students,
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
    public function delete(Request $request) {
        $user = Auth::user();
        $course_id = $request->id;
        if ($user->role == 'teacher') {
            $course = Course::find($course_id);
            $scr = SCR::where('course_id', $course_id)->delete();
            $course->delete();
            return redirect('/')->with('success', 'Course deleted successfully.');
        } else {
            SCR::where([['student_id', $user->id], ['course_id', $course_id]])->delete();
            return redirect('/')->with('success', 'You left the course successfully.');
        }
    }
    public function kickStudent(Request $request) {
        SCR::where([['student_id', $request->student_id], ['course_id', $request->course_id]])->delete();
        return back()->with('success', 'You kick the student out.');
    }
}
