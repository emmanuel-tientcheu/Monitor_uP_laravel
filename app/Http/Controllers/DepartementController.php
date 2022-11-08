<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    //
    public function getDepartements(){
        $departements = Departement::all();
        return response()->json([
            'message'=>'liste de tout les departements',
            'data'=>$departements
        ],200);
    }
    
    public function getDepartement($id){
        $departement = Departement::find($id);
        if(is_null($departement)){
            return response()->json(['message'=>'departement introuvable'],404);
        }

        return response()->json([
            'message'=>'departement trouvé',
            'data'=>$departement
        ],200);
    }

    public function addDepartement(Request $request){
        $validator = Validator::make($request->all(),[
            'nomDepartement'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $departement = Departement::create($request->all());
        return response()->json([
            'message'=>'departement ajouté',
            'data'=>$departement,
        ],200);
    }

    public function updateDepartement(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'nomDepartement'=>'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $departement = Departement::find($id);
        if(is_null($departement)){
            return response()->json(['message'=>'departement introuvable'],404);
        }
        return response()->json([
            'message'=>'departement bien mis a jour',
            'data'=>$departement
        ],200);
    }

    public function deleteDepartement($id){
        $departement = Departement::find($id);
        if(is_null($departement)){
            return response()->json(['message'=>'departement introuvable'],404);
        }
        $departement->delete($id);
        return response()->json('departement bien supprimé',200);
    }
}
