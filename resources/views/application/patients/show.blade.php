@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-wheelchair"></i>
                </a>
            </li>
            <li><span>{{ $chemin }}</span></li>
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
        <h2 class="panel-title">Information sur {{ $data->nom }} {{ $data->prenom }}</h2>
    </header>
    <div class="panel-body">
    <a href="{{ route('patient.index') }}" class="btn btn-primary mb-5"><i class="fa fa-tasks"></i> Liste patients</a>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="nom" class="control-label"><strong>Nom : </strong></label>
                    {{ $data->nom }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="prenom" class="control-label"><strong>Prénom : </strong></label>
                    {{ $data->prenom }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="age" class="control-label"><strong>Age : </strong></label>
                    {{ $data->age }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="sexe" class="control-label"><strong>Sexe : </strong></label>
                    {{ $data->sexe }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="adresse" class="control-label"><strong>Adresse : </strong></label>
                    {{ $data->adresse }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="tel" class="control-label"><strong>Téléphone : </strong></label>
                    {{ $data->tel }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="email" class="control-label"><strong>Email : </strong></label>
                    {{ ($data->email) ? $data->email : 'N/A' }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="typePatient" class="control-label"><strong>Type patient : </strong></label>
                    {{ $data->typePatient }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="cin" class="control-label"><strong>CIN : </strong></label>
                    {{ $data->cin }}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="motifAdmission" class="control-label"><strong>Motif d'admission : </strong></label>
                    {{ $data->urgence->motifAdmission }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection