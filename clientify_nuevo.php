<?php

include "php/header.php";
include "php/funciones.php";
if (isset($_GET["nuevoClientify"]) && $_GET["nuevoClientify"] == "crear") {
    $owner_name = $_GET["name"];
    $id = $_GET["customId"];
    $owner = $_GET["email"];
    nuevoContactoClientify($owner_name, $id, $owner);
}

?>
<div class="row">
    <div class="col-6">
        <form id="formulario_clientify_nuevo_contacto" method="GET" action="#">
            <div><label>Cliente</label><input type="text" name="name" id="cliente_nombre"></div>
            <div><label>id</label><input type="text" name="customId" id="cliente_id"></div>
            <div><label>e-mail</label><input type="text" name="email" id="cliente_email"></div>
            <input type="submit" value="crear" name="nuevoClientify">
        </form>
    </div>
  
</div>

<?php include "php/footer.php"; ?>