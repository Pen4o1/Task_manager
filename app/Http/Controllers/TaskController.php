<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use App\Models\TaskModel;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = TaskModel::with('project')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = ProjectModel::all();
        $statuses = ['open', 'in_progress', 'closed'];
        return view('tasks.create', compact('projects', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:open,in_progress,closed',
            'project_id' => 'required|exists:projects,id' // Matches table name
        ]);

        TaskModel::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function show(TaskModel $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(TaskModel $task)
    {
        $projects = ProjectModel::all();
        $statuses = ['open', 'in_progress', 'closed'];
        return view('tasks.edit', compact('task', 'projects', 'statuses'));
    }

    public function update(Request $request, TaskModel $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:open,in_progress,closed',
            'project_id' => 'required|exists:projects,id'
        ]);

        $task->update($validated);
        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(TaskModel $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}