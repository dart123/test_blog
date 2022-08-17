<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'content',
        'post_id'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'id', 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->with('children');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
