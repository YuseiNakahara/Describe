<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;
use App\Services\SearchingScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Describe extends Model
{

    protected $fillable = [
        'id',
        'user_id',
        'category',
        'title',
        'comments',
        'url',
        'content',
        'image_url',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'describes';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function timeCategory()
    {
        return $this->belongsTo(TimeCategory::class);
    }

    public function searchingWord($inputs)
    {
        return $this->filterEqual('tag_category_id', $inputs['tag_category_id'])
                    ->filterLike('title', $inputs['searchword'])
                    ->orderby('created_at', 'desc')
                    ->get();
    }

    public function createImage($inputs, $describeImage)
    {
        $this->create([
            'user_id' => $inputs['user_id'],
            'title' => $inputs['title'],
            'content' => $inputs['content'],
            'url' => $inputs['url'],
            'image_url' => $describeImage
        ]);
    }

}

