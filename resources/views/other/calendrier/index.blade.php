@extends('other.layouts.app')
@section('content')
    <h2>Saisie des calendriers: </h2>
    <form action="{{ route('calendriers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">Date : </label>
            <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date"
                value="{{ old('date') }}" placeholder="date">

            @error('date')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Sites : </label>
            <select class="form-select" name="site" aria-label="site">
                <option selected>Select site</option>
                @foreach ($site as $site)
                    <option name="site" value="{{ $site->site }}">{{ $site->site }}</option>
                @endforeach
            </select>
            @error('site')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Discilpine</label>
            <select class="form-select" name="discipline" aria-label="pays">
                <option selected>Select discipline</option>
                @foreach ($disciplines as $discipline)
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
    <h2>Calendrier des disciplines</h2>
    <div class="container">
        <div class="row">
            @foreach ($calendrier as $calendrier)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $calendrier->nom }}</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    <path
                                        d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                {{ $calendrier->site }}
                            </h5>
                            <p class="card-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-calendar" viewBox="0 0 16 16">
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                                {{ $calendrier->date }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
