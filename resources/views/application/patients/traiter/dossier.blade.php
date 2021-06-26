@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>{{ $chemin }}</span></li>
        </ol>
    </div>
</header>
@endsection

@section('content-body')
@if(Session::has('messageSuccess'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('messageSuccess') }}</p>
</div>
@endif

@if(is_null($option))
<a href="{{ route('patient.index.traiter') }}" class="btn btn-primary mb-5"><i class="fa fa-tasks"></i>&nbsp;Listes patient en cours de traitement</a>
@elseif($option == 'listTraiter')
<a href="{{ route('patient.archive.dossier', ['idPatient' => $patient->patient->id, 'option' => 'listTraiter']) }}" class="btn btn-primary"><i class="fa fa-tasks"></i>&nbsp;Liste de dossiers de {{ $patient->patient->nom }} {{ $patient->patient->prenom }}</a>
@elseif($option == 'printDossier')
<a href="{{ route('patient.index.traiter') }}" class="btn btn-primary"><i class="fa fa-tasks"></i>&nbsp;Liste patients en traitement</a>
@else
<a href="{{ route('patient.archive.dossier', ['idPatient' => $patient->patient->id]) }}" class="btn btn-primary mb-5"><i class="fa fa-tasks"></i>&nbsp;Liste de dossiers de {{ $patient->patient->nom }} {{ $patient->patient->prenom }}</a>
@endif

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>
        <h2 class="panel-title">Dossier de {{ $patient->patient->nom }} {{ $patient->patient->prenom }}</h2>
    </header>
    <div class="panel-body" id="printable">

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Nom</strong></label>
                    {{ $patient->patient->nom }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Prenom</strong></label>
                    {{ $patient->patient->prenom }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Âge</strong></label>
                    {{ $patient->patient->age }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Sexe</strong></label>
                    {{ $patient->patient->sexe }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Adresse</strong></label>
                    {{ $patient->patient->adresse }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Téléphone</strong></label>
                    {{ $patient->patient->tel }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Type Patient</strong></label>
                    {{ $patient->patient->typePatient }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>CIN</strong></label>
                    {{ $patient->patient->cin }}
                </div>
            </div>
            @if($option == 'printDossier' || $option == 'printDossierArchive' || $option == 'listTraiter')
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Etat</strong></label>
                    @if($patient->patient->etatPatient == 0)
                    <span class="text-default">En attente de traitement</span>
                    @elseif($patient->patient->etatPatient == 1)
                    <span class="text-primary">En traitement</span>
                    @elseif($patient->patient->etatPatient == 2)
                    <span class="text-success">Sortie de l'hôpital</span>
                    <div><span><strong>Motif de sortie hôpitale : </strong></span> {{ ($patient->motifSortieHopital) ? $patient->motifSortieHopital : '' }}</div>
                    @elseif($patient->patient->etatPatient == 3)
                    <span class="text-warning">Sortie de l'urgence</span>
                    <div>
                        <span><strong>Motif de sortie Urgence : </strong></span> {{ ($patient->motifSortieUrgence) ? $patient->motifSortieUrgence : '' }}
                    </div>
                    @elseif($patient->patient->etatPatient == 4)
                    <span class="text-danger">Décéder</span>
                    <div>
                        <span><strong>Motif de Décès : </strong></span> {{ ($patient->motifDece) ? $patient->motifDece : '' }}
                    </div>
                    @endif
                </div>
            </div>
            @endif
            <div class="col-sm-12">
                <div class="form-group">
                    <h1>Info dossier</h1>
                    <label for="" class="control-label"> <strong>Observation : </strong> </label>
                    {{ $dossier->observation }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Analyse Bacteriologique : </strong></label>
                    {{ $dossier->analyseBacteriologique }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Analyse Chimique : </strong></label>
                    {{ $dossier->analyseChimique }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Début traitement : </strong></label>
                    {{ $dossier->dateDebut }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="" class="control-label"><strong>Fin traitement : </strong></label>
                    {{ ($dossier->dateFin) ? $dossier->dateFin : 'N/A' }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h1>RADIO</h1>
                    <label for="" class="control-label"><strong>Interpretation Radio : </strong></label>
                    {{ ($radioInt) ? $radioInt : 'N/A' }}
                </div>
                @if($option != 'printDossier' && $option != 'printDossierArchive' || $option == 'listTraiter' || is_null($option))
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableRadio">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Radio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($radio as $res)
                            <tr>
                                <td>{{ $res->id }}</td>
                                <td>
                                    <a href="{{ asset($res->radio) }}" target="_blank"><img src="{{ asset($res->radio) }}" alt="" height="60px" width="60px"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h1>Scanner</h1>
                    <label for="" class="control-label"><strong>Interpretation Scanner : </strong></label>
                    {{ ($scanInt) ? $scanInt : 'N/A' }}
                </div>
                @if($option != 'printDossier' && $option != 'printDossierArchive' || $option == 'listTraiter' || is_null($option))
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableScan">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Radio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scanner as $res)
                            <tr>
                                <td>{{ $res->id }}</td>
                                <td>
                                    <a href="{{ asset($res->scanner) }}" target="_blank"><img src="{{ asset($res->scanner) }}" alt="" height="60px" width="60px"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            @if($option == 'printDossier' || $option == 'printDossierArchive')
            <div class="col-sm-12">
                <h1>Traitements</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Maladie</th>
                                <th>Médicament</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($traitement as $res)
                            <tr>
                                <td>@if($res->maladie != NULL) {{ $res->maladie->nomMaladie }} @else N/A @endif</td>
                                <td> {{ $res->medicament->nomMedicament }} </td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if(is_null($option))
            <div class="col-sm-12">
                <h1>Traitements</h1>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableTraitement">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Maladie</th>
                                <th>Médicament</th>
                                <th>Médecin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($traitement as $res)
                            <tr>
                                <td> {{ $res->id }} </td>
                                <td>@if($res->maladie != NULL) {{ $res->maladie->nomMaladie }} @else N/A @endif</td>
                                <td> {{ $res->medicament->nomMedicament }} </td>
                                <td> {{ $res->user->name }} </td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin')
            <form action="{{ route('traitements.store', ['idDossierPatient' => $dossier->id]) }}" method="post">
                <div class="traitement">
                    <div class="col-sm-12">
                        <h1>Ajouter Traitement</h1>
                    </div>
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="control-label">Maladie</label>
                            <select class="form-control" name="maladie[]" id="">
                                <option value="">Choisir la maladie</option>
                                @foreach($maladies as $res)
                                <option value="{{$res->id}}">{{ $res->nomMaladie }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="control-label">Médicament <span class="required">*</span></label>
                            <div class="input-group mb-md">
                                <select name="medicament[]" id="" class="form-control" required>
                                    <option value="">Choisir le médicament</option>
                                    @foreach($medocs as $res)
                                    <option value="{{ $res->id }}">{{ $res->nomMedicament }}</option>
                                    @endforeach
                                </select>
                                <span class='input-group-addon btn-primary addInput'>+</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter traitement</button>
                    </div>
                </div>
            </form>
            <div>
                <form action="{{ route('patient.updateEtat', ['idPatient' => $patient->patient->id, 'idUrgence' => $patient->id, 'idDossierP' => $dossier->id, 'option' => 'printDossier']) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-12">
                        <h1>Verdicte pour le patient</h1>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="radio-custom radio-success">
                                <input type="radio" name="etatPatient" value="2" id="sortieHopitale" required>
                                <label for="sortieHopitale">Sortie hôpitale</label>
                            </div>
                            <div class="motifSortieHopitale"></div>
                            <div class="radio-custom radio-warning">
                                <input type="radio" name="etatPatient" value="3" id="sortieUrgence" required>
                                <label for="sortieUrgence">Sortie de l'urgence</label>
                            </div>
                            <div class="motifSortieUrgence"></div>
                            <div class="radio-custom radio-danger">
                                <input type="radio" name="etatPatient" value="4" id="deces" required>
                                <label for="deces">Décéder</label>
                            </div>
                            <div class="motifDeces"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Valider verdicte</button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
            @endif
        </div>
    </div>
    @if(is_null($option))
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <a href="{{ route('patient.index.traiter') }}" class="btn btn-default">Annuler</a>
            </div>
        </div>
    </div>
    @endif
    @if($option == 'printDossier' || $option == 'printDossierArchive')
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-default print">Imprimer</button>
            </div>
        </div>
    </div>
    @endif

</section>

<script src="{{ asset('js/application/patients/traiter/traiter.js') }}"></script>
@endsection