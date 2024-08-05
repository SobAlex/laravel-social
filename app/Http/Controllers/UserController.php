<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Models\PostImage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Post\PostResource;

class UserController extends Controller
{

    public function index() {

        $users = User::whereNot('id', auth()->id())->get();

        return UserResource::collection($users);
    }

    public function post(User $user)
    {
        return PostResource::collection($user->posts);
    }


}
