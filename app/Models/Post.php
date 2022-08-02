<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'image', 'content'];

    public static function boot(){

        parent::boot();
        static::creating(function($post) {
            $slug = Str::slug($post->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $post->slug = $count ? "{$slug}-{$count}" : $slug;
        });

    }
}
