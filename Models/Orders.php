<?php

namespace Models;
class Orders
{
    private $ordersId,$date,$price,$amount;

    public function GetOrdersId(): int{
        return $this->ordersId;
    }
    public function SetOrdersId($id): void{
        $this->ordersId = $id;
    }
    public function GetOrdersDate(): string{
        return $this->date;
    }
    public function SetOrdersDate($date): void{
        $this->date = $date;
    }
    public function GetOrderPrice(): float{
       return $this->price;
    }
    public function SetOrderPrice($price): void{
        $this->price = $price;
    }
    public function GetOrderAmount(): int{
        return $this->amount;
    }
    public function SetOrdersAmount($amount): void{
        $this->amount = $amount;
    }

}