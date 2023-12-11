@extends('admin.layouts.app')
@section('content')
<h2>Creation de recettes:</h2>
<form action="{{ route('recettes.store') }}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <label class="font-weight-bold">Type de recette : </label>
        <input type="text" class="form-control @error('type_recette') is-invalid @enderror" name="type_recette" value="{{ old('type_recette') }}" placeholder="Type de recette">

        @error('type_recette')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label class="font-weight-bold">Code recette : </label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" placeholder="code">

        @error('code')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>

    <input type="submit" class="btn btn-primary" value="Valider">
    <button type="reset" class="btn btn-md btn-warning">Reset</button>

</form>

<h2>Voici la liste des recettes : </h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Type de recette</th>
                    <th scope="col">Code</th>
                    <th scope="col">Action</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recettes as $recette)
                <tr>
                    <td>{{ $recette->type_recette }}</td>
                    <td>{{ $recette->code }}</td>
                    <td><a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-sm btn-primary">Update</a></td>
                    <td><form onsubmit="return confirm('Etes vous sur ?');" action="{{ route('recettes.destroy', $recette->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form></td>
                </tr>    
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">{!! $recettes->appends(['sort' => 'votes'])->links() !!}</div>
@endsection