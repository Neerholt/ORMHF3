<?php

namespace Controller\Customer;
use Models\Customers;
use Orm\Orm_sql;
require_once "../../vendor/autoload.php";

header('Content-Type: application/json;charset=UTF-8');
$sqlObject = new Orm_sql();
//Data bliver send via frontend til denne backend file, som griper post request og sender det til vores Customer class, som vi så passer til vores
//createCustomer, inde i createCustomer, har vi sagt at vi skal paser vores classe.
$customer = new Customers($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['phone'], $_POST['street'], $_POST['password']);
$sqlObject->CreateCustomer($customer);