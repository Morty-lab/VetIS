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
        'read',
        'message',
        'link',
    ];

    public static function getNotifsForUser($user_id)
    {
        return self::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
    }

    public static function addNotif($data)
    {
        // Get all user IDs that have the role specified in 'visible_to'
        $role = $data['visible_to'];
        $userIds = [];
        if (in_array($role, User::ROLES)) {
            $userIds = User::where('role', $role)->pluck('id')->toArray();
            // Add user ID 1 to the list of user IDs
            if (!in_array(1, $userIds)) {
                $userIds[] = 1;
            }
        } else {
            $userIds = [$role];
        }


        // Replace 'visible_to' with the string of user IDs
        $data['visible_to'] = implode(',', $userIds);

        return self::create($data);
    }
}
