<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{

    protected $fillable = ['question', 'type'];

    public function answers()
    {
        $ret = [];
        $answers = PollAnswer::where('question_id', $this->id)->groupBy('answer')->select(['answer', DB::raw('COUNT(*) as cnt')])->get();
        foreach ($answers as $answer)
            $ret[$answer->answer] = $answer->cnt;
        return $ret;
    }

    public function answerCnt()
    {
        return PollAnswer::where('question_id', $this->id)->count();
    }

    public function multipleChoiceAnswers()
    {
        return $this->hasMany(QuestionChoice::class, 'question_id', 'id');
    }

    public function getMultipleChoiceResults()
    {
        return QuestionChoice::join('poll_multiple_choice_answers', 'poll_multiple_choice_answers.answer_id', '=', 'question_choices.id')
            ->where('poll_multiple_choice_answers.question_id', $this->id)
            ->groupBy('poll_multiple_choice_answers.answer_id')
            ->select(DB::raw('question_choices.*'), DB::raw('COUNT(*) AS cnt'))
            ->orderBy(DB::raw('COUNT(*)'), 'desc')
            ->get();
    }
}
