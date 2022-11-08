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
        
        $request->validate([
            'id_ressource'=>'required|integer',
            'file.*' => 'mimes:jpeg,jpg,png|max:5048'
        ]);

        if($request->hasfile('file')){
            foreach($request->file('file') as $file)
          { 
            // $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filePath = $file->storeAs('images', $fileName, 'public');

            $fileModal = new Media();

            $fileModal->fileName = ($fileName);
            $fileModal->filePath = ($filePath);
        //    $fileModal->extension = ($extension);
            $fileModal->id_ressource = $request->id_ressource;

            $fileModal->save();
        }
        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "file" => $request->file,
        ]);
        }
    }

    public function updateMedia(Request $request, $id){
        $media = Media::find($id);
        if(is_null($media)){
            return response()->json(['message' => 'le media nexiste pas'],404);
        }
         $request->validate([
            'id_ressource'=>'required|integer',
            'file.*' => 'mimes:jpeg,jpg,png|max:5048'
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
        'updated_data' => $media], 200);
    }

    public function deleteMedia($id){
       $files = Media::findOrFail($id);
       if(Media::exists(public_path("storage/images".$files->fileName))){
        File::delete(public_path("storage/images".$files->fileName));
        Media::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'fichier bien supprimé'],200);
       } 
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
