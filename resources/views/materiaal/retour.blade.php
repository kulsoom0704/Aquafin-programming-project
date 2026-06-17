<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Retour registreren</title>
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

        select, input {
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

        .succes {
            color: green;
            font-size: 14px;
            margin-bottom: 15px;
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

    <h1>Retour registreren</h1>

    @if(session('succes'))
        <p class="succes">{{ session('succes') }}</p>
    @endif

    <div class="formulier">
        <form method="POST" action="/retour">
            @csrf

            <label>Artikel</label>
            <select name="materiaal_id">
                <option value="">-- Kies een artikel --</option>
                @foreach ($materialen as $item)
                    <option value="{{ $item->id }}">{{ $item->artikelnummer }} - {{ $item->omschrijving }}</option>
                @endforeach
            </select>
            @error('materiaal_id') <p class="fout">{{ $message }}</p> @enderror

            <label>Aantal</label>
            <input type="number" name="aantal" value="{{ old('aantal') }}">
            @error('aantal') <p class="fout">{{ $message }}</p> @enderror

            <button type="submit" class="btn-opslaan">Registreren</button>
        </form>

        <a href="/materiaal" class="btn-terug">Terug naar overzicht</a>
    </div>

</body>
</html>