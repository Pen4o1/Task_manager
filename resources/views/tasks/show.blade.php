@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold mb-2">{{ $task->title }}</h1>
    <div class="flex items-center gap-4 mb-4">
        <span class="text-gray-600">Status: {{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
        <span class="text-gray-600">Project: {{ $task->project->name }}</span>
    </div>

    <div class="mb-8">
        <a href="{{ route('comments.create', $task) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Comment</a>
    </div>

    <h2 class="text-xl font-semibold mb-4">Comments</h2>
    <div class="space-y-4">
        @foreach($task->comments as $comment)
        <div class="border rounded p-4">
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">{{ $comment->user->name }}</span>
                <span class="text-sm text-gray-500">{{ $comment->created_at->format('M d, Y H:i') }}</span>
            </div>
            <p>{{ $comment->content }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection