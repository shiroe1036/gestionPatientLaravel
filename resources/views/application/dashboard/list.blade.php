@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="#">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>{{ $chemin }}</span></li>&nbsp;
        </ol>
    </div>
</header>
@endsection

@section('content-body')
<div class="row">
    <div class="col-md-6 col-lg-12 col-xl-12">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-xl-6">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-quartenary">
                                    <i class="fa fa-ambulance"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Nombre de patients</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $patient->totalPatient }}</strong>
                                    </div>
                                </div>
                                @if(Auth::user()->typeUtilisateur != 'medecin')
                                <div class="summary-footer">
                                    <a href="{{ route('patient.index') }}" class="text-muted text-uppercase">Voir</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-6">
                <section class="panel panel-featured-left panel-featured-secondary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-secondary">
                                    <i class="fa fa-pause"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Nombre de patients non traités</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $patientAttente->patientAttente }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('patient.index.attente') }}" class="text-muted text-uppercase">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-6">
                <section class="panel panel-featured-left panel-featured-tertiary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-stethoscope"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Nombre de patients traités</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $patientTraiter->patientTraiter }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('patient.index.traiter') }}" class="text-muted text-uppercase">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-6">
                <section class="panel panel-featured-left panel-featured-quartenary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-dark">
                                    <i class="fa fa-archive"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Nombre de patients Archivés</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $patientArchiver->archive }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('patient.index.archive') }}" class="text-muted text-uppercase">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection