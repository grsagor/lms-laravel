<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AllPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class QuizController extends Controller
{
    public function createQuiz($course_id)
    {
        $data = [
            'course_id' => $course_id
        ];
        return view('front.pages.quiz.create_quiz', $data);
    }

    public function storeQuiz(Request $request) {
        $quizzes = [];

        foreach ($request->question as $index => $value) {
            $quiz = [
                'question' => $value,
                'option' => $request->option[$index + 1],
                'right_ans' => $request->right_ans[$index],
            ];
            $quizzes[] = $quiz;        
        }

        $quiz = new Quiz();
        $quiz->user_id = Auth::user()->id;
        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->total_marks = count($request->question);
        $quiz->quizzes = json_encode($quizzes);
        $quiz->deadline = Carbon::parse($request->deadline)->format('Y-m-d H:i:s');

        $quiz->save();

        $all_post = new AllPost();

        $all_post->post_id = $quiz->id;
        $all_post->user_id = Auth::user()->id;
        $all_post->course_id = $request->course_id;
        $all_post->post_type = 'quiz';

        $all_post->save();

        return back()->with('success','Quiz saved successfully');
    }

    public function quizSubmitPage($id) {
        $post = AllPost::where('id',$id)->with(['quiz', 'user'])->first();
        $currentDateTime = Carbon::now();
        $expired_at = Carbon::parse($post->quiz->deadline);
        
        if ($expired_at->lt($currentDateTime)) {
            $expired = 1;
        } else {
            $expired = 0;
        }
        $quiz = $post->quiz;
        $quiz_submitted = QuizSubmission::where([['quiz_id', $quiz->id], ['student_id', Auth::user()->id]])->first();
        $quiz->quizzes = json_decode($quiz->quizzes);
        $answered = false;
        if ($quiz_submitted) {
            $quiz->quizzes = json_decode($quiz_submitted->answers);
            $quiz->marks = $quiz_submitted->marks;
            $answered = true;
        }
        // return $quiz_submitted;
        $data = [
            'quiz' => $quiz,
            'answered' => $answered,
            'expired' => $expired,
        ];

        return view('front.pages.quiz.quiz_submit_page', $data);
    }

    public function quizSubmitStore(Request $request) {
        $quiz = Quiz::where('id',$request->quiz_id)->first();
        $quizzes = json_decode($quiz->quizzes);
        $marks = 0;
        foreach ($quizzes as $key => $value) {
            $value->answer = $request->{"answer_" . $key};
            if($value->answer == $value->right_ans){$marks++;}
        }
        $quiz_submit = new QuizSubmission();
        
        $quiz_submit->student_id = Auth::user()->id;
        $quiz_submit->quiz_id = $request->quiz_id;
        $quiz_submit->answers = json_encode($quizzes);
        $quiz_submit->marks = $marks;
        $quiz_submit->save();

        return back()->with('success','Quiz submitted successfully');
    }

    public function addQuestion(Request $request)
    {
        $data = [
            'q_counter' => $request->q_counter
        ];
        $html = view('front.pages.quiz.question-template', $data)->render();
        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }

    public function addOption(Request $request)
    {
        $data = [
            'q_counter' => $request->q_counter,
            'o_couonter' => $request->o_couonter,
        ];
        $html = view('front.pages.quiz.option-template', $data)->render();
        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }

    public function removeQuestion(Request $request)
    {
        $questionId = $request->input('questionId');
        return response()->json(['success' => true]);
    }

    public function removeOption(Request $request)
    {
        $questionId = $request->input('questionId');
        $optionId = $request->input('optionId');
        // Remove the option from the database or perform any necessary cleanup
        return response()->json(['success' => true]);
    }

    public function getAssignmentSubmission(Request $request)
    {
        $data = QuizSubmission::where('quiz_id', $request->quiz_id)->get();

        return DataTables::of($data)
            ->editColumn('marks', function ($row) {
                if ($row->marks || $row->marks == 0) {
                    return $row->marks;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('student_name', function ($row) {
                return $row->student->name;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="d-flex gap-1">';
                $btn = $btn . '<button class="btn btn-sm btn-primary edit_btn" data-id="' . $row->id . '"><i class="fa-solid fa-pen"></i></button>';
                $btn = $btn . '<button class="btn btn-sm btn-danger delete_btn" data-id="' . $row->id . '"><i class="fa-solid fa-trash"></i></button>';
                $btn = $btn . '</div>';
                return  $btn;
            })
            ->rawColumns(['action', 'student_name'])
            ->make(true);
    }

    public function assignmentReviewModal(Request $request) {
        $assignment = QuizSubmission::find($request->id);
        return view('front.pages.quiz.review_student_submission', compact('assignment'));
    }

    public function assignmentReviewUpdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'teachers_feedback' => 'required',
            'marks' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $assignment = QuizSubmission::find($request->id);
        $assignment->teachers_feedback = $request->teachers_feedback;
        $assignment->marks = $request->marks;
        $assignment->save();
        $response =[
            'success' => true
        ];
        return response()->json($response);
    }

    public function teacherAssignmentSubmissionDelete(Request $request) {
        $assignment = QuizSubmission::find($request->id);
        if ($assignment) {
            $assignment->delete();
            $response = [
                'success' => true
            ];
        }

        return response()->json($response);
    }
}
