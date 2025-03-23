<?php

namespace App\Http\Controllers;

use App\Models\gifts;
use App\Models\User;
use App\Models\tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Support\Facades\Auth;

class dbcontroller extends Controller{
    // функция добавления объектов в базу данных
    public function submit(Request $req) {
        $gift = new gifts();
        $gift->name = $req->input('descript_prompt');
        // $gift->description = "loxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
        // $gift->link = "lox";
        // $gift->tag = "lox";
        // $gift->photo = "lox";
        $gift->save();
        return redirect()->route('home')->with('success', 'Подарок успешно добавлен');
    }
    // получение данных из базы данных
    public function get(Request $req){
        $tag = tags::where('name', $req->input('descript_prompt'))->first();
        //dd($tag->id);
        //$tag = tags::find($tag->id);      
        $tag = $tag->gifts;

        return view('Results', ['gifts' => $tag]);
    }
    public function gift_page($id){
        $converter = new CommonMarkConverter();
        $gift = new gifts;
        $gifts = [
            '0' => '0'
        ];
        $el = $gift->find($id); //поиск подарка
        $source = $el->source;
        $tags = $el->tags;
        $descript = $el->description;
        $descript = $converter->convert($descript);
        //search gifts for tags
        foreach($tags as $tag){
            $gift_db = $tag->gifts ?? [];
            foreach($gift_db as $gift){
                if (Array_key_exists($gift->id, $gifts) == false){$gifts[$gift->id] = 1;}//add gift in array with start value
                else{$gifts[$gift->id] += 1;}//add value
            }
        }
        arsort($gifts);//сортируем по рейтингу
        $ids = array_keys($gifts);
        $perPage = 5;
        $gifts = gifts::whereIn('id', $ids)    
            ->orderByRaw("FIELD(id, " . implode(',', $ids) . ")")
            ->paginate($perPage);//создаем список подарков-объектов по этим ключам


        $photo_url[]= 'Images/' . $source . '_' . $id . '_1.jpg'; //добавляем возможные фото
        $j = 2;
        while($j<5){
            if (Storage::disk('ycs3')->exists('Images/' . $source . '_' . $id . '_'.$j.'.jpg')) {
                $photo_url[]= 'Images/' . $source . '_' . $id . '_'.$j.'.jpg';
            }
            $j += 1;
            
        }
        //dd($photo_url);
        return view('Product', ['gift' => $el], ['photos' => $photo_url])->with('description', $descript)->with('gifts', $gifts);
    }
    
    public function gift_search(Request $req) {
        $responseData= session('user_request');
        foreach($responseData as $data){
            $tags[] = tags::where('name', $data)->first();
        }
        $gifts = [
            '0' => '0'
        ];
        foreach($tags as $tag){ 
            //dd($tag->gifts);   
            $gift_db = $tag->gifts ?? [];
            foreach($gift_db as $gift){
                if (Array_key_exists($gift->id, $gifts) == false){$gifts[$gift->id] = 1;}
                else{$gifts[$gift->id] += 1;}
            }
            
        }
        arsort($gifts);//сортируем по рейтингу
        
        $ids = array_keys($gifts);//выделяем ключи из словаря
        $gifts = gifts::whereIn('id', $ids)    
            ->orderByRaw("FIELD(id, " . implode(',', $ids) . ")")
            ->paginate(20);//создаем список подарков-объектов по этим ключам
        return view('Results', ['gifts' => $gifts]);
    }
    // public function loadMore(Request $gifts)
    // {
    //     $perPage = 10;
    //     $gifts = gifts::whereIn('id', $ids)    
    //         ->orderByRaw("FIELD(id, " . implode(',', $ids) . ")")
    //         ->cursorPaginate($perPage);

    //     return response()->json([
    //         'products' => $products->items(),
    //         'next_cursor' => $products->nextCursor()?->encode(), // Кодируем курсор для следующего запроса
    //     ]);
    // }
}


     





