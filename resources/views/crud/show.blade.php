@extends('welcome')

@section('main')
    <style>
        .front-height {
            height: 40vh;
        }
    </style>
    <div class="card uper m-b-md">
        <div class="card-header">
            Projekt
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nazwa projektu:</strong>
                        {{ $project->projectName }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Adres strony:</strong>
                        {{ $project->projectWebsite }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nazwa grupy projektu:</strong>
                        {{ $project->groupName }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nazwa kampanii:</strong>
                        {{ $project->campaignName }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Aktywność projektu:</strong>
                        @if ($project->projectActive == 0)
                            Niektywny
                        @elseif ($project->projectActive == 1)
                            Aktywny
                        @elseif ($project->projectActive == 2)
                            W trakcie realizacji
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Data rozpoczęcia:</strong>
                        {{ $project->campaignDate }}
                    </div>
                </div>
            </div>
            <a class="btn btn-secondary" href="{{ route('crudEdit', $project->projectId)}}" title="Edytuj">Edytuj</a>
        </div>
    </div>
@endsection
