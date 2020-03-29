@extends('welcome')

@section('main')
    <style>
        .front-height {
            height: 40vh;
        }
    </style>
    <div>
        <h2 class="m-b-md">Lista projektów</h2>
        <a href="{{ route('crudAdd') }}" class="btn btn-secondary float-left m-b-md">Dodaj projekt</a>
        <form class="form-inline float-right" method="get" action="{{ route('crudList') }}">
            <div class="form-group">
                <label for="price" class="m-r-sm">Filtrowanie: </label>
                <select class="form-control" name="project_activity" onchange="this.form.submit()">
                    <option value="-1" @if ($project_activity == -1) selected @endif>Wybierz</option>
                    <option value="0" @if ($project_activity == 0) selected @endif>Nieaktywny</option>
                    <option value="1" @if ($project_activity == 1) selected @endif>Aktywnny</option>
                    <option value="2" @if ($project_activity == 2) selected @endif>W trakcie realizacji</option>
                </select>
            </div>
        </form>
        <table class="table table-hover text-center">
            <thead class="thead-light ">
            <tr>
                <th>Nazwa projektu</th>
                <th>Nazwa grupy projektu</th>
                <th>Nazwa kampanii</th>
                <th>Adres strony</th>
                <th>Aktywność projektu</th>
                <th colspan="3">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->projectName }}</td>
                <td>{{ $project->groupName }}</td>
                <td>{{ $project->campaignName }}</td>
                <td>{{ $project->projectWebsite }}</td>
                @if ($project->projectActive == 0)
                    <td>Niektywny</td>
                @elseif ($project->projectActive == 1)
                    <td>Aktywny</td>
                @elseif ($project->projectActive == 2)
                    <td>W trakcie realizacji</td>
                @endif
                <td><a class="btn btn-link href-link show-link" href="{{ route('crudShow', $project->projectId)}}" title="Pokaż"><i class="fas fa-eye"></i></a></td>
                <td><a class="btn btn-link href-link edit-link" href="{{ route('crudEdit', $project->projectId)}}" title="Edytuj"><i class="fas fa-edit"></i></a></td>
                <td>
                    <form action="{{ route('crudDestroy', $project->projectId) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link href-link delete-link" onclick="this.form.submit()" title="Usuń"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {{ $projects->links() }}
        </div>
    </div>
@endsection
