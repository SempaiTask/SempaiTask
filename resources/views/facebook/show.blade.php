@extends('welcome')

@section('main')
    <style>
        .front-height {
            height: 40vh;
        }
    </style>
    <div class="card uper m-b-md">
        <div class="card-header">
            Odpowiedź z Facebooka
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $response->getGraphUser()['name'] }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Id:</strong>
                        {{ $response->getGraphUser()['id'] }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {{ dump($response->getGraphUser()) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
