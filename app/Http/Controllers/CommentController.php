<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\TaskModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = CommentModel::with(['task', 'user'])->latest()->get();
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TaskModel $task)
    {
        return view('comments.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'task_id' => 'required|exists:tasks,id'
        ]);

        CommentModel::create([
            'content' => $validated['content'],
            'task_id' => $validated['task_id'],
            'user_id' => auth()->id()
        ]);

        return redirect()->route('tasks.show', $validated['task_id'])
            ->with('success', 'Comment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentModel $comment)
    {
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentModel $comment)
    {
        $tasks = TaskModel::all();
        $users = User::all();
        return view('comments.edit', compact('comment', 'tasks', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommentModel $comment)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'task_id' => 'required|exists:tasks,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $comment->update($validated);

        return redirect()->route('comments.index')
            ->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentModel $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')
            ->with('success', 'Comment deleted successfully.');
    }
}