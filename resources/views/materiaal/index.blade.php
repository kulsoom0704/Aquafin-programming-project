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
            background: linear-gradient(135deg, #dceefb 0%, #c8e6f5 50%, #d4eef7 100%);
            min-height: 100vh;
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
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .zoekbalk {
            margin-bottom: 20px;
        }

        .zoekbalk input {
            padding: 8px;
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .zoekbalk button {
            padding: 8px 14px;
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }

        thead tr {
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
        }

        th {
            background: transparent;
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
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .succes {
            color: green;
            margin-bottom: 10px;
        }

        .popup-achtergrond {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
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

        .popup img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .btn-sluiten {
            margin-top: 15px;
            padding: 6px 14px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-wijzigen {
            margin-top: 15px;
            padding: 6px 14px;
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 5px;
        }

        .foto-upload {
            cursor: pointer;
            color: #2980b9;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <h1>Voorraad overzicht</h1>

    @if(session('succes'))
    <p class="succes">{{ session('succes') }}</p>
    @endif

    {{-- <a href="/materiaal/create" class="btn-nieuw">+ Nieuw artikel toevoegen</a> --}}
    {{-- <a href="/levering" class="btn-nieuw">+ Nieuwe levering</a> --}}
    {{-- <a href="/retour" class="btn-nieuw">+ Retour registreren</a> --}}
    <a href="/meldingen" class="btn-nieuw"> Meldingen</a>

    <br><br>

    <form method="GET" action="/materiaal" class="zoekbalk">
        <input type="text" id="zoekterm" name="zoekterm" placeholder="Zoek op artikelnummer, omschrijving of locatie..." value="{{ $zoekterm ?? '' }}">
        <button type="submit">Zoeken</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
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
                <td>
                    @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}"
                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; cursor: pointer;"
                        onclick="toonFotoPopup('{{ $item->id }}')">
                    @else
                    <span class="foto-upload" onclick="toonFotoPopup('{{ $item->id }}')">+ Foto</span>
                    @endif
                </td>
                <td>{{ $item->artikelnummer }}</td>
                <td>{{ $item->omschrijving }}</td>
                <td>{{ $item->locatie }}</td>
                <td class="{{ $item->beschikbaar < 5 ? 'kritiek' : '' }}">
                    {{ $item->beschikbaar }}
                </td>
                <td>
                    <button class="btn-details"
                        onclick="toonPopup(
                            '{{ $item->id }}',
                            '{{ $item->artikelnummer }}',
                            '{{ $item->omschrijving }}',
                            '{{ $item->locatie }}',
                            '{{ $item->beschikbaar }}',
                            '{{ $item->foto ? asset('storage/' . $item->foto) : '' }}'
                        )">
                        Details
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Details Popup -->
    <div class="popup-achtergrond" id="popup-achtergrond">
        <div class="popup">
            <h2>Artikel details</h2>
            <p style="display:none;"><span id="popup-id"></span></p>
            <img id="popup-foto" src="" style="display:none;" onclick="toonGroteFoto(this.src)">
            <p><strong>Artikelnummer:</strong> <span id="popup-artikelnummer"></span></p>
            <p><strong>Omschrijving:</strong> <span id="popup-omschrijving"></span></p>
            <p><strong>Locatie:</strong> <span id="popup-locatie"></span></p>
            <p><strong>Beschikbaar:</strong> <span id="popup-beschikbaar"></span></p>
            <button class="btn-sluiten" onclick="sluitPopup()">Sluiten</button>
            <button class="btn-wijzigen" onclick="wijzigen()">Wijzigen</button>
        </div>
    </div>

    <!-- Foto upload popup -->
    <div class="popup-achtergrond" id="foto-popup-achtergrond">
        <div class="popup">
            <h2>Foto uploaden</h2>
            <form method="POST" id="foto-form" action="" enctype="multipart/form-data">
                @csrf
                <input type="file" name="foto" accept="image/*" style="margin-bottom: 10px;">
                <br>
                <button type="submit" class="btn-wijzigen">Opslaan</button>
                <button type="button" class="btn-sluiten" onclick="sluitFotoPopup()">Annuleren</button>
            </form>
            <form method="POST" id="foto-verwijder-form" action="" style="margin-top: 10px;">
                @csrf
                <button type="submit" style="padding: 6px 14px; background-color: #e74c3c; color: white; border: none; cursor: pointer; border-radius: 4px;">Foto verwijderen</button>
            </form>
        </div>
    </div>

    <!-- Grote foto popup -->
    <div class="popup-achtergrond" id="grote-foto-achtergrond" onclick="this.style.display='none'">
        <div style="margin: 5% auto; text-align: center; width: 80%;">
            <img id="grote-foto" src="" style="max-width: 100%; max-height: 80vh; border-radius: 8px;">
        </div>
    </div>

    <script>
        function toonPopup(id, artikelnummer, omschrijving, locatie, beschikbaar, foto) {
            document.getElementById('popup-id').innerText = id;
            document.getElementById('popup-artikelnummer').innerText = artikelnummer;
            document.getElementById('popup-omschrijving').innerText = omschrijving;
            document.getElementById('popup-locatie').innerText = locatie;
            document.getElementById('popup-beschikbaar').innerText = beschikbaar;

            var fotoEl = document.getElementById('popup-foto');
            if (foto) {
                fotoEl.src = foto;
                fotoEl.style.display = 'block';
            } else {
                fotoEl.style.display = 'none';
            }

            document.getElementById('popup-achtergrond').style.display = 'block';
        }

        function sluitPopup() {
            document.getElementById('popup-achtergrond').style.display = 'none';
        }

        function wijzigen() {
            var id = document.getElementById('popup-id').innerText;
            window.location.href = '/materiaal/' + id + '/wijzigen';
        }

        function toonFotoPopup(id) {
            document.getElementById('foto-form').action = '/materiaal/' + id + '/foto';
            document.getElementById('foto-verwijder-form').action = '/materiaal/' + id + '/foto-verwijderen';
            document.getElementById('foto-popup-achtergrond').style.display = 'block';
        }

        function sluitFotoPopup() {
            document.getElementById('foto-popup-achtergrond').style.display = 'none';
        }

        function toonGroteFoto(src) {
            document.getElementById('grote-foto').src = src;
            document.getElementById('grote-foto-achtergrond').style.display = 'block';
        }

        // Live zoeken
        document.getElementById('zoekterm').addEventListener('keyup', function() {
            var zoekterm = this.value.toLowerCase();
            var rijen = document.querySelectorAll('tbody tr');

            rijen.forEach(function(rij) {
                var tekst = rij.innerText.toLowerCase();
                if (tekst.includes(zoekterm)) {
                    rij.style.display = '';
                } else {
                    rij.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>