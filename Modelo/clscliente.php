<?php
include_once 'Modelo/clsconexion.php';

class clscliente extends clsconexion{


    public function ExtraerDatos($id) {
        $result=$this->conectar->query("CALL spConsultarUsuario('$id')");
        $resp=$result->fetch_assoc();
        return $resp;
    }
}
?>