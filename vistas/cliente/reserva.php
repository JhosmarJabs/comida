<div class="contenedor-reserva">
    <div class="rejilla-reserva">
        <form class="datos-formulario-reserva" action="/comida/index?clase=controladorcliente&metodo=Solicitar" method="POST">
            <h1 class="titulo-reserva">Formulario de reservacion</h1>
                <div class="espacio-vertical-reserva">
                    <label for="nombre" class="etiqueta-reserva">Nombre del cliente</label>
                    <div class="rejilla-reserva columnas-2-reserva gap-pequeno-reserva">
                    <?php
                        if (isset($datos) && $datos !== null) {
                            while ($dat = $datos->fetch_object()) {
                                echo '<div id="1">';
                                echo '<input class="input-reserva etiqueta-reserva" name="txtNombre" type="text" placeholder="Nombre(s)" value="'.$dat->vchNombre.'"readonly>';
                                echo '</div>';
                                echo '<div id="1">';
                                echo '<input class="input-reserva etiqueta-reserva" name="txtApellido" type="text" placeholder="Apellido(s)" value="'.$dat->vchApellidos.'"readonly>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div>';
                            echo '<input value="No hay datos">';
                            echo '</div>';
                            echo '<div id="1">';
                            echo '<input value="No hay datos">';
                            echo '</div>';
                        }
                    ?>
                    </div>
                    <div id="2">
                        <label for="telefono" class="etiqueta-reserva">Numero de telefono</label>
                        <input class="input-reserva max-reserva" name="txtNomeroTelefonico" nametype="number">
                    </div>
                    <div id="3">
                        <label for="fecha" class="etiqueta-reserva">Fecha de reservacion</label>
                        <input class="input-reserva max-reserva" name="txtFecha" type="date">
                    </div>
                    <div class="rejilla-reserva columnas-2-reserva gap-pequeno-reserva">
                        <div id="4">
                            <label for="hora-inicio" class="etiqueta-reserva">Hora de Inicio</label>
                            <input class="input-reserva" name="txtHoraI" type="time">
                        </div>
                        <div id="5">
                            <label for="hora-final" class="etiqueta-reserva">Hora de Final</label>
                            <input class="input-reserva" name="txtHoraF" type="time">
                        </div>
                    </div>
                    <div id="6">
                        <label for="ocasion" class="etiqueta-reserva">Ocacion</label>
                        <select class="input-reserva max-reserva" id="Ocacion" name="txtOcacion" style="width: 94%;" required>
                            <?php
                            if (isset($idOca) && $idOca !== null) {
                                while ($Ocacion = $idOca->fetch_object()) {
                                    echo '<option value="' . $Ocacion->IdOcasiones . '">' . $Ocacion->vchNombreOcasiones . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay zonas disponibles</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div id="7">
                        <label for="invitados" class="etiqueta-reserva">Numero de comensales</label>
                        <select id="invitados" name="txtinvitados" class="input-reserva maximo-reserva">
                        <option value="" disabled selected></option>
                        </select>
                    </div>
                    <div id="8">
                        <label for="zona-preferencia" class="etiqueta-reserva">Zona de preferencia</label>
                        <select class="input-reserva max-reserva" id="zona-reserva" name="txtZonaReserva" style="width: 94%;" required>
                            <?php
                            if (isset($datosZonas) && $datosZonas !== null) {
                                while ($zonaRes = $datosZonas->fetch_object()) {
                                    echo '<option  value="' . $zonaRes->IdZona . '">' . $zonaRes->vchUbicacion . '</option>';
                                }
                            } else {
                                echo '<option value="">No hay zonas disponibles</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button class="input-reserva centrado-reserva boton-reserva maximo-reserva" value="btnSolicitar">Solicitar</button>
                </div>
            </div>
            <script>
                const selectElement = document.getElementById('invitados');
                for (let i = 2; i <= 15; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    selectElement.appendChild(option);
                }
            </script>
        </form>
    </div>
</div>

    <!-- <script>
        const selectElement = document.getElementById('invitados');
        const numberWords = [
        "Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve", "Diez",
        "Once", "Doce", "Trece", "Catorce", "Quince", "Dieciséis", "Diecisiete", "Dieciocho", "Diecinueve", "Veinte"
        ];

        numberWords.forEach((word, index) => {
        const option = document.createElement('option');
        option.value = index + 1;
        option.textContent = word;
        selectElement.appendChild(option);
        });
    </script> -->