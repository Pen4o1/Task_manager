<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table = 'comment';
    protected $fillable = ['comment_text', 'task_id'];
    
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
