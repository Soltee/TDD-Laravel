<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_form()
    {
        $res = $this->get('/login');

        $res->assertStatus(200);
    }

    public function test_user_email_cannot_be_same()
    {
        $user1 = User::make([
            'name'  => 'John Doe',
            'email' => 'john@gmail.com'
        ]);
        $user2 = User::make([
            'name'  => 'Dary Doe',
            'email' => 'dary@gmail.com'
        ]);

        $this->assertTrue($user1->name !== $user2->name);
    }
 

    public function test_it_can_store_an_user()
    {
        $res = $this->post('/register', [
            'name'  => 'Hello',
            'email' => 'hello@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $this->assertDatabaseHas('users', [
            'name'  => 'Hello'
        ]);

        $res->assertRedirect('/home');
    }

    /** DB Testin */
    public function test_database_has_user()
    {   
        $this->post('/register', [
            'name'  => 'Lary',
            'email' => 'lary@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $this->assertDatabaseHas('users', [
            'name'  => 'Lary'
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  => 'Bary'
        ]);
    }

    /** Seed Test */
    public function test_seeder_works()
    {   
        $this->seed(); //Seed all seedersin  the seeders folder
        // php artisan db:seed
    }
}
