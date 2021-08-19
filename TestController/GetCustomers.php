<?php

require_once "../Orm/Orm_sql.php";
header('Content-Type: application/json;charset=UTF-8');
$sqlObject = new Orm_sql();
print_r(json_encode($sqlObject->GetCustomers()));