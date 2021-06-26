<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index($id){
        $titre = "Profile";
        $chemin = "Profile";

        $data = User::findOrFail($id);
        return view('application.profil.profil', compact('titre', 'chemin', 'data'));
    }
}
