@extends('admin.layouts.app')
@section('content')
    <h2>Creation de pays: </h2>
    <form action="{{ route('pays.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">Ajouter un pays participant : </label>
            <input type="text" class="form-control @error('pays') is-invalid @enderror" name="pays"
                value="{{ old('pays') }}" placeholder="Ajouter pays">

            @error('pays')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <input type="submit" class="btn btn-primary" value="Ajouter">
        <button type="reset" class="btn btn-md btn-warning">Reset</button>
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

    <br>
    <h2>Voici la liste des pays : </h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom de pays</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pays as $paysparticipant)
                <tr>
                    <td>{{ $paysparticipant->pays }}</td>
                    <td><a href="{{ route('pays.edit', $paysparticipant->id) }}" class="btn btn-sm btn-primary">Update</a>
                    </td>
                    <td>
                        <form onsubmit="return confirm('Etes vous sur ?');"
                            action="{{ route('pays.destroy', $paysparticipant->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">{!! $pays->appends(['sort' => 'votes'])->links() !!}</div>
@endsection
