<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'body' => 'array'
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected $fillable = [
        'title',
        'body'
    ];

    public function getUppercaseTitleAttribute()
    {
        return strtoupper($this->title);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y M d', strtotime($value));   
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
