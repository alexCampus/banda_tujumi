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
       	return view('FO.medias', ['imageUrl' => 'img/galerie-grp.jpg','categorie' => $categorie]);
    }

    public function uploadView()
    {
        $imgModel = new Image();
        $images   = $imgModel->getAllImages();
        $categories = [];
        foreach ($images as $key => $image) {
            $categories[$image->categorie][$key] = $image;
        }
    	return view('BO.Media.upload', ['categories' => $categories]);
    }

    public function deleteView()
    {
        $imgModel = new Image;
        
        $images = $imgModel->getAllImages();
        $categorie = [];
        foreach ($images as $key => $image) {
            $categorie[$image->categorie][$key] = $image;
        }
        return view('BO.Media.deleteImages', ['categorie' => $categorie]);
    }

    public function store(Request $request)
    {

        if ($request->categorieInput === '' && $request->categorieSelect != '') {
            $categorie = $request->categorieSelect;
        } else if ($request->categorieSelect === '' && $request->categorieInput != ''){
            $categorie = $request->categorieInput;
        } else {
            return redirect('/uploadImages')->with('status', 'Vous devez choisir OU saisir une catégorie.');
        }
        if ($request->hasFile('image'))
        {
    		$request->file('image')->storeAs('public/' . $categorie, $request->file('image')->getClientOriginalName());
    		$url = Storage::url($request->file('image')->getClientOriginalName());

    		$img = new Image;

    		$img->name      = $request->file('image')->getClientOriginalName();
    		$img->title     = $request->input('title');
    		$img->categorie = $categorie;
    		$img->save();

    		return redirect('/admin/adminMedia');
    	}
    	//@TODO PREVOIR UNE ALERTE ET PR2CISER LA TAILLE MAX
        return redirect('/uploadImages')->with('status', 'Le fichier est supérieur à 3Mo.');
    }

    public function deleteStore($id, Request $request) 
    {
        Image::destroy($id);
        Storage::delete($request->img);
        return redirect('/deleteImages');
    }
}
