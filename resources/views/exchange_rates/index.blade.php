@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Exchange Rates</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('exchange-rates.create') }}" class="btn btn-primary mb-3">Update Exchange Rate</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Rate</th>
                    <th>Effective Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exchangeRates as $rate)
                    <tr>
                        <td>{{ $rate->id }}</td>
                        <td>{{ $rate->currency_from }}</td>
                        <td>{{ $rate->currency_to }}</td>
                        <td>{{ $rate->exchange_rate }}</td>
                        <td>{{ $rate->effective_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $exchangeRates->links() }}
    </div>
@endsection
