<?php

namespace App\Http\Controllers;

use App\Models\gifts;
use Illuminate\Http\Request;

class maincontroller extends Controller
{
    public function home(){
        $gifts = gifts::orderBy('rate', 'desc')
                 ->limit(10)
                 ->get();
        return view('Giftiks', compact('gifts'));
    }
    public function loadMore(Request $request){
        $offset = $request->input('offset', 0); // Смещение для подгрузки
        $limit = 10; // Количество элементов для подгрузки
        $gifts = gifts::orderBy('rate', 'desc')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.gifts', compact('gifts'))->render(),
                'nextOffset' => $offset + $limit,
            ]);
        }
        return redirect()->back();
    }

    public function catalog(){
        $gifts = gifts::orderBy('rate', 'desc')
                   ->paginate(20);
        return view('Catalog')->with('gifts', $gifts);
    }
    public function auth(){
        return view('login');
    }
    public function auth_check(Request $request){
        $valid = $request->validate([
            'email' => 'required|min:4|max:100',
            'password' => 'required|min:4|max:100',
        ]);
        return view('login');
    }


}
