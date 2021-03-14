<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'body',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'article_id', 'user_id')->withTimestamps();
    }
}
