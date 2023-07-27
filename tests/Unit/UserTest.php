<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_register()
    {
        $formData = [
            "username" => "MNafisN 3",
            "name" => "M Nafis 3",
            "email" => "mnafisn3@gmail.com",
            "password" => "admin3"
        ];

        $response = $this->post('api/auth/register', $formData);

        $response->assertStatus(201);
    }

    public function test_login()
    {
        $formData = [
            "email" => "mnafisn@gmail.com",
            "password" => "admin1"
        ];

        $response = $this->post('api/auth/login', $formData);

        $response->assertStatus(200);
    }
}
