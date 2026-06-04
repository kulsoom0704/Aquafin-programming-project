<?php
// start.php - Eerste pagina met 3 kaarten
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aquafin Portaal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #005b96 0%, #003d66 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            width: 100%;
        }
        
        h1 {
            text-align: center;
            color: white;
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .subtitel {
            text-align: center;
            color: rgba(255,255,255,0.9);
            margin-bottom: 50px;
            font-size: 18px;
        }
        
        .kaarten {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .kaart {
            background-color: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            flex: 1;
            min-width: 250px;
            max-width: 350px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .kaart:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        
        .kaart h2 {
            color: #005b96;
            margin-bottom: 15px;
            font-size: 24px;
        }
        
        .kaart p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        
        .knop {
            display: inline-block;
            background: linear-gradient(135deg, #005b96 0%, #003d66 100%);
            color: white;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: opacity 0.3s;
        }
        
        .knop:hover {
            opacity: 0.9;
        }
        
        .admin { border-top: 5px solid #005b96; }
        .technieker { border-top: 5px solid #17a2b8; }
        .magazijnier { border-top: 5px solid #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <h1> AQUAFIN</h1>
        <div class="subtitel">Welkom op het medewerkersportaal | Selecteer uw werkruimte</div>
        
        <div class="kaarten">
            <!-- Admin kaart -->
            <div class="kaart admin">
                <h2> ADMIN</h2>
                <p>Beheer gebruikers, toegang en rapporten.</p>
                <a href="login.php?rol=Admin" class="knop"> Login </a>
            </div>
            
            <!-- Technieker kaart -->
            <div class="kaart technieker">
                <h2> TECHNIEKER</h2>
                <p>Bekijk interventies, plannen en technische rapporten.</p>
                <a href="login.php?rol=Technieker" class="knop"> Login </a>
            </div>
            
            <!-- Magazijnier kaart -->
            <div class="kaart magazijnier">
                <h2> MAGAZIJNIER</h2>
                <p>Voorraadbeheer, bestellingen van onderdelen en inventaris.</p>
                <a href="login.php?rol=Magazijnier" class="knop">Login </a>
            </div>
        </div>
    </div>
</body>
</html>