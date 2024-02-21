<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\SCR;
use App\Models\Course;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('front.pages.home.left-side', function ($view) {
            $user = Auth::user();
            if ($user->role == 'student') {
                $courses = [];
                $scrs = SCR::where([['student_id', $user->id], ['verified', 1]])->with('course')->get();
                foreach ($scrs as $item) {
                    $courses[] = $item->course;
                }
            } else {
                $courses = Course::where('teacher_id', $user->id)->get();
            }
    
            $data = [
                'courses' => $courses,
            ];
            $view->with('data', $data);
        });
    }
    
}
