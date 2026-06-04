<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikel wijzigen</title>
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

        .formulier {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            width: 400px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50;
            font-weight: bold;
        }

        input {
            display: block;
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .fout {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .info {
            background-color: #fff3cd;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
            color: #856404;
        }

        .btn-opslaan {
            padding: 8px 16px;
            background-color: #2c3e50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }

        .btn-terug {
            display: inline-block;
            margin-top: 15px;
            color: #2980b9;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h1>Artikel wijzigen</h1>

    <div class="formulier">
        <p class="info">⚠️ Je wijziging wordt eerst nagekeken door de admin voor het wordt toegepast.</p>

        <form method="POST" action="/materiaal/{{ $materiaal->id }}/wijzigen">
            @csrf

            <label>Artikelnummer</label>
            <input type="text" name="nieuw_artikelnummer" value="{{ old('nieuw_artikelnummer', $materiaal->artikelnummer) }}">
            @error('nieuw_artikelnummer') <p class="fout">{{ $message }}</p> @enderror

            <label>Omschrijving</label>
            <input type="text" name="nieuwe_omschrijving" value="{{ old('nieuwe_omschrijving', $materiaal->omschrijving) }}">
            @error('nieuwe_omschrijving') <p class="fout">{{ $message }}</p> @enderror

            <label>Locatie</label>
            <input type="text" name="nieuwe_locatie" value="{{ old('nieuwe_locatie', $materiaal->locatie) }}">
            @error('nieuwe_locatie') <p class="fout">{{ $message }}</p> @enderror

            <label>Beschikbaar</label>
            <input type="number" name="nieuwe_beschikbaar" value="{{ old('nieuwe_beschikbaar', $materiaal->beschikbaar) }}">
            @error('nieuwe_beschikbaar') <p class="fout">{{ $message }}</p> @enderror

            <button type="submit" class="btn-opslaan">Indienen</button>
        </form>

        <a href="/materiaal" class="btn-terug">Terug naar overzicht</a>
    </div>

</body>
</html>