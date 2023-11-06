<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\AllPost;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
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
        
        $assignment->files = [];
        if ($request->file('files')) {
            $assignment->files = FileHelper::saveFiles($request->file('files'));
        }
        $assignment->save();

        $all_post->post_id = $assignment->id;
        $all_post->user_id = Auth::user()->id;
        $all_post->course_id = $request->course_id;
        $all_post->post_type = 'assignment';

        $all_post->save();

        return back()->with('success','Assignment saved successfully');
    }

    public function assignimentSubmitPage($id) {
        $post = AllPost::where('id',$id)->with(['assignment', 'user'])->first();
        $original_files = json_decode($post->assignment->files);

        $files = [];

        foreach ($original_files as $file) {
            $filePath = $file;
            $filename = pathinfo($filePath, PATHINFO_BASENAME);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            $files[] = [
                'path' => $file,
                'name' => $filename,
                'extension' => $extension
            ];
        }

        $data = [
            'post' => $post,
            'files' => $files
        ];
        return view('front.pages.assignment.assignment_submit_page', $data);
    }

    public function assignimentSubmitStore(Request $request) {
        $assignment = new AssignmentSubmission();

        $assignment->student_id = Auth::user()->id;
        $assignment->assignment_id = $request->assignment_id;
        $assignment->comments = $request->comments;

        $assignment->files = [];
        if ($request->file('files')) {
            $assignment->files = FileHelper::saveFiles($request->file('files'));
        }

        $assignment->save();

        return back()->with('success', 'Assignment submitted successfully.');
    }
}
