<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class TestController
{
    public function test(): Response
    {

        return new Response(
            '<html><body><h1>Test</h1></body></html>'
        );
    }
}
