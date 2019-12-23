@extends('layouts.app')

@section('page')
  Affectations
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($elem_arr['breadcrumb_show'],$elem_arr['elem']->id,$affectation->id) }}
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

        <p class="text-muted m-b-30 font-14">Détails de l affection <code class="highlighter-rouge"><strong>{{ $affectation->objet }}</strong></code>  assignee {{ $elem_arr['article'] }}  {{ $elem_arr['type'] }} <strong>{{ $elem_arr['elem']->designation_complete }}</strong>.</p>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $affectation->id }}</dd>

            <dt class="col-sm-3">Objet</dt>
            <dd class="col-sm-9">{{ $affectation->objet }}</dd>

            <dt class="col-sm-3">Type</dt>
            <dd class="col-sm-9">{{ $affectation->typeAffectation->libelle }}</dd>

            <dt class="col-sm-3">{{ $elem_arr['type'] }}</dt>
            <dd class="col-sm-9">{{ $affectation->elem()->designation_complete }}</dd>

            <dt class="col-sm-3">Statut</dt>
            <dd class="col-sm-9">{{ $affectation->statut->libelle }}</dd>

            <dt class="col-sm-3">Créé le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($affectation->created_at)) }}</dd>

            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($affectation->updated_at)) }}</dd>
        </dl>

      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">
        <div class="row">

          <h6 class="card-title">Article(s)</h6>

          <table class="table table-hover table-sm">
            <thead class="thead-default">
              <tr>
                <th class="font-weight-bold">#</th>
                <th class="font-weight-bold">Référence Complète</th>
                <th class="font-weight-bold">Type Mouvement</th>
                <th class="font-weight-bold">Details Mouvement</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($affectation->affectationarticles as $affectationarticle)
                <tr>
                  <td>{{ $affectationarticle->article->id }}</td>
                  <td>{{ $affectationarticle->article->reference_complete }}</td>
                  <td>{{ $affectationarticle->typemouvement->libelle }}</td>
                  <td>{{ $affectationarticle->details }}</td>
                </tr>
              @empty
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
