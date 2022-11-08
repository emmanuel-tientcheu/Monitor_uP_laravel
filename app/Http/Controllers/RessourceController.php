<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;
use Illuminate\Support\Facades\Validator;


class RessourceController extends Controller
{
    //
    public function getRessources(){
        $ressources = Ressource::all();
        return response()->json([
            'message'=>'liste des ressources',
            'data'=>$ressources
        ],200);
    }

    public function getRessource($id){
        $ressource = Ressource::find($id);
        if(is_null($ressource)){
            return response()->json([
                'message'=>'la ressource n existe pas'
            ],404);
        }

        return response()->json([
            'message'=>'liste des ressources',
            'data'=>$ressource
        ]);
    }

    public function addRessource(Request $request){
        $validator = Validator::make($request->all(),[
            'id_departement'=>'required',
            'id_categorie'=>'required',
            'isDisponible'=>'required|boolean',
            'nom'=>'required|string',
            'description'=>'required|string',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $ressource = Ressource::create($request->all());
        return response()->json([
            'message'=>'ressource bien ajouté',
            'data'=>$ressource
        ],200);
    }

    public function updateRessource(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'id_departement'=>'required',
            'id_categorie'=>'required',
            'isDisponible'=>'required|boolean',
            'nom'=>'required|string',
            'description'=>'required|string',
        ]);

        
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $ressource = Ressource::find($id);
        if(is_null($ressource)){
            return response()->json(['message' => 'la ressorce est introuvable',404]);
        }
        $ressource->update($request->all());
        return response()->json([
            'message'=>'mise a jour de la ressource',
            'data'=>$ressource
        ],200);
    }

    public function deleteRessource($id){
        $ressource = Ressource::find($id);
        if(is_null($ressource)){
            return response()->json(['message' => 'la ressorce est introuvable',404]);
        }
        $ressource->delete($id);
        return response()->json('ressource supprimé',200);
    }
}


