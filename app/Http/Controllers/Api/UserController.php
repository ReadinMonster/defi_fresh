<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmployeeRequest;

class UserController extends Controller
{
  public function index()
  {
      $users = User::all();
      $data = UserResource::collection($users);
      return response()->json($data);
  }

  public function store(CreateEmployeeRequest $request)
  {      
      $validated = $request->validated();
      
      $input = $request->all();

      $user = User::create($input);

      if($user->save())
      {
        return response()->json(['message' => 'User successfuly saved!', $user, 200]);
      }

      return response()->json(['message' => 'Failed to save User', $user]);
  }

  public function show($id)
  {
      $user = User::findOrFail($id);
      $data = new UserResource($user);
      return response()->json($data);
  }

  public function update(CreateEmployeeRequest $request, $id)
  {
      $validated = $request->validated();
      
      $updatedUserInfo = [
          'first_name' => $request->first_name,
          'middle_name' => $request->middle_name,
          'last_name' => $request->last_name,
          'position' => $request->position,
          'sex' => $request->sex,
          'email' => $request->email,
      ];

      $updatedUser = User::where('id', $id)
          ->update($updatedUserInfo);
      
      $user = User::where('id', $id)->update($request->all(), $id);
      return response()->json(['message' => 'User successfuly updated!', $user, 200]);
  
  }

  public function destroy($id)
  {
      $user = User::findOrFail($id);
      
      if($user->delete())
      {
          return response()->json(['message' => 'User successfuly deleted!', $data]);
      }

      return response()->json(['message' => 'Failed to remove User.', $data]);

  }
}
