@extends('template')

@section('content')
    <div class="mdl-cell mdl-cell--12-col center">
        <h1>Problem Detail</h1>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp">
        <div class="mdl-card__title">
            <h3><b>{{$problem->id}}</b> > {{ $problem->name }}</h3><br>
        </div>
        <div class="mdl-card__supporting-text mdl-card--expand">
            <h5><b>Description:</b> {{ $problem->description }}</h5><br>
            <h5><b>Lesson:</b> {{ $problem->lesson->name }}</h5><br>
            <h5><b>Evaluator:</b> {{ $problem->evaluator }}</h5>
            <h5><b>TimeLimit:</b> {{ $problem->timelimit }} Sec</h5>
            <h5><b>MemoryLimit:</b> {{ $problem->memorylimit }} MB</h5>
            <h5><b>Problem Submission:</b> {{ $problem->submissions_count }}</h5>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a href="{{ url('problem/'.$problem->id.'/edit') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                edit
            </a>
        </div>
        <div class="mdl-card__menu">
            {!! Form::model($problem, ['method' => 'DELETE', 'url'=>'problem/'.$problem->id]) !!}
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                <i class="material-icons">cancel</i>
            </button>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-card code-card mdl-shadow--4dp" id="editor" >
        {{ $problem->code }}
    </div>

    <div class="mdl-cell mdl-cell--12-col">
        <div class="mdl-card__title">
            <h4>Problem Structures (Teacher Require)</h4>
        </div>
    </div>

    @foreach($problem->problemAnalysis as $analysis)
        <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title">
                <h4><b>{{ str_replace(';', ' ', $analysis->class) }}</b></h4>
            </div>
            <div class="mdl-card__supporting-text mdl-card--expand">
                <p>
                    <b>Package</b>: {{ $analysis->package }}<br>
                    <b>Enclose</b>: {{ $analysis->enclose }}<br>
                </p>
            </div>
            <div class="mdl-card__actions mdl-card--border">

            </div>
            <div class="mdl-card__menu">

            </div>
        </div>
        <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title">
                <b>Constructor</b>
            </div>
            <table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">ID</th>
                    <th>Access Modifier</th>
                    <th>Name</th>
                    <th>Parameter</th>
                    <th>Score</th>
                </tr>
                </thead>
                <tbody>
                @foreach($analysis->constructors as $constructor)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{ $constructor->id }}</td>
                        <td>{{ $constructor->access_modifier }}</td>
                        <td>{{ $constructor->name }}</td>
                        <td>{{ $constructor->parameter }}</td>
                        <td>{{ $constructor->score }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title">
                <b>Attribute</b>
            </div>
            <table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">ID</th>
                    <th>Access Modifier</th>
                    <th>Non-Access Modifier</th>
                    <th>Data Type</th>
                    <th>Name</th>
                    <th>Score</th>
                </tr>
                </thead>
                <tbody>
                @foreach($analysis->attributes as $attribute)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{ $attribute->id }}</td>
                        <td>{{ $attribute->access_modifier }}</td>
                        <td>{{ $attribute->non_access_modifier }}</td>
                        <td>{{ $attribute->data_type }}</td>
                        <td>{{ $attribute->name }}</td>
                        <td>{{ $attribute->score }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
            <div class="mdl-card__title">
                <b>Method</b>
            </div>
            <table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table">
                <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">ID</th>
                    <th>Access Modifier</th>
                    <th>Non-Access Modifier</th>
                    <th>Return Type</th>
                    <th>Name</th>
                    <th>Parameter</th>
                    <th>Score</th>
                </tr>
                </thead>
                <tbody>
                @foreach($analysis->methods as $method)
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">{{ $method->id }}</td>
                        <td>{{ $method->access_modifier }}</td>
                        <td>{{ $method->non_access_modifier }}</td>
                        <td>{{ $method->return_type }}</td>
                        <td>{{ $method->name }}</td>
                        <td>{{ $method->parameter }}</td>
                        <td>{{ $method->score }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mdl-cell mdl-cell--12-col">
            <hr>
            <br>
        </div>
    @endforeach

    <div class="mdl-cell mdl-cell--12-col">
        <div class="mdl-card__title">
            <h4>Problem Submission</h4>
        </div>
    </div>
    <table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table mdl-shadow--2dp">
        <thead>
        <tr>
            <th class="mdl-data-table__cell--non-numeric">StudentID</th>
            <th>Username</th>
            <th>ProblemID</th>
            <th>SubNum</th>
            <th>SubTime</th>
            <th>View</th>
            {{--<th>Delete</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($problem->submissions as $submission)
            <tr>
                <td class="mdl-data-table__cell--non-numeric">{{ $submission->student->student_id }}</td>
                <td>{{ $submission->student->username }}</td>
                <td>{{ $submission->problem_id }}</td>
                <td>{{ $submission->sub_num }}</td>
                <td>{{ $submission->created_at }}</td>
                <td>
                    <a href="{{ url('submission/'.$submission->id) }}"
                       class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        <i class="material-icons">launch</i>
                    </a>
                </td>
                {{--<td>
                    {!! Form::model($submission, ['method' => 'DELETE', 'url'=>'submission/'.$submission->id]) !!}
                    <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                        <i class="material-icons">cancel</i>
                    </button>
                    {!! Form::close() !!}
                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mdl-cell mdl-cell--12-col right">
        <a href="{{ url('submission/create') }}" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>

    <script src="{{ URL::asset('CodeRoom/js/lib/ace-builds/src-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/java");
    </script>
@stop