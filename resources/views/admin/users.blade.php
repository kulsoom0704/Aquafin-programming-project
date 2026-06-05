<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikersbeheer</title>

    <style>

        body{
            margin:0;
            font-family:Arial,sans-serif;
            background:#f4f6f9;
        }

        .sidebar{
            width:220px;
            background:#0a67c7;
            height:100vh;
            position:fixed;
            padding:20px;
        }

        .sidebar h2{
            color:white;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            margin:15px 0;
        }

        .content{
            margin-left:270px;
            padding:30px;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:10px;
            margin-bottom:25px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        input, select{
            width:100%;
            padding:10px;
            margin-top:10px;
            margin-bottom:15px;
            border:1px solid #ddd;
            border-radius:5px;
        }

        button{
            background:#0a67c7;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:5px;
            cursor:pointer;
        }

        .delete{
            background:red;
        }

        .disable{
            background:orange;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }

        th{
            background:#0a67c7;
            color:white;
            padding:12px;
        }

        td{
            padding:12px;
            border-bottom:1px solid #ddd;
        }

        .active{
            color:green;
            font-weight:bold;
        }

    </style>
</head>

<body>

<div class="sidebar">

    <h2>Aquafin</h2>

    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/users">Gebruikers</a>
    <a href="/admin/reports">Rapporten</a>

</div>

<div class="content">

    <h1>Gebruikersbeheer</h1>

    <p>Totaal aantal gebruikers: 3</p>

    <div class="card">

        <h2>Nieuwe gebruiker aanmaken</h2>

        <form>

            <label>Naam</label>
            <input type="text" placeholder="Naam">

            <label>Email</label>
            <input type="email" placeholder="Email">

            <label>Rol</label>

            <select>
                <option>Admin</option>
                <option>Technieker</option>
                <option>Magazijnier</option>
            </select>

            <button type="submit">
                Gebruiker toevoegen
            </button>

        </form>

    </div>

    <div class="card">

        <h2>Gebruikerslijst</h2>

        <table>

            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>

            <tr>
                <td>Jan Peeters</td>
                <td>jan@aquafin.be</td>
                <td>Technieker</td>
                <td class="active">Actief</td>
                <td>
                    <button class="disable">Deactiveren</button>
                    <button class="delete">Verwijderen</button>
                </td>
            </tr>

            <tr>
                <td>Marie Janssens</td>
                <td>marie@aquafin.be</td>
                <td>Magazijnier</td>
                <td class="active">Actief</td>
                <td>
                    <button class="disable">Deactiveren</button>
                    <button class="delete">Verwijderen</button>
                </td>
            </tr>

            <tr>
                <td>Admin Aquafin</td>
                <td>admin@aquafin.be</td>
                <td>Admin</td>
                <td class="active">Actief</td>
                <td>
                  <button onclick="deactivateUser(this)" class="disable">
                     Deactiveren
                    </button>

                    <button onclick="deleteUser(this)" class="delete">
                        Verwijderen
                    </button>
                </td>
            </tr>

        </table>

    </div>

</div>
<script>

function deactivateUser(button)
{
    let confirmation = confirm(
        "Bent u zeker dat u deze gebruiker wilt deactiveren?"
    );

    if(confirmation)
    {
        let row = button.closest("tr");

        row.cells[3].innerHTML =
            '<span style="color:gray;font-weight:bold;">Gedeactiveerd</span>';

        alert("Gebruiker succesvol gedeactiveerd.");
    }
}

function deleteUser(button)
{
    let confirmation = confirm(
        "Bent u zeker dat u deze gebruiker wilt verwijderen?"
    );

    if(confirmation)
    {
        let row = button.closest("tr");

        row.remove();

        alert("Gebruiker succesvol verwijderd.");
    }
}

</script>
</body>
</html>