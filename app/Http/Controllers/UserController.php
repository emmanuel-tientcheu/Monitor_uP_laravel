<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function getUsers(){
        $users = User::all();
        return  response()->json([
            'message'=>'liste des utilisateurs',
            'data'=>$users,
        ],200);
    }

    public function getUser($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json([
                'message'=>'l\'utilisateur n\'existe pas'
            ],404);
        }
        return response()->json([
            'message'=>'utilisateur trouvé',
            'data'=>$user
        ]);
    }

    public function addUser(Request $request){
        $validator = Validator::make($request->all(),[
            'nom'=>'required|string|between:2,100',
            'prenom'=>'required|string|between:2,100',
            'email'=>'required|string|email|max:100|unique:users',
            'password'=>'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create($request->all());
        return response()->json([
            'message' => 'utilisateur ajouté',
            'data'=> $user,
          ],200);
    }

    public function updateUser(Request $request , $id){
        $validator = Validator::make($request->all(),[
            'nom'=>'required|string|between:2,100',
            'prenom'=>'required|string|between:2,100',
            'email'=>'required|string|email|max:100|unique:users',
            'password'=>'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::find($id);
        $user->update($request->all());
        return  response()->json([
            'message'=>'utilisateur modifié',
            'data'=>$user
        ]);
    }

    public function deleteUser($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message' => 'utilisateur supprimé'],404);
        }
        $user->delete();
        return response()->json('utilisateur supprimé');

    }
}
