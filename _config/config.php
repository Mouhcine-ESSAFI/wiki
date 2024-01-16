<?php

//------------------------//
//         ERRORS         //
//------------------------//

error_reporting(E_ALL);
ini_set('display_errors', true);

//------------------------//
//       SESSIONS         //
//------------------------//

ini_set('session.cookie_lifetime', false);
session_start();

//------------------------//
//      CONSTANTS         //
//------------------------//

/* paths */
define('PATH_REQUIRE', substr($_SERVER['SCRIPT_FILENAME'], 0, -9)); // inclusion php
define('PATH', substr($_SERVER['PHP_SELF'], 0, -9)); // pour les images et les fichiers
define('__ROOT__', dirname(dirname(__FILE__)));

/* db info */
const DB_HOST = 'localhost';
const DB_NAME = 'wiki';
const DB_USER = 'root';
const DB_PASS = '';