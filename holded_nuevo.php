<?php

include "php/header.php";
include "php/funciones.php";
if (isset($_GET["nuevoHolded"]) && $_GET["nuevoHolded"] == "crear") {
    $name = $_GET["name"];
    $customId = $_GET["customId"];
    $email = $_GET["email"];
    nuevoContactoHolded($name, $customId, $email);
}
if (isset($_GET["modificarHolded"]) && $_GET["modificarHolded"] == "modificar") {
    $name = $_GET["name"];
    $customId = $_GET["customId"];
    $email = $_GET["email"];
    modificarContactoHolded($name, $customId, $email);
}

?>
<div class="row">
    <div class="col-6">
    <form id="formulario_holded_nuevo_contacto" method="GET" action="#">
        <div><label>Cliente</label><input type="text" name="name" id="cliente_nombre"></div>
        <div><label>id</label><input type="text" name="customId" id="cliente_id"></div>
        <div><label>e-mail</label><input type="text" name="email" id="cliente_email"></div>
        <div><input type="submit" value="crear" name="nuevoHolded"></div>
    </form>
    </div>
    <div class="col-6"></div>
</div>

<?php include "php/footer.php"; ?>