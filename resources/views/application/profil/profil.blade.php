@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-user"></i>
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
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>
        <h2 class="panel-title">Votre profile</h2>
    </header>
    <div class="panel-body">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="name" class="control-label"><strong> Nom : </strong></label>
                {{ $data->name }}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="prenom" class="control-label"> <strong> Prenom : </strong> </label>
                {{ $data->prenom }}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="tel" class="control-label"> <strong> Téléphone : </strong> </label>
                {{ $data->tel }}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="email" class="control-label"> <strong> Email : </strong> </label>
                {{ $data->email }}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="typeUtilisateur" class="control-label"><strong>Type utilisateur : </strong></label>
                {{ $data->typeUtilisateur }}
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('utilisateur.edit', ['id' => $data->id, 'option' => 'profileEdit']) }}" class="btn btn-primary"><i class="fa fa-pencil"></i>&nbsp;Modifier</a>
            </div>
        </div>
    </div>
</section>
@endsection