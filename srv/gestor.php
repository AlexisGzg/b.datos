<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_GESTOR.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");

 $modelo =
  selectFirst(pdo: Bd::pdo(),  from: GESTOR,  where: [GES_ID => $id]);

 if ($modelo === false) {
  $idHtml = htmlentities($id);
  throw new ProblemDetails(
   status: NOT_FOUND,
   title: "Pasatiempo no encontrado.",
   type: "/error/pasatiemponoencontrado.html",
   detail: "No se encontró ningún pasatiempo con el id $idHtml.",
  );
 }

 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $modelo[GES_NOMBRE]],
  "apellido" => ["value" => $modelo[GES_APELLIDO]],
  "cargo" => ["value" => $modelo[GES_CARGO]],
  "departamento" => ["value" => $modelo[GES_DEPARTAMENTO]],
  
 ]);
});