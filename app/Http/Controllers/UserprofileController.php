<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\department;
use App\Models\GraduationProjects;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class UserprofileController extends Controller
{
    public function index(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }
    public function edit(Request $request): View
    {
        $categories = Category::all();
        $user = $request->user();
        $Projects = GraduationProjects::all();
        return view('userprofile.edit',['Projects' => $Projects, 'department' => department::all()], compact('categories'))->with('user', $user);
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('userprofile.edit')->with('status', 'userprofile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
