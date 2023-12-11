@extends('guest.layouts.app')
@section('content')
    <h3>Calendrier des disciplines : </h3>
    <form action="{{ route('calendars.filter') }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('get')
        <div class="col">
            <div class="row">
                <div class="col">
                    Discipline : <select name="discipline" id="pays">
                        <option selected>Select discipline</option>
                        @foreach ($discipline as $discipline)
                            <option value="{{ $discipline->nom }}">{{ $discipline->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    Date :
                        <input type="date" name="date">
                    </select>
                </div>
            </div>
            <input class="btn btn-sm btn-primary" type="submit" value="Filter">
        </div>
    </form>
    <br>
    <div class="container">
        <div class="row">
            @foreach ($calendar as $calendar)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $calendar->nom }}</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    <path
                                        d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                {{ $calendar->site }}
                            </h5>
                            <p class="card-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-calendar" viewBox="0 0 16 16">
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                                {{ $calendar->date }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection



{{-- <meta name="csrf-token" content="{{ csrf_token() }}">

    <input type="text" id="discipline" placeholder="Discipline">
    <input type="date" id="date" placeholder="Date">
    <button id="filter-btn">Filter</button>

    <div id="results"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#filter-btn').click(function() {
                $.ajax({
                    url: "{{ route('calendars.filter') }}",
                    method: "POST",
                    data: {
                        discipline: $('#discipline').val(),
                        date: $('#date').val()
                    },
                    success: function(data) {
                        let html = '';
                        data.forEach(item => {
                            html +=
                                `<p>${item.discipline} - ${item.date} - ${item.site}</p>`;
                        });
                        $('#results').html(html);
                    }
                });
            });
        });
    </script> --}}
