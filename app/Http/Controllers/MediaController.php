<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media ;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class MediaController extends Controller
{
    //
    public function getMedias(){
        $media = Media::all();
        return response()->json([
            'message' =>'tout les immages',
            'data'=>$media
        ],200);
    }

    public function getMedia($id){
        $media=Media::find($id);
        if(is_null($media)){
            return response()->json([
                'message' =>'le media nexiste pas',
            ],404);
        }

        return response()->json([
            'message' =>'le media a bien ete trouvé',
            'data'=>$media
        ],200);
    }

    public function addMedia(Request $request){
        
        $req->validate([
            'id_ressource'=>'required|integer',
            'file.*' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        if($rep->hasfile('file')){
            $file = $rep->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filePath = $file->storeAs('images', $fileName, 'public');

            $fileModal = new Media();

            $fileModal->fileName = ($fileName);
            $fileModal->filePath = ($filePath);
            $fileModal->extension = ($extension);
            $fileModal->id_ressource = $request->id_ressource;

            $fileModal->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $req->file,
            ]);
        }
    }

    public function updateMedia(Request $request, $id){
        $media = Media::find($id);
        if(is_null($media)){
            return response()->json(['message' => 'le media nexiste pas'],404);
        }

        $validator=Validator::make($request->all(),[
            'file'=>'required|mimes:png,jpeg',
            'id_ressource'=>'required|integer',
        ]);
      
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        if ($request->hasFile('file')) {
            $file = $request->file;
            $name =  date('Y').$file->getClientOriginalName();
            $path = $request->file->store('public/images');

            $media['filePath'] = $path;
            $media['fileName'] = $name;
        }
        $media->update($request->except('file'));
        return response()->json(['success' => true, 'message' => 'Partner updated successfully!', 
        'updated_data' => $found], 200);
    }

    public function deleteMedia($id){
        $media = Media::find($id);
        if(is_null($media)){
            return response()->json(['message' => 'image introuvable'],404);
        }
        $media->delete();
        return response()->json('la photo a ete supprimé');
    }

    public function searchFile($id){
        $file= Media::findOrFail($id);
        $image;
      if($image=File::exists(public_path('storage/images/'.$file->nom_image))){
        return response()->json($image);
      }else{
        return response()->json('non');
      }
    }
}
