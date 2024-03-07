<?php

namespace App\Services;

use App\Models\People;

class PeopleService
{
    public function __construct()
    {
        // Constructor of the class
    }

    public function store(array $data): People
    {
        $people = new People($data);
        $people->save();
        return $people;
    }
}
