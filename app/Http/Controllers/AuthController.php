<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the unified access page (Register/Login).
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Handle the unified access request.
     */
    public function access(Request $request)
    {
        // Check if user exists by username
        $user = User::where('username', $request->username)->first();

        if ($user) {
            // User exists, attempt login
            $credentials = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return $this->redirectUser(Auth::user());
            }

            return back()->withErrors([
                'password' => 'Password salah untuk username ini.',
            ])->withInput($request->only('username'));
        } else {
            // User does not exist, perform registration
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:admin,siswa',
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            Auth::login($user);
            return $this->redirectUser($user);
        }
    }

    /**
     * Redirect user based on role.
     */
    protected function redirectUser($user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.index');
        }
        return redirect()->route('siswa.index');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/register'); // Redirect back to unified entry
    }
}
