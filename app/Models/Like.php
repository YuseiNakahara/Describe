<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\Describe;
use App\Model\User;

class Like extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'describe_id',
    ];

    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'likes';

    public function describe()
    {
        return $this->belongsTo(Describe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUserLike($query, $userId, $describeId) { //＄queryは、受け取る引数　UserIdとDesccribeIdを持っていている
        // dd($describeId);
        return $query->where('user_id', $userId)->where('describe_id', $describeId);
    }
}
