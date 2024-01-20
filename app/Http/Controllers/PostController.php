<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\AllPost;
use App\Models\Post;
use App\Models\PostLike;
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
        
        $post->files = [];
        if ($request->file('files')) {
            $post->files = FileHelper::saveFiles($request->file('files'));
        }

        $post->save();

        $all_post->post_id = $post->id;
        $all_post->user_id = Auth::user()->id;
        $all_post->course_id = $request->course_id;
        $all_post->post_type = 'normal';

        $all_post->save();

        return back()->with('success','Post saved successfully');
    }

    public function postLikeStore(Request $request) {
        $like = new PostLike();
        $like->user_id = Auth::user()->id;
        $like->post_id = $request->post_id;
        $like->save();
    }
}
