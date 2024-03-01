<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\AllPost;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function storePost(Request $request)
    {
        try {
            DB::beginTransaction();
            $post = new Post();
            $all_post = new AllPost();

            $post->user_id = Auth::user()->id;
            $post->course_id = $request->course_id;
            $post->post = $request->post;
            $post->posted_date = Carbon::now('Asia/Dhaka')->format('d F, Y');
            $post->posted_time = Carbon::now('Asia/Dhaka')->format('h:i A');

            $post->files = json_encode([]);
            if ($request->file('files')) {
                $post->files = FileHelper::saveFiles($request->file('files'));
            }

            $post->save();

            $all_post->post_id = $post->id;
            $all_post->user_id = Auth::user()->id;
            $all_post->course_id = $request->course_id;
            $all_post->post_type = 'normal';

            $all_post->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage()
;        }

        return back()->with('success', 'Post saved successfully');
    }

    public function postLikeStore(Request $request)
    {
        $like = PostLike::where([['user_id', Auth::user()->id], ['post_id', $request->post_id]])->first();
        if ($like) {
            $like->delete();
        } else {
            $like = new PostLike();
            $like->user_id = Auth::user()->id;
            $like->post_id = $request->post_id;
            $like->save();
        }
    }

    public function postDetails($id)
    {
        $post = AllPost::with(['post', 'assignment', 'quiz', 'user', 'likes', 'comments'])->find($id);
        $post->like_count = count($post->likes);
        if (PostLike::where([['user_id', Auth::user()->id], ['post_id', $post->id]])->first()) {
            $post->is_liked = 1;
        } else {
            $post->is_liked = 0;
        }
        // return $post->comments[0];
        return view('front.pages.post.details', compact('post'));
    }

    public function postCommentStore(Request $request)
    {
        if ($request->comment && $request->id) {
            $comment = new Comment();

            $comment->post_id = $request->id;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;

            $comment->save();

            $comment->user = Auth::user();

            return view('front.pages.post.single_comment', compact('comment'));
        }
    }
}