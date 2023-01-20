<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{
    /**
     * List users
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::where('name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")                    
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();

        return Inertia::render('User/Index', compact('users', 'search'));
    }
}