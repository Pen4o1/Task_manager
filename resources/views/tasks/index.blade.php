@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">New Task</a>
</div>

<table class="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Project</th>
            <th class="px-6 py-3 bg-gray-50"></th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach($tasks as $task)
        <tr x-data="{ open: false }">
            <td class="px-6 py-4 whitespace-nowrap">{{ $task->title }}</td>
            <td class="px-6 py-4">
                <span class="px-2 py-1 text-sm rounded-full 
                    @if($task->status === 'open') bg-green-100 text-green-800
                    @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                </span>
            </td>
            <td class="px-6 py-4">{{ $task->project->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <form class="inline-block" action="{{ route('tasks.destroy', $task) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
                <button @click="open = !open" class="text-green-600 hover:text-green-900">
                    Add Comment
                </button>
                <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-900">
                    View Comments ({{ $task->comments->count() }})
                </a>
            </td>
        </tr>
        <tr x-show="open" class="bg-gray-50">
            <td colspan="4" class="px-6 py-4">
                <form action="{{ route('comments.store') }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <textarea 
                        name="content" 
                        rows="2"
                        class="flex-1 rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Write your comment..."
                        required
                    ></textarea>
                    <button 
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 self-start"
                    >
                        Post Comment
                    </button>
                </form>
                @error('content')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection