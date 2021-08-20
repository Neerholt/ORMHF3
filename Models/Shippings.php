<?php
namespace Models;
class Shippings
{
    private $shippingId, $data, $status;

    public function GetShippingId(): int{
       return $this->shippingId;
    }
    public function SetShippingId($shipping): void{
        $this->shippingId = $shipping;
    }
    public function GetShippingData(): string{
        return $this->data;
    }
    public function SetShippingStatus(): string{
        return $this->status;
    }
    public function GetShippingStatus($status): void{
        $this->status = $status;
    }

}