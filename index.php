<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <title>Autopart Battery Monitor</title>
    <meta name="author" content="Bartłomiej Giera">
    <style>
        @font-face { font-family: 'Protest Strike';
             src: url('ProtestStrike-Regular.ttf') format('woff2'), url('ProtestStrike-Regular.ttf') format('woff'); }
        body {
            background-color: black;
            color: white;
            font-family: "Protest Strike", sans-serif;
            font-weight: 400;
            letter-spacing: 2.5px;
            margin: 0px;
            text-align: center;
            font-size: 30px;
            font-style: normal;
            padding: 5%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            
        }
        h1, #progressBar {
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        #progressBar {
            height: 75px;
            background-color: #286BB1;
            
        }
        #progressCheck {

            display: flex; justify-content: center; align-items: center;
            width: 50px;
            position: relative;
            overflow: hidden;
        }
        .extra-divs {
            position: absolute; 
            left: 50%; 
            transform: translateX(-50%); 
            display: flex;
            animation-name: progressAnimation;
            animation-duration: 15s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }
        @keyframes progressAnimation {
            0%   { transform: translateX(-60%);}
            25%  { transform: translateX(-55%);}
            50%  { transform: translateX(-50%);}
            75%  { transform: translateX(-45%);}
            100% { transform: translateX(-40%);}
        }
        .extra-divs > div {
            width: 40px;
            height: 150px;
            background-color: white;
            transform: rotate(-30deg);
            opacity: 0.05;
            margin-right: 50px;

        }
        img{width:80%}

    </style>
</head>
<body>
    <div>
    <img src="autopartLogoBlank.png" alt="">
    <h1>LICZBA <span style="color: #C72F3B;">AKUMULATORÓW</span> WYPRODUKOWANA <span style="color:#286BB1">W 2024</span></h1>
    <div id="progressBar">
        <div id="progressCheck" style="height: 100%;background-color:#C72F3B;">
        <p id="percentBar"></p>
        <div class="extra-divs">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    </div>
    </div>
    <h2><span style="color: #C72F3B;" id="batteryNum"></span> / <span style="color:#286BB1">1 950 000</span></h2>
    </div>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "autopart";

    $conn = mysqli_connect($servername, $username, $password, $dbname); //łączenie z bazą

    $sql = "SELECT COUNT(id_akumulatora) AS battery_count FROM akumulatory"; //zapytanie sql pobierające aktualną liczbe wyprodukowanych akumulatorów
    $result = mysqli_query($conn, $sql); // wywołanie zapytania

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $batteryNum = $row['battery_count'];
    } else {
        $batteryNum = "Error";
    } // debuger błędów
    ?>

    <script>
        var ThisYearGoal = 1950000; //Cel, liczba wyprodukowania akumulatorów na ten rok
        var batteryCountValue = "<?php echo $batteryNum; ?>"; //pobranie wartości liczby akumulatorów z php i przypisanie do zmiennej
        document.getElementById("batteryNum").innerHTML = batteryCountValue.replace(/\B(?=(\d{3})+(?!\d))/g, " ");; //wyświetlanie aktualnej wyprodukowanej liczby akumulatorów w tym roku
        document.getElementById("progressCheck").style.width = (batteryCountValue / ThisYearGoal) * 100 + "%"; // pasek progressu
        document.getElementById("percentBar").innerHTML = ((batteryCountValue / ThisYearGoal) * 100).toFixed(1) + "%"; //wyświetlanie % celu

        setTimeout(function() {
        location.reload();
        }, 120000); //aktualizacja danych co 2 minuty
    </script>

</body>
</html>
