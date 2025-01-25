@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold mb-2">{{ $task->title }}</h1>
    <div class="flex items-center gap-4 mb-4">
        <span class="text-gray-600">Status: {{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
        <span class="text-gray-600">Project: {{ $task->project->name }}</span>
    </div>

    {{-- Comment Creation Form --}}
    <div class="mb-8 bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-4">Add New Comment</h2>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            
            <div class="mb-4">
                <textarea 
                    name="content" 
                    rows="3" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Write your comment here..."
                    required
                ></textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors"
            >
                Post Comment
            </button>
        </form>
    </div>

    {{-- Existing Comments --}}
    <h2 class="text-xl font-semibold mb-4">Comments</h2>
    <div class="space-y-4">
        @forelse($task->comments as $comment)
        <div class="border rounded p-4 bg-white shadow-sm">
            <div class="flex justify-between mb-2">
                <span class="text-gray-600 font-medium">{{ $comment->user->name }}</span>
                <span class="text-sm text-gray-500">{{ $comment->created_at->format('M d, Y H:i') }}</span>
            </div>
            <p class="text-gray-800">{{ $comment->content }}</p>
            
            {{-- Optional Delete Button --}}
            @can('delete', $comment)
            <form class="mt-2" action="{{ route('comments.destroy', $comment) }}" method="POST">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    class="text-red-500 text-sm hover:text-red-700"
                    onclick="return confirm('Are you sure you want to delete this comment?')"
                >
                    Delete
                </button>
            </form>
            @endcan
        </div>
        @empty
        <div class="text-gray-500 text-center py-4">
            No comments yet. Be the first to add one!
        </div>
        @endforelse
    </div>
</div>
@endsection