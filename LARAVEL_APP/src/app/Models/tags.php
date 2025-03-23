<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    /** @use HasFactory<\Database\Factories\TagsFactory> */
    use HasFactory;
    public function gifts(){
        return $this->belongsToMany(gifts::class,'gifts-tags','tag_id', 'gift_id');//
    }
    public function articles(){
        return $this->belongsToMany(gifts::class,'articles-tags','tag_id', 'article_id');//
    }
}
