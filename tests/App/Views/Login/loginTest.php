<?php

namespace Tests\Views\Login;

use Tests\Functional\BaseTestCase;

class loginTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetLoginPage()
    {
        $response = $this->runApp('GET', '/login');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Acesso ao sistema', (string)$response->getBody());
        // $this->assertStringNotContainsString('Hello', (string)$response->getBody());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostLoginPage()
    {
        $data['username'] = 'jorgegru';
        $data['password'] = 'goulart';
        $response = $this->runApp('POST', '/login', $data);

        // $this->assertEquals(200, $response->getStatusCode());
        echo (string)$response->getBody();
        // $this->assertStringContainsString('Method not allowed', (string)$response->getBody());
    }


    // /**
    //  * Test that the index route with optional name argument returns a rendered greeting
    //  */
    // public function testGetHomepageWithGreeting()
    // {
    //     $response = $this->runApp('GET', '/name');

    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertStringContainsString('Hello name!', (string)$response->getBody());
    // }

  
}
