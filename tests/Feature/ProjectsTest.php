<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
  use withFaker, RefreshDatabase; /* RefreshDatabase: after test, reset everything to initial state */

  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function test_example()
  {
    $response = $this->get('/');

    $response->assertStatus(200);
  }

  public function test_a_user_can_create_project()
  {
    $this->withoutExceptionHandling();

    $attributes = [
      'title' => $this->faker->sentence,
      'description' => $this->faker->paragraph
    ];

    $this->post('/projects', $attributes)->assertRedirect('/projects');

    $this->assertDatabaseHas('projects', $attributes);

    $this->get('/projects')->assertSee($attributes['title']);
  }
}
