<?php

class ClsConexion
{
    private $servidor = '82.197.82.130';
    private $Base = 'u734437104_Comida';
    private $usuario = 'u734437104_Josmar';
    // private $Base = 'u734437104_ComidaA';
    // private $usuario = 'u734437104_JosmarA';
    private $passw = '6UrWWUSHdKB2t2F';

    // private $servidor = 'localhost';
    // private $Base = 'bdcomida';
    // private $usuario = 'root';
    // private $passw = '';

    public $conectar;

    function __construct()
    {
        $this->conectar = new mysqli($this->servidor, $this->usuario, $this->passw, $this->Base);

        if ($this->conectar->connect_errno) {
            printf("Imposible conectarse: %s\n", $this->conectar->connect_error);
            exit();
        }
    }
}
?>
