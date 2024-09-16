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
        'privacy',
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


    public function scopeWithReactionCounts($query)
    {
        return $query->withCount([
            'reactions as heart_count' => function ($query) {
                $query->where('type', 'heart');
            },
            'reactions as happy_count' => function ($query) {
                $query->where('type', 'happy');
            },
            'reactions as dislike_count' => function ($query) {
                $query->where('type', 'dislike');
            },
            'reactions as mad_count' => function ($query) {
                $query->where('type', 'mad');
            },
            'reactions as sad_count' => function ($query) {
                $query->where('type', 'sad');
            },
            'reactions' // Total reactions count
        ]);
    }
}
