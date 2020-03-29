@extends('welcome')

@section('main')
    <style>
        .front-height {
            height: 40vh;
        }
    </style>
    <div class="card uper m-b-md">
        <div class="card-header">
            Dodaj nowy projekt
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
            <form method="post" action="{{ route('crudNew') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Nazwa projektu:</label>
                    <input type="text" class="form-control" name="project_name"/>
                </div>
                <div class="form-group">
                    <label for="price">Adres strony:</label>
                    <input type="text" class="form-control" name="project_website"/>
                </div>
                <div class="form-group">
                    <label for="price">Aktywność projektu:</label>
                    <select class="form-control" name="project_activity">
                        <option value="0">Nieaktywny</option>
                        <option value="1">Aktywnny</option>
                        <option value="2">W trakcie realizacji</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Nazwa grupy projektu:</label>
                    <input type="text" class="form-control" name="group_name"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Budżet:</label>
                    <input type="text" class="form-control" name="group_budget"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Nazwa kampanii:</label>
                    <input type="text" class="form-control" name="campaign_name"/>
                </div>
                <div class="form-group">
                    <label for="quantity">Status:</label>
                    <select class="form-control" name="campaign_status">
                        <option value="0">Nieaktywny</option>
                        <option value="1">Aktywnny</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Data rozpoczęcia:</label>
                    <input type="text" class="form-control datepicker" name="campaign_start_date"/>
                </div>
                <button type="submit" class="btn btn-success float-left">Dodaj</button>
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
