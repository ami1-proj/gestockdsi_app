@extends('layouts.app')

@section('page')
  Types Mouvement
@endsection

@section('content')

<div class="row">
  @include('layouts.message')
</div>

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Détails</h4>

        <p class="text-muted m-b-30 font-14">Détails du Type de Mouvement <code class="highlighter-rouge">{{ $typemouvement->libelle }}</code>.</p>

        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $typemouvement->id }}</dd>

            <dt class="col-sm-3">Libelle</dt>
            <dd class="col-sm-9">{{ $typemouvement->libelle }}</dd>

            <dt class="col-sm-3">Par Défaut</dt>
            <dd class="col-sm-9">
              <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $typemouvement->is_default ? 'checked="checked"' : '' }}/>
            </dd>

            <dt class="col-sm-3">Statut</dt>
            <dd class="col-sm-9">{{ $typemouvement->statut->libelle ?? '' }}</dd>

            <dt class="col-sm-3">Tags</dt>
            <dd class="col-sm-9">{{ $typemouvement->tags }}</dd>

            <dt class="col-sm-3">Créé le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($typemouvement->created_at)) }}</dd>

            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($typemouvement->updated_at)) }}</dd>
        </dl>

      </div>
    </div>
  </div>
</div>

@endsection
