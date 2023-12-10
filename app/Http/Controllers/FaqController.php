<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Faq::get();
        return Inertia::render('About', [
            'faq' => $data
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddFaq');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Faq::find($id);
        return Inertia::render('Admin/AddFaq', [
            'faq' => $data,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Faq::create([
            'title' => $data['title'],
            'description' => $data['description']
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Faq::find($id);
        $data = $request->all();
        $model->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Faq::find($id)->delete();
    }
}
