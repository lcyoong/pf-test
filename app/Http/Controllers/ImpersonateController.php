<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\UserNotification;

class ImpersonateController extends Controller
{
    /**
     * Impersonate user (and retrieve its active notification).
     */
    public function index(Request $request, User $user)
    {
        $user->load(['activeNotifications' => function($query) {
            $query->latest();
        }]);

        return Inertia::render('Impersonate', compact('user'));
    }

    /**
     * Update a notification is read by user
     */
    public function read(Request $request, User $user, UserNotification $notification)
    {
        // Throw error if notification doesn't belong to user
        if ($notification->user != $user->id) {
            abort(403);
        }

        $notification->update([
            'read' => 1,
            'read_at' => Carbon::now()
        ]);

        return back();
    }
}
