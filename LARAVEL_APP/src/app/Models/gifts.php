<?php

namespace App\Models;

use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gifts extends Model
{
    /** @use HasFactory<\Database\Factories\GiftsFactory> */
    use HasFactory;
    public function tags(){
        return $this->belongsToMany(tags::class,'gifts-tags','gift_id', 'tag_id'); //
    }
    use HasFactory;
    public function articles(){
        return $this->belongsToMany(tags::class,'articles-gifts','gift_id', 'article_id'); //
    }
    use HasFactory;
    public function users(){
        return $this->belongsToMany(tags::class,'gifts-users','gift_id', 'user_id'); //
    }
}
