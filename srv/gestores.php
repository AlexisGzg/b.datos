<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_GESTOR.php";

ejecutaServicio(codigo: function (): void {

 $lista = select(pdo: Bd::pdo(),  from: GESTOR,  orderBy: GES_NOMBRE);

 $render = "";
 foreach ($lista as $modelo) {
  $encodeId = urlencode(string: $modelo[GES_ID]);
  $id = htmlentities(string:$encodeId);
  $apellido = htmlentities(string:$modelo[GES_APELLIDO]);
  $cargo = htmlentities(string:$modelo[GES_CARGO]);
  $departamento = htmlentities(string:$modelo[GES_DEPARTAMENTO]);
  $nombre = htmlentities(string:$modelo[GES_NOMBRE]);

  $render .=
   "<li>
     <p>
      <a href='modifica.html?id=$id'>$nombre $apellido $cargo $departamento</a>
     </p>
    </li>";
 }

 devuelveJson(resultado: ["lista" => ["innerHTML" => $render]]);
});