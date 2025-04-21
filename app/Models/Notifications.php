<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [

        'visible_to',
        'notification_type',
        'title',
        'message',
        'link',
    ];

    public static function getNotifsForUser($user_id){
        return self::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
    }

    public static function addNotif($data){
        return self::create($data);
    }
}
