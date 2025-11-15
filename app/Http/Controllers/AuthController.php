<?php

namespace App\Http\Controllers;

use App\Events\UserCreatedEvent;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Functions Returning to the View

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function showResetPasswordForm($token, $email)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    // Functions posting request to the database

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|min:3',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Logged in successfully!');
        }

        return redirect()->back()->with('error', 'The provided credentials do not match our records');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        Auth::login($user);

        event(new UserCreatedEvent($user));

        return redirect('/')->with('success', 'Registered Successfully');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return redirect()->back()->with('error', 'User with that email doesn\'t exists');
        }

        $token = Str::random(40);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );

        // send email instead of below
        Mail::to($user->email)->queue(new ResetPasswordMail($user, $token));

        return redirect()->route('login')->with('success', 'Reset Password Link Sent to your email');

        // return redirect()->route('password.reset', ['token' => $token, 'email' => $user->email])
        //     ->with('success', 'Password reset token generated');
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $reset_record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (! $reset_record) {
            return redirect()->back()->with('error', 'Invalid Reset token');
        }

        if (Carbon::parse($reset_record->created_at)->addHour()->isPast()) {
            DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

            return redirect()->back()->with('error', 'Invalid Reset token');
        }

        if (! Hash::check($validated['token'], $reset_record->token)) {
            return redirect()->back()->with('error', 'Invalid Reset token');
        }

        $user = User::where('email', $validated['email'])->first();
        if (! $user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password Reset Successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out Successfully');
    }
}
