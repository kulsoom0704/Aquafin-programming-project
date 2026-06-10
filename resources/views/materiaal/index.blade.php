<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Magazijnier Portaal</title>
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
        }

        .content {
            padding: 30px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .sectie {
            display: none;
        }

        .sectie.actief {
            display: block;
        }

        nav {
            background: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-logo-icon {
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
            padding: 8px;
            border-radius: 8px;
            font-size: 18px;
            color: white;
        }

        .nav-logo-titel {
            font-weight: bold;
            color: #0a5a8a;
            font-size: 16px;
        }

        .nav-logo-subtitel {
            font-size: 11px;
            color: #999;
        }

        .nav-links {
            display: flex;
            gap: 10px;
        }

        .nav-links button {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            color: #555;
            background: #f5f5f5;
            font-size: 14px;
        }

        .nav-links button.actief {
            color: white;
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
        }

        .nav-avatar {
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .zoekbalk {
            margin-bottom: 20px;
        }

        .zoekbalk input {
            padding: 8px;
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

        .formulier {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            width: 600px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50;
            font-weight: bold;
        }

        select,
        input[type="number"],
        input[type="text"] {
            display: block;
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-opslaan {
            padding: 8px 16px;
            background: linear-gradient(to right, #0a5a8a, #00b4d8);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }

        .melding {
            background-color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 5px solid #00b4d8;
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
        }

        .melding small {
            color: #999;
            font-size: 12px;
        }

        .btn-melding {
            padding: 5px 12px;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 13px;
            margin-top: 8px;
        }

        .succes {
            color: green;
            margin-bottom: 10px;
        }

        .fout {
            color: red;
            font-size: 13px;
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

        .artikel-rij {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
            align-items: center;
        }

        .artikel-rij input {
            flex: 1;
            margin-bottom: 0;
        }

        .btn-verwijder-rij {
            padding: 6px 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .suggesties-lijst {
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            z-index: 100;
        }

        .suggestie-item {
            padding: 8px 12px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .suggestie-item:hover {
            background: #f0f0f0;
        }
    </style>
</head>

<body>

    <nav>
        <div class="nav-logo">
            <div class="nav-logo-icon">📦</div>
            <div>
                <div class="nav-logo-titel">AQUAFIN</div>
                <div class="nav-logo-subtitel">MAGAZIJNIER PORTAAL</div>
            </div>
        </div>

        <div class="nav-links">
            <button onclick="toonSectie('voorraad')" id="btn-voorraad" class="actief">Voorraad</button>
            <button onclick="toonSectie('meldingen')" id="btn-meldingen">Bestellingen</button>
            <button onclick="toonSectie('leveringen')" id="btn-leveringen">Uitgifte</button>
            <button onclick="toonSectie('retours')" id="btn-retours">Retours</button>
            <button onclick="toonSectie('archief')" id="btn-archief">Archief</button>
        </div>

        <div class="nav-avatar">M</div>
    </nav>

    <div class="content">

        @if(session('succes'))
        <p class="succes">{{ session('succes') }}</p>
        @endif

        <!-- Sectie: Voorraad -->
        <div class="sectie actief" id="sectie-voorraad">
            <h1>Voorraad overzicht</h1>
            <br>
            <form method="GET" action="/materiaal" class="zoekbalk" style="display: flex; align-items: center; gap: 8px;">
                <input type="text" id="zoekterm" name="zoekterm" placeholder="Zoek op artikelnummer, omschrijving of locatie..." value="{{ $zoekterm ?? '' }}" style="width: 25%;">
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
        </div>

        <!-- Sectie: Bestellingen -->
        <div class="sectie" id="sectie-meldingen">
            <h1>Bestellingen</h1>
            <br>
            @if($meldingen->where('gearchiveerd', false)->isEmpty())
                <p style="color: #999;">Geen bestellingen.</p>
            @else
                @foreach($meldingen->where('gearchiveerd', false) as $melding)
                <div class="melding {{ $melding->gelezen ? 'gelezen' : '' }}" style="cursor: pointer;"
                    onclick="toonMeldingPopup(
                        '{{ addslashes($melding->titel) }}',
                        '{{ addslashes($melding->bericht) }}',
                        '{{ $melding->created_at->format('d/m/Y H:i') }}'
                    )">
                    <h3>{{ $melding->titel }}</h3>
                    <p>{{ $melding->bericht }}</p>
                    <small>{{ $melding->created_at->format('d/m/Y H:i') }}</small>
                    <br>
                    @if(!$melding->gelezen)
                        <form method="POST" action="/meldingen/{{ $melding->id }}/gelezen" style="display:inline;" onclick="event.stopPropagation()">
                            @csrf
                            <button type="submit" class="btn-melding" style="background: linear-gradient(to right, #0a5a8a, #00b4d8);">Markeer als gelezen</button>
                        </form>
                    @else
                        <form method="POST" action="/meldingen/{{ $melding->id }}/ongelezen" style="display:inline;" onclick="event.stopPropagation()">
                            @csrf
                            <button type="submit" class="btn-melding" style="background-color: #999;">Markeer als ongelezen</button>
                        </form>
                    @endif
                    <form method="POST" action="/meldingen/{{ $melding->id }}/archiveren" style="display:inline;" onclick="event.stopPropagation()">
                        @csrf
                        <button type="submit" class="btn-melding" style="background-color: #e67e22;">Archiveren</button>
                    </form>
                </div>
                @endforeach
            @endif
        </div>

        <!-- Sectie: Uitgifte -->
        <div class="sectie" id="sectie-leveringen">
            <h1>Materiaal uitgifte</h1>
            <br>
            <div class="formulier">
                <form method="POST" action="/levering">
                    @csrf

                    <label>Naam technieker</label>
                    <input type="text" name="technieker_naam" placeholder="Naam van de technieker">
                    @error('technieker_naam') <p class="fout">{{ $message }}</p> @enderror

                    <label style="margin-top: 10px;">Zoek en voeg artikel toe</label>
                    <div style="position: relative; margin-bottom: 10px;">
                        <input type="text" id="zoek-uitgifte" placeholder="Typ om te zoeken..." autocomplete="off" onkeyup="filterUitgifte()">
                        <div class="suggesties-lijst" id="zoek-suggesties"></div>
                    </div>

                    <label>Geselecteerde artikelen</label>
                    <div id="artikelen-lijst" style="margin-bottom: 10px;"></div>

                    <button type="submit" class="btn-opslaan">Uitgifte registreren</button>
                </form>
            </div>
        </div>

        <!-- Sectie: Retours -->
        <div class="sectie" id="sectie-retours">
            <h1>Retour registreren</h1>
            <br>
            <div class="formulier">
                <form method="POST" action="/retour">
                    @csrf

                    <label>Naam technieker</label>
                    <input type="text" name="technieker_naam" placeholder="Naam van de technieker">
                    @error('technieker_naam') <p class="fout">{{ $message }}</p> @enderror

                    <label style="margin-top: 10px;">Zoek en voeg artikel toe</label>
                    <div style="position: relative; margin-bottom: 10px;">
                        <input type="text" id="zoek-retour" placeholder="Typ om te zoeken..." autocomplete="off" onkeyup="filterRetour()">
                        <div class="suggesties-lijst" id="zoek-suggesties-retour"></div>
                    </div>

                    <label>Geselecteerde artikelen</label>
                    <div id="retour-artikelen-lijst" style="margin-bottom: 10px;"></div>

                    <button type="submit" class="btn-opslaan">Retour registreren</button>
                </form>
            </div>
        </div>

        <!-- Sectie: Archief -->
        <div class="sectie" id="sectie-archief">
            <h1>Archief</h1>
            <br>
            @if($meldingen->where('gearchiveerd', true)->isEmpty())
                <p style="color: #999;">Geen gearchiveerde bestellingen.</p>
            @else
                @foreach($meldingen->where('gearchiveerd', true) as $melding)
                <div class="melding" style="opacity: 1; border-left: 5px solid #0a5a8a; cursor: pointer;"
    onclick="toonMeldingPopup(
        '{{ addslashes($melding->titel) }}',
        '{{ addslashes($melding->bericht) }}',
        '{{ $melding->created_at->format('d/m/Y H:i') }}'
    )">
    <h3>{{ $melding->titel }}</h3>
    <p>{{ $melding->bericht }}</p>
    <small>{{ $melding->created_at->format('d/m/Y H:i') }}</small>
</div>
                @endforeach
            @endif
        </div>

    </div>

    <!-- Bestelling popup -->
    <div class="popup-achtergrond" id="melding-popup-achtergrond">
        <div class="popup">
            <h2>Bestelling details</h2>
            <p><strong>Titel:</strong> <span id="melding-popup-titel"></span></p>
            <p><strong>Bericht:</strong> <span id="melding-popup-bericht"></span></p>
            <p><strong>Datum:</strong> <span id="melding-popup-datum"></span></p>
            <button class="btn-sluiten" onclick="document.getElementById('melding-popup-achtergrond').style.display='none'">Sluiten</button>
        </div>
    </div>

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
        var alleMateriaal = [
            @foreach($materialen as $item)
            { id: {{ $item->id }}, tekst: '{{ addslashes($item->artikelnummer) }} - {{ addslashes($item->omschrijving) }}' },
            @endforeach
        ];

        function toonMeldingPopup(titel, bericht, datum) {
            document.getElementById('melding-popup-titel').innerText = titel;
            document.getElementById('melding-popup-bericht').innerText = bericht;
            document.getElementById('melding-popup-datum').innerText = datum;
            document.getElementById('melding-popup-achtergrond').style.display = 'block';
        }

        function filterUitgifte() {
            var zoekterm = document.getElementById('zoek-uitgifte').value.toLowerCase();
            var suggesties = document.getElementById('zoek-suggesties');

            if (zoekterm.length < 1) {
                suggesties.style.display = 'none';
                return;
            }

            var resultaten = alleMateriaal.filter(function(item) {
                return item.tekst.toLowerCase().includes(zoekterm);
            });

            suggesties.innerHTML = '';

            if (resultaten.length === 0) {
                suggesties.style.display = 'none';
                return;
            }

            resultaten.forEach(function(item) {
                var div = document.createElement('div');
                div.className = 'suggestie-item';
                div.innerText = item.tekst;
                div.onclick = function() {
                    voegArtikelToeAanLijst(item.id, item.tekst, 'artikelen-lijst');
                    document.getElementById('zoek-uitgifte').value = '';
                    suggesties.style.display = 'none';
                };
                suggesties.appendChild(div);
            });

            suggesties.style.display = 'block';
        }

        function filterRetour() {
            var zoekterm = document.getElementById('zoek-retour').value.toLowerCase();
            var suggesties = document.getElementById('zoek-suggesties-retour');

            if (zoekterm.length < 1) {
                suggesties.style.display = 'none';
                return;
            }

            var resultaten = alleMateriaal.filter(function(item) {
                return item.tekst.toLowerCase().includes(zoekterm);
            });

            suggesties.innerHTML = '';

            if (resultaten.length === 0) {
                suggesties.style.display = 'none';
                return;
            }

            resultaten.forEach(function(item) {
                var div = document.createElement('div');
                div.className = 'suggestie-item';
                div.innerText = item.tekst;
                div.onclick = function() {
                    voegArtikelToeAanLijst(item.id, item.tekst, 'retour-artikelen-lijst');
                    document.getElementById('zoek-retour').value = '';
                    suggesties.style.display = 'none';
                };
                suggesties.appendChild(div);
            });

            suggesties.style.display = 'block';
        }

        function voegArtikelToeAanLijst(id, tekst, lijstId) {
            var lijst = document.getElementById(lijstId);
            var rij = document.createElement('div');
            rij.className = 'artikel-rij';
            rij.innerHTML = `
                <input type="hidden" name="materiaal_id[]" value="${id}">
                <span style="flex: 2; padding: 8px; background: #f9f9f9; border-radius: 4px;">${tekst}</span>
                <input type="number" name="aantal[]" placeholder="Aantal" style="width: 80px; flex: none;">
                <button type="button" class="btn-verwijder-rij" onclick="this.parentElement.remove()">X</button>
            `;
            lijst.appendChild(rij);
        }

        function toonSectie(naam) {
            document.querySelectorAll('.sectie').forEach(s => s.classList.remove('actief'));
            document.querySelectorAll('.nav-links button').forEach(b => b.classList.remove('actief'));
            document.getElementById('sectie-' + naam).classList.add('actief');
            document.getElementById('btn-' + naam).classList.add('actief');
        }

        var urlParams = new URLSearchParams(window.location.search);
        var sectie = urlParams.get('sectie');
        if (sectie) {
            toonSectie(sectie);
        }

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

        document.addEventListener('click', function(e) {
            if (!e.target.closest('#zoek-uitgifte') && !e.target.closest('#zoek-suggesties')) {
                document.getElementById('zoek-suggesties').style.display = 'none';
            }
            if (!e.target.closest('#zoek-retour') && !e.target.closest('#zoek-suggesties-retour')) {
                document.getElementById('zoek-suggesties-retour').style.display = 'none';
            }
        });
    </script>

</body>

</html>