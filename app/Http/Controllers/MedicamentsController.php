<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicaments;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class MedicamentsController extends Controller
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
        if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin'){
            $data = Medicaments::orderBy('id', 'desc')->get();
            $titre = 'Medicament';
            return view('application.medicaments.list', compact('data', 'titre'));
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin'){
            $titre = 'Ajout médicament';
            return view('application.medicaments.create', compact('titre'));
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
        if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin'){
            $this->validateInput($request);

            Medicaments::create([
                'nomMedicament' => $request['nomMedicament']
            ]);
    
            Session::flash('messageSuccess', "{$request['nomMedicament']} Ajouter avec succès");
            return redirect()->route('medoc.index');
        }else{
            abort(403, 'Action non autorisé');
        }
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
            $titre = 'Modifier médicament';

            $data = Medicaments::findOrFail($id);
    
            return view('application.medicaments.edit', compact('data', 'titre'));
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
        if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin'){
            $this->validateInput($request);

            $data = [
                'nomMedicament' => $request['nomMedicament']
            ];
    
            Medicaments::where('id', $id)->update($data);
    
            Session::flash('messageSuccess', "{$request['nomMedicament']} Modifier avec succès");
    
            return redirect()->route('medoc.index');
        }else{
            abort(403, 'Action non Autorisé');
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
            $medoc = Medicaments::findOrFail($id);
            $medoc->delete();
    
            Session::flash('messageSuccess', "{$medoc['nomMedicament']} Supprimer avec succès");
            return redirect()->route('medoc.index');
        }else{
            abort(403, 'Action non autorisé');
        }
    }

    private function validateInput($request)
    {
        $this->validate($request, [
            'nomMedicament' => 'required'
        ]);
    }

    public function getAll(){
        $data = Medicaments::get();

        return response()->json($data);
    }
}
