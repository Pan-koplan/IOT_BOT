<?php

namespace App\Http\Controllers;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\CommonMarkConverter;

class ArticleController extends Controller
{
    public function articles_main_page() {
        $articles[] = Articles::all();

        return view('Library', ['articles' => $articles[0]]);
        
        
    }
    public function article_page($id){
        $converter = new CommonMarkConverter();
        $article = new Articles();
        $el = $article->find($id); //поиск подарка
        $descripts = [];
        $articles = [
            '0' => '0'
        ];
        $gifts = $el->gifts;
        foreach($gifts as $gift){
            $descripts[] = $converter->convert($gift->description);
        }
        #dd($descripts);
        $tags = $el->tags;
        foreach($tags as $tag){
            $article_db = $tag->articles ?? [];
            foreach($article_db as $art){
                if (Array_key_exists($art->id, $articles) == false){$articles[$art->id] = 1;}//add gift in array with start value
                else{$articles[$art->id] += 1;}//add value
            }
        }
        arsort($articles);//сортируем по рейтингу
        $ids = array_keys($articles);
        $perPage = 5;
        $articles = Articles::whereIn('id', $ids)    
            ->orderByRaw("FIELD(id, " . implode(',', $ids) . ")")
            ->paginate($perPage);//создаем список подарков-объектов по этим ключам

       

        return view('reader', ['gifts' => $gifts], 
        ['article' => $el], 
        ['descripts' => $descripts])
        ->with('descriptions', $descripts)
        ->with('articles', $articles);
    }
}
