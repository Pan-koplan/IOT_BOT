<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;
    public function gifts(){
        return $this->belongsToMany(gifts::class,'articles-gifts','article_id', 'gift_id'); //
    }
    public function tags(){
        return $this->belongsToMany(tags::class,'articles-tags','article_id', 'tag_id'); //
    }
}
