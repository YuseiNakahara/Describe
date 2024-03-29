<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'describe_id',
        'comment',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function describe()
    {
        return $this->belongsTo(Describe::class);
    }
}