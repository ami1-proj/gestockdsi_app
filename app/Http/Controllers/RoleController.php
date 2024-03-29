<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\Traits\PermissionTrait;

class RoleController extends Controller
{
    use PermissionTrait;

    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recherche_cols = ['id', 'name'];

        $sortBy = 'id';
        $orderBy = 'asc';
        $perPage = 5;
        $q = null;
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        $roles = Role::where('name', 'LIKE', "%{$q}%")
          ->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('roles.index', compact('roles', 'recherche_cols', 'orderBy', 'sortBy', 'q', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();

        return view('roles.create')
          ->with('permissions', $permissions)
          ->with('role', (new Role()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $formInput = $request->all();
        if (array_key_exists('select_all', $formInput)) {
          $permissions = Permission::pluck('id','id')->all();
        } else {
          $this->validate($request, [
              'permissions' => 'required',
          ]);

          $permissions = $request->input('permissions');
        }

        $role = Role::create([
          'name' => $request->input('name'),
          'description' => $request->input('description'),
        ]);

        $role->syncPermissions($permissions);

        $request->session()->flash('msg_success',__('messages.modelSaved', ['modelname' => 'Role'] ));

        return redirect()->action('RoleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = Role::find($role->id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role=Role::find($role->id);

        //$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)->get('role_has_permissions.permission_id')->toArray();
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get()->pluck('name', 'id')->toArray();

        return view('roles.edit')
          ->with('selectedpermissions', $rolePermissions)
          ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $formInput = $request->all();
        if (array_key_exists('select_all', $formInput)) {
          $permissions = Permission::pluck('id','id')->all();
        } else {
          $this->validate($request, [
              'permissions' => 'required',
          ]);

          $permissions = $request->input('permissions');
        }

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($permissions);
        $request->session()->flash('msg_success',__('messages.modelUpdated', ['modelname' => 'Role'] ));

        return redirect()->action('RoleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        DB::table("roles")->where('id',$id)->delete();

        return redirect()->route('roles.index')
          ->with('success','Role deleted successfully');
    }

    public function selectmoreroles(Request $request)
    {
        $search = $request->get('search');
        $data = Role::select(['id', 'name'])->where('name', 'like', '%' . $search . '%')->orderBy('name')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }
}
