<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit() {
        $user = auth()->user();
        $addresses = $user->addresses;
        return view('profile.edit', compact('user', 'addresses'));
    }

    public function update(UpdateProfileRequest $request) {
        $user = $request->user();
        $data = $request->validated();
        // Avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) Storage::disk('public')->delete($user->avatar);
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        $user->update($data);
        return back()->with('success', 'Profile updated!');
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        $user = $request->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password salah']);
        }
        $user->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password updated!');
    }
}
