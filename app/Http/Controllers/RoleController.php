<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //
    public function getRoles(){
        $roles = Role::all();
        return response()->json([
            'message'=>'tout les roles disponibles',
            'data'=>$roles
        ],200);
    }

    public function getRole($id){
        $role = Role::find($id);
        if(is_null($role)){
            return response()->json([
                'message'=>'aucun role disponible',
            ],404);
        }
        return response()->json([
            'message'=>"liste des roles",
            'date'=>$role,
        ],200);
    }

    public function addRole(Request $request){
        $validator = Validator::make($request->all(),[
            'intitule'=>'required|between:2,100',
        ]);

        if($validator->fails()) {
            return response()->json(
               $validator->errors()->toJson(),400
            );
        }
        $role =Role::create($request->all());
        return response()->json([
            'message'=>'role ajouté',
             'data'=>$role
        ],200);
    }

    public function updateRole(Request $request, $id){
        $validator = Validato::make($request->all(),[
            'intitule'=>'required|between:2,100',
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $role::find($id);
        if(is_null($role)){
            return response()->json([
                'message'=>'le role nexiste pas ',
            ],404);
        }
        $role->update($request->all());
        return response()->json([
            'message'=>'role modifié',
            'data'=>$role
        ],200);
    }

    public function deleteRole($id){
        $role = Role::find($id);
        if(is_null($role)){
            return response()->json([
                'message'=>'le role nexiste pas ',
            ],404);
        }

        $role->delete($id);
        return response()->json('role supprimé',200);
    }
}
