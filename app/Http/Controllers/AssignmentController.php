<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\AllPost;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AssignmentController extends Controller
{
    public function createAssignment($course_id)
    {
        $data = [
            'course_id' => $course_id
        ];
        return view('front.pages.assignment.create_assignment', $data);
    }
    public function storeCreateAssignment(Request $request)
    {
        $assignment = new Assignment();
        $all_post = new AllPost();

        $assignment->user_id = Auth::user()->id;
        $assignment->course_id = $request->course_id;
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->total_marks = $request->total_marks;
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

        return back()->with('success', 'Assignment saved successfully');
    }

    public function assignimentSubmitPage($id)
    {
        $post = AllPost::where('id', $id)->with(['assignment', 'user'])->first();
        $currentDateTime = Carbon::now();
        $expired_at = Carbon::parse($post->assignment->deadline);
        
        if ($expired_at->lt($currentDateTime)) {
            $expired = 1;
        } else {
            $expired = 0;
        }
        $original_files = json_decode($post->assignment->files);

        $files = [];

        foreach ($original_files as $file) {
            $filePath = $file;
            $filename = pathinfo($filePath, PATHINFO_BASENAME);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            $files[] = [
                'path' => $file,
                'name' => FileHelper::getOriginalFilename($filename),
                'extension' => $extension
            ];
        }
        $assignment_submit = AssignmentSubmission::where([['student_id', Auth::user()->id], ['assignment_id', $post->assignment->id]])->first();
        $submit_files = [];
        if ($assignment_submit) {
            $original_files = json_decode($assignment_submit->files);
            foreach ($original_files as $file) {
                $filePath = $file;
                $filename = pathinfo($filePath, PATHINFO_BASENAME);
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
    
                $submit_files[] = [
                    'path' => $file,
                    'name' => FileHelper::getOriginalFilename($filename),
                    'extension' => $extension
                ];
            }
        }

        $data = [
            'post' => $post,
            'files' => $files,
            'assignment_submit' => $assignment_submit,
            'submit_files' => $submit_files,
            'expired' => $expired,
        ];
        return view('front.pages.assignment.assignment_submit_page', $data);
    }

    public function assignimentSubmitStore(Request $request)
    {
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

    public function getAssignmentSubmission(Request $request)
    {
        $data = AssignmentSubmission::where('assignment_id', $request->assignment_id)->get();

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
            ->addColumn('files', function ($row) {
                $btn = '<div class="d-flex gap-1">';
                $files = json_decode($row->files);
                foreach ($files as $file) {
                    $btn = $btn . '<a class="btn" href="' . url($file) . '" target="_blank"><i class="fa-solid fa-paperclip"></i></a>';
                }
                $btn = $btn . '</div>';
                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="d-flex gap-1">';
                $btn = $btn . '<button class="btn btn-sm btn-primary edit_btn" data-id="' . $row->id . '"><i class="fa-solid fa-pen"></i></button>';
                $btn = $btn . '<button class="btn btn-sm btn-danger delete_btn" data-id="' . $row->id . '"><i class="fa-solid fa-trash"></i></button>';
                $btn = $btn . '</div>';
                return $btn;
            })
            ->rawColumns(['action', 'files'])
            ->make(true);
    }

    public function assignmentReviewModal(Request $request)
    {
        $assignment = AssignmentSubmission::find($request->id);
        return view('front.pages.assignment.review_student_submission', compact('assignment'));
    }

    public function assignmentReviewUpdate(Request $request)
    {
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
        $assignment = AssignmentSubmission::find($request->id);
        $assignment->teachers_feedback = $request->teachers_feedback;
        $assignment->marks = $request->marks;
        $assignment->save();
        $response = [
            'success' => true
        ];
        return response()->json($response);
    }

    public function teacherAssignmentSubmissionDelete(Request $request)
    {
        $assignment = AssignmentSubmission::find($request->id);
        if ($assignment) {
            $assignment->delete();
            $response = [
                'success' => true
            ];
        }

        return response()->json($response);
    }
}
