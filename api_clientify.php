<?php
include "php/header.php";
include "php/funciones.php";

$resultClientify = clientifyClientesTodos();
echo "<script> let contactosClientify= $resultClientify;</script>";

if (isset($_GET["actualizarClientify"]) && $_GET["actualizarClientify"] == "actualizar") {
    echo "actualizar contacto";
}
?>

<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">LISTADO DE CLIENTES EN CLIENTIFY</h1>
    </div>
   <!-- <div class="col-md-6">
        <form id="formulario_clientify_mostrar" method="GET" action="#">
            <div><label>Cliente</label><input type="text" name="owner_name" id="cliente_nombre"></div>
            <div><label>id</label><input type="text" name="id" id="cliente_id"></div>
            <div><label>e-mail</label><input type="text" name="owner" id="cliente_email"></div>
            <div><label>holded_id</label><input type="text" name="holded_id" id="cliente_holded_id"></div>
            <input type="submit" value="actualizar" name="actualizarClientify">
        </form>
    </div>-->

    <div class="col-md-12">
        <table id="clientify_table" class="table table-striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>id</th>
                    <th>e-mail</th>                    
                    <th>holded_id</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php include "php/footer.php"; ?>