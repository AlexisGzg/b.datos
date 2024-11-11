<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    dsn: "sqlite:srvbd.db",
    // usuario
    username: null,
    // contraseña
    password: null,
    // Opciones: pdos no persistentes y lanza excepciones.
    options: [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   //self::$pdo->exec("DROP TABLE IF EXISTS GESTOR");

   self::$pdo->exec(
    statement: "CREATE TABLE IF NOT EXISTS GESTOR (
      GES_ID INTEGER,
      GES_NOMBRE TEXT NOT NULL,
      GES_APELLIDO TEXT NOT NULL,
      GES_CARGO TEXT NOT NULL,
      GES_DEPARTAMENTO TEXT NOT NULL,
      CONSTRAINT GES_PK
       PRIMARY KEY(GES_ID),
      CONSTRAINT GES_NOM_NV
       CHECK(LENGTH(GES_NOMBRE) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}