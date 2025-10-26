<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // List users for admin
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Delete user (prevent deleting admins)
    public function destroy(User $user)
    {
        if ($user->is_admin) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Неможливо видалити адміністратора.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Користувача видалено.');
    }
}
