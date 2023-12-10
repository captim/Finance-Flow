<?php

namespace App\Http\Controllers;

use App\Models\PostsComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsCommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = PostsComments::create([
            'users_id' => Auth::id(),
            'posts_id' => $request->posts_id,
            'description' => $request->description
        ]);
        return response()->json(PostsComments::with('user')->find($response['id']));
    }
}
