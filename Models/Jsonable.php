<?php
namespace Models;

abstract class Jsonable
{
    public function conToJson(): string{
        return json_encode(get_object_vars($this));
    }

    public function __toString(): string
    {
        return $this->conToJson();
    }
}