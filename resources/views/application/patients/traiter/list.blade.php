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

        <table class="table table-bordered table-striped mb-none" id="tablePatient" data-swf-path="{{ asset('template/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf')}}">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Type</th>
                    @if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'chefDeService' || Auth::user()->typeUtilisateur == 'superAdmin')
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
                    @if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'chefDeService' || Auth::user()->typeUtilisateur == 'superAdmin')
                    <td class="actions">
                        <a href="{{ route('patient.dossier.traiter', ['id' => $res->id]) }}" class="on-default" data-toggle="tooltip" data-placement="top" title="Voir le dossier en cours du patient"><i class="fa fa-folder-open"></i> </a>
                        @if($res->etatVenue == 1)
                        <a href="{{ route('patient.archive.dossier', ['idPatient' => $res->id, 'option' => 'listTraiter']) }}" data-toggle="tooltip" data-placement="top" title="Voir la liste des dossiers du patient"><i class="fa fa-hospital-o"></i></a>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<script src="{{ asset('js/application/patients/patient.js')}}"></script>
@endsection