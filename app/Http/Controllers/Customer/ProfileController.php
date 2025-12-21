<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit() {
        $user = auth()->user();
        $addresses = $user->addresses;
        $regions = $this->loadRegions();

        return view('profile.edit', compact('user', 'addresses', 'regions'));
    }

    public function update(UpdateProfileRequest $request) {
        $user = $request->user();
        $data = $request->validated();
        // Avatar upload
        if ($request->hasFile('picture')) {
            if ($user->picture) {
                Storage::disk('public')->delete($user->picture);
            }
            $data['picture'] = $request->file('picture')->store('avatars', 'public');
        } else {
            unset($data['picture']);
        }
        $user->update($data);
        return back()->with('success', 'Profile updated!');
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.'], 'password');
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password updated!');
    }

    private function loadRegions(): array
    {
        $path = resource_path('data/regions.json');

        if (! is_file($path)) {
            return [];
        }

        $payload = json_decode(file_get_contents($path), true);

        return $payload['provinces'] ?? [];
    }
}
