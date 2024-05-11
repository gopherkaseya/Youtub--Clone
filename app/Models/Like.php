<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'like',
        'dislike',
        'user_id',
        'video_id'
        ];
        
    public function user(){
        return $this->belongsTo(User::class);
    }
}
