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
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('messageError') }}</p>
</div>
@endif()
<form action="{{ route('patient.store') }}" id="form" method="POST">
    @csrf
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>
            <h2 class="panel-title">Ajout</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="form-group{{ $errors->has('nom') ? 'has-error' : '' }}">
                        <label for="nom" class="control-label">Nom <span class="required">*</span></label>
                        <input type="text" placeholder="Votre nom" name="nom" class="form-control" required>

                        @if($errors->has('nom'))
                        <label class="error">{{ $errors->first('nom') }}</label>
                        @endif
                    </div>
                </div>


                <div class="col-sm-4 col-md-4">
                    <div class="form-group{{ $errors->has('prenom') ? 'has-error' : '' }}">
                        <label for="prenom" class="control-label">Prénom <span class="required">*</span></label>
                        <input type="text" placeholder="Votre prenom" name="prenom" class="form-control" required>

                        @if($errors->has('prenom'))
                        <label for="prenom" class="error">{{ $errors->first('prenom') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('age') ? 'has-error' : '' }}">
                        <label for="age" class=" control-label">Age <span class="required">*</span></label>
                        <input type="number" placeholder="Votre age" name="age" class="form-control" required>

                        @if($errors->has('age'))
                        <label for="nom" class="error">{{ $errors->first('age') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="form-group{{ $errors->has('sexe') ? 'has-error' : '' }}">
                        <label for="sexe" class="control-label">Sexe <span class="required">*</span></label>

                        <select name="sexe" id="" class="form-control" required>
                            <option value="">Choisir votre sexe</option>
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                        </select>

                        @if($errors->has('sexe'))
                        <label for="nom" class="error">{{ $errors->first('sexe') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('adresse') ? 'has-error' : '' }}">
                        <label for="adresse" class="control-label">Adresse <span class="required">*</span></label>
                        <input type="text" placeholder="Votre adresse" name="adresse" class="form-control">

                        @if($errors->has('adresse'))
                        <label for="adresse" class="error">{{ $errors->first('adresse') }}</label>
                        @endif
                    </div>
                </div>

                <div class="col-sm-4 col-md-4">
                    <div class="form-group{{ $errors->has('tel') ? 'has-error' : '' }}">
                        <label for="tel" class="control-label">Téléphone <span class="required">*</span></label>

                        <input type="number" placeholder="Votre téléphone" name="tel" class="form-control">

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
                            <input type="email" placeholder="Votre email" name="email" class="form-control">

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
                            <option value="millitaire">Millitaire</option>
                            <option value="conventionne">conventionné</option>
                            <option value="civil">Civil</option>
                            <option value="pasf">PASF</option>
                        </select>
                        @if($errors->has('tel'))
                        <label for="typePatient" class="error">{{ $errors->first('typePatient') }}</label>
                        @endif
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group{{ $errors->has('cin') ? 'has-error' : '' }}">
                        <label for="cin" class="control-label">CIN <span class="required">*</span></label>

                        <input type="number" placeholder="CIN du patient" class="form-control" name="cin" required>

                        @if($errors->has('cin'))
                        <label for="cin" class="error">{{ $errors->first('cin') }}</label>
                        @endif
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group{{ $errors->has('motifAdmission') ? 'has-error' : '' }}">
                        <label for="motifAdmission" class="control-label">Motif d'urgence <span class="required">*</span></label>
                        <textarea name="motifAdmission" id="" rows="10" class="form-control"></textarea>

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
    </section>
</form>

<!-- <script src="{{ asset('js/application/patients/validation.js') }}"></script> -->
@endsection