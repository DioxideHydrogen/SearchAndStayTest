<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    
	public function login(Request $request) {
		
		$data = $request->post();

		$rules = [
			'email' => 'required|email',
			'password' => 'required',
 		];

		$messages = [
			'email.required' => 'The field email is required',
			'email.email' => 'The field email must be a email valid',
			'password.required' => 'The field password is required',
		];

		$validator = Validator::make($data, $rules, $messages);

		if($validator->fails()) return \response()->json(['error' => true, 'message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);

		$email = $data['email'];

		$password = $data['password'];

		if(Auth::attempt(['email' => $email, 'password' => $password])) {
			return \redirect()->route('books.list');
		}

		
	}

}
