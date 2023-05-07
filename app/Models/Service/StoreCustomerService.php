<?php

namespace App\Models\Service;

use App\Models\Customer;

class StoreCustomerService
{
    public function store($name, $city)
    {
        Customer::create([
            'name' => $name,
            'city' => $city,
        ]);
    }
}
