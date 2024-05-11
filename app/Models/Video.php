<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'views',
        'videoPath',
        'imagePath',
        'user_id',
    ];

    public function commentaires()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function imageUrl():string
    {
        return Storage::disk('public')->url($this->imagePath);
    }

    public function videoUrl():string
    {
        return Storage::disk('public')->url($this->videoPath);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
