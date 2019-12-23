@extends('layouts.app_show',[
  'title' => 'roles',
  'model' => $role,
  'modelname' => $role->name,
  'modeltype' => 'du role',
  'index_route' => 'RoleController@index',
  'store_route' => 'RoleController@store',
  'show_route' => 'RoleController@show',
  'edit_route' => 'RoleController@edit',
  'destroy_route' => 'RoleController@destroy',
  'breadcrumb_title' => 'roles.show',
  'breadcrumb_param' => $role->id,
  'canlist' => 'role-list',
  'cancreate' => 'role-create',
  'canedit' => 'role-edit',
  'candelete' => 'role-delete'
])

@section('show_details')

<dl class="row">
    <dt class="col-sm-3">Id</dt>
    <dd class="col-sm-9">{{ $role->id }}</dd>

    <dt class="col-sm-3">Nom</dt>
    <dd class="col-sm-9">{{ $role->name }}</dd>

    <dt class="col-sm-3">Description</dt>
    <dd class="col-sm-9">{{ $role->description }}</dd>

    <dt class="col-sm-3">Permission(s)</dt>
    <dd class="col-sm-9">
      @if(!empty($rolePermissions))
        @foreach($rolePermissions as $v)
          <label class="badge badge-success">{{ $v->name }}</label>
        @endforeach
      @endif
    </dd>
</dl>

@endsection
