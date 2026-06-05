<!DOCTYPE html>
<html>
<head>
    <title>Overstromingsrapporten</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="sidebar">
    <h2>Aquafin</h2>

    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/users">Gebruikers</a>
    <a href="/admin/reports">Rapporten</a>
</div>

<div class="content">

    <h1>Overstromingsrapporten</h1>

    <button class="btn">
        Rapport genereren
    </button>

    <table>

        <tr>
            <th>Seizoen</th>
            <th>Neerslag</th>
            <th>Risico</th>
        </tr>

        <tr>
            <td>Winter</td>
            <td>242 mm</td>
            <td>🟢 Laag</td>
        </tr>

        <tr>
            <td>Lente</td>
            <td>193 mm</td>
            <td>🟢 Laag</td>
        </tr>

        <tr>
            <td>Zomer</td>
            <td>238 mm</td>
            <td>🟠 Gemiddeld</td>
        </tr>

        <tr>
            <td>Herfst</td>
            <td>255 mm</td>
            <td>🟠 Gemiddeld</td>
        </tr>

    </table>

</div>

</body>
</html>