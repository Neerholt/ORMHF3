<?php

class Customers
{
    private int $customersId,$phone;
    private string $name,$mail,$street;
    /**
     * @var Orders[]
     */
    public array $orders;

    public function GetCustomersId(): int{
        return $this->customersId;
    }
    public function SetCustomersId($id): void{
        $this->customersId = $id;
    }
    public function GetCustomersName(): string{
        return $this->name;
    }
    public function SetCustomersName($name): void{
        $this->name = $name;
    }
    public function GetCustomersMail(): string{
        return $this->mail;
    }
    public function SetCustomersMail($mail): void{
        $this->mail = $mail;
    }
    public function GetCustomersStreet(): string{
        return $this->street;
    }
    public function SetCustomersStreet($street): void{
        $this->street = $street;
    }
    public function GetCustomersPhone(): int{
        return $this->phone;
    }
    public function SetCustomersPhone($phone): void{
        $this->phone = $phone;
    }
}

/*
$d = new Customers();
$d->orders[0] = new Orders();
$d->orders[0]->GetOrderAmount()
*/
