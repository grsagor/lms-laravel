<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\AllPost;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AssignmentController extends Controller
{
    public function createAssignment($course_id) {
        $data = [
            'course_id' => $course_id
        ];
        return view('front.pages.assignment.create_assignment', $data);
    }
    public function storeCreateAssignment(Request $request) {
        $assignment = new Assignment();
        $all_post = new AllPost();

        $assignment->user_id = Auth::user()->id;
        $assignment->course_id = $request->course_id; 
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->deadline = Carbon::parse($request->deadline)->format('Y-m-d H:i:s');
        
        $files = [];
        if ($request->file('files')) {
            $files = FileHelper::saveFiles($request->file('files'));
        }
        $assignment->files = json_encode($files);

        $assignment->save();

        $all_post->post_id = $assignment->id;
        $all_post->course_id = $request->course_id;
        $all_post->post_type = 'assignment';

        $all_post->save();

        return back()->with('success','Assignment saved successfully');
    }
}
