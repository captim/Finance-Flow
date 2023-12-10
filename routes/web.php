<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserDatesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\PostsCommentsController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('admin', [AdminController::class, 'admin']);

    Route::get('admin/categories', [AdminController::class, 'categories']);
    Route::post('/admin/categories-delete/{id}', [CategoriesController::class, 'destroy']);

    Route::get('admin/posts', [AdminController::class, 'posts']);
    Route::get('admin/posts/create', [PostsController::class, 'create']);
    Route::post('admin/posts', [PostsController::class, 'store']);
    Route::get('admin/posts/{id}/edit', [PostsController::class, 'edit']);
    Route::put('admin/posts/{id}', [PostsController::class, 'update']);
    Route::post('admin/posts-delete/{id}', [PostsController::class, 'destroy']);

    Route::get('admin/faq', [AdminController::class, 'faq']);
    Route::get('admin/faq/create', [FaqController::class, 'create']);
    Route::post('admin/faq', [FaqController::class, 'store']);
    Route::get('admin/faq/{id}/edit', [FaqController::class, 'edit']);
    Route::put('admin/faq/{id}', [FaqController::class, 'update']);
    Route::post('admin/faq-delete/{id}', [FaqController::class, 'destroy']);

    Route::get('admin/questions', [AdminController::class, 'questions']);
    Route::get('admin/questions/{id}', [QuestionsController::class, 'showAdmin']);

    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/user/{id}', [ProfileController::class, 'updateUser']);

    Route::resource('posts', PostsController::class);
    Route::resource('categories', CategoriesController::class);
    Route::post('categories/{id}', [CategoriesController::class, 'update']);
    Route::resource('answers', AnswersController::class);
    Route::resource('comments', PostsCommentsController::class);
    Route::get('favorites', [PostsController::class, 'favorites']);
    Route::post('favorites/{id}', [PostsController::class, 'saveFavorites']);
    Route::get('about', [FaqController::class, 'index']);
    Route::get('questions', [QuestionsController::class, 'index']);
    Route::post('questions', [QuestionsController::class, 'store']);
    Route::post('questions-delete/{id}', [QuestionsController::class, 'destroy']);
    Route::get('questions/{id}', [QuestionsController::class, 'show']);
    Route::get('/wallet/{id}', [UserDatesController::class, 'index']);
    Route::get('/wallet-data/{id}', [UserDatesController::class, 'wallet']);
    Route::post('/wallet', [UserDatesController::class, 'store']);
    Route::post('/wallet/{id}', [UserDatesController::class, 'update']);
    Route::get('/statistic', [UserDatesController::class, 'statistic']);
    Route::get('/general-statistic', [UserDatesController::class, 'generalStatistic']);
    Route::post('/wallet-delete/{id}', [UserDatesController::class, 'destroy']);

    Route::get('/statistics', [UserDatesController::class, 'apiStatistic']);

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    });
});

Route::get('/course', [CourseController::class, 'get']);

require __DIR__.'/auth.php';
