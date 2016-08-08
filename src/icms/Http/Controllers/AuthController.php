<?php

namespace ICMS\Http\Controllers;

use Illuminate\Http\Request;
use ICMS\Http\Requests;
use Auth;

class AuthController extends Controller
{
	public function login()
	{
		return view('auth.login');
	}

	public function register()
	{
		return view('auth.register');
	}

	public function postLogin(Request $request)
	{
		$creds = $request->only(['email', 'password']);

		if (Auth::attempt($creds)) {
			return redirect()->route('app.home');
		}

		return redirect()->back()->withErrors(['user' => 'Wrong username or password.']);
	}

	public function postRegister(Request $request)
	{
		//
	}

	public function logout()
	{
		if (Auth::check()) {
			Auth::logout();
		}

		return redirect()->to(resolveRoute('app.home'));
	}

	public function profile()
	{
		return view('auth.profile');
	}
}
