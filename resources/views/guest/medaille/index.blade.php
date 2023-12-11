@extends('guest.layouts.app')
@section('content')
<h3>Tableau des medailles : </h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Rank</th>
            <th scope="col">Pays</th>
            <th scope="col">Or  </th>
            <th scope="col">Argent</th>
            <th scope="col">Bronze</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        {{-- @php $i=1 @endphp --}}
        @foreach ($medaille as $medaille)
        <tr>
            <td>{{ $medaille->rang }}</td>
            <td>{{ $medaille->pays }}</td>
            <td>{{ $medaille->gold }}</td>
            <td>{{ $medaille->silver }}</td>
            <td>{{ $medaille->bronze }}</td>
            <td>{{ $medaille->gold+$medaille->silver+$medaille->bronze }}</td>
        </tr>    
        @endforeach
    </tbody>
</table>


@endsection