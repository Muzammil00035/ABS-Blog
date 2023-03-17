<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured',
        'image',
        'interlink',
        'url',
        'interlink_image',
        'time_in_second',
        'meta_title',
        'meta_description',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        // $this->attributes['slug'] = Str::slug($value);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function headers()
    {
        return $this->hasMany(PostHeaders::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function previousPost()
    {
        return Post::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

    public function nextPost()
    {
        return Post::where('id', '>', $this->id)->orderBy('id')->first();
    }

    public function recentPost()
    {
        return Post::where("id", '!=', $this->id)->orderBy('id', 'desc')->take(5)->get();
    }
}
