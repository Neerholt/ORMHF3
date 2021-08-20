<?php
require_once "../Orm/Orm_sql.php";
header('Content-Type: application/json;charset=UTF-8');
$sqlObject = new Orm_sql();
$sqlObject->DeleteCustomer($_GET['id']);