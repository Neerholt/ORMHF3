<?php

interface IOrm{
    /**
     * @return Customers[]
     */
    public function GetCustomers(): array;//Gets all the customers. Index
    public function CreateCustomer(): Customers;//Create the customer. Create
    public function GetCustomer(int $id): Customers; //Reads one customer. Read
    public function UpdateCustomer(int $id): Customers;//Update the customer. Update
    public function DeleteCustomer(int $id): bool;//Delete the customer. Delete

}




