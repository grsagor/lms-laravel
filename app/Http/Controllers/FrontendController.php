<?php

namespace App\Http\Controllers;

use App\Models\AllPost;
use App\Models\Course;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SCR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        foreach ($posts as $post) {
            $post->like_count = count($post->likes);
            if (PostLike::where([['user_id', Auth::user()->id], ['post_id', $post->id]])->first()) {
                $post->is_liked = 1;
            } else {
                $post->is_liked = 0;
            }
        }
        $data = [
            'posts' => $posts,
        ];
        return view('front.pages.home.home', $data);
    }

    public function profile() {
        $user = Auth::user();
        return view('front.pages.profile.profile', compact('user'));
    }

    public function updateProfileInfo(Request $request) {
        try {
            $user = User::find(Auth::user()->id);

            $user->name = $request->name;
    
            if ($request->hasFile('dp')) {
                if ($user->dp != Null && file_exists(public_path($user->dp))) {
                    unlink(public_path($user->dp));
                }
                $image = $request->file('dp');
                $filename = time() . uniqid() . $image->getClientOriginalName();
                $image->move(public_path('uploads/user-images'), $filename);
                $user->dp = 'uploads/user-images/' . $filename;
            }
    
            $user->save();
            return back()->with('success', "User updated successfully.");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function changePassword(Request $request) {
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password == $request->confirm_password) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                Auth::logout();
                return redirect(route('login'))->with('success', "Password changed successfully.");
            } else {
                return back()->with('error', "New password and confirm password don't matched.");
            }
        } else {
            return back()->with('error', "Old password doesn't matched.");
        }
    }
}
