<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    protected $table = 'project';
    protected $fillable = ['project_name'];


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
