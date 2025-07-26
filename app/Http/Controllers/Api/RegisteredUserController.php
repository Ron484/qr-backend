<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreRegisteredUserRequest;
use App\Http\Requests\UpdateRegisteredUserRequest;
use App\Models\RegisteredUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegisteredUserResource;
use Illuminate\Validation\ValidationException;


class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = RegisteredUser::all();
        return RegisteredUserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegisteredUserRequest $request)
    {
        try {

            $registeredUser = RegisteredUser::create($request->all());
            return response()->json(
                new RegisteredUserResource($registeredUser),
            );
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 401);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage(), 'statusCode' => 500]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RegisteredUser $user)
    {
        try {
            $user = new RegisteredUserResource($user);

            if ($user) {
                return response()->json($user);
            }
            return response()->json(['message' => 'User not found'], 401);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage(), 'statusCode' => 500]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegisteredUser $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegisteredUserRequest $request, RegisteredUser $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegisteredUser $user)
    {
        //
    }


}
