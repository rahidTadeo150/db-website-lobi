<?php
namespace App\Models;
use Laravel\Passport\Client;

class passport extends Client
{

    public function skipAuthorization()
    {
        return false;
    }
}