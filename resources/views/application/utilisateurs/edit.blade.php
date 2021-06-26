@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-users"></i>
                </a>
            </li>
            <li><span>{{ $chemin }}</span></li>
        </ol>
    </div>
</header>
@endsection

@section('content-body')
@if(Session::has('messageError'))
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('messageError') }}</p>
</div>
@endif()
<form action="{{ ($option == 'profileEdit') ? route('utilisateur.update', ['id' => $data->id, 'option' => $option]) : route('utilisateur.update', ['id' => $data->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>
            <h2 class="panel-title">Modifier</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Nom</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

                        @if ($errors->has('name'))
                        <label for="name" class="error">{{ $errors->first('name') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('prenom') ? 'has-error' : '' }}">
                        <label for="prenom" class="control-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" value="{{ $data->prenom }}" required autofocus>

                        @if($errors->has('prenom'))
                        <label for="prenom" class="error">{{ $errors->first('prenom') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('tel') ? 'has-error' : '' }}">
                        <label for="tel" class="control-label">Téléphone</label>
                        <input type="number" class="form-control" name="tel" value="{{ $data->tel }}" required autofocus>

                        @if($errors->has('tel'))
                        <label for="tel" class="error">{{ $errors->first('tel') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $data->email }}" required autofocus>

                        @if ($errors->has('email'))
                        <label for="email" class="error">{{ $errors->first('email') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" class="control-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required autofocus>
                        @if ($errors->has('password'))
                        <label for="password" class="error">{{ $errors->first('password') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="password-confirm" class="control-label">Confirmer mot de passe</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autofocus>
                    </div>
                </div>
                @if(Auth::user()->typeUtilisateur == 'superAdmin')
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('typeUtilisateur') ? 'has-error' : '' }}">
                        <label for="typeUtilisateur" class="control-label">Type d'utilisateur</label>
                        <select name="typeUtilisateur" id="typeUtilisateur" required autofocus class="form-control">
                            <option value="">Choisir le type</option>
                            @if(Auth::user()->typeUtilisateur == 'superAdmin')
                            <option value="superAdmin" {{ ($data->typeUtilisateur == 'superAdmin') ? 'selected' : '' }}>Super utilisateur</option>
                            @endif
                            <option value="chefDeService" {{ ($data->typeUtilisateur == 'chefDeService') ? 'selected' : '' }}>Chef de service</option>
                            <option value="medecin" {{ ($data->typeUtilisateur == 'medecin') ? 'selected' : '' }}>Médecin</option>
                            <option value="secretaire" {{ ($data->typeUtilisateur == 'secretaire') ? 'selected' : '' }}>Sécrétaire</option>
                        </select>

                        @if ($errors->has('typeUtilisateur'))
                        <label for="typeUtilisateur" class="error">{{ $errors->first('typeUtilisateur') }}</label>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Valider</button>
                    <a href="{{ ($option == 'profileEdit') ? route('profile.index', ['id' => Auth::user()->id]) : route('utilisateur.index') }}" class="btn btn-default">Annuler</a>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection