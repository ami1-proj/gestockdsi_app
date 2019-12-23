@extends('layouts.app_show',[
  'title' => 'utilisateur',
  'model' => $user,
  'modelname' => $user->name,
  'modeltype' => 'de l utilisateur',
  'index_route' => 'UserController@index',
  'store_route' => 'UserController@store',
  'show_route' => 'UserController@show',
  'edit_route' => 'UserController@edit',
  'destroy_route' => 'UserController@destroy',
  'breadcrumb_title' => 'users.show',
  'breadcrumb_param' => $user->id,
  'canlist' => 'user-list',
  'cancreate' => 'user-create',
  'canedit' => 'user-edit',
  'candelete' => 'user-delete'
])

@section('show_details')

  <dl class="row">
      <dt class="col-sm-3">Id</dt>
      <dd class="col-sm-9">{{ $user->id }}</dd>

      <dt class="col-sm-3">Nom</dt>
      <dd class="col-sm-9">{{ $user->name }}</dd>

      <dt class="col-sm-3">Email</dt>
      <dd class="col-sm-9">{{ $user->email }}</dd>

      <dt class="col-sm-3">Roles</dt>
      <dd class="col-sm-9">
        @if(!empty($user->getRoleNames()))
          @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
          @endforeach
        @endif
      </dd>
  </dl>
  
@endsection
