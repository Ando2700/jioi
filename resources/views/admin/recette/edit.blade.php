@extends('admin.layouts.app')
@section('content')
<div class="card-body">
    <h2>Editer recette : {{ $recette->type_recette }} </h2>
    <form action="{{ route('recettes.update', $recette->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
            <div class="form-group">
                <label class="font-weight-bold">Type de recette : </label>
                <input type="text" class="form-control @error('type_recette') is-invalid @enderror" name="type_recette" value="{{ $recette->type_recette }}" placeholder="{{ $recette->type_recette }}">
    
                @error('type_recette')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Code : </label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $recette->code }}" placeholder="">
        
                @error('code')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <input type="submit" class="btn btn-primary" value="Valider">
            <button type="reset" class="btn btn-md btn-warning">Reset</button>
    
        </form>
</div>
@endsection