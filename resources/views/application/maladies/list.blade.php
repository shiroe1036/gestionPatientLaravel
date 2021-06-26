@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-h-square"></i>
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

        <h2 class="panel-title">Liste maladies</h2>

    </header>

    <div class="panel-body">
        @if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin')
        <a href="{{ route('maladie.create') }}" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
        @endif
        <!-- <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-plus"></i> Ajouter</button> -->
        @if(Session::has('messageSuccess'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>{{ Session('messageSuccess') }}</p>
        </div>
        @endif()

        <table class="table table-borered table-striped mb-none" id="tableMaladie" data-swf-path="{{ asset('template/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf')}}">
            <thead>
                <tr>
                    <th>#</th>
                    <th>maladies</th>
                    @if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin')
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($maladies as $res)
                <tr>
                    <td>{{ $res->id }}</td>
                    <td>{{ $res->nomMaladie }}</td>
                    @if(Auth::user()->typeUtilisateur == 'medecin' || Auth::user()->typeUtilisateur == 'superAdmin')
                    <td class="actions">
                        <a href="{{ route('maladie.edit', ['id' => $res->id]) }}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Modifier maladie"><i class="fa fa-pencil"></i></a>

                        <a href="{{ route('maladie.destroy', ['id' => $res->id]) }}" class="on-default remove-row" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $res->id }}').submit();" data-toggle="tooltip" data-placement="top" title="Supprimer maladie"><i class="fa fa-trash-o"></i></a>
                        <form id="delete-form-{{ $res->id }}" action="{{ route('maladie.destroy', ['id' => $res->id]) }}" method="POST" style="display: none;">
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

<script src="{{ asset('js/application/maladies/maladie.js')}}"></script>
@endsection