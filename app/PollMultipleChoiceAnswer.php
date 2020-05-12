<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollMultipleChoiceAnswer extends Model
{
    protected $fillable = ['poll_id', 'question_id', 'answer_id'];

    public function answer() {
        return $this->belongsTo(QuestionChoice::class, 'id', 'answer_id');
    }
}
