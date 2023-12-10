<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\PostsFavorites;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    protected $publicStorage = "/uploads/users/";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Posts::with('user', 'favorite')->get();
        return Inertia::render('Posts', [
            'posts' => $data
        ]);
    }

    public function favorites()
    {
        $data = Posts::with('user', 'favorite')->whereHas('favorite', function($q) {
            $q->where('users_id', Auth::id());
        })->get();
        return Inertia::render('Favorites', [
            'posts' => $data
        ]);
    }

    function saveFavorites($id)
    {
        if (PostsFavorites::where('users_id', Auth::id())->where('posts_id', $id)->exists()) {
            PostsFavorites::where('users_id', Auth::id())->where('posts_id', $id)->delete();
        } else {
            PostsFavorites::create(
                [
                    'users_id' => Auth::id(),
                    'posts_id' => $id
                ]
            );
        }
        return response()->json(Posts::with('favorite')->find($id));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddPost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if (isset($request['newPhoto']) && $request['newPhoto'] != "null" && $request['newPhoto'] != "undefined") {
            $name =  $this->publicStorage . uniqid() . '.' . $request['newPhoto']->getClientOriginalExtension();
            $request['newPhoto']->move(public_path() . $this->publicStorage, $name);
            $data['preview'] = $name;
        }
        Posts::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'preview' => $data['preview'],
            'users_id' => Auth::id()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Posts::with('user', 'comments.user')->find($id);
        return Inertia::render('Post', [
            'post' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Posts::find($id);
        return Inertia::render('Admin/AddPost', [
            'post' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Posts::find($id);
        $data = $request->all();
        if (isset($request['newPhoto']) && $request['newPhoto'] != "null" && $request['newPhoto'] != "undefined") {
            $name =  $this->publicStorage . uniqid() . '.' . $request['newPhoto']->getClientOriginalExtension();
            $request['newPhoto']->move(public_path() . $this->publicStorage, $name);
            $data['preview'] = $name;
        }
        $model->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Posts::find($id)->delete();
    }
}
