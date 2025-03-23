<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class LoginController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator) // Ошибки валидации
                ->withInput() // Старые данные формы
                ->with([
                    'custom_message', 'Пожалуйста, исправьте ошибки в форме',
                    'login' => 'true',
                    'status' => 'success'
                ]);

        }
        if(Auth::attempt($request->only('email', 'password'), $request->has('remember'))){
            $request->session()->regenerate();
            return redirect()->intended()->with('id' , User::where('email', $request->email)->first()->id);
        }
        return back()
                ->withErrors(['password' => 'Пароль неверный']) // Ошибки валидации
                ->withInput() // Старые данные формы
                ->with([
                    'custom_message', 'Пожалуйста, исправьте ошибки в форме',
                    'login' => 'true',
                    'status' => 'success'
                ]);

        
        
        
    }
}
