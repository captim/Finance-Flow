<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        Categories::find($id)->update([
            'title' => $data['title']
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Categories::create([
            'title' => $data['title'],
            'types_id' => $data['types_id'],
            'users_id' => Auth::id()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Categories::find($id)->delete();
    }
}
