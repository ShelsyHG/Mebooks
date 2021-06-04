<?php
class admin_VI{

    function __construct()
    {
        
    }

    function agregar(){
?>
        <div class="card">
            <div class="card-body">
                <form id="formulario_agregar_admin">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nit">Nit:</label>
                                <input type="text" class="form-control" id="nit" name="nit">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" class="form-control" id="usuario" name="usuario">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="contrasena">Contraseña:</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="modu" name="modu" value="admin">
                    <input type="hidden" id="acci" name="acci" value="CONTROLADOR_AGREGAR_ADMIN">
                    <button type="button" class="btn btn-primary float-right" onclick="controladorAgregarAdmin()"><i class="fas fa-save"></i> Guardar</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <script>
        function controladorAgregarAdmin()
        {
            var cadena = $("#formulario_agregar_admin").serialize();

            $.post("index.php", cadena, function(respuesta){
                var objeto_respuesta = JSON.parse(respuesta);
                if(objeto_respuesta.estado == "EXITO"){
                    $('#formulario_agregar_admin')[0].reset();

                    exito(objeto_respuesta.mensaje);
                }else if(objeto_respuesta.estado == "ADVERTENCIA"){
                    advertencia(objeto_respuesta.mensaje);
                }else if(objeto_respuesta.estado == "ERROR"){
                    error(objeto_respuesta.mensaje);
                }
            });
        }
        </script>

<?php
    }
}
?>