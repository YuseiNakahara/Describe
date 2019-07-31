<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DescribeTest extends TestCase
{
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function indexTest()
    {
        $response = $this->get('/describe');

        $response->assertStatus(200);
    }

    public function createTest()
    {
        $response = $this->get('/describe/create');
        $response->assertStatus(200);
    }
}
