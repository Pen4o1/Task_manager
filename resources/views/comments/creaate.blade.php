@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Comment to Task: {{ $task->title }}</h1>
    
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
            <textarea name="content" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Comment</button>
    </form>
</div>
@endsection