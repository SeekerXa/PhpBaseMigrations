<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CityControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_city_create_succesed()
    {
       // Log::info('Test started!');
        $response = $this->postJson('api/cities', ['name' => 'babica']);
        $response->assertStatus(201);
    }

    public function test_city_create_validation_failed()
    {
       $response = $this->postJson('api/cities', ['name' => 'debica2']);
       $response->assertStatus(422);
    }

    public function test_city_update_succesed()
    {
        $response = $this->putJson('api/cities/1', ['name' => 'rzeszow']);
        $response->assertStatus(200);
    }
    public function test_city_update_failed_wrong_id()
    {
        $response = $this->putJson('api/cities/111111', ['name' => 'rzeszow']);
        $response->assertStatus(404);
    }

    public function test_city_update_failed_wrong_name()
    {
        $response = $this->putJson('api/cities/1', ['name' => 'rzeszow222']);
        $response->assertStatus(422);
    }
    public function test_city_update_failed_wrong_null_name()
    {
        $response = $this->putJson('api/cities/1', ['name' => null]);
        $response->assertStatus(422);
    }

    public function test_city_delete_succesed()
    {
        $response = $this->deleteJson('api/cities/1');
        $response->assertStatus(204);
    }

    public function test_city_delete_fail_wrong_id()
    {
        $response = $this->deleteJson('api/cities/1111111');
        $response->assertStatus(404);
    }
}
