<?php
require_once __DIR__ . './src/util/createDB.php';


define("DBCREATED", 1);
if (!isset(DBCREATED)) {
    createDB();
    header('Location: ./src/view/pages/adicionarConta.php');
} else {
    header('Location: ./src/view/pages/adicionarConta.php');
}
