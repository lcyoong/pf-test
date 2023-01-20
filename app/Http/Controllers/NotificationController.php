<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Notification;
use Illuminate\Http\Request;

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
                            ->paginate(10)
                            ->withQueryString();

        $users = User::get();

        return Inertia::render('Notification/Index', compact('notifications', 'search', 'users'));
    }
}
