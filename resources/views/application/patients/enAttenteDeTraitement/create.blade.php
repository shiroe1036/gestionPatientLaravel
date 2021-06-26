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
@endif
<form action="{{ ($option == 'retourPatient') ? route('patient.traiter', ['option' => $option, 'idUrgence' => $idUrgence]) : route('patient.traiter') }}" method="POST" enctype="multipart/form-data">
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
                <input type="hidden" name="idPatient" value="{{ $patient->id }}">
                @if($option == 'retourPatient')
                <div class="col-sm-12">
                    <div class="form-group{{ $errors->has('motifAdmission') ? 'has-error' : '' }}">
                        <label for="" class="control-label">Motif d'admission à l'urgence <span class="required">*</span></label>
                        <textarea name="motifAdmission" id="" rows="4" class="form-control" required></textarea>
                        @if($errors->has('motifAdmission'))
                        <label for="motifAdmission" class="error">{{ $errors->first('motifAdmission') }}</label>
                        @endif
                    </div>
                </div>
                @endif
                <div class="col-sm-12">
                    <div class="form-group{{ $errors->has('observationDossier') ? 'has-error' : '' }}">
                        <label for="observationDossier" class="control-label">Observation <span class="required">*</span></label>
                        <textarea name="observationDossier" class="form-control" id="" rows="4" required></textarea>
                        @if($errors->has('observation'))
                        <label for="" class="error">{{ $errors->first('observationDossier') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('analyseBact') ? 'has-error' : '' }}">
                        <label for="analyseBact" class="control-label">Analyse bacteriologique <span class="required">*</span></label>
                        <textarea name="analyseBact" id="" class="form-control" rows="6" required></textarea>
                        @if($errors->has('analyseBact'))
                        <label for="" class="error">{{ $errors->first('analyseBact') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('analyseChim') ? 'has-error' : '' }}">
                        <label for="analyseChim" class="control-label">Analyse chimique <span class="required">*</span></label>
                        <textarea name="analyseChim" class="form-control" id="" rows="6" required></textarea>
                        @if($errors->has('analyseChim'))
                        <label for="" class="error">{{ $errors->first('analyseChim') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('radio') ? 'has-error' : '' }}">
                        <label for="" class="control-label">Image Radio</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                <div class="uneditable-input">
                                    <i class="fa fa-file fileupload-exists"></i>
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileupload-exists">Change</span>
                                    <span class="fileupload-new">Select file</span>
                                    <input type="file" name="radio[]" multiple accept="image/*" />
                                </span>
                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                @if($errors->has('radio'))
                                <label for="" class="error">{{ $errors->first('radio') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('interpretation') ? 'has-error' : '' }}">
                        <label for="interpretationRadio" class="control-label">Interpretation Radio <span class="required">*</span></label>
                        <textarea name="interpretationRadio" class="form-control" id="" rows="6"></textarea>
                        @if($errors->has('interpretation'))
                        <label for="" class="error">{{ $errors->first('interpretation') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('scanner') ? 'has-error' : '' }}">
                        <label for="" class="control-label">Image Scanner</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                <div class="uneditable-input">
                                    <i class="fa fa-file fileupload-exists"></i>
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileupload-exists">Change</span>
                                    <span class="fileupload-new">Select file</span>
                                    <input type="file" name="scanner[]" multiple accept="image/*"/>
                                </span>
                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                @if($errors->has('scanner'))
                                <label for="" class="error">{{ $errors->first('scanner') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('interpretation') ? 'has-error' : '' }}">
                        <label for="interpretationScan" class="control-label">Interpretation Scanner <span class="required">*</span></label>
                        <textarea name="interpretationScan" class="form-control" id="" rows="6"></textarea>
                        @if($errors->has('interpretation'))
                        <label for="" class="error">{{ $errors->first('interpretation') }}</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="traitement">
                <h3>Traitement</h3>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="" class="control-label">Maladie</label>
                        <select class="form-control" name="maladie[]" id="">
                            <option value="">Choisir la maladie</option>
                            @foreach($maladies as $res)
                            <option value="{{$res->id}}">{{ $res->nomMaladie }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="" class="control-label">Médicament <span class="required">*</span> </label>
                        <div class="input-group mb-md">
                            <select name="medicament[]" id="" class="form-control" required>
                                <option value="">Choisir le médicament</option>
                                @foreach($medocs as $res)
                                <option value="{{ $res->id }}">{{ $res->nomMedicament }}</option>
                                @endforeach
                            </select>
                            <span class='input-group-addon btn-primary addInput'>+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <a href="{{ ($option == 'retourPatient') ? route('patient.index.archive') : route('patient.index.attente') }}" class="btn btn-default">Annuler</a>
                </div>
            </div>
        </div>
    </section>
</form>

<script src="{{ asset('js/application/patients/enAttente/action.js') }}"></script>
@endsection