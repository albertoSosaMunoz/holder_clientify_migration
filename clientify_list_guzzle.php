<?php
require_once "php/scripts/script_closemarketing_guzzle.php";
require_once "php/header.php";

echo "<script>let personasClientify=" . obtenerPersonasClientify() . "; </script>";

echo "<script>let companiasClientify=" . obtenerCompaniasClientify() . "; </script>";
?>

<div class="row">
    <div class="col-md-6" id="table_clientify_personas_guzzle">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-striped" id="table_clientify_empresas_guzzle">
            <thead>
                <tr>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <?php require_once "php/header.php"; ?>