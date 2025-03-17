<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validation unifiée
        $validated = $request->validated();
        $additionalData = $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);

        // Gestion avancée de l'avatar
        if ($request->hasFile('avatar')) {
            $this->updateAvatar($request->user(), $request->file('avatar'));
            $additionalData['avatar'] = $request->user()->avatar;
        }

        // Mise à jour atomique
        $request->user()->update(array_merge($validated, $additionalData));

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Gestion sécurisée de l'avatar
     */
    protected function updateAvatar($user, $file): void
    {
        Storage::disk('public')->delete($user->avatar);
        $user->avatar = $file->store('avatars', 'public');
        $user->save();
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
