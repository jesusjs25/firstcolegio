<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Rellenar con los campos validados (nombre, correo, etc.)
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // --- AQUÍ EMPIEZA NUESTRA LÓGICA DE LA FOTO ---
        if ($request->hasFile('avatar')) {
            // 1. Si ya tiene una foto anterior, la borramos para no llenar el disco de basura
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // 2. Guardamos la nueva foto en storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
            
            // 3. Asignamos la ruta al campo avatar del usuario
            $user->avatar = $path;
        }
        // --- AQUÍ TERMINA ---

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
