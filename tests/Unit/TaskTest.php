<?php

namespace Tests\Unit;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_task()
    {
        $this->withoutMiddleware([\App\Http\Middleware\Authenticate::class, \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class]);

        $response = $this->post('/add-task',[
            "task"=>"This is a new Task (Test)"
        ]);

        $response->assertRedirect('/tasks');
    }

    public function test_delete_task()
    {
        $this->withoutMiddleware([\App\Http\Middleware\Authenticate::class, \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class]);

        $user = Task::create([
            'task' => 'Test Task',
            'status' => 'incomplete'
        ]);


        $response = $this->get('/delete-task/'.$user['id']);

        $response->assertRedirect('/tasks');
    }

}
