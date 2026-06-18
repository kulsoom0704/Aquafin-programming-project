<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Aquafin Rapport</title>
</head>
<body>

<h1>Aquafin Rapport</h1>

<table border="1" width="100%" cellpadding="10">

<tr>
    <th>Seizoen</th>
    <th>Regenval</th>
    <th>Risico</th>
</tr>

@foreach($rapporten as $rapport)

<tr>
    <td>{{ $rapport['seizoen'] }}</td>
    <td>{{ $rapport['regenval'] }}</td>
    <td>{{ $rapport['risico'] }}</td>
</tr>

@endforeach

</table>

</body>
</html>