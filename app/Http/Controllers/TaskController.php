<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AddTaskRequest;
use App\Repositories\TaskRepository;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function __construct(TaskRepository $taskRepository)
    {
        $this->middleware('auth');
        $this->tasks = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->collection($req->user()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTaskRequest $req)
    {
        Task::create($req->all() + ['user_id' => \Auth::user()->id]);
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }
}
