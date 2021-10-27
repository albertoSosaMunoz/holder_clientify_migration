<?php

include "php/header.php";
include "php/funciones.php";

$resultHolded = holdedClientesTodos();
echo "<script> let contactosHolded= $resultHolded;</script>";

if (isset($_GET["actualizarHolded"]) && $_GET["actualizarHolded"] == "actualizar") {
    echo "actualizar contacto";
}
?>

<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">LISTADO DE CLIENTES EN HOLDED</h1>
    </div>
    <!--<div class="col-md-6">
        <form id="formulario_holded_mostrar" method="GET" action="#">
            <div><label>Cliente</label><input type="text" name="name" id="cliente_nombre"></div>
            <div><label>id</label><input type="text" name="customId" id="cliente_id"></div>
            <div><label>e-mail</label><input type="text" name="email" id="cliente_email"></div>            
            <input type="submit" value="actualizar" name="actualizarHolded">
        </form>
    </div>-->

    <div class="col-md-12">
        <table id="holded_table" class="table table-striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>id</th>
                    <th>e-mail</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php include "php/footer.php"; ?>