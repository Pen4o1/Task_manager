<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = ['content', 'task_id', 'user_id'];

    public function task()
    {
        return $this->belongsTo(TaskModel::class, 'task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
