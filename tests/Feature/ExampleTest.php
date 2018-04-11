<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testNewClientForm()
    {
        $response = $this->get('/clients/new');
        $response->assertStatus(200); // with no error
    }

    public function testProfessorOption()
    {
        $response = $this->get('/clients/new');
        // For look nicer   | get all content and serach for "professor" in the view(HTML)
        $this->assertContains('Professor',
            $response->getContent(),
            'HTML should have Professor'    
        );
    }
}
