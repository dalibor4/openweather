<?php
	include './includes/app.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo PORTAL_NAME; ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <h2>Just an example <span id="timer"></span></h2>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>Time</th>
                <th>Country</th>
                <th>City</th>
                <th>Weather main</th>
                <th>Weather desc</th>
                <th>Temperature F</th>
                <th>Temperature C</th>
                <th>Pressure</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="Time"></td>
                <td id="Country"></td>
                <td id="City"></td>
                <td id="Wmain"></td>
                <td id="Wdesc"></td>
                <td id="Wtemp"></td>
                <td id="WtempCel"></td>
                <td id="Wpres"></td>
              </tr>
            </tbody>
        </table>
        <pre>
            <div id="OW"></div>
        </pre>
    </body>
    <script type="text/javascript">
        
        var seconds = 10;
        var span;
        window.onload = loadOW;
        setInterval(function() {
            loadOW();
        }, seconds * 1000);
        
        
        function loadOW() {
            /*Show timer*/
            timer(seconds);
            
            /*For time*/
            var d = new Date();
            var xmlhttp = new XMLHttpRequest(), Weather;
            xmlhttp.open('GET', 'OWcheck.php');
            xmlhttp.setRequestHeader('Content-Type', 'application/json');
            
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 ) {
                   if (xmlhttp.status == 200) {
                        Weather = JSON.parse(xmlhttp.responseText);
                        
                            document.getElementById("Time").innerHTML = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
                            document.getElementById("Country").innerHTML = Weather.sys.country;
                            document.getElementById("City").innerHTML = Weather.name;
                            document.getElementById("Wmain").innerHTML = Weather.weather[0].main;
                            document.getElementById("Wdesc").innerHTML = Weather.weather[0].description;
                            document.getElementById("Wtemp").innerHTML = Weather.main.temp;
                            document.getElementById("WtempCel").innerHTML = Math.round(Weather.main.temp / 32 * 100) / 100;
                            document.getElementById("Wpres").innerHTML = Weather.main.pressure;
                            
                        document.getElementById("OW").innerHTML = xmlhttp.responseText;
                        
                   }
                   else if (xmlhttp.status == 400) {
                        console.log(xmlhttp);
                        console.log('Error 400');
                   }
                   else {
                       console.log(xmlhttp);
                       console.log('Error :: somethingelse');
                   }
                }
            };
            
            xmlhttp.send();
        }
        
        function timer(secondsTimeOut) 
        {
            setInterval(
                    function() {
                        secondsTimeOut--;
                        
                        if(secondsTimeOut < 0) 
                        {
                            clearInterval(span);
                        } else {
                            document.getElementById("timer").innerHTML = secondsTimeOut.toString();
                        }
                    }, 
            1000);
            
        }
            
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
