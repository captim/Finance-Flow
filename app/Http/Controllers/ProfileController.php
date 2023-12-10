<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class ProfileController extends Controller
{
    protected $publicStorage = "/uploads/users/";
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $model = User::find(Auth::id());
        $data = $request->all();
        if (isset($request['newPhoto']) && $request['newPhoto'] != "null" && $request['newPhoto'] != "undefined") {
            $name =  $this->publicStorage . uniqid() . '.' . $request['newPhoto']->getClientOriginalExtension();
            $request['newPhoto']->move(public_path() . $this->publicStorage, $name);
            $data['photo'] = $name;
        }
        $model->update($data);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateUser(Request $request, $id)
    {
        $data = $request->all();
        User::find($id)->update([
            'is_ban' => $data['is_ban'],
        ]);
    }
}
