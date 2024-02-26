<?php

namespace Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateUserActionTest extends WebTestCase
{
    public function testCreateUser(): void
    {
        $client = static::createClient();

        $userData = [
            'email' => 'test@example.com',
            'firstName' => 'firstName',
            'lastName' => 'lastName',
        ];

        $client->request(
            'POST',
            '/users',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($userData)
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}