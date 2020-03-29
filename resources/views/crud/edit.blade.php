@extends('welcome')

@section('main')
    <style>
        .front-height {
            height: 40vh;
        }
    </style>
    <div class="card uper m-b-md">
        <div class="card-header">
            Edytuj projekt
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('crudUpdate', $project->projectId) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="name">Nazwa projektu:</label>
                    <input type="text" class="form-control" name="project_name" value="{{ $project->projectName }}"/>
                </div>
                <div class="form-group">
                    <label for="price">Adres strony:</label>
                    <input type="text" class="form-control" name="project_website" value="{{ $project->projectWebsite }}"/>
                </div>
                <div class="form-group">
                    <label for="price">Aktywność projektu:</label>
                    <select class="form-control" name="project_activity">
                        <option value="0" @if($project->projectActive == 0) selected @endif>Nieaktywny</option>
                        <option value="1" @if($project->projectActive == 1) selected @endif>Aktywnny</option>
                        <option value="2" @if($project->projectActive == 2) selected @endif>W trakcie realizacji</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Nazwa grupy projektu:</label>
                    <input type="text" class="form-control" name="group_name" value="{{ $project->groupName }}"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Nazwa kampanii:</label>
                    <input type="text" class="form-control" name="campaign_name" value="{{ $project->campaignName }}"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Data rozpoczęcia:</label>
                    <input type="text" class="form-control datepicker" name="campaign_start_date" value="{{ $project->campaignDate }}"/>
                </div>
                <button type="submit" class="btn btn-success float-left">Zapisz</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                language: "pl",
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection
