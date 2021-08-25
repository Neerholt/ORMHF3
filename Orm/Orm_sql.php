<?php

namespace Orm;

use Models\Customers;
use PDO;

session_start();
class Orm_sql implements IOrm
{
    private $servername = "localhost", $username = "root", $password = "", $db = "homemadeorm";

    private function dbConn(): PDO
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function GetCustomers(): array
    {
        $customers = array();
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT * FROM customers");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $customer = new Customers($row['firstname'], $row['lastname'], $row['mail'], $row['phone'], $row['street'], $row['password']);
            $customer->id = $row['id'];
            array_push($customers, $customer);
        }
        return $customers;
    }

    public function CreateCustomer(Customers $customer, int $locationId): Customers
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname, mail, phone, password, street, location_id) VALUES (:firstname, :lastname, :mail, :phone, :password, :street, :location_id)");
        $stmt->bindParam(':firstname', $customer->firstname);
        $stmt->bindParam(':lastname', $customer->lastname);
        $stmt->bindParam(':mail', $customer->mail);
        $stmt->bindParam(':phone', $customer->phone);
        $stmt->bindParam(':password', $customer->password);
        $stmt->bindParam(':street', $customer->street);
        $stmt->bindParam(':location_id', $locationId);
        $stmt->execute();
        $customer->id = $conn->lastInsertId();
        return $customer;

    }

    public function GetCustomer(int $id): Customers
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT id, firstname, lastname, mail, phone, password, street FROM customers WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $customer = new Customers($row['firstname'], $row['lastname'], $row['mail'], $row['phone'], $row['street'], $row['password']);
        $customer->id = $row['id'];
        //$s->orders[] =
        return $customer;
    }

    public function UpdateCustomer(Customers $customer, $id): Customers
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("UPDATE customers SET firstname=:firstname, lastname=:lastname,mail=:mail, phone=:phone,street=:street, password=:password  WHERE id = :id");
        $stmt->bindParam(':firstname', $customer->firstname);
        $stmt->bindParam(':lastname', $customer->lastname);
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
        $stmt = $conn->prepare("DELETE FROM customers WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return 0;
    }

    /**
     * @throws \Exception
     */
    public function login($firstname, $password): string
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT firstname, password FROM customers WHERE firstname = :firstname AND password = :password");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':password', $password);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->execute();

        return $row;
    }
}



