<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getUsers = User::all();
        return $getUsers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        //Autogenerate ID for the UUID
        $request['id'] = Str::uuid();
        $newUser = User::create($request->all());

        if ($newUser) {
            return response()->json([
                // 'data' => [
                'message' => 'Success',
                'userData' => $newUser,
                // ],
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getUsers = User::find($id);
        return $getUsers;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateUser = User::where('id', $id)->update($request->all());

        if ($updateUser) {
            return response()->json([
                'message' => 'Success',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteUser = User::where('id', $id)->delete();
        if ($deleteUser) {
            return response()->json([
                'message' => 'Success',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed',
            ], 400);
        }
    }
}
