<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\StoreRequest;
use App\Http\Requests\user\UpdateRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index () {

        $users = User::all();

        return UserResource::collection($users);
    }

    public function store (StoreRequest $request) {
        
        $validated = $request->validated();
        
        $user = User::firstOrCreate($validated);

        return new AuthResource($user);
    }

    public function show ($id) {
        
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function update (UpdateRequest $request, $id) {
        
        $validated = $request->validated();

        $user = User::findOrfail($id);

        $user->update($validated);

        return new UserResource($user);        
    }

    public function delete ($id) {
        
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'data' => [
                'massege' => 'User succesfuly deleted'
            ]
        ], 200);
    }
}
