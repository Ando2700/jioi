@extends('guest.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <h3>Tableau des recettes et des depenses : </h3>
            <div class="card">
                <div class="card-header">Tableau</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Discipline</th>
                                <th>Recette</th>
                                <th>Depense</th>
                                <th>Difference</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tableau as $item)
                                <tr>
                                    <td>{{ $item->discipline }}</td>
                                    <td>{{ $item->recette }}</td>
                                    <td>{{ $item->depense }}</td>
                                    <td>{{ $item->difference < 0 ? '(' . abs($item->difference) . ')' : $item->difference }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
