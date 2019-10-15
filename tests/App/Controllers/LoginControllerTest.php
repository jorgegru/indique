<?php

namespace Tests\App\Controllers;

use \Project\Traits\ModelTrait;
use Tests\Functional\BaseTestCase;

class LoginControllerTest extends BaseTestCase 
{
    public function testGetLogin()
    {
        $_SESSION['user'] = null;
        $response = $this->runApp('GET', '/login');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Acesso ao sistema', (string)$response->getBody());
        $this->assertStringContainsString('name="username"', (string)$response->getBody());
        $this->assertStringContainsString('name="password"', (string)$response->getBody());
        $this->assertStringContainsString('type="text"', (string)$response->getBody());
        $this->assertStringContainsString('type="password"', (string)$response->getBody());
    }

    public function testPosLogin()
    {
       // $response = $this->runApp('GET', '/login');
        // $body = '<input type="text" class="form-control" name="username"><input type="password" class="form-control" name="password">';
       
        // $texto=$response->getBody();
        // $posicao = strpos($texto,'name="username"');
        // //substr_replace();
        // $debug2 = fopen("texto.txt","a");
        // fwrite($debug2,$texto);
       
        
        $response = $this->runApp('POST', '/login', ['username'=>'jjjjj'],['password'=>'jjjjj']);
    
        $location = $response->getHeader("location");

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertStringContainsString('login', current($location));



        $data['username'] = 'anlumira@gmail.com';
        $data['password'] = '123123';
        
        $response = $this->runApp('POST', '/login', $data);
var_dump((string)$response->getBody());
        $location = $response->getHeader("location");
        $this->assertStringContainsString('dashboard', current($location));
    }



}
