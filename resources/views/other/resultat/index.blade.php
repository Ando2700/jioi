@extends('other.layouts.app')
@section('content')
    <h2>Saisie des resultats finaux: </h2>
    <form action="{{ route('resultats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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

        <div class="form-group">
            <label class="font-weight-bold">Rang</label>
            <select class="form-select" name="rang" aria-label="rang">
                <option selected>Select rang</option>
                @for ($i = 1; $i <= $rang; $i++)
                    <option name="rang" value="{{ $i }}">{{ $i }}</option>
                @endfor
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

    <h3>Les resultats finaux : </h3>
    {{-- <form action="{{ route('results') }}" method="GET">
        <select class="form-select" name="pays">
            @foreach ($pays as $pays)
                <option value="{{ $pays->pays }}">{{ $pays->pays }}</option>
            @endforeach
        </select>

        <select class="form-select" name="discipline">
            @foreach ($discipline as $discipline)
                <option value="{{ $discipline->nom }}">{{ $discipline->nom }}</option>
            @endforeach
        </select>

        <button type="submit">Filtrer</button>
    </form> --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Rang</th>
                <th scope="col">Medaille<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                        <path
                            d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z" />
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                    </svg>
                </th>
                <th scope="col">Pays</th>
                <th scope="col">Discilpine</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultats as $resultat)
                <tr>
                    <td>{{ $resultat->rang }}</td>
                    <td>{{ $resultat->medaille }}</td>
                    <td>{{ $resultat->pays }}</td>
                    <td>{{ $resultat->discipline }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <table class="table">
        <thead>
            <tr>
                <th scope="col">Rang</th>
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
    </table> --}}
@endsection
