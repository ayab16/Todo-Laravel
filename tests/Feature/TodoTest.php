<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_new_todo_can_be_added_to_the_list()
    {
        $response = $this->post("/MyTodos", [
            "label"=> "first task",
            "user"=> "ayoub",
        ]);

        $response->assertOk();

        $this->assertCount(1, Todo::all());
    }

    /** @test */
    public function the_label_is_required()
    {
        $response = $this->post("/MyTodos", [
            "label"=> "",
            "user"=> "ayoub",
        ]);

        $response->assertSessionHasErrors('label');
    }

    /** @test */
    public function the_user_is_required()
    {
        $response = $this->post("/MyTodos", [
            "label"=> "first task",
            "user"=> "",
        ]);

        $response->assertSessionHasErrors('user');
    }

    /** @test */
    public function the_task_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post("/MyTodos", [
            "label"=> "first task",
            "user"=> "ayoub",
        ]);

        $todo = Todo::first();

        $response = $this->patch( '/MyTodos/'. $todo->id, [
            "label"=> "first task update",
            "user"=> "ayoub",
        ]);

        $this->assertEquals("first task update", Todo::first()->label);
    }


}
