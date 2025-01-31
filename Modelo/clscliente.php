<?php
include_once 'modelo/ClsConexion.php';

class ClsCliente extends ClsConexion
{
    public function ExtraerDatos($id)
    {
        $result = $this->conectar->query("CALL spConsultarUsuario('$id')");
        return $result->fetch_assoc();
    }
}
?>
