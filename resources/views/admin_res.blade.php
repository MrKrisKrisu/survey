@php($perc = $question->answerCnt() == 0 ? 0 : ($question->answers()[$value] ?? 0) / $question->answerCnt() * 100)

<td style="text-align: center;"
    class="table-{{$perc > 80 ? 'danger' : ($perc > 60 ? 'warning' : ($perc > 40 ? 'success' : ''))}}">
    {{$question->answers()[$value] ?? '0'}}
</td>
