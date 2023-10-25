<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\AllPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function storePost(Request $request) {
        $post = new Post();
        $all_post = new AllPost();

        $post->user_id = Auth::user()->id;
        $post->course_id = $request->course_id; 
        $post->post = $request->post;
        $post->posted_date = Carbon::now('Asia/Dhaka')->format('d F, Y');
        $post->posted_time = Carbon::now('Asia/Dhaka')->format('h:i A');
        $post->post_type = 'normal';
        
        $files = [];
        if ($request->file('files')) {
            $files = FileHelper::saveFiles($request->file('files'));
        }
        $post->files = json_encode($files);

        $post->save();

        $all_post->post_id = $post->id;
        $all_post->course_id = $request->course_id;
        $all_post->post_type = 'normal';

        $all_post->save();

        return back()->with('success','Post saved successfully');
    }
}
