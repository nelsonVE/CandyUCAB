<?php

// Función que chequea los permisos en base al rol suministrado
if(!function_exists('checkPermiso')){
  function checkPermiso($rol, $ch_permiso) {
      $permisos = \DB::table('rol_per')->where('fk_rol', $rol)->get();
      foreach($permisos as $permiso){
        if($permiso->fk_per == $ch_permiso)
          return true;
      }
      return false;
  }
}
?>
