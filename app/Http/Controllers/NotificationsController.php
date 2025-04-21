<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = DB::table('notifications')
            ->whereRaw('FIND_IN_SET(' . Auth::id() . ', visible_to)')
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // show first 10

        return view('notifications.index', compact('notifications'));
    }

    public function load(Request $request)
    {
        $notifications = DB::table('notifications')
            ->whereRaw('FIND_IN_SET(' . Auth::id() . ', visible_to)')
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'page', $request->get('page', 1));

        $view = view('notifications.partials.notification-items', compact('notifications'))->render();

        return response()->json(['html' => $view]);
    }
}
