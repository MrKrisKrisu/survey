@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Befragung zum Thema {{env('SUBJECT')}}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST">
                            @csrf

                            <div class="form-group col-md-4">
                                <label for="inputState">Ich befinde mich in folgendem Semester:</label>
                                <select id="inputState" class="form-control" name="semester">
                                    <option selected>Bitte wählen...</option>
                                    @for($i = 1; $i < 20; $i++)
                                        <option>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                            <table class="table table-striped">
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
                                <tbody>
                                @foreach($questions_os as $question)
                                    <tr>
                                        <td style="max-width: 50%;">{{$question->question}}</td>
                                        <td style="text-align: center;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="question[{{$question->id}}]"
                                                       value="Trifft voll zu" {{ old('question.' . $question->id)== "Trifft voll zu" ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="question[{{$question->id}}]"
                                                       value="Trifft eher zu" {{ old('question.' . $question->id)== "Trifft eher zu" ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="question[{{$question->id}}]"
                                                       value="Weder noch" {{ old('question.' . $question->id)== "Weder noch" ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="question[{{$question->id}}]"
                                                       value="Trifft eher nicht zu" {{ old('question.' . $question->id)== "Trifft eher nicht zu" ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="question[{{$question->id}}]"
                                                       value="Trifft nicht zu" {{ old('question.' . $question->id)== "Trifft nicht zu" ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="question[{{$question->id}}]"
                                                       value="Keine Angabe" {{ old('question.'.$question->id , "Keine Angabe")== "Keine Angabe" ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr/>
                            <table class="table table-striped">
                                <tbody>
                                @foreach($questions_mc as $question)
                                    <tr>
                                        <td>{{$question->question}}<br/><small>(Mehrfachauswahl möglich, Shift bzw. Strg + anklicken)</small></td>
                                        <td>
                                            <select multiple class="form-control" name="question[{{$question->id}}][]" size="6">
                                                @foreach($question->multipleChoiceAnswers as $choice)
                                                    <option value="{{$choice->id}}">{{$choice->answer}}</option>
                                                @endforeach
                                            </select>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr/>
                            <table class="table table-striped">
                                <tbody>
                                @foreach($questions_text as $question)
                                    <tr>
                                        <td>{{$question->question}}</td>
                                        <td>
                                            <textarea name="question[{{$question->id}}]" class="form-control"></textarea>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr/>
                            <button type="submit" class="btn btn-success">Befragung fertigstellen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
