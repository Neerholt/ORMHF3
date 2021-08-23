<?php

namespace Models;

class Customers extends Jsonable
{
    public int $customersId, $phone, $location_id;
    public string $firstname, $lastname, $mail, $street, $password;
    /**
     * @var Orders[]
     */
    public array $orders;

    public function __construct($name, $lastname, $mail, $phone, $street, $password, $location_id)
    {
        $this->firstname = $name;
        $this->lastname = $lastname;
        $this->mail = $mail;
        $this->phone = $phone;
        $this->street = $street;
        $this->location_id = $location_id;
        $this->password = password_hash($password, PASSWORD_DEFAULT);


    }

    public function GetCustomersId(): int
    {
        return $this->customersId;
    }

    public function SetCustomersId($id): void
    {
        $this->customersId = $id;
    }

    public function GetCustomersName(): string
    {
        return $this->firstname;
    }

    public function SetCustomersName($name): void
    {
        $this->firstname = $name;
    }

    public function GetCustomersMail(): string
    {
        return $this->mail;
    }

    public function SetCustomersMail($mail): void
    {
        $this->mail = $mail;
    }

    public function GetCustomersStreet(): string
    {
        return $this->street;
    }

    public function SetCustomersStreet($street): void
    {
        $this->street = $street;
    }

    public function GetCustomersPhone(): int
    {
        return $this->phone;
    }

    public function SetCustomersPhone($phone): void
    {
        $this->phone = $phone;
    }

    public function SetCustomerPassword($password): void
    {
        $this->password = $password;
    }
}


