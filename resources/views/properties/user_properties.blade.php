@extends('dashboard/master')

@section('title', 'User Properties')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ $user->first_name }} {{ $user->last_name }}'s Properties</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                @if($user->properties->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Unit Number</th>
                            <th>Street</th>
                            <th>Suburb</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Contract Start</th>
                            <th>Contract End</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->properties as $property)
                        <tr>
                            <td>{{ $property->unit_number }}</td>
                            <td>{{ $property->street_number }} {{ $property->street_name }}</td>
                            <td>{{ $property->suburb }}</td>
                            <td>{{ $property->state }}</td>
                            <td>{{ $property->country }}</td>
                            <td>{{ \Carbon\Carbon::parse($property->contract_start_date)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($property->contract_end_date)->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>No properties found for this user.</p>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
