<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuw artikel toevoegen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        input {
            display: block;
            margin-bottom: 5px;
            padding: 8px;
            width: 300px;
        }

        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .fout {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1>Nieuw artikel toevoegen</h1>

    <form method="POST" action="/materiaal">
        @csrf

        <label>Artikelnummer</label>
        <input type="text" name="artikelnummer" value="{{ old('artikelnummer') }}">
        @error('artikelnummer') <p class="fout">{{ $message }}</p> @enderror

        <label>Omschrijving</label>
        <input type="text" name="omschrijving" value="{{ old('omschrijving') }}">
        @error('omschrijving') <p class="fout">{{ $message }}</p> @enderror

        <label>Locatie</label>
        <input type="text" name="locatie" value="{{ old('locatie') }}">
        @error('locatie') <p class="fout">{{ $message }}</p> @enderror

        <label>Beschikbaar</label>
        <input type="number" name="beschikbaar" value="{{ old('beschikbaar') }}">
        @error('beschikbaar') <p class="fout">{{ $message }}</p> @enderror

        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="/materiaal">Terug naar overzicht</a>

</body>
</html>