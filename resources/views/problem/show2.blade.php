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
                <span class="mdl-layout-title">Problem Detail</span>
            </div>
            <!-- Tabs -->
            <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Summary</a>
                @for($i = 0; $i < sizeof($problem->problemFiles); $i++)
                    <a href="#scroll-tab-{{$i+2}}" class="mdl-layout__tab">{{ $problem->problemFiles[$i]->filename }}</a>
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
                    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                        <div class="mdl-card__title">
                            <h3><b>{{$problem->id}}</b> > {{ $problem->name }}</h3><br>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            <h5><b>Description:</b> {{ $problem->description }}</h5><br>
                            <h5><b>Lesson:</b> {{ $problem->lesson->name }}</h5><br>
                            <h5><b>Evaluator:</b> {{ $problem->evaluator }}</h5>
                            <h5><b>TimeLimit:</b> {{ $problem->timelimit }} Sec</h5>
                            <h5><b>MemoryLimit:</b> {{ $problem->memorylimit }} KB</h5>
                            <h5><b>Analyze Structures:</b> {{ $problem->is_parse }}</h5>
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
                   {{-- @foreach($problem->problemAnalysis as $analysis)
                        <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                            <div class="mdl-cell mdl-cell--12-col center">
                                <h4>{{ $analysis->class }}</h4>
                            </div>
                            <div class="mdl-card__supporting-text mdl-card--expand">
                                <p>Package: {{ $analysis->package }}</p>
                                <p>Enclose: {{ $analysis->enclose }}</p>
                                <p>Extends: {{ $analysis->extends }}</p>
                                <p>Implements: {{ $analysis->implements }}</p>
                                <b>Constructor</b>
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
                                <b>Attribute</b>
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
                                <b>Method</b>
                                <table class="mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table">
                                    <thead>
                                    <tr>
                                        <th class="mdl-data-table__cell--non-numeric">ID</th>
                                        <th>Access Modifier</th>
                                        <th>Non-Access Modifier</th>
                                        <th>Return Type</th>
                                        <th>Name</th>
                                        <th>Parameter</th>
                                        <th>Recursive</th>
                                        <th>Loop</th>
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
                                            <td>{{ $method->recursive }}</td>
                                            <td>{{ $method->loop }}</td>
                                            <td>{{ $method->score }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach--}}
                </div>
            </section>

            @for($i = 0; $i < sizeof($problem->problemFiles); $i++)
            <section class="mdl-layout__tab-panel" id="scroll-tab-{{$i+2}}">
                <div class="mdl-grid page-max-width">
                    <div class="mdl-cell mdl-cell--7-col mdl-card code-card mdl-shadow--4dp" id="editor{{$i+2}}" >
                        {{ $problem->problemFiles[$i]->code }}
                    </div>

                    <div class="mdl-cell mdl-cell--5-col mdl-card mdl-shadow--4dp">

                        @foreach($problem->problemFiles[$i]->problemAnalysis as $analysis)
                        <div class="mdl-card mdl-cell mdl-cell--12-col mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <h4>{{ $analysis->class }}</h4>
                            </div>
                            <div class="mdl-card__supporting-text mdl-card--expand">
                                <b>Package:</b> {{ $analysis->package }}
                                <b>Enclose:</b> {{ $analysis->enclose }}
                                <b>Extends:</b> {{ $analysis->extends }}
                                <b>Implements:</b> {{ $analysis->implements }}
                            </div>
                        </div>
                        <ul class="mdl-list">
                            <li class="mdl-list__item">
                                <h5>Attribute</h5>
                            </li>
                            @foreach($analysis->attributes as $attribute)
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
                            @foreach($analysis->constructors as $constructor)
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
                            @foreach($analysis->methods as $method)
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
        @for($i = 0; $i < sizeof($problem->problemFiles); $i++)
            var editor{{$i+2}} = ace.edit("editor{{$i+2}}");
            editor{{$i+2}}.setTheme("ace/theme/eclipse");
            editor{{$i+2}}.getSession().setMode("ace/mode/java");
            editor{{$i+2}}.setFontSize(14);
        @endfor
    </script>
</body>
</html>