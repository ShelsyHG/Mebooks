<?php
class punto_VI
{
    function __construct()
    {
        
    }

    function listar(){
        require_once "modelos/usuarios_MO.php";

        $conexion = new conexion('A');
        $usuarios_MO = new usuarios_MO($conexion);

        $arreglo_puntos = $usuarios_MO->listarPuntos();
?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de libros</h3>
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#ventana_modal" onclick="vistaAgregarPuntos()"><i class="far fa-plus-square"></i> Agregar</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="listar_puntos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Editorial</th>
                            <th>Autor</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($arreglo_puntos) {
                            foreach ($arreglo_puntos as $objeto_punto) {
                                $id_usuario = $objeto_punto->id_libro;
                                $nombre = $objeto_punto->nombre;
                                $editorial = $objeto_punto->editorial;
                                $autor = $objeto_punto->autor;
                                $descripcion = $objeto_punto->descripcion;
                                $precio = $objeto_punto->precio;

                        ?>
                                <tr>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo $editorial; ?></td>
                                    <td><?php echo $autor; ?></td>
                                    <td><?php echo $descripcion; ?></td>
                                    <td><?php echo $precio; ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Editorial</th>
                            <th>Autor</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <script>
            function vistaAgregarPuntos() {
                $.post('index.php',{modulo:'punto',accion:'VISTA_AGREGAR_PUNTOS'},function(respuesta)
            {
                $('#titulo_modal').html('Agregar puntos de venta');
                $('#contenido_modal').html(respuesta);
            });
            }

            data_table_puntos = organizarTabla({
                id: "listar_puntos"
            });
        </script>
<?php
    }

    function agregar(){
?>
    <div class="card">
            <div class="card-body">
                <form id="formulario_agregar_puntos">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editorial">Editorial:</label>
                                <input type="text" class="form-control" id="editorial" name="editorial">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="autor">Autor:</label>
                                <input type="text" class="form-control" id="autor" name="autor">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripcion:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="text" class="form-control" id="precio" name="precio">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="modulo" name="modulo" value="punto">
                    <input type="hidden" id="accion" name="accion" value="CONTROLADOR_AGREGAR_PUNTOS">
                    <button type="button" class="btn btn-primary float-right" onclick="controladorAgregarPuntos()"><i class="fas fa-save"></i> Guardar</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <script>
            function controladorAgregarPuntos() {
                var cadena = $('#formulario_agregar_puntos').serialize();

                $.post('index.php', cadena, function(respuesta) {
                    var objeto_respuesta = JSON.parse(respuesta);

                    if (objeto_respuesta.estado == "EXITO") {
                        $('#formulario_agregar_puntos')[0].reset();

                        exito(objeto_respuesta.mensaje);

                        data_table_puntos.row.add([objeto_respuesta.nombre, objeto_respuesta.editorial, objeto_respuesta.autor, objeto_respuesta.descripcion, objeto_respuesta.precio]).draw();

                    } else if (objeto_respuesta.estado == "ADVERTENCIA") {
                        advertencia(objeto_respuesta.mensaje);
                    } else if (objeto_respuesta.estado == "ERROR") {
                        error(objeto_respuesta.mensaje);
                    }
                });
            }
        </script>

<?php
    }
}
?>