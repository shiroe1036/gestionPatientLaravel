<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maladies;
use App\Medicaments;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class MaladiesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maladies = Maladies::orderBy('id', 'desc')->paginate(3);
        $titre = "Maladie";
        $chemin = "Maladie";

        return view('application.maladies.list', compact('maladies', 'titre', 'chemin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin'){
            $titre = "Ajout maladie";
            $chemin = "Ajouter maladie";
            return view('application.maladies.create', compact('titre', 'chemin'));
        }else{
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $this->validateInput($request);

            $dataFind = $this->findDuplicate([['nomMaladie', $request['nomMaladie']]]);


            if ($dataFind != null) {
                Session::flash('messageExist', "{$request['nomMaladie']} Existe déjà");
                return redirect()->route('maladie.create');
            } else {
                $insert = Maladies::create([
                    'nomMaladie' => $request['nomMaladie']
                ]);

                if ($insert) {
                    Session::flash('messageSuccess', "{$request['nomMaladie']} Ajouter avec succès");
                    return redirect()->route('maladie.index');
                } else {
                    Session::flash('messageError', "Une erreur est survenue lors de l'insertion");
                    return redirect()->route('maladie.create');
                }
            }
        } else {
            abort(403, 'Action non autorisé');
        }
    }

    private function findDuplicate($params = [])
    {
        $dataFind = Maladies::where($params)->first();

        return $dataFind;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin'){
            $titre = 'Modifier maladie';
            $chemin = 'Modifier maladie';
            $data = Maladies::findOrFail($id);
    
            return view('application.maladies.edit', compact('data', 'titre', 'chemin'));
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $this->validateInput($request);

            $data = [
                'nomMaladie' => $request['nomMaladie']
            ];

            $maladie = Maladies::where('id', $id)->update($data);

            if ($maladie) {
                Session::flash('messageSuccess', "{$request['nomMaladie']} Modifier avec succès");
            } else {
                Session::flash('messageError', "Une erreur est survenue lors de la modification");
            }

            return redirect()->route('maladie.index');
        }else{
            abort(403, 'Action non autorisé');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin'){
            $maladie = Maladies::findOrFail($id);
            $delete = $maladie->delete();
    
            if ($delete) {
                Session::flash('messageSuccess', "{$maladie['nomMaladie']} Supprimer avec succès");
            } else {
                Session::flash('messageError', "Une erreur est survenue lors de la suppression");
            }
    
            return redirect()->route('maladie.index');
        }else{
            abort(403, 'Action non autorisé');
        }
    }

    private function validateInput($request)
    {
        $this->validate($request, [
            'nomMaladie' => 'required'
        ]);
    }

    public function getData()
    {
        $data = Maladies::get();

        return response()->json($data);
    }
}
