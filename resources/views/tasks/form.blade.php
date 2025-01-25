@php
    $isEdit = isset($task);
@endphp

<form method="POST" action="{{ $isEdit ? route('tasks.update', $task) : route('tasks.store') }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
        <input type="text" name="title" value="{{ old('title', $task->title ?? '') }}" 
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
        <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach(['open', 'in_progress', 'closed'] as $status)
                <option value="{{ $status }}" @selected(old('status', $task->status ?? '') === $status)>
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Project</label>
        <select name="project_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" @selected(old('project_id', $task->project_id ?? '') == $project->id)>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ $isEdit ? 'Update' : 'Create' }} Task</button>
</form>