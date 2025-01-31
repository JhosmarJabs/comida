<?php
include_once 'modelo/ClsConexion.php';

class ClsLogin extends ClsConexion
{
    public function ConsultaUsuario($email, $password)
    {
        $this->conectar->query("CALL spLogin('$email','$password',@respuesta);");
        $result = $this->conectar->query("SELECT @respuesta AS respuesta");
        return $result->fetch_assoc();
    }

    public function ConsultarDatos($email)
    {
        $result = $this->conectar->query("CALL spConsultarDatos('$email')");
        return $result->fetch_assoc();
    }

    public function RegistrarUsuario($nombre, $apellidos, $noTelefono, $email, $password, $pregunta, $respuesta)
    {
        $sql = "CALL spInsertarUsuarios('$nombre', '$apellidos', '$noTelefono', '$email', '$password', '$pregunta', '$respuesta', 'Cliente');";
        $this->conectar->query($sql);
    }

    public function ConsultaEmail($email)
    {
        $this->conectar->query("CALL spConsultarEmail('$email', @respuesta);");
        $result = $this->conectar->query("SELECT @respuesta AS respuesta");
        $row = $result->fetch_assoc();
        return isset($row['respuesta']) && $row['respuesta'] == 1;
    }

    public function ObtenerPreguntaSecreta($email)
    {
        $result = $this->conectar->query("CALL spObtenerPreguntaSecreta('$email');");
        return $result->fetch_assoc();
    }
    
    public function GenerarCodigoRecuperacion($email)
    {
        $codigo = $this->conectar->query("CALL spGuardarCodigoRecuperacion('$email');");
        $row = $codigo->fetch_assoc();
        return $row['TokenGenerado'] ?? null;
    }

    public function ValidarCodigoRecuperacion($email, $codigo)
    {
        $result = $this->conectar->query("CALL spValidarCodigoRecuperacion('$email', '$codigo');");
        return $result->fetch_assoc();
    }
    
    public function ActualizarPassword($email, $nuevaPassword)
    {
        $sql = "CALL spActualizarPassword('$email', '$nuevaPassword');";
        $this->conectar->query($sql);
    }
}
?>
