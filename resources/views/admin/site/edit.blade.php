@extends('admin.layouts.app')
@section('content')
<div class="card-body">
    <h2>Editer site : {{ $site->site }} </h2>
    <form action="{{ route('sites.update', $site->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
            <div class="form-group">
                <label class="font-weight-bold">Editer site : </label>
                <input type="text" class="form-control @error('site') is-invalid @enderror" name="site" value="{{ $site->site }}" placeholder="{{ $site->site }}">
    
                @error('site')
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