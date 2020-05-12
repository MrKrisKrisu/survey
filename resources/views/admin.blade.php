@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>Single Choice - Meinungsbild</h2>
                        <table class="table">
                            <thead>
                            <tr style="font-size: 12px;">
                                <th></th>
                                <th>Trifft voll zu</th>
                                <th>Trifft eher zu</th>
                                <th>Weder noch</th>
                                <th>Trifft eher nicht zu</th>
                                <th>Trifft nicht zu</th>
                                <th>Keine Angabe</th>
                            </tr>
                            </thead>
                            @foreach($questions_sc as $question)
                                <tr>
                                    <td style="max-width: 50%;">{{$question->question}}</td>
                                    @include('admin_res', ['question' => $question, 'value' => 'Trifft voll zu'])
                                    @include('admin_res', ['question' => $question, 'value' => 'Trifft eher zu'])
                                    @include('admin_res', ['question' => $question, 'value' => 'Weder noch'])
                                    @include('admin_res', ['question' => $question, 'value' => 'Trifft eher nicht zu'])
                                    @include('admin_res', ['question' => $question, 'value' => 'Trifft nicht zu'])
                                    @include('admin_res', ['question' => $question, 'value' => 'Keine Angabe'])
                                </tr>
                            @endforeach
                        </table>


                        <h2>Multiple Choice</h2>
                        <table class="table">
                            <thead>
                            <tr style="font-size: 12px;">
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($questions_mc as $question)
                                <tr>
                                    <td style="max-width: 50%;">{{$question->question}}</td>
                                    <td>
                                        <table>
                                        @foreach($question->getMultipleChoiceResults() as $choice)
                                               <tr>
                                                   <td>{{$choice->cnt}}x</td>
                                                   <td>{{$choice->answer}}</td>
                                               </tr>
                                        @endforeach
                                           </table>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
