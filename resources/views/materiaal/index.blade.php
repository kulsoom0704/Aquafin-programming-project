<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Voorraad overzicht</title>
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
            margin-bottom: 10px;
        }

        .btn-nieuw {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 14px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #2c3e50;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .kritiek {
            color: red;
            font-weight: bold;
        }

        .btn-details {
            padding: 5px 12px;
            background-color: #2980b9;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .popup-achtergrond {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .popup {
            background: white;
            margin: 10% auto;
            padding: 25px;
            width: 400px;
            border-radius: 8px;
        }

        .popup h2 {
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .popup p {
            margin: 8px 0;
            font-size: 15px;
        }

        .btn-sluiten {
            margin-top: 15px;
            padding: 6px 14px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <h1>Voorraad overzicht</h1>
<a href="/materiaal/create" class="btn-nieuw">+ Nieuw artikel toevoegen</a>
<a href="/levering" class="btn-nieuw">+ Nieuwe levering</a>
<a href="/retour" class="btn-nieuw">+ Retour registreren</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>Artikelnummer</th>
                <th>Omschrijving</th>
                <th>Locatie</th>
                <th>Beschikbaar</th>
                <th>Actie</th>
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
                <td>
                    <button class="btn-details"
                        onclick="toonPopup(
                            '{{ $item->artikelnummer }}',
                            '{{ $item->omschrijving }}',
                            '{{ $item->locatie }}',
                            '{{ $item->beschikbaar }}'
                        )">
                        Details
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Popup -->
    <div class="popup-achtergrond" id="popup-achtergrond">
        <div class="popup">
            <h2>Artikel details</h2>
            <p><strong>Artikelnummer:</strong> <span id="popup-artikelnummer"></span></p>
            <p><strong>Omschrijving:</strong> <span id="popup-omschrijving"></span></p>
            <p><strong>Locatie:</strong> <span id="popup-locatie"></span></p>
            <p><strong>Beschikbaar:</strong> <span id="popup-beschikbaar"></span></p>
            <button class="btn-sluiten" onclick="sluitPopup()">Sluiten</button>
        </div>
    </div>

    <script>
        function toonPopup(artikelnummer, omschrijving, locatie, beschikbaar) {
            document.getElementById('popup-artikelnummer').innerText = artikelnummer;
            document.getElementById('popup-omschrijving').innerText = omschrijving;
            document.getElementById('popup-locatie').innerText = locatie;
            document.getElementById('popup-beschikbaar').innerText = beschikbaar;
            document.getElementById('popup-achtergrond').style.display = 'block';
        }

        function sluitPopup() {
            document.getElementById('popup-achtergrond').style.display = 'none';
        }
    </script>

</body>
</html>