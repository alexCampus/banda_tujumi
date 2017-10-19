<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Image;

class ImagesController extends Controller
{
    public function index()
    {
    	$imgModel = new Image;
    	
    	$images = $imgModel->getAllImages();
        $categorie = [];
        foreach ($images as $key => $image) {
            $categorie[$image->categorie][$key] = $image;
        }
       	return view('medias', ['imageUrl' => 'img/galerie-grp.jpg','images' => $images, 'categorie' => $categorie]);
    }

    public function uploadView()
    {
    	return view('admin.upload');
    }

    public function store(Request $request)
    {
        $categorie = $request->input('categorie');
        if ($request->hasFile('image'))
        {
    		$request->file('image')->storeAs('public/' . $categorie, $request->file('image')->getClientOriginalName());
    		$url = Storage::url($request->file('image')->getClientOriginalName());

    		$img = new Image;

    		$img->name      = $request->file('image')->getClientOriginalName();
    		$img->title     = $request->input('title');
    		$img->categorie = $categorie;
    		
    		$img->save();

    		return redirect('/medias');
    	}
    	return 'The files is too big';
    }
}
