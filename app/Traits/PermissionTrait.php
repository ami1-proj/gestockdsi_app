<?php

namespace App\Traits;
use Spatie\Permission\Models\Permission;

trait PermissionTrait {

   /**
    * Renvoi une liste de noms de permissions a partir d une liste d ids de permissions
    * @param  array $permissions_arr liste d ids de permissions contenu dans un tableau
    * @return string            la liste de noms de permissions ou une variable vide
    */
  public function setPermissions($permissions_arr) : string {
      $permissions = "";

      if ((is_array($permissions_arr)) ) {
          foreach ($permissions_arr as $permission_id) {
              $permission = Permission::find($permission_id);
              if ($permissions == "") {
                  $permissions = "" . $permission->name;
              } else {
                  $permissions = $permissions . "," . $permission->name;
              }
          }

          $permissions = $permissions . "";
      }

      return $permissions;
  }

  /**
   * Renvoi une liste d objet permission a partir d un string de noms de permissions delemites
   * @param  collection $permissions_str liste de noms de permissions delimite
   * @return array           liste d objets permission
   */
  public function getPermissions($permissions_coll)
  {
      $permissions = "";

      $permissions_str = "";

      foreach ($permissions_coll as $perm) {
          if (empty($permissions_str)){
            $permissions_str = $perm->permission_id;
          } else {
            $permissions_str .= ",".$perm->permission_id;
          }
      }

      $permissions_arr = explode(",", $permissions_str);

      //dd($permissions_arr);

      $permissions = Permission::whereIn('id', $permissions_arr)->get()->pluck('name', 'id');

      //dd($permissions);

      return $permissions;
  }

  public function setFormatpermissions($formInput) {
      if (array_key_exists('permissions', $formInput)) {
            $formInput['permissions'] = $this->setpermissions($formInput['permissions']);
      }

      return $formInput;
  }

}
