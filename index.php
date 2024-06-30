<?php
require_once __DIR__ . './src/util/createDB.php';

define("DBCREATED", 0);
if (!DBCREATED) {
    define("DBCREATED", 1);
    createDB();
    header('Location: ./src/view/pages/adicionarConta.php');
} else {
    header('Location: ./src/view/pages/adicionarConta.php');
}
