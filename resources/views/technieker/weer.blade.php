@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Weerdashboard</h1>

    <div class="card">
        <div class="card-body">

            <h4>{{ $seizoen }} {{ $jaar }}</h4>

            <p>
                Totale neerslag seizoen:
                <strong>{{ $totaleNeerslagSeizoen }} mm</strong>
            </p>

            <p>
                Grenswaarde:
                <strong>{{ $grenswaarde }} mm</strong>
            </p>

            <p>
                Overstromingsgevaar:
                <strong>{{ $overstromingsgevaar }}</strong>
            </p>

        </div>
    </div>

</div>

@endsection