@php
    $isEdit = isset($project);
@endphp

<form method="POST" action="{{ $isEdit ? route('projects.update', $project) : route('projects.store') }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
        <input type="text" name="name" value="{{ old('name', $project->name ?? '') }}" 
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
        <textarea name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3">{{ old('description', $project->description ?? '') }}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ $isEdit ? 'Update' : 'Create' }} Project</button>
</form>