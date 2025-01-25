<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = ['title', 'status', 'project_id'];

    public function project()
    {
        return $this->belongsTo(ProjectModel::class);
    }

    public function comments()
    {
        return $this->hasMany(CommentModel::class, 'task_id');
    }
}
