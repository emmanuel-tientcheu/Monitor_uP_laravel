<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    //
    public function getCategories(){
        $categories = Categorie::all();
        return response()->json([
            'message'=>'toute les caregories',
            'data'=>$categories
        ],200);
    }

    public function getCategorie($id){
        $categories = Categorie::find($id);
        if(is_null($categories)){
            return response()->json([
                'message'=>'la categorie n existe pas',
            ],404);
        }
        return response()->json([
            'message'=>'la categorie a bien ete trouvé',
            'data'=>$categories
        ],200);
    }

    public function addCategorie(Request $request){
        $validator = Validator::make($request->all(),[
            'titre'=>'required|string|between:2,100',
        ]);

        if(validator($request->fails())){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $categorie = Categorie::create($request->all());
        return response()->json([
            'message'=>'la categorie a ete cree',
            'data'=>$categorie
        ],200);
    }
    
    public function updateCategorie(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'titre'=>'required|string|between:2,100',
        ]);

        if(($request->fails())){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $categorie = Categorie::find($id);
        if(is_null($categories)){
            return response()->json([
                'message'=>'la categorie n existe pas',
            ],404);
        }
        $categorie->update($request->all());
        return response()->json([
            'messsage'=>'categorie modifié',
            'data'=>$categories,
        ],200);
    }

    public function deleCategorie($id){
        $categorie = Categorie::find($id);
        if(is_null($categories)){
            return response()->json([
                'message'=>'la categorie n existe pas',
            ],404);
        }
        $categorie->delete($id);
        return response()->json('categorie supprimé',200);
    }
}
