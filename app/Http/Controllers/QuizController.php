<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AllPost;
use Illuminate\Support\Facades\Auth;

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

}
