<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    // public $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create([
            "name"      => "Prabin",
            "email"     => "prabin@tdd.test"
        ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_create_a_note(): void
    {

        // A User Sent Post Request to "/notes" routes with notes:title, description,
        $response = $this->actingAs($this->user)->post("/notes", [
            "title"        => "TDD",
            "description"  => "Cool way to ensure your code works",
        ]);


        // Assert that a notes with id, title, is created and redirect to /notes page
        $this->assertDatabaseCount("notes", 1);
        $this->assertDatabaseHas("notes", ["title" => "TDD"]);
        $response->assertRedirect("/");
        
    }

    /**
     */
    public function  test_get_error_when_title_field_is_not_provided_when_creating_a_note(): void
    {
            
        // $this->disableExceptionHandling();

        // Post to  "/notes" with notes: title, description 
        $response = $this->actingAs($this->user)->post("/notes", [
            "description"  => "Cool way to ensure your code works",
        ]);

        // Assert that the session has errros
        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount("notes", 0);

        $response = $this->actingAs($this->user)->post("/notes", [
            "title"        => "Passed TDD",
            "description"  => "TDD Passed",
        ]);

        $this->assertDatabaseCount("notes", 1);
        $this->assertDatabaseHas("notes", ["title" => "Passed TDD"]);

   }


}
