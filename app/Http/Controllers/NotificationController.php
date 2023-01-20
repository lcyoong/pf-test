<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNotification;

class NotificationController extends Controller
{
    /**
     * List notifications
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $notifications = Notification::where('text', 'like', "%$search%")
                            ->orWhere('type', 'like', "%$search%")                            
                            ->latest()
                            ->paginate(10)
                            ->withQueryString();

        $users = User::get()->mapWithKeys(function($item, $key) {
            return [$item['id'] => $item['name']];
        });

        $types = explode(',', env('NOTIFICATION_TYPE'));

        return Inertia::render('Notification/Index', compact('notifications', 'search', 'users', 'types'));
    }

    /**
     * Store new notification and related users
     */
    public function store(StoreNotification $request)
    {
        $input = $request->input();

        $notification = Notification::create($input);
        
        $notification->users()->sync(!empty($input['send_to']) ? $input['send_to'] : array_column(User::get(['id'])->toArray(), 'id'));

        return back();
    }
}
