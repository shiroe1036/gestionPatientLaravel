@extends('layouts.base')

@section('header-body')
<header class="page-header">
    <h2>{{ $titre }}</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="#">
                    <i class="fa fa-users"></i>
                </a>
            </li>
            <li><span>{{ $chemin }}</span></li>&nbsp;
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

        <h2 class="panel-title">Liste utilisateurs</h2>

    </header>

    <div class="panel-body">
        <a href="{{ route('register') }}" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-plus"></i> Ajouter</a>
        @if(Session::has('messageSuccess'))
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>{{ Session('messageSuccess') }}</p>
            </div>
        @endif()
        <table class="table table-bordered table-striped mb-none" id="tableUser" data-swf-path="{{ asset('template/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf')}}">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $res)
                <tr>
                    <td>{{ $res->id }}</td>
                    <td>{{ $res->name }}</td>
                    <td>{{ $res->prenom }}</td>
                    <td>{{ $res->tel }}</td>
                    <td>{{ $res->email }}</td>
                    <td>{{ $res->typeUtilisateur }}</td>
                    <td class="actions">
                        <a href="{{ route('utilisateur.edit', ['id' => $res->id]) }}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Modifier utilisateur"><i class="fa fa-pencil"></i></a>
                        @if($res->typeUtilisateur != 'superAdmin')
                        <a href="{{ route('utilisateur.destroy', ['id' => $res->id]) }}" class="on-default remove-row" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $res->id }}').submit();" data-toggle="tooltip" data-placement="top" title="Supprimer utilisateur"><i class="fa fa-trash-o"></i></a>
                        <form id="delete-form-{{ $res->id }}" action="{{ route('utilisateur.destroy', ['id' => $res->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<script src="{{ asset('js/application/users/user.js')}}"></script>
@endsection