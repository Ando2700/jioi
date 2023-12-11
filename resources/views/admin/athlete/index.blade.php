@extends('admin.layouts.app')
@section('content')
    <h2>Ajouter un(e) athlete: </h2>
    <form action="{{ route('athletes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">Nom : </label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                value="{{ old('nom') }}" placeholder="Ajouter nom">

            @error('nom')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="font-weight-bold">Date de naissance : </label>
            <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" name="date_naissance"
                value="{{ old('date_naissance') }}" placeholder="date_naissance">

            @error('date_naissance')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Taille : </label>
            <input type="number" class="form-control @error('longueur') is-invalid @enderror" name="longueur"
                value="{{ old('longueur') }}" placeholder="en cm">

            @error('longueur')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Poids : </label>
            <input type="number" class="form-control @error('poids') is-invalid @enderror" name="poids"
                value="{{ old('poids') }}" placeholder="en kg">

            @error('poids')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Genre</label>
            <select class="form-select" name="genre" aria-label="genre">
                <option selected>Select genre</option>
                @foreach ($genre as $genre)
                    <option name="genre" value="{{ $genre->genre }}">{{ $genre->genre }}</option>
                @endforeach
            </select>
            @error('genre')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Pays</label>
            <select class="form-select" name="pays" aria-label="pays">
                <option selected>Select pays</option>
                @foreach ($pays as $pays)
                    <option name="pays" value="{{ $pays->pays }}">{{ $pays->pays }}</option>
                @endforeach
            </select>
            @error('pays')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Discilpine</label>
            <select class="form-select" name="discipline" aria-label="pays">
                <option selected>Select discipline</option>
                @foreach ($discipline as $discipline)
                    <option name="discipline" value="{{ $discipline->nom }}">{{ $discipline->nom }}</option>
                @endforeach
            </select>
            @error('discipline')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <input type="submit" class="btn btn-primary" value="Ajouter">
        <button type="reset" class="btn btn-md btn-warning">Reset</button>

    </form>
    <br>

    <h2>Voici la liste des athletes : </h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Longueur</th>
                <th scope="col">Poids</th>
                <th scope="col">Genre</th>
                <th scope="col">Pays</th>
                <th scope="col">Discilpine</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($athletes as $athlete)
                <tr>
                    <td>{{ $athlete->nom }}</td>
                    <td>{{ $athlete->date_naissance }}</td>
                    <td>{{ $athlete->longueur }}</td>
                    <td>{{ $athlete->poids }}</td>
                    <td>{{ $athlete->genre }}</td>
                    <td>{{ $athlete->pays }}</td>
                    <td>{{ $athlete->discipline }}</td>
                    <td><a href="{{ route('athletes.edit', $discipline->id) }}" class="btn btn-sm btn-primary">Update</a>
                    </td>
                    <td>
                        <form onsubmit="return confirm('Etes vous sur ?');"
                            action="{{ route('athletes.destroy', $discipline->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">{!! $athletes->appends(['sort' => 'votes'])->links() !!}</div>
@endsection
