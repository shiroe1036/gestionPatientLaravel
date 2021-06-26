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
@if(Session::has('messageExist'))
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('messageExist') }}</p>
</div>
@endif()
@if(Session::has('messageError'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('mesageError') }}</p>
</div>
@endif()
<form action="{{ route('patient.update', ['id' => $data->id]) }}" id="form" method="POST">
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
                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('nom') ? 'has-error' : '' }}">
                        <label for="nom" class="control-label">Nom <span class="required">*</span></label>
                        <input type="text" placeholder="Votre nom" name="nom" class="form-control" value="{{ $data->nom }}" required>

                        @if($errors->has('nom'))
                        <label for="nom" class="error">{{ $errors->first('nom') }}</label>
                        @endif
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('prenom') ? 'has-error' : '' }}">
                        <label for="prenom" class="control-label">Prénom <span class="required">*</span></label>
                        <input type="text" placeholder="Votre prenom" name="prenom" class="form-control" value="{{ $data->prenom }}" required>

                        @if($errors->has('prenom'))
                        <label for="prenom" class="error">{{ $errors->first('prenom') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('age') ? 'has-error' : '' }}">
                        <label for="age" class=" control-label">Age <span class="required">*</span></label>
                        <input type="number" placeholder="Votre age" name="age" class="form-control" value="{{ $data->age }}">

                        @if($errors->has('age'))
                        <label for="nom" class="error">{{ $errors->first('age') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('sexe') ? 'has-error' : '' }}">
                        <label for="sexe" class="control-label">Sexe <span class="required">*</span></label>

                        <select name="sexe" id="" class="form-control" required>
                            <option value="">Choisir votre sexe</option>
                            <option value="homme" {{ ($data->sexe == 'homme') ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ ($data->sexe == 'femme') ? 'selected' : '' }}>Femme</option>
                        </select>

                        @if($errors->has('sexe'))
                        <label for="nom" class="error">{{ $errors->first('sexe') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('adresse') ? 'has-error' : '' }}">
                        <label for="adresse" class="control-label">Adresse <span class="required">*</span></label>
                        <input type="text" placeholder="Votre adresse" name="adresse" class="form-control" value="{{ $data->adresse }}">

                        @if($errors->has('adresse'))
                        <label for="adresse" class="error">{{ $errors->first('adresse') }}</label>
                        @endif
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('tel') ? 'has-error' : '' }}">
                        <label for="tel" class="control-label">Téléphone <span class="required">*</span></label>

                        <input type="text" placeholder="Votre téléphone" name="tel" class="form-control" value="{{ $data->tel }}">

                        @if($errors->has('tel'))
                        <label for="nom" class="error">{{ $errors->first('tel') }}</label>
                        @endif
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" placeholder="Votre email" name="email" class="form-control" value="{{ $data->email }}">

                            @if($errors->has('tel'))
                            <label for="email" class="error">{{ $errors->first('email') }}</label>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('typePatient') ? 'has-error' : '' }}">
                        <label for="typePatient" class="control-label">Type patient <span class="required">*</span></label>
                        <select name="typePatient" id="" class="form-control" required>
                            <option value="">Choisir Type patient</option>
                            <option value="millitaire" {{ ($data->typePatient == 'millitaire') ? 'selected' : '' }}>Millitaire</option>
                            <option value="conventionne" {{ ($data->typePatient == 'conventionne') ? 'selected' : '' }}>conventionné</option>
                            <option value="civil" {{ ($data->typePatient == 'civil') ? 'selected' : '' }}>Civil</option>
                            <option value="pasf" {{ ($data->typePatient == 'pasf') ? 'selected' : '' }}>PASF</option>
                        </select>
                        @if($errors->has('tel'))
                        <label for="typePatient" class="error">{{ $errors->first('typePatient') }}</label>
                        @endif
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('cin') ? 'has-error' : '' }}">
                        <label for="cin" class="control-label">CIN <span class="required">*</span></label>

                        <input type="number" placeholder="CIN du patient" class="form-control" name="cin" value="{{ $data->cin }}" required>

                        @if($errors->has('cin'))
                        <label for="cin" class="error">{{ $errors->first('cin') }}</label>
                        @endif
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group{{ $errors->has('motifAdmission') ? 'has-error' : '' }}">
                        <label for="motifAdmission" class="control-label">Motif d'urgence <span class="required">*</span></label>
                        <input type="hidden" name="idUrgence" value="{{ $data->urgence->id }}">
                        <textarea name="motifAdmission" id="" rows="10" value="" class="form-control">{{ $data->urgence->motifAdmission }}</textarea>
                        

                        @if($errors->has('motifAdmission'))
                        <label for="typePatient" class="error">{{ $errors->first('motifAdmission') }}</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Valider</button>
                    <a href="{{ route('patient.index') }}" class="btn btn-default">Annuler</a>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
</form>

<script src="{{ asset('js/application/patients/validation.js') }}"></script>
@endsection