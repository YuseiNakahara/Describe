<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\SearchingScope;


class Describe extends Model
{

    use SearchingScope, SoftDeletes;


    protected $fillable = [
        'id',
        'user_id',
        'category',
        'title',
        'comments',
        'url',
        'content',
        'image_url',
        'likes_count',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'describes';

    public function user()
    {
        return $this->belongsToMany(User::class, 'describe_user');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function timeCategory()
    {
        return $this->belongsTo(TimeCategory::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function searchingWord($inputs)
    {
        return Describe::where('title', 'like', "%タイトル%")
                        ->where('title', $inputs['searchword'])
                        ->orderby('created_at', 'desc')
                        ->get();
    }

    public function createImage($inputs, $imageUrl)
    {
        $this->create([
            'user_id'   => $inputs['user_id'],
            'title'     => $inputs['title'],
            'content'   => $inputs['content'],
            'url'       => $inputs['url'],
            'image_url' => $imageUrl
        ]);
    }
}

