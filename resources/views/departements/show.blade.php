@extends('layouts.app_show',[
  'title' => 'departements',
  'model' => $departement,
  'modelname' => $departement->intitule,
  'modeltype' => 'du departement',
  'index_route' => 'DepartementController@index',
  'store_route' => 'DepartementController@store',
  'show_route' => 'DepartementController@show',
  'edit_route' => 'DepartementController@edit',
  'destroy_route' => 'DepartementController@destroy',
  'breadcrumb_title' => 'departements.show',
  'breadcrumb_param' => $departement->id,
  'canlist' => 'departement-list',
  'cancreate' => 'departement-create',
  'canedit' => 'departement-edit',
  'candelete' => 'departement-delete'
])

@section('show_details')

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $departement->id }}</dd>

        <dt class="col-sm-3">Intitule</dt>
        <dd class="col-sm-9">{{ $departement->intitule }}</dd>

        <dt class="col-sm-3">Département Parent</dt>
        <dd class="col-sm-9">{{ $departement->parent ? $departement->parent->chemin_complet : '' }}</dd>

        <dt class="col-sm-3">Responsable</dt>
        <dd class="col-sm-9">{{ $departement->employeResponsable ? $departement->employeResponsable->nom_complet : '' }}</dd>

        <dt class="col-sm-3">Type</dt>
        <dd class="col-sm-9">{{ $departement->typedepartement->intitule }}</dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $departement->statut->libelle }}</dd>
     <dt class="col-sm-3">Créé le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($departement->created_at)) }}</dd>
            <dt class="col-sm-3">Modifié le</dt>
            <dd class="col-sm-9">{{ date('F d, Y', strtotime($departement->updated_at)) }}</dd>
        </dl>

      </div>
    </div>
  </div>


     <div class="col-lg-6">
      <div class="card m-b-30">
      <div class="card-body">

        @include('affectations.liste', ['type_affectation_tag' => 'Departement', 'elem_id' => $departement->id])

      </div>
    </div>
  </div>


@endsection
