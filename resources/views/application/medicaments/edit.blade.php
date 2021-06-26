@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="#">
                    <i class="fa fa-medkit"></i>
                </a>
            </li>
            <li><span>{{ $titre }}</span></li>
        </ol>
    </div>
</header>
@endsection

@section('content-body')
<form action="{{ route('medoc.update', ['id' => $data->id]) }}" method="POST" id="form">
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
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Medicament <span class="required">*</span> </label>
                    <div class="col-sm-9">
                        <input type="text" name="nomMedicament" placeholder="nom medicament" class="form-control" value="{{ $data->nomMedicament }}" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button class="btn btn-primary">Valider</button>
                    <a href="{{ route('medoc.index') }}" class="btn btn-default">Annuler</a>
                </div>
            </div>
        </div>
    </section>
</form>

<script src="{{ asset('js/application/medicaments/validation.js') }}"></script>
@endsection