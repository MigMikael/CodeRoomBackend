@extends('template')

@section('content')
    <div class="mdl-grid">
        <div class="demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>
                    Problem<br>
                </h4>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ url('problems') }}">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">subject</i>
            </div>
        </div>

        <div class="demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>
                    Problem Analysis<br>
                </h4>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ url('problem_analysis') }}">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">subject</i>
            </div>
        </div>


        <div class="demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>
                    Submission<br>
                </h4>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ url('submissions') }}">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">subject</i>
            </div>
        </div>


        <div class="demo-card-event mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mdl-card--expand">
                <h4>
                    Result<br>
                </h4>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ url('results') }}">
                    View
                </a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">subject</i>
            </div>
        </div>
    </div>
@stop