<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function test(){
        return view('pages.uploadImage');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');

        $fileName = time().'.'.$image->getClientOriginalExtension();
        $imagePath = Storage::disk('database')->putFile('images', $image, $fileName);
        $imageModel = new Image;
        $imageModel->file = $imagePath;
        return $imageModel->save();
    }

    public function update($image, int $idImage){
        if($imageModel = Image::find($idImage)){
            return -1;
        }

        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = Storage::disk('database')->putFile('images', $image, $fileName);
        $imageModel->file = $imagePath;
        if($imageModel->save()){
            return $idImage;
        }else{
            return -1;
        }
    }

    public function create($image){

        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = Storage::disk('database')->putFile('images', $image, $fileName);
        $imageModel = new Image;
        $imageModel->file = $imagePath;
        return $imageModel->id;
    }
}