<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //

    protected function index()
    {
        $incomplete = Task::where('status', 'incomplete')->get();
        $complete = Task::where('status', 'complete')->get();

        return view('tasks', ['incomplete_tasks'=> $incomplete, 'complete_tasks'=> $complete]);
    }

    protected function addTask(Request $request)
    {
        $validated = $request->validate([
            'task' => 'required'
        ]);

        if(!$validated) {
            return redirect('tasks')->with('error', 'Task is required');
        }

        $task = new Task;

        $task->task = $request->task;
        $task->status = 'incomplete';

        if($task->save()){
            return redirect('tasks')->with('success', 'Item Added Successfully');
        } else {
            return redirect('tasks')->with('error', 'Failed to Add Item');
        }
    }

    protected function markAsComplete($id)
    {
        $task = Task::find($id);

        $task->status = 'complete';

        if($task->save()){
            return redirect('tasks')->with('success', 'Task Complete Success');
        } else {
            return redirect('tasks')->with('error', 'Failed to Complete Task');
        }
    }

    protected function delete($id)
    {
        $task = Task::find($id);


        if($task->delete()){
            return redirect('tasks')->with('success', 'Task Deleted Successfully');
        } else {
            return redirect('tasks')->with('error', 'Failed to Delete Task');
        }
    }
}
