<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Meldingen</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 30px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .melding {
            background-color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 5px solid #2980b9;
        }

        .melding.gelezen {
            border-left: 5px solid #ccc;
            opacity: 0.6;
        }

        .melding h3 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .melding p {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .melding small {
            color: #999;
            font-size: 12px;
        }

        .btn-gelezen {
            padding: 5px 12px;
            background-color: #2c3e50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 13px;
            margin-top: 8px;
        }

        .geen-meldingen {
            color: #999;
            font-size: 15px;
        }

        .btn-terug {
            display: inline-block;
            margin-bottom: 20px;
            color: #2980b9;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h1>Meldingen</h1>
    <a href="/materiaal" class="btn-terug">← Terug naar overzicht</a>

    @if($meldingen->isEmpty())
        <p class="geen-meldingen">Geen nieuwe meldingen.</p>
    @else
        @foreach($meldingen as $melding)
            <div class="melding {{ $melding->gelezen ? 'gelezen' : '' }}">
                <h3>{{ $melding->titel }}</h3>
                <p>{{ $melding->bericht }}</p>
                <small>{{ $melding->created_at->format('d/m/Y H:i') }}</small>

            @if(!$melding->gelezen)
    <br>
    <form method="POST" action="/meldingen/{{ $melding->id }}/gelezen" style="display:inline;">
        @csrf
        <button type="submit" class="btn-gelezen">Markeer als gelezen</button>
    </form>
@else
    <br>
    <form method="POST" action="/meldingen/{{ $melding->id }}/ongelezen" style="display:inline;">
        @csrf
        <button type="submit" class="btn-gelezen" style="background-color: #999;">Markeer als ongelezen</button>
    </form>
@endif

<form method="POST" action="/meldingen/{{ $melding->id }}/verwijderen" style="display:inline;">
    @csrf
    <button type="submit" class="btn-gelezen" style="background-color: #e74c3c;">Verwijderen</button>
</form>
            </div>
        @endforeach
    @endif

</body>
</html>