<?php

namespace App\Http\Controllers;

use App\DossierPatients;
use App\ImageDossiers;
use App\Maladies;
use App\Medicaments;
use App\Patients;
use App\Traitements;
use App\Urgences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PatientsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->typeUtilisateur != 'medecin') {
            $patients = Urgences::whereHas('patient', function ($query) {
                $query->where('etatPatient', 0)->orWhere('etatPatient', 1);
            })->get();

            $titre = 'Patients';
            $chemin = 'Patients';

            return view('application.patients.list', compact('patients', 'titre', 'chemin'));
        } else {
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
        if (Auth::user()->typeUtilisateur == 'superAdmin' || Auth::user()->typeUtilisateur == 'secretaire') {
            $titre = "Ajout Patient";
            $chemin = "Ajouter Patient";
            return view('application.patients.create', compact('titre', 'chemin'));
        } else {
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
        if (Auth::user()->typeUtilisateur == 'superAdmin' || Auth::user()->typeUtilisateur == 'secretaire') {
            $this->validateInput($request);

            $dataFind = $this->findDuplicate([
                ['nom', $request['nom']],
                ['prenom', $request['prenom']],
                ['sexe', $request['sexe']],
                ['age', $request['age']],
                ['adresse', $request['adresse']],
                ['tel', $request['tel']],
                ['typePatient', $request['typePatient']]
            ]);

            if ($dataFind != null) {
                Session::flash('messageExist', 'Ce patient est déjà dans la base de données, Demander à un médecin de créer un nouveau dossier pour le patient à l\'archive');
                return redirect()->route('patient.create');
            } else {
                $insertPatient = Patients::create([
                    'nom' => $request['nom'],
                    'prenom' => $request['prenom'],
                    'sexe' => $request['sexe'],
                    'age' => $request['age'],
                    'adresse' => $request['adresse'],
                    'tel' => $request['tel'],
                    'email' => $request['email'],
                    'typePatient' => $request['typePatient'],
                    'etatPatient' => 0,
                    'cin' => $request['cin'],
                    'user_id' => Auth::id()
                ]);

                if ($insertPatient) {
                    $insertUrgence = Urgences::create([
                        'dateAdmission' => date("Y/m/d"),
                        'motifAdmission' => $request['motifAdmission'],
                        'patient_id' => $insertPatient->id
                    ]);
                }

                if ($insertUrgence) {
                    Session::flash('messageSuccess', "Patient ajouter avec succès");
                    return redirect()->route('patient.index');
                } else {
                    Session::flash('messageError', "Une erreur est survenue lors de l'insertion");
                    return redirect()->route('patient.create');
                }
            }
        } else {
            abort(403, 'Action non Autorisé');
        }
    }

    private function findDuplicate($params = [])
    {
        $dataFind = Patients::where($params)->first();
        return $dataFind;
    }

    private function findDuplicateUrgence($params = [])
    {
        $dataFindU = Urgences::where($params)->first();
        return $dataFindU;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->typeUtilisateur == 'secretaire' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $titre = 'Information patient';
            $chemin = 'patient';
            $data = Patients::has('urgence')->where('id', $id)->firstOrFail();

            return view('application.patients.show', compact('data', 'titre', 'chemin'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->typeUtilisateur == 'secretaire' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $titre = 'Modifier patient';
            $chemin = 'Modifier patient';
            $data = Patients::has('urgence')->where('id', $id)->first();

            return view('application.patients.edit', compact('data', 'titre', 'chemin'));
        } else {
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
        if (Auth::user()->typeUtilisateur == 'secretaire' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $this->validateInput($request);

            $dataFind = $this->findDuplicate([
                ['nom', $request['nom']],
                ['prenom', $request['prenom']],
                ['sexe', $request['sexe']],
                ['age', $request['age']],
                ['adresse', $request['adresse']],
                ['tel', $request['tel']],
                ['typePatient', $request['typePatient']]
            ]);

            $dataFindU = $this->findDuplicateUrgence([
                ['id', $request['idUrgence']],
                ['motifAdmission', $request['motifAdmission']]
            ]);

            if ($dataFind != null && $dataFindU != null) {
                Session::flash('messageExist', 'Vous n\'avez fait aucune modification');
                return redirect()->route('patient.edit', ['id' => $dataFind->id]);
            } else {
                $updatePatient = Patients::where('id', $id)->update([
                    'nom' => $request['nom'],
                    'prenom' => $request['prenom'],
                    'sexe' => $request['sexe'],
                    'age' => $request['age'],
                    'adresse' => $request['adresse'],
                    'tel' => $request['tel'],
                    'email' => $request['email'],
                    'typePatient' => $request['typePatient'],
                    'etatPatient' => 0,
                    'cin' => $request['cin'],
                    'user_id' => Auth::id()
                ]);

                if ($updatePatient) {
                    $updateUrgence = Urgences::where('id', $request["idUrgence"])->update([
                        'motifAdmission' => $request['motifAdmission'],
                    ]);
                }

                if ($updatePatient && $updateUrgence) {
                    Session::flash('messageSuccess', "Patient modifier avec succès");
                    return redirect()->route('patient.index');
                } else {
                    Session::flash('messaError', "Une erreur est survenue lors de la modification");
                    return redirect()->route('patient.edit', ['id' => $id]);
                }
            }
        } else {
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
        if (Auth::user()->typeUtilisateur == 'secretaire' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $patient = Patients::findOrFail($id);
            $delete = $patient->delete();

            if ($delete) {
                Session::flash('messageSuccess', "Le patient a été supprimer avec succès");
            } else {
                Session::flash('messageError', "Une erreur est survenue lors de la suppression");
            }

            return redirect()->route('patient.index');
        } else {
            abort(403, 'Action non autorisé');
        }
    }

    private function validateInput($request)
    {
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'age' => 'required',
            'sexe' => 'required',
            'adresse' => 'required',
            'tel' => 'required',
            'typePatient' => 'required',
            'cin' => 'required',
            'motifAdmission' => 'required'
        ]);
    }

    // liste des patient en attente de traitement
    public function indexAttente()
    {
        $titre = 'Liste des patients en attente de traitement';
        $chemin = 'Patient / En attente';
        $patients = Patients::has('urgence')->where('etatPatient', 0)->get();

        return view('application.patients.enAttenteDeTraitement.list', compact('patients', 'titre', 'chemin'));
    }

    // affichage donnée patient en attente de traitement pour la creation de son dossier
    public function traiterPatient($idPatient, $option = NULL, $idUrgence = NULL)
    {
        if (Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAmdin') {
            $patient = Patients::where('id', $idPatient)->first();
            $titre = 'Traiter le patient';
            $chemin = 'Patient / En attente / traiter';

            $maladies = Maladies::get();
            $medocs = Medicaments::get();
            return view('application.patients.enAttenteDeTraitement.create', compact('titre', 'maladies', 'medocs', 'chemin', 'patient', 'option', 'idUrgence'));
        } else {
            abort(404);
        }
    }

    // action de creation dossier
    public function traiter(Request $request, $option = NULL, $idUrgence = NULL)
    {
        if (Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $this->validateDossier($request);
            // echo $request['observationDossier'];
            $insertDossier = DossierPatients::create([
                'observation' => $request['observationDossier'],
                'dateDebut' => date('Y/m/d'),
                'patient_id' => $request['idPatient'],
                'analyseBacteriologique' => $request['analyseBact'],
                'analyseChimique' => $request['analyseChim']
            ]);

            if ($insertDossier) {
                if ($request['interpretationRadio'] && $request->hasFile('radio') ||  $request['interpretationScan'] && $request->hasFile('scanner')) {

                    if ($request->hasFile('radio')) {

                        $imageNameRadioArr = [];
                        foreach ($request['radio'] as $fileRadio) {
                            $imageRadioName = time() . '-' . $fileRadio->getClientOriginalName();
                            $imageNameRadioArr[] = $imageRadioName;
                            $fileRadio->move(public_path('uploads/radio'), $imageRadioName);

                            ImageDossiers::create([
                                'radio' => "uploads/radio/{$imageRadioName}",
                                'interpretation' => $request['interpretationRadio'],
                                'dossier_patient_id' => $insertDossier['id']
                            ]);
                        }
                    }

                    if ($request->hasFile('scanner')) {

                        if ($request->hasFile('scanner')) {
                            $imageNameScannerArr = [];
                            foreach ($request['scanner'] as $filescanner) {
                                $imageScannerName = time() . '-' . $filescanner->getClientOriginalName();
                                $imageNameScannerArr[] = $imageScannerName;
                                $filescanner->move(public_path('uploads/scanner'), $imageScannerName);

                                ImageDossiers::create([
                                    'scanner' => "uploads/scanner/{$imageScannerName}",
                                    'interpretation' => $request['interpretationScan'],
                                    'dossier_patient_id' => $insertDossier['id']
                                ]);
                            }
                        }
                    }
                }

                for ($i = 0; $i < count($request['medicament']); $i++) {
                    Traitements::create([
                        'user_id' => Auth::id(),
                        'maladie_id' => $request['maladie'][$i],
                        'medicament_id' => $request['medicament'][$i],
                        'dossier_patient_id' => $insertDossier['id']
                    ]);
                }

                Patients::where('id', $request['idPatient'])->update([
                    'etatPatient' => 1
                ]);

                if (!is_null($option)) {
                    // remise à zero ny compteur ao amn urgence
                    Urgences::where('id', $idUrgence)->update([
                        'dateAdmission' => date('Y-m-d'),
                        'motifAdmission' => $request['motifAdmission'],
                        'dateSortieUrgence' => NULL,
                        'motifSortieUrgence' => NULL,
                        'dateSortieHopital' => NULL,
                        'motifSortieHopital' => NULL
                    ]);
                }

                return redirect()->route('patient.index.attente')->with('messageSuccess', 'Dossier de la patient a été créer avec succès');
            } else {
                return redirect()->route('patient.traiter.attente', ['id' => $request['idPatient']])->with('messageError', 'Une erreur est survenue lors de la création du dossier');
            }
        } else {
            abort(403, 'Action non autorisé');
        }
    }

    // voir la liste des patients en cours de traitement
    public function indexTraiter()
    {
        $titre = 'Liste des patients traiter';
        $chemin = 'Patient / Traiter';
        $patients = Patients::has('urgence')->where('etatPatient', 1)->get();

        return view('application.patients.traiter.list', compact('titre', 'chemin', 'patients'));
    }

    // apperçu dossier patient
    public function dossierPatient($idPatient, $option = NULL)
    {
        if (Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'chefDeService' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $radio = [];
            $scanner = [];
            $radioComment = [];
            $scanComment = [];

            $titre = 'Dossier patient';
            $chemin = 'Patient / En cours de traitement / Dossier';
            $patient = Patients::find($idPatient)->urgence()->orderBy('id', 'desc')->first();
            $dossier = Patients::find($idPatient)->dossiers()->first();
            $imageDossier = DossierPatients::find($dossier->id)->imageDossier()->get();
            // echo var_dump($patient->patient->sexe); die;
            $traitement = Traitements::with('user', 'medicament', 'maladie', 'dossierPatient')
                ->where('dossier_patient_id', $dossier->id)
                ->get();

            $maladies = Maladies::get();
            $medocs = Medicaments::get();

            foreach ($imageDossier as $res) {
                if ($res->radio != NULL) {
                    array_push($radio, $res);
                    if (!in_array($res->interpretation, $radioComment)) {
                        array_push($radioComment, $res->interpretation);
                    }
                }

                if ($res->scanner != NULL) {
                    array_push($scanner, $res);
                    if (!in_array($res->interpretation, $scanComment)) {
                        array_push($scanComment, $res->interpretation);
                    }
                }
            }

            $radioInt = implode(", ", $radioComment);
            $scanInt = implode(", ", $scanComment);

            return view('application.patients.traiter.dossier', compact('titre', 'chemin', 'dossier', 'patient', 'radio', 'scanner', 'radioInt', 'scanInt', 'traitement', 'maladies', 'medocs', 'option'));
        } else {
            abort(404);
        }
    }

    private function validateDossier($request)
    {
        $this->validate($request, [
            'observationDossier' => 'required',
            'analyseChim' => 'required',
            'analyseBact' => 'required',
        ]);
    }

    // MAJ etatPatient
    public function updateEtatPatient(Request $request, $idPatient, $idUrgence, $idDossierP, $option = NULL)
    {
        if (Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $updateEtat = Patients::where('id', $idPatient)->update([
                'etatPatient' => $request['etatPatient'],
                'etatVenue' => 1
            ]);

            if ($updateEtat) {
                if ($request["etatPatient"] == 2) {
                    $updateUrgence = Urgences::where('id', $idUrgence)->update([
                        'dateSortieHopital' => date('Y-m-d'),
                        'motifSortieHopital' => $request['motifSortieHopitale']
                    ]);
                } elseif ($request['etatPatient'] == 3) {
                    $updateUrgence = Urgences::where('id', $idUrgence)->update([
                        'dateSortieUrgence' => date('Y-m-d'),
                        'motifSortieUrgence' => $request['motifSortieUrgence']
                    ]);
                } elseif ($request['etatPatient'] == 4) {
                    $updateUrgence = Urgences::where('id', $idUrgence)->update([
                        'dateDece' => date('Y-m-d'),
                        'motifDece' => $request['motifDeces']
                    ]);
                }

                if ($updateUrgence) {
                    DossierPatients::where('id', $idDossierP)->update([
                        'dateFin' => date('Y-m-d')
                    ]);

                    if ($option == 'printDossier') {
                        return redirect()->route('patient.dossier.traiter', ['patientTraiter' => $idPatient, 'option' => $option]);
                    } else {
                        return redirect()->route('patient.index.traiter')->with('messageSuccess', 'Verdicte modifier');
                    }
                }
            } else {
                return redirect()->back()->with('messageError', 'Erreur lors du verdict de la patient');
            }
        } else {
            abort(403, 'Action non autorisé');
        }
    }

    // list patient en archive
    public function listArchiveP()
    {
        $patients = Patients::where('etatPatient', 2)
            ->orWhere(['etatPatient' => 3, 'etatPatient' => 1, 'etatVenue' => 1, 'etatPatient' => 0])
            ->has('urgence')
            ->get();
        $titre = "Liste patients archivé";
        $chemin = "Patient / Archive";

        return view('application.patients.archiver.list', compact('patients', 'titre', 'chemin'));
    }

    // afficher la liste des dossiers d'un patient
    public function listDossier($idPatient, $option = NULL)
    {
        if (Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'chefDeService' || Auth::user()->typeUtilisateur == 'superAdmin') {
            $patient = Patients::where('id', $idPatient)->first();
            $dossiers = Patients::find($idPatient)->dossiers;
            $titre = "Liste de dossiers";
            $chemin = "Patients / Archive / Dossier";

            return view('application.patients.archiver.dossiers', compact('patient', 'dossiers', 'titre', 'chemin', 'option'));
        } else {
            abort(404);
        }
    }
}
