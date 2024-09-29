<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $list = User::query()
            ->when(
                $request->filled('keywords'),
                function ($query) use ($request) {
                    $query->where('product_name', 'like', '%' . $request->keywords . '%')
                        ->orWhere('description', 'like', '%' . $request->keywords . '%');
                }
            )
            ->whereNot('id', auth()->user()->id)
            ->get();

        return view('users.index', compact('list'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'roles' => 'required||array',
            'roles.*' => Rule::in(Role::query()->pluck('name')->toArray())
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            $user->assignMultipleRoles($validated['roles']);

            return back()->with('success', 'Product created successfully!');
        } catch (\Exception $exception) {
            return back()
                ->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', ['needle' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'roles' => 'required',
        ]);

        try {
            $user->update([
                'name' => $validated['name']
            ]);

            $user->assignMultipleRoles($validated['roles']);

            return back()->with('success', 'User updated successfully!');
        } catch (\Exception $exception) {
            return back()
                ->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->roles()->detach();

            $user->delete();

            return back()->with('success', 'User deleted successfully!');
        } catch (\Exception $exception) {
            return back()
                ->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
