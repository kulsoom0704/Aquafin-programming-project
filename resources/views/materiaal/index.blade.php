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

        .btn-details {
            padding: 5px 10px;
            background-color: #008CBA;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Popup achtergrond */
        .popup-achtergrond {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        /* Popup venster */
        .popup {
            background: white;
            margin: 10% auto;
            padding: 20px;
            width: 400px;
            border-radius: 8px;
        }

        .popup h2 {
            margin-top: 0;
        }

        .popup p {
            margin: 8px 0;
        }

        .btn-sluiten {
            margin-top: 15px;
            padding: 5px 10px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <h1>Voorraad overzicht</h1>
    <a href="/materiaal/create">+ Nieuw artikel toevoegen</a>

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