@extends('admin.layouts.app')
@section('content')
    <h2>Creation de discipline: </h2>
    <form action="{{ route('disciplines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">Ajouter une discipline : </label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                value="{{ old('nom') }}" placeholder="Ajouter nom">

            @error('nom')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Code discipline : </label>
            <input type="text" class="form-control @error('code_discipline') is-invalid @enderror" name="code_discipline" value="{{ old('code_discipline') }}" placeholder="Code discipline">
    
            @error('code_discipline')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Type de discipline</label>
            <select class="form-select" name="type" aria-label="type">
                <option selected>Type</option>
                <option name="type" value="collectif">Collectif</option>
                <option name="type" value="individuel">Individuel</option>
            </select>
            @error('type')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        
    

        <input type="submit" class="btn btn-primary" value="Ajouter">
        <button type="reset" class="btn btn-md btn-warning">Reset</button>

    </form>
    <br>
    <h2>Voici la liste des disciplines : </h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Discipline</th>
                <th scope="col">Type de discipline</th>
                <th scope="col">Code discipline</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplines as $discipline)
                <tr>
                    <td>{{ $discipline->nom }}</td>
                    <td>{{ $discipline->type }}</td>
                    <td>{{ $discipline->code_discipline }}</td>
                    <td><a href="{{ route('disciplines.edit', $discipline->id) }}" class="btn btn-sm btn-primary">Update</a>
                    </td>
                    <td>
                        <form onsubmit="return confirm('Etes vous sur ?');"
                            action="{{ route('disciplines.destroy', $discipline->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">{!! $disciplines->appends(['sort' => 'votes'])->links() !!}</div>
@endsection
