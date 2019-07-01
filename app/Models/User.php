<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Carbon;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'email',
        'avatar',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function dailyReport()
    {
        return $this->hasMany(DailyReport::class, 'user_id');
    }

    public function question()
    {
        return $this->hasMany(Question::class, 'user_id');
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'user_id')->where('date', Carbon::today()->format('Y-m-d'));
    }

    public function allAttendance()
    {
        return $this->hasMany(Attendance::class, 'user_id')->orderBy('date', 'desc');
    }

    public function createUserInstance($userId)
    {
        return $this->withTrashed()->whereNotNull('id')->firstOrNew(['user_id' => $userId]);
    }

    public function getUsers($userInfoId)
    {
        return $this->firstOrNew(['user_id' => $userInfoId]);
    }

    public function saveUserInfos($users, $UserInfos)
    {
        $users->fill([
            'name'          => $UserInfos->name,
            'user_id' => $UserInfos->id,
            'email'         => $UserInfos->email,
            'avatar'        => $UserInfos->avatar,
        ])->save();
    }

    public function restoreDeletedUser($userInfoId)
    {
        DB::transaction(function() use($userInfoId) {
            $this->withTrashed()->where('user_info_id', $userInfoId)->update(['deleted_at' => null]);
        });
    }
}

