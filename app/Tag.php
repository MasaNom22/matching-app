<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    
    public function getHashtagAttribute(): string
    {
        return '#' . $this->name;
    }
}
