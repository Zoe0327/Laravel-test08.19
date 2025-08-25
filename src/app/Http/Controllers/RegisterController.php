<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\FormRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function store(RegisterRequest $request)
    {
        $userData = $request->only(['name', 'email']);
        $userData['password'] = bcrypt($request->password);
        $userData['is_admin'] = true;

        User::create($userData);

        return redirect('/login')->with('success', '登録が完了しました');
    }
}
