<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_GESTOR.php";

ejecutaServicio(function () {
    $nombre = recuperaTexto("nombre");
    $apellido = recuperaTexto("apellido");
    $cargo = recuperaTexto("cargo");
    $departamento = recuperaTexto("departamento");
    $nombre = validaNombre($nombre);


    $pdo = Bd::pdo();
    insert(pdo: $pdo, into: GESTOR, values: [GES_NOMBRE => $nombre, GES_APELLIDO => $apellido, GES_CARGO => $cargo, GES_DEPARTAMENTO => $departamento]);
    $id = $pdo->lastInsertId();

    $encodeId = urlencode($id);
    devuelveCreated("/srv/gestor.php?id=$encodeId", [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "apellido" => ["value" => $apellido],
        "cargo" => ["value" => $cargo],
        "departamento" => ["value" => $departamento]
    ]);
});