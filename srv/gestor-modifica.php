<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_GESTOR.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $nombre = recuperaTexto("nombre");
 $apellido = recuperaTexto("apellido");
 $cargo = recuperaTexto("cargo");
 $departamento = recuperaTexto("departamento");
 $nombre = validaNombre($nombre);

 update(
  pdo: Bd::pdo(),
  table: GESTOR,
  set: [GES_NOMBRE => $nombre, GES_APELLIDO => $apellido, GES_CARGO => $cargo, GES_DEPARTAMENTO => $departamento],
  where: [GES_ID => $id]
 );

 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "apellido" => ["value" => $apellido],
  "cargo" => ["value" => $cargo],
  "departamento" => ["value" => $departamento]
 ]);
});