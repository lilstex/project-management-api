<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login users
     */
    public function login(AuthRequest $request)
    {
        $validated = $request->validated();
        if(!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $validated['email'])->first();
        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'access_type' => 'Bearer'
        ], 200);
    }

   /**
     * Register users
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
    
        $user = User::create($validated);
        
        return response()->json([
            'data' => $user,
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'access_type' => 'Bearer'
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
