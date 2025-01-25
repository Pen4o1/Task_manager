<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = ['name', 'description'];

    public function tasks()
    {
        return $this->hasMany(TaskModel::class);
    }
}
