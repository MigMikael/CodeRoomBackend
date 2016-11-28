<!doctype html>
<html lang="en">
<head>
    @include('_head')
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">Submission Detail</span>
        </div>
        <!-- Tabs -->
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
            <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Summary</a>
            @for($i = 0; $i < sizeof($submission->submissionFiles); $i++)
                <a href="#scroll-tab-{{$i+2}}" class="mdl-layout__tab">{{ $submission->submissionFiles[$i]->filename }}</a>
            @endfor
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Model</span>
        @include('_nav')
    </div>
    <main class="mdl-layout__content">
        <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
            <div class="mdl-grid page-max-width">
                <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__media" style="background-color: #FFFFFF">
                        <img src="{{ url('api/image/'.$submission->student->image) }}" alt="Student Image" class="article-image" border="0"/>
                    </div>
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">{{ $submission->student->name }}</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <h6>
                            <b>Sub Num:</b> {{ $submission->sub_num }}<br>
                            <b>Sub Time:</b> {{ $submission->created_at }}
                        </h6>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="{{ url('student/'.$submission->student->id) }}"
                           class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" target="_blank">
                            Student Profile
                        </a>
                    </div>
                    <div class="mdl-card__menu">
                        {!! Form::model($submission, ['method' => 'DELETE', 'url'=>'submission/'.$submission->id]) !!}
                        <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">
                            <i class="material-icons">cancel</i>
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h3><b>{{$submission->id}}</b> > {{ $submission->student->student_id }} <u>on</u> {{ $submission->problem->name }}</h3><br>
                    </div>
                    <div class="mdl-card__supporting-text mdl-card--expand">
                        <h6><b>Lesson:</b> {{ $submission->problem->lesson->name }}</h6>
                        <h6><b>Evaluator:</b> {{ $submission->problem->evaluator }}</h6>
                        <h6><b>TimeLimit:</b> {{ $submission->problem->timelimit }} Sec</h6>
                        <h6><b>MemoryLimit:</b> {{ $submission->problem->memorylimit }} KB</h6>
                        <h6><b>Analyze Structures:</b> {{ $submission->problem->is_parse }}</h6>
                    </div>
                </div>
            </div>
            <div class="mdl-grid page-max-width">
                @foreach($submission->submissionFiles as $submissionFile)
                    <div class="mdl-cell mdl-cell--12-col">
                        <h2>{{ $submissionFile->filename }}</h2>
                    </div>
                    @foreach($submissionFile->outputs as $output)
                        <div class="mdl-cell mdl-cell--2-col mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">Test Case: <b>{{ $output->id }}</b></h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                Score <h1>{{ $output->score }}</h1>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </section>

        @for($i = 0; $i < sizeof($submission->submissionFiles); $i++)
            <section class="mdl-layout__tab-panel" id="scroll-tab-{{$i+2}}">
                <div class="mdl-grid page-max-width">
                    <div class="mdl-cell mdl-cell--7-col mdl-card code-card mdl-shadow--4dp" id="editor{{$i+2}}" >
                        {{ $submission->submissionFiles[$i]->code }}
                    </div>

                    <div class="mdl-cell mdl-cell--5-col mdl-card mdl-shadow--4dp">

                        @foreach($submission->submissionFiles[$i]->results as $result)
                            <div class="mdl-card mdl-cell mdl-cell--12-col mdl-shadow--2dp">
                                <div class="mdl-card__title">
                                    <h4>{{ $result->class }}</h4>
                                </div>
                                <div class="mdl-card__supporting-text mdl-card--expand">
                                    <b>Package:</b> {{ $result->package }}
                                    <b>Enclose:</b> {{ $result->enclose }}
                                    <b>Extends:</b> {{ $result->extends }}
                                    <b>Implements:</b> {{ $result->implements }}
                                </div>
                            </div>
                            <ul class="mdl-list">
                                <li class="mdl-list__item">
                                    <h5>Attribute</h5>
                                </li>
                                @foreach($result->attributes as $attribute)
                                    <li class="mdl-list__item mdl-list__item--three-line">
                                        <span class="mdl-list__item-primary-content">
                                          <i class="material-icons mdl-list__item-avatar">accessibility</i>
                                          <span>{{ $attribute->access_modifier }} {{ $attribute->non_access_modifier }} {{ $attribute->data_type }} <b>{{ $attribute->name }}</b></span>
                                          <span class="mdl-list__item-text-body">
                                              <b>Score</b>: {{ $attribute->score }}
                                          </span>
                                        </span>
                                        <span class="mdl-list__item-secondary-content">
                                            <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
                                        </span>
                                    </li>
                                @endforeach
                                <li class="mdl-list__item">
                                    <h5>Constructor</h5>
                                </li>
                                @foreach($result->constructors as $constructor)
                                    <li class="mdl-list__item mdl-list__item--three-line">
                                        <span class="mdl-list__item-primary-content">
                                          <i class="material-icons mdl-list__item-avatar">account_balance</i>
                                          <span>{{ $constructor->access_modifier }} <b>{{ $constructor->name }}</b></span>
                                          <span class="mdl-list__item-text-body">
                                              <b>Score :</b> {{ $constructor->score }}
                                              <b>Parameter :</b>{{ $constructor->parameter }}
                                          </span>
                                        </span>
                                        <span class="mdl-list__item-secondary-content">
                                            <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
                                        </span>
                                    </li>
                                @endforeach
                                <li class="mdl-list__item">
                                    <h5>Method</h5>
                                </li>
                                @foreach($result->methods as $method)
                                    <li class="mdl-list__item mdl-list__item--three-line">
                                        <span class="mdl-list__item-primary-content">
                                          <i class="material-icons mdl-list__item-avatar">directions_run</i>
                                          <span>{{ $method->access_modifier }} {{ $method->non_access_modifier }} {{ $method->return_type }} <b>{{ $method->name }}</b></span>
                                            <span class="mdl-list__item-text-body">
                                                <b>Parameter :</b>{{ $method->parameter }}<br>
                                                <b>Recursive :</b>{{ $method->recursive }}
                                                <b>Loop :</b>{{ $method->loop }}
                                                <b>Score :</b> {{ $method->score }}
                                            </span>
                                        </span>
                                        <span class="mdl-list__item-secondary-content">
                                          <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </section>
        @endfor
    </main>
</div>
<script src="{{ URL::asset('CodeRoom/js/lib/ace-builds/src-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
<script>
    @for($i = 0; $i < sizeof($submission->submissionFiles); $i++)
        var editor{{$i+2}} = ace.edit("editor{{$i+2}}");
        editor{{$i+2}}.setTheme("ace/theme/eclipse");
        editor{{$i+2}}.getSession().setMode("ace/mode/java");
        editor{{$i+2}}.setFontSize(14);
    @endfor
</script>
</body>
</html>