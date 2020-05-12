<?php

namespace App\Http\Controllers;

use App\Poll;
use App\PollAnswer;
use App\PollMultipleChoiceAnswer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PollController extends Controller
{
    public function renderPoll(Request $request)
    {
        if ($request->cookie('poll'))
            return view('poll_result');

        $questions_os = Question::where('type', 'single_choice_opinion_scale')->inRandomOrder()->get();
        $questions_mc = Question::where('type', 'multiple_choice')->inRandomOrder()->get();
        $questions_text = Question::where('type', 'text')->inRandomOrder()->get();

        return view('poll', [
            'questions_os' => $questions_os,
            'questions_mc' => $questions_mc,
            'questions_text' => $questions_text
        ]);
    }

    public function handlePollResult(Request $request)
    {

        $validateMap = [
            'semester' => ['required', 'integer']
        ];

        $questions = Question::all();
        foreach ($questions as $question) {
            switch ($question->type) {
                case 'single_choice_opinion_scale':
                    $validateMap['question.' . $question->id] = ['required'];
                    break;
                case 'multiple_choice':
                    $validateMap['question.' . $question->id] = ['required']; //TODO: Check Count
                    break;
                case 'text':
                    $validateMap['question.' . $question->id] = ['string', 'nullable'];
                    break;
            }
        }
        $validatedData = $request->validate($validateMap, [
            'semester.integer' => 'Bitte wählen Sie ihr Semester aus.'
        ]);

        try {
            $poll = Poll::create([
                'semester' => $validatedData['semester']
            ]);

            foreach ($validatedData['question'] as $q_id => $q_answer) {
                $question = Question::find($q_id);
                switch ($question->type) {
                    case 'single_choice_opinion_scale':
                    case 'text':
                        PollAnswer::create([
                            'poll_id' => $poll->id,
                            'question_id' => $q_id,
                            'answer' => $q_answer
                        ]);
                        break;
                    case 'multiple_choice':
                        dump($q_answer);
                        foreach($q_answer as $a) {
                            dump($a);
                            PollMultipleChoiceAnswer::create([
                                'poll_id' => $poll->id,
                                'question_id' => $q_id,
                                'answer_id' => $a
                            ]);
                        }
                        break;
                }

            }
        } catch (\Exception $e) {

        }

        $response = new Response(view('poll_result'));
        $response->withCookie(cookie('poll', 'succeed', 45000));
        return $response;
    }
}
