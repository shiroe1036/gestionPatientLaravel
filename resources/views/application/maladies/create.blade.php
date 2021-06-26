@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="#">
                    <i class="fa fa-h-square"></i>
                </a>
            </li>
            <li><span>{{ $chemin }}</span></li>
        </ol>
    </div>
</header>
@endsection

@section('content-body')
@if(Session::has('messageError'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('messageError') }}</p>
</div>
@endif()

@if(Session::has('messageExist'))
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>{{ Session('messageExist') }}</p>
</div>
@endif

<form action="{{ route('maladie.store') }}" method="POST" id="form">
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
                <div class="form-group{{ $errors->has('nomMaladie') ? 'has-error' : '' }}">
                    <label for="" class="col-sm-3 control-label">Maladie <span class="required">*</span> </label>
                    <div class="col-sm-9">
                        <input type="text" name="nomMaladie" placeholder="nom maladie" class="form-control" value="{{ old('nomMaladie') }}" required autofocus>
                    </div>

                    @if($errors->has('nomMaladie'))
                    <label for="nomMaladie" class="error">{{ $errors->first('nomMaladie') }}</label>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Valider</button>
                    <a href="{{ route('maladie.index') }}" class="btn btn-default">Annuler</a>
                </div>
            </div>
        </div>
    </section>
</form>

<script src="{{ asset('js/application/maladies/validation.js') }}"></script>
@endsection