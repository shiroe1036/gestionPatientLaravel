@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="#">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>{{ $chemin }}</span></li>&nbsp;
        </ol>
    </div>
</header>
@endsection

@section('content-body')
@if($option == 'listTraiter')
<a href="{{ route('patient.index.traiter') }}" class="btn btn-primary"><i class="fa fa-tasks"></i> Liste des patients Traiter</a>
@else
<a href="{{ route('patient.index.archive') }}" class="btn btn-primary"><i class="fa fa-tasks"></i> Liste des patients archiver</a>
@endif
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>
        <h2 class="panel-title">Liste dossiers de {{ $patient->nom }} {{ $patient->prenom }}</h2>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none" id="tableDossier" data-swf-path="{{ asset('template/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf')}}">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Observation</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Analyse Bactériologique</th>
                        <th>Analyse Chimique</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dossiers as $res)
                        <tr>
                            <td> {{$res->id}} </td>
                            <td> {{$res->observation}} </td>
                            <td> {{$res->dateDebut}} </td>
                            <td> @if($res->dateFin) {{$res->dateFin}} @else N/A @endif</td>
                            <td> {{$res->analyseBacteriologique}} </td>
                            <td> {{$res->analyseChimique}} </td>
                            <td class="actions">
                                <a href="{{ ($option == $option)? route('patient.dossier.traiter', ['id' => $patient->id, 'option' => 'listTraiter']) : route('patient.dossier.traiter', ['id' => $patient->id, 'option' => 'archive']) }}" class="on-default" data-toggle="tooltip" data-placement="top" title="Ouvrir le dossier"><i class="fa fa-folder-open"></i> </a>
                                <a href="{{ ($option == $option)? route('patient.dossier.traiter', ['id' => $patient->id, 'option' => 'printDossierArchive']) : route('patient.dossier.traiter', ['id' => $patient->id, 'option' => 'archive']) }}" class="on-default"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Imprimer le dossier"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="{{ asset('js/application/patients/archiver/archive.js') }}"></script>
@endsection