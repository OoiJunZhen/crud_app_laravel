<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
        
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'due_date' => 'required',
            'description' => 'nullable'
        ]);

        $newTask = Task::create($data);

        return redirect(route('tasks.index'));
    }

    public function show(Task $id){
        return view('tasks.show', ['id' => $id]);
    }

    public function edit(Task $id){
        return view('tasks.edit', ['id' => $id]);
    }

    public function update(Task $id, Request $request){
        $data = $request->validate([
            'title' => 'required',
            'due_date' => 'required',
            'description' => 'nullable'
        ]);

        $id->update($data);

        return redirect(route('tasks.index'))->with('success', 'Task Updated Successfully');
    }

    public function destroy(Task $id){
        $id->delete();
        return redirect(route('tasks.index'))->with('success', 'Task Deleted Successfully');
    }

}
