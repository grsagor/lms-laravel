<?php

namespace App\Http\Controllers;

use App\Models\AllPost;
use App\Models\Course;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;
use App\Models\SCR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function home(){
        $user = Auth::user();
        if ($user->role == 'student') {
            $courses = [];
            $scrs = SCR::where('student_id', $user->id)->with('course')->get();
            foreach ($scrs as $item) {
                $courses[] = $item->course;
            }
        } else {
            $courses = Course::where('teacher_id', $user->id)->get();
        }
        $courseIds = collect($courses)->pluck('id')->toArray();

        $posts = AllPost::whereIn('course_id',$courseIds)->with(['post', 'assignment', 'quiz', 'user', 'likes'])->get();
        $posts = PostLike::with('post')->get();
        return $posts;
        $data = [
            'posts' => $posts,
        ];
        return view('front.pages.home.home', $data);
    }
}
