<?php

namespace App\Traits;
use Spatie\Permission\Models\Role;


trait RoleTrait {

   /**
    * Renvoi une liste de noms de roles a partir d une liste d ids de roles
    * @param  array $roles_arr liste d ids de roles contenu dans un tableau
    * @return string            la liste de noms de roles ou une variable vide
    */
  public function setRoles($roles_arr) : string {
      $roles = "";

      if ((is_array($roles_arr)) ) {
          foreach ($roles_arr as $role_id) {
              $role = Role::find($role_id);
              if ($roles == "") {
                  $roles = "" . $role->name;
              } else {
                  $roles = $roles . "," . $role->name;
              }
          }

          $roles = $roles . "";
      }

      return $roles;
  }

  /**
   * Renvoi une liste d objet role a partir d un string de noms de roles delemites
   * @param  array $roles_str liste de noms de roles delimite
   * @return array           liste d objets role
   */
  public function getRoles($roles_arr)
  {
      $roles = "";

      $roles_str = "";

      foreach ($roles_arr as $key => $rol) {
          if (empty($roles_str)){
            $roles_str = $key;
          } else {
            $roles_str .= ",".$key;
          }
      }

      $roles_arr = explode(",", $roles_str);

      //dd($roles_arr);

      $roles = Role::whereIn('id', $roles_arr)->get()->pluck('name', 'id');

      //dd($roles);

      return $roles;
  }

  public function setFormatroles($formInput) {
      if (array_key_exists('roles', $formInput)) {
            $formInput['roles'] = $this->setroles($formInput['roles']);
      }

      return $formInput;
  }

}
