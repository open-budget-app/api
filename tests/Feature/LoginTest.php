<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('passport:install', ['-vvv' => true]);

        $this->user = factory(User::class)->create([
            'email' => 'existinguser@example.com',
            'password' => Hash::make('supersecret'),
        ]);
    }

    /**
     * @test
     */
    public function user_can_login()
    {

        $response = $this->json('POST','/api/login', [
            'email' => $this->user->email,
            'password' => 'supersecret',
        ]);

        $response->assertStatus(200);

    }


    /**
     * @test
     */
    public function user_can_register()
    {

        $response = $this->json('POST', '/api/register', [
            'email' => 'johndoe@example.com',
            'name' => 'John Doe',
            'password' => 'supersecret',
            'confirm_password' => 'supersecret',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);

    }

    /**
     * @test
     */
    public function user_can_not_register_if_email_address_already_exists()
    {

        $response = $this->json('POST','/api/register', [
            'email' => 'existinguser@example.com',
            'name' => 'John Doe',
            'password' => 'supersecret',
            'confirm_password' => 'supersecret',
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', ['email' => 'johndoe@example.com']);

    }
}
