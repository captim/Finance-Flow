<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Questions::withCount('answers')->where('users_id', Auth::id())->get();
        return Inertia::render('Questions', [
            'questions' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $response = Questions::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'users_id' => Auth::id()
        ]);
        
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function showAdmin($id)
    {
        $data = Questions::with('answers.user', 'user')->find($id);
        return Inertia::render('Admin/Question', [
            'question' => $data
        ]);
    }
    public function show($id)
    {
        $data = Questions::with('answers.user', 'user')->find($id);
        return Inertia::render('Question', [
            'question' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Questions::find($id)->delete();
    }
}
