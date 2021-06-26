@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="#">
                    <i class="fa fa-wheelchair"></i>
                </a>
            </li>
            <li><span>{{ $chemin }}</span></li>&nbsp;
        </ol>
    </div>
</header>
@endsection

@section('content-body')
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">Liste patients</h2>

    </header>

    <div class="panel-body">
        @if(Session::has('messageSuccess'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>{{ Session('messageSuccess') }}</p>
        </div>
        @endif()

        <table class="table table-bordered table-striped mb-none" id="tableArchive" data-swf-path="{{ asset('template/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf')}}">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Type</th>
                    <th>Etat</th>
                    @if(Auth::user()->typeUtilisateur != 'secretaire')
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $res)
                <tr>
                    <td>{{ $res->id }}</td>
                    <td>{{ $res->nom }}</td>
                    <td>{{ $res->prenom }}</td>
                    <td>{{ $res->typePatient }}</td>
                    <td>
                        @if($res->etatPatient == 0)
                        <span class="text-default">En attente de traitement</span>
                        <span>Admis le {{ $res->urgence->dateAdmission }}</span>
                        @elseif($res->etatPatient == 1)
                        <span class="text-primary">En traitement</span>
                        <span>Admis le {{ $res->urgence->dateAdmission }}</span>
                        @elseif($res->etatPatient == 2)
                        <span class="text-success">Sortie de l'hôpital</span>
                        <span>le {{ $res->urgence->dateSortieHopital }}</span>
                        @elseif($res->etatPatient == 3)
                        <span class="text-warning">Sortie de l'urgence</span>
                        <span>le {{ $res->urgence->dateSortieUrgence }}</span>
                        @elseif($res->etatPatient == 4)
                        <span class="text-danger">Décéder</span>
                        <span>le {{ $res->urgence->dateDece }}</span>
                        @endif
                    </td>
                    @if(Auth::user()->typeUtilisateur != 'secretaire')
                    <td class="actions">
                        @if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin')
                            @if($res->etatPatient != 4 && $res->etatPatient != 0 && $res->etatPatient != 1)
                            <a href="{{ route('patient.traiter.attente', ['idPatient' => $res->id, 'option' => 'retourPatient', 'idUrgence' => $res->urgence->id]) }}" data-toggle="tooltip" data-placement="top" title="Créer un nouveau dossier"><i class="fa fa-folder"></i></a>
                            @endif
                        @endif
                        @if(Auth::user()->typeUtilisateur != 'secretaire')
                        <a href="{{ route('patient.archive.dossier', ['idPatient' => $res->id]) }}" class="on-default" data-toggle="tooltip" data-placement="top" title="Voir les archives de dossier du patient"><i class="fa fa-folder-open"></i> </a>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<script src="{{ asset('js/application/patients/archiver/archive.js')}}"></script>
@endsection