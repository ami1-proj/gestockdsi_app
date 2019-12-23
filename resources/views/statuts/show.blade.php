@extends('layouts.app')

@section('page')
  Statuts
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

        <p class="text-muted m-b-30 font-14">Détails du Statut <code class="highlighter-rouge"><strong>{{ $statut->libelle }}</strong></code>.</p>

        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $statut->id }}</dd>

            <dt class="col-sm-3">Libelle</dt>
            <dd class="col-sm-9">{{ $statut->libelle }}</dd>

            <dt class="col-sm-3">Par Défaut</dt>
            <dd class="col-sm-9">
              <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $statut->is_default ? 'checked="checked"' : '' }}/>
            </dd>

            <dt class="col-sm-3">Tags</dt>
            <dd class="col-sm-9">{{ $statut->tags }}</dd>

            <dt class="col-sm-3">Créé le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($statut->created_at)) }}</dd>

            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($statut->updated_at)) }}</dd>
        </dl>

      </div>
    </div>
  </div>
</div>

@endsection
