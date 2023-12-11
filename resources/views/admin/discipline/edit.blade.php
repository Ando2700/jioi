@extends('admin.layouts.app')
@section('content')
    <div class="card-body">
        <h2>Editer discipline : {{ $discipline->nom }} </h2>
        <form action="{{ route('disciplines.update', $discipline->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="font-weight-bold">Editer discipline : </label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                    value="{{ $discipline->nom }}" placeholder="{{ $discipline->nom }}">

                @error('nom')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Type de discipline</label>
                <select class="form-select" name="type" aria-label="type">
                    <option selected>{{ $discipline->type }}</option>
                    <option name="type" value="collectif">Collectif</option>
                    <option name="type" value="individuel">Individuel</option>
                </select>
                @error('type')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Code discipline : </label>
                <input type="text" class="form-control @error('code_discipline') is-invalid @enderror" name="code_discipline" value="{{ $discipline->code_discipline }}" placeholder="">
        
                @error('code_discipline')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <input type="submit" class="btn btn-primary" value="Valider">

        </form>
    </div>
@endsection
