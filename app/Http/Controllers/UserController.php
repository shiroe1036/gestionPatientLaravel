<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index(){
        if(Auth::user()->typeUtilisateur == 'superAdmin'){
            $users = User::all();
            $titre = 'Liste utilisateurs';
            $chemin = 'Utilisateurs';
    
            return view('application.utilisateurs.list', compact('users', 'titre', 'chemin'));
        }else{
            abort(404);
        }
    }

    public function edit($id, $option = NULL){
        $titre = "Modifier utilisateur";
        $chemin = "utilisateurs / Modifier";
        $data = User::findOrFail($id);

        return view('application.utilisateurs.edit', compact('titre', 'chemin', 'data', 'option'));
    }

    public function update(Request $request, $id, $option = NULL){
        $this->validateInput($request);

        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'prenom' => $request['prenom'],
            'tel' => $request['tel'],
            'typeUtilisateur' => $request['typeUtilisateur']
        ];

        $user = User::where('id', $id)->update($data);

        if($user){
            if(is_null($option)){
                return redirect()->route('utilisateur.index')->with('messageSuccess', "{$user['name']} Modifier avec succès");
            }else{
                return redirect()->route('profile.index', ['id' => Auth::id()])->with('messageSuccess', 'Votre profile a bien été modifier avec succès');
            }
        }else{
            return redirect()->back()->with('messageError', 'Une erreur est survenue lors de la modification');
        }
    }

    public function destroy($id){
        if(Auth::user()->typeUtilisateur == 'superAdmin'){
            $user = User::findOrFail($id);
            $delete = $user->delete();
    
            if($delete){
                Session::flash('messageSuccess', "{$user['name']} Supprimer avec succès");
            }else{
                Session::flash('messageError', "Une erreur est survenue lors de la suppression");
            }
    
            return redirect()->route('utilisateur.index');
        }else{
            abort(403, 'Action non autorisé');
        }
    }

    private function validateInput($request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'prenom' => 'required',
            'tel' => 'required',
            'typeUtilisateur' => 'required'
        ]);
    }
}
