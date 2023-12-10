<?php

namespace App\Http\Controllers;

use App\Models\Answers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $response = Answers::create([
            'description' => $data['description'],
            'users_id' => Auth::id(),
            'questions_id' => $data['questions_id'],
        ]);
        return response()->json(Answers::with('user')->find($response['id']));
    }
}
