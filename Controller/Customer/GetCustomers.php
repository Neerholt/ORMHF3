<?php
namespace Controller\Customer;
use Orm\Orm_sql;
require_once "../../vendor/autoload.php";
header('Content-Type: application/json;charset=UTF-8');
$sqlObject = new Orm_sql();
print_r(json_encode($sqlObject->GetCustomers()));