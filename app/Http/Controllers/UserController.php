<?php

namespace App\Http\Controllers;

use App\Rules\PasswordCompare;
use Illuminate\Http\Request;
use Image;
use Hash;
use Auth;

class UserController extends Controller
{
    public function view()
    {
        return view('user.profile');
    }

    public function edit()
    {
        return view('user.edit', ['user' => \Auth::user()]);
    }

    public function save(Request $request)
    {
        $user = \Auth::user();

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'avatar' => 'image',
        ]);

        $user->name = $request->get('name');
        $user->description = $request->get('description');

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = uniqid($user->id) . '.' . $avatar->getClientOriginalExtension();

            if (!empty($user->avatar)) {
                $user->removeAvatar();
            }

            $user->avatar = $filename;
            Image::make($avatar)->resize(128, 128)->save($user->getAvatarPath());
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Your changes saved');
    }

    /**
     * Change password action
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'current_password' => ['required', new PasswordCompare(), 'max:32', 'min:4'],
                'new_password' => 'required|max:32|min:4',
            ]);

            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new_password'));
            $user->save();

            return redirect()->route('profile.view')->with('success', 'Your password successfully changed');
        }


        return view('user.password');
    }
}
