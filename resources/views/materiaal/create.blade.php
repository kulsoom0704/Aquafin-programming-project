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
            margin-bottom: 10px;
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
    </style>
</head>
<body>

    <h1>Nieuw artikel toevoegen</h1>

    <form method="POST" action="/materiaal">
        @csrf

        <label>Artikelnummer</label>
        <input type="text" name="artikelnummer">

        <label>Omschrijving</label>
        <input type="text" name="omschrijving">

        <label>Locatie</label>
        <input type="text" name="locatie">

        <label>Beschikbaar</label>
        <input type="number" name="beschikbaar">

        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="/materiaal">Terug naar overzicht</a>

</body>
</html>