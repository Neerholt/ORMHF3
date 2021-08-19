<?php

require_once "IOrm.php";
require_once "../Models/Customers.php";

class Orm_sql implements IOrm
{
    private $servername = "localhost", $username = "root", $password = "", $db = "homemadeorm";

    private function dbConn(): PDO {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;//Return so I can use $run
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function GetCustomers(): array
    {
        $customers = array();
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT * FROM customer");
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $customer = new Customers($row['firstname'],$row['lastname'],$row['mail'], $row['phone'], $row['street'] );
            array_push($customers, $customer);
        }
        return $customers;
    }

    public function CreateCustomer(Customers $customer): Customers
    {

        $conn = $this->dbConn();
        $stmt = $conn->prepare("INSERT INTO customer (firstname, lastname, mail, phone, password, street) VALUES (:firstname, :lastname, :mail, :phone, :password, :street)");
        $stmt->BindParam(':firstname', $customer->firstname);
        $stmt->BindParam(':lastname', $customer->lastname);
        $stmt->BindParam(':mail', $customer->mail);
        $stmt->BindParam(':phone', $customer->phone);
        $stmt->BindParam(':password', $customer->password);
        $stmt->BindParam(':street', $customer->street);
        $stmt->execute();
        $customer->customersId = $conn->lastInsertId();
        return $customer;

    }

    public function GetCustomer(int $id): Customers
    {
        // TODO: Implement GetCustomer() method.
        return 0;
    }

    public function UpdateCustomer(int $id): Customers
    {
        // TODO: Implement UpdateCustomer() method.
        return 0;
    }

    public function DeleteCustomer(int $id): bool
    {
        // TODO: Implement DeleteCustomer() method.
        return 0;
    }
}

