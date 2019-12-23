  @extends('layouts.app')

@section('page')
  Détails Stock
@endsection

@section('content')
    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $stock->id }}</dd>

        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $stock->intitule }}</dd>

        <dt class="col-sm-3">Lieu</dt>
        <dd class="col-sm-9">{{ $stock->stock_lieu->nom}}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $stocks->statut->libelle }}</dd>
    </dl>
@endsection