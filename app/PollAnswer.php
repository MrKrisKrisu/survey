<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    protected $fillable = ['poll_id', 'question_id', 'answer'];
}
