<?php

namespace Orm;


use Models\Customers;
use PDO;
use PDOException;

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
            $customer = new Customers($row['firstname'],$row['lastname'],$row['mail'], $row['phone'], $row['street'], $row['password'] );
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
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT ID, firstname, lastname, mail, phone, password, street FROM customer WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Customers($row['firstname'],$row['lastname'],$row['mail'], $row['phone'], $row['street'], $row['password'] );
    }

    public function UpdateCustomer(Customers $customer, $id): Customers
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("UPDATE customer SET firstname=:firstname, lastname=:lastname,mail=:mail, phone=:phone,street=:street, password=:password  WHERE id = :id");
        $stmt->bindParam(':firstname', $customer->firstname);
        $stmt->bindParam(':lastname',$customer->lastname);
        $stmt->bindParam(':mail', $customer->mail);
        $stmt->bindParam(':phone', $customer->phone);
        $stmt->bindParam(':street', $customer->street);
        $stmt->bindParam(':password', $customer->password);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $customer;
    }

    public function DeleteCustomer(int $id): bool
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("DELETE FROM customer WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return 0;
    }
}

