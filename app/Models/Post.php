<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'user_id',
        'caption',
        'content',
        'isPinned',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function reactions(){
        return $this->morphMany(Reaction::class,'reactable');
    }

    public function reactionCount($type = null)
    {
        if ($type) {
            return $this->reactions()->where('type', $type)->count();
        }
        return $this->reactions()->count();
    }
}
