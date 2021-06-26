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
@if(Session::has('messageSuccess'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('messageSuccess') }}</p>
</div>
@endif()
@if(Session::has('messageError'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('messageError') }}</p>
</div>
@endif()
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">Liste patients</h2>

    </header>

    <div class="panel-body">
        @if(Auth::user()->typeUtilisateur == 'secretaire' || Auth::user()->typeUtilisateur == 'superAdmin')
        <a href="{{ route('patient.create') }}" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
        @endif
        <table class="table table-borered table-striped mb-none" id="tablePatient" data-swf-path="{{ asset('template/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf')}}">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date entrée</th>
                    <th>Type</th>
                    <th>Etat</th>
                    @if(Auth::user()->typeUtilisateur == 'secretaire' || Auth::user()->typeUtilisateur == 'superAdmin')
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $res)
                <tr>
                    <td>{{ $res->patient->id }}</td>
                    <td>{{ $res->patient->nom }}</td>
                    <td>{{ $res->patient->prenom }}</td>
                    <td>{{ $res->dateAdmission }}</td>
                    <td>{{ $res->patient->typePatient }}</td>
                    <td>
                        @if($res->patient->etatPatient == 0)
                        <span class="text-default">En attente de traitement</span>
                        @elseif($res->patient->etatPatient == 1)
                        <span class="text-primary">En traitement</span>
                        @elseif($res->patient->etatPatient == 2)
                        <span class="text-success">Sortie de l'hôpital</span>
                        @elseif($res->patient->etatPatient == 3)
                        <span class="text-warning">Sortie de l'urgence</span>
                        @elseif($res->patient->etatPatient == 4)
                        <span class="text-danger">Décéder</span>
                        @endif
                    </td>
                    @if(Auth::user()->typeUtilisateur == 'secretaire' || Auth::user()->typeUtilisateur == 'superAdmin')
                    <td class="actions">
                        <a href="{{ route('patient.show', ['id' => $res->patient->id]) }}" class="on-default" data-toggle="tooltip" data-placement="top" title="Information sur le patient"><i class="fa fa-eye"></i> </a>
                        <a href="{{ route('patient.edit', ['id' => $res->patient->id]) }}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Modifier le patient"><i class="fa fa-pencil"></i></a>
                        <a href="{{ route('patient.destroy', ['id' => $res->patient->id]) }}" class="on-default remove-row" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $res->patient->id }}').submit();" data-toggle="tooltip" data-placement="top" title="Supprimer le patient"><i class="fa fa-trash-o"></i></a>
                        <form id="delete-form-{{ $res->patient->id }}" action="{{ route('patient.destroy', ['id' => $res->patient->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
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