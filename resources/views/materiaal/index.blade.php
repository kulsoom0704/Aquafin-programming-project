<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Voorraad overzicht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .kritiek {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Voorraad overzicht</h1>
    <a href="/materiaal/create">+ Nieuw artikel toevoegen</a>

    <table>
        <thead>
            <tr>
                <th>Artikelnummer</th>
                <th>Omschrijving</th>
                <th>Locatie</th>
                <th>Beschikbaar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materialen as $item)
            <tr>
                <td>{{ $item->artikelnummer }}</td>
                <td>{{ $item->omschrijving }}</td>
                <td>{{ $item->locatie }}</td>
                <td class="{{ $item->beschikbaar < 5 ? 'kritiek' : '' }}">
                    {{ $item->beschikbaar }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>