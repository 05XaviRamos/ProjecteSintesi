<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Mostra la llista d'usuaris.
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $users = User::query()->latest()->get();

        return view('admin.users.user-management', compact('users'));
    }

    /**
     * Mostra el formulari de creació d'usuaris.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        return view('admin.users.create');
    }

    /**
     * Desa un usuari nou.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['required', 'boolean'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => (bool) $validated['is_admin'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuari creat correctament.');
    }

    /**
     * Mostra el formulari d'edició d'un usuari.
     *
     * @param User $user
     * @return View|RedirectResponse
     */
    public function edit(User $user): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Actualitza les dades d'un usuari.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['required', 'boolean'],
        ]);

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => (bool) $validated['is_admin'],
        ];

        if (! empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);

        return redirect()->route('users.index')->with('success', 'Usuari actualitzat correctament.');
    }

    /**
     * Elimina un usuari.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'No pots eliminar el teu propi usuari.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuari eliminat correctament.');
    }
}
