<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\gifts;
use App\Models\User;

class FavoriteController extends Controller
{
    public function add($id){
        
            // Проверка авторизации
        if (Auth::check()) {
            // Логика для авторизованного пользователя
            $user = Auth::user()->id;
            $user = User::where('id', $user)->first();
            $user->gifts()->toggle($id);
            return response()->json(['message' => 'ok']);
        } 
        else {
            // Редирект для неавторизованного пользователя
            return redirect('/Auth')->with('error', 'Пожалуйста, войдите в систему.');
    }
    }
    public function fav(){
        
            // Проверка авторизации
        if (Auth::check()) {
            // Логика для авторизованного пользователя
            $gifts = Auth::user()->gifts;
            return view('Favorite')->with(['gifts' => $gifts]);
        } 
        else {
            // Редирект для неавторизованного пользователя
            return redirect('/Auth')->with('error', 'Пожалуйста, войдите в систему.');
    }
    }
    
}
