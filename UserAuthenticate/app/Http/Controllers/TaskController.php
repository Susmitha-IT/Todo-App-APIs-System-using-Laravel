<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function getTasks()
    {
        $userId = session('user_id');
        $tasks = Task::where('user_id', $userId)->get();
        return response()->json([
            'tasks' => $tasks
        ]);
    }
    public function add(Request $request)
    {
        $request->validate([
            'task' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::create([
            'task' => $request->task,
            'user_id' => $request->user_id,
            'status' => 'pending',
        ]);

        return response()->json([
            'task' => $task,
            'status' => 1,
            'message' => 'Successfully created a task'
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'status' => 'required|in:pending,done',
        ]);

        $task = Task::findOrFail($request->task_id);
        $task->status = $request->status;
        $task->save();

        $message = $task->status === 'done' ? 'Marked task as done' : 'Marked task as pending';

        return response()->json([
            'task' => $task,
            'status' => 1,
            'message' => $message
        ]);
    }
}
