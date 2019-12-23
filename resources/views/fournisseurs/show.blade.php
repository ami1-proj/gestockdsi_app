@extends('layouts.app_show',[
  'title' => 'fournisseurs',
  'model' => $fournisseur,
  'modelname' => $fournisseur->raison_sociale,
  'modeltype' => 'de lfournisseur',
  'index_route' => 'FournisseurController@index',
  'store_route' => 'FournisseurController@store',
  'show_route' => 'FournisseurController@show',
  'edit_route' => 'FournisseurController@edit',
  'destroy_route' => 'FournisseurController@destroy',
  'breadcrumb_title' => 'fournisseurs.show',
  'breadcrumb_param' => $fournisseur->id,
  'canlist' => 'fournisseur-list',
  'cancreate' => 'fournisseur-create',
  'canedit' => 'fournisseur-edit',
  'candelete' => 'fournisseur-delete'
])

@section('show_details')
    <dl class="row">
        <dt class="col-sm-3">Id</dt>
        <dd class="col-sm-9">{{ $fournisseur->id }}</dd>

        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $fournisseur->nom }}</dd>

        <dt class="col-sm-3">Prenom</dt>
        <dd class="col-sm-9">{{ $fournisseur->prenom }}</dd>

        <dt class="col-sm-3">Raison Sociale</dt>
        <dd class="col-sm-9">{{ $fournisseur->Raison_Sociale }}</dd>

        <dt class="col-sm-3">Adresse(s) E-mail</dt>
        <dd class="col-sm-9">
          <select class="select2 form-control " name="$Fournisseuradresseemails[]" multiple="multiple" id="$Fournisseuradresseemails" style="width: 50%">
            @foreach($fournisseur->adresseemails as $adresseemail)
                <option value="{{ $adresseemail->id }}">{{ $adresseemail->email }}</option>
            @endforeach
          </select>
        </dd>

        <dt class="col-sm-3">Numéro(s) de Téléphone</dt>
        <dd class="col-sm-9">
          <select class="select2 form-control " name="$Fournisseurphonenums[]" multiple="multiple" id="$Fournisseurphonenums" style="width: 50%">
            @foreach($fournisseur->phonenums as $phonenum)
                <option value="{{ $phonenum->id }}">{{ $phonenum->numero }}</option>
            @endforeach
          </select>
        </dd>

        <dt class="col-sm-3">Statut</dt>
        <dd class="col-sm-9">{{ $fournisseur->statut->libelle }}</dd>

        <dt class="col-sm-3">Créé le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($fournisseur->created_at)) }}</dd>

        <dt class="col-sm-3">Modifié le</dt>
        <dd class="col-sm-9">{{ date('F d, Y', strtotime($fournisseur->updated_at)) }}</dd>
    </dl>
@endsection
