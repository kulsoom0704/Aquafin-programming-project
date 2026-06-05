<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquafin - Admin Dashboard</title>

    <style>

        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:#f4f6f9;
        }

        .container{
            width:90%;
            margin:auto;
            padding:30px;
        }

        h1{
            color:#1b2a41;
            margin-bottom:10px;
        }

        h2{
            color:#0a67c7;
        }

        .description{
            margin-bottom:30px;
            color:#555;
        }

        .cards{
            display:flex;
            gap:20px;
            flex-wrap:wrap;
        }

        .card{
            background:white;
            border-radius:12px;
            padding:20px;
            flex:1;
            min-width:220px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .card h2{
            color:#0a67c7;
            margin-top:0;
        }

        .stat{
            font-size:35px;
            font-weight:bold;
            margin-top:15px;
        }

        .green{
            color:green;
        }

        .orange{
            color:orange;
        }

        .red{
            color:red;
        }

        table{
            width:100%;
            margin-top:30px;
            background:white;
            border-collapse:collapse;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        th{
            background:#0a67c7;
            color:white;
            padding:15px;
        }

        td{
            padding:12px;
            border-bottom:1px solid #ddd;
            text-align:center;
        }

        .chart-container{
            width:500px;
            margin:40px auto;
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Master Dashboard & Rapporten</h1>
<div class="sidebar">
    <h2>Aquafin</h2>

    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/users">Gebruikers</a>
    <a href="/admin/reports">Rapporten</a>
</div>
    
    <div class="cards">

        <div class="card">
            <h2>Gebruikers</h2>
            <div class="stat">15</div>
        </div>

        <div class="card">
            <h2>Installaties</h2>
            <div class="stat green">85%</div>
            <p>Operationeel</p>
        </div>

        <div class="card">
            <h2>Onderhoud</h2>
            <div class="stat orange">10%</div>
            <p>In onderhoud</p>
        </div>

        <div class="card">
            <h2>Kritieke storingen</h2>
            <div class="stat red">5%</div>
            <p>Waarschuwingen</p>
        </div>

    </div>

    <h2 style="margin-top:40px;">
        Voorspellingen Overstromingsrisico 2026-2030
    </h2>

    <table>

        <tr>
            <th>Jaar</th>
            <th>Gemiddelde Regenval</th>
            <th>Risico</th>
        </tr>

        @foreach($rainfall as $data)

        <tr>

            <td>{{ $data['year'] }}</td>

            <td>{{ $data['rainfall'] }} mm</td>

            <td>

                @if($data['risk'] == 'Laag')

                    <span class="green">
                        {{ $data['risk'] }}
                    </span>

                @elseif($data['risk'] == 'Hoog')

                    <span class="red">
                        {{ $data['risk'] }}
                    </span>

                @else

                    <span class="orange">
                        {{ $data['risk'] }}
                    </span>

                @endif

            </td>

        </tr>

        @endforeach

    </table>

    <div class="chart-container">

        <h2>Systeemstatus</h2>

        <canvas id="riskChart"></canvas>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('riskChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [
            'Operationeel',
            'Onderhoud',
            'Kritieke storing'
        ],
        datasets: [{
            data: [85,10,5],
            backgroundColor: [
                '#28a745',
                '#ffc107',
                '#dc3545'
            ]
        }]
    }
});

</script>

</body>
</html>