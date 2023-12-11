@extends('admin.layouts.app')
@section('content')
<div class="card-body">
    <h2>Editer pays : {{ $pays->pays }} </h2>
    <form action="{{ route('pays.update', $pays->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
            <div class="form-group">
                <label class="font-weight-bold">Editer pays : </label>
                <input type="text" class="form-control @error('pays') is-invalid @enderror" name="pays" value="{{ $pays->pays }}" placeholder="{{ $pays->pays }}">
    
                @error('pays')
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