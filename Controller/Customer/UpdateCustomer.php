<?php
namespace Controller\Customer;
use Models\Customers;
use Orm\Orm_sql;
require_once "../../vendor/autoload.php";
header('Content-Type: application/json;charset=UTF-8');
$sqlObject = new Orm_sql();
$customer = new Customers($_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['phone'], $_POST['street'], $_POST['password'] );
$sqlObject->UpdateCustomer($customer, $_POST['id']);
