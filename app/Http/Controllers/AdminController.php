<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Categories;
use App\Models\Posts;
use App\Models\Faq;
use App\Models\Questions;

class AdminController extends Controller
{
    function admin() {
        $data = User::where('is_admin', 0)->get();

        return Inertia::render('Admin/Index', [
            'users' => $data,
        ]);
    }
    function categories() {
        $categories = Categories::with('user', 'type')->get();
        return Inertia::render('Admin/Categories', [
            'categories' => $categories,
        ]);
    }
    function posts() {
        $posts = Posts::with('user')->get();
        return Inertia::render('Admin/Posts', [
            'posts' => $posts,
        ]);
    }
    function faq() {
        $faq = Faq::get();
        return Inertia::render('Admin/Faq', [
            'faq' => $faq,
        ]);
    }
    function questions() {
        $questions = Questions::with('user')->get();
        return Inertia::render('Admin/Questions', [
            'questions' => $questions
        ]);
    }
}
