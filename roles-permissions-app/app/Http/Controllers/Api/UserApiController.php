<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Illuminate\Http\Response;
use App\Models\User as UserResource;

class UserApiController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/users",
 *     tags={"Users"},
 *     summary="Get list of users",
 *     description="Returns a list of users",
 *     @OA\Response(response="200", description="List of users"),
 *     @OA\Response(response="401", description="Unauthorized"),
 * )
 */
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
 * @OA\Delete(
 *     path="/api/usersdelete/{id}",
 *     tags={"Users"},
 *     summary="Delete a user by ID",
 *     description="Deletes a user by their ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of user to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response="204", description="User deleted successfully"),
 *     @OA\Response(response="401", description="Unauthorized"),
 *     @OA\Response(response="404", description="User not found"),
 * )
 */
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(null, 204);
    }

    /**
 * @OA\Post(
 *     path="/api/users",
 *     tags={"Users"},
 *     summary="Create a new user",
 *     description="Creates a new user with the provided information",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Provide user information",
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
 *             @OA\Property(property="password", type="string", example="mypassword"),
 *         )
 *     ),
 *     @OA\Response(response="201", description="User created successfully"),
 *     @OA\Response(response="401", description="Unauthorized"),
 *     @OA\Response(response="422", description="Unprocessable Entity"),
 * )
 */
    public function createUser(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 422);
        // }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json($user, 201);
    }

/**
 * @OA\Put(
 *     path="/api/useredit/{id}",
 *     tags={"Users"},
 *     summary="Update a user",
 *     description="Update an existing user with the provided information",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Provide updated user information",
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated User Name"),
 *             @OA\Property(property="email", type="string", example="updated.email@example.com"),
 *         )
 *     ),
 *     @OA\Response(response="200", description="User updated successfully"),
 *     @OA\Response(response="401", description="Unauthorized"),
 *     @OA\Response(response="404", description="User not found"),
 *     @OA\Response(response="422", description="Unprocessable Entity"),
 * )
 */
    public function editUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users,email,' . $user->id,
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 422);
        // }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json($user, 200);
    }

}