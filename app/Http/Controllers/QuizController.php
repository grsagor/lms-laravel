<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function createQuiz($course_id)
    {
        $data = [
            'course_id' => $course_id
        ];
        return view('front.pages.quiz.create_quiz', $data);
    }

    public function addQuestion(Request $request)
    {
        $number_of_question = $request->number_of_question;
        $data = [
            'number_of_question' => $number_of_question
        ];
        $html = view('front.pages.quiz.question-template', $data)->render();
        $response = [
            'html' => $html
        ];
        return response()->json($response);
    }

    public function addOption(Request $request)
    {
        $questionId = $request->input('questionId');
        return view('front.pages.quiz.option-template', compact('questionId'));
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
