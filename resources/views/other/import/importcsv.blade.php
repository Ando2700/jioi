@extends('other.layouts.app')
@section('content')
    <h4>Import CSV : </h4>
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label class="font-weight-bold">Inserer csv : </label>
        <input type="file" accept=".csv" class="form-control @error('csv_file') is-invalid @enderror" name="csv_file" value="{{ old('csv_file') }}" placeholder="Type d'acte">
        </div>
        <input type="submit" class="btn btn-warning" value="Save">
        <input type="reset" class="btn btn-dark" value="Reset">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
    </form>
@endsection