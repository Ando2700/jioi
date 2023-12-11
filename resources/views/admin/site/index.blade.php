@extends('admin.layouts.app')
@section('content')
<h2>Creation de site: </h2>
<form action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <label class="font-weight-bold">Ajouter un site : </label>
        <input type="text" class="form-control @error('site') is-invalid @enderror" name="site" value="{{ old('site') }}" placeholder="Ajouter site">

        @error('site')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>

    <input type="submit" class="btn btn-primary" value="Ajouter">
    <button type="reset" class="btn btn-md btn-warning">Reset</button>

</form>
<br>
<h2>Voici la liste des site : </h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom de site</th>
                    <th scope="col">Action</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sites as $site)
                <tr>
                    <td>{{ $site->site }}</td>
                    <td><a href="{{ route('sites.edit', $site->id) }}" class="btn btn-sm btn-primary">Update</a></td>
                    <td><form onsubmit="return confirm('Etes vous sur ?');" action="{{ route('sites.destroy', $site->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form></td>
                </tr>    
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">{!! $sites->appends(['sort' => 'votes'])->links() !!}</div>
@endsection