@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Project</h1>
    
    <form method="POST" action="{{ route('projects.update', $project) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="{{ old('name', $project->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" 
                      rows="3">{{ old('description', $project->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection