<?php

namespace App\Http\Controllers;

use App\Patients;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class DashboardController extends Controller
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
        $titre = 'Accueil';
        $chemin = 'Accueil';

        $patient = DB::table('patients')
            ->select(DB::raw('COUNT(*) as totalPatient'))
            ->where('etatPatient', 0)
            ->orWhere('etatPatient', 1)
            ->first();
        
        $patientAttente = DB::table('patients')
            ->select(DB::raw('COUNT(*) as patientAttente'))
            ->where('etatPatient', 0)
            ->first();

        $patientTraiter = DB::table('patients')
            ->select(DB::raw('COUNT(*) as patientTraiter'))
            ->where('etatPatient', 1)
            ->first();
        
        $patientArchiver = DB::table('patients')
            ->select(DB::raw('COUNT(*) as archive'))
            ->where(['etatPatient' => 1, 'etatVenue' => 1])
            ->orWhere([
                'etatPatient' => 1, 'etatVenue' => 1,
                'etatPatient' => 2,
                'etatPatient' => 3,
                'etatPatient' => 4
            ])->first();


        return view('application.dashboard.list', compact('titre', 'chemin', 'patient', 'patientAttente', 'patientTraiter', 'patientArchiver'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
