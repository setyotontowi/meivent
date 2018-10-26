<!doctype html>
<html lang="en" style="height: 100%;">
  <head>
    <title>Meivent</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <style type="text/css">
      @font-face {
        font-family: "Perpetua";
        src: url('fonts/PER_____.ttf');
      }
     
      .perpetua {
        font-family: "Perpetua";
      }
    </style>

    <script type="text/javascript">
      function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        var d = today.getDate();
        var day = dayFull(today.getDay());
        var moon = month3(today.getMonth());
        var y = today.getFullYear();
        h = checkTime(h);
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('jam').innerHTML = h;
        document.getElementById('menit').innerHTML = m;
        document.getElementById('detik').innerHTML = s;
        document.getElementById('tanggal').innerHTML = day + ", " + d + " " + moon + " " + y;
        setTimeout(startTime, 1000);
      }

      function dayFull(day){
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return days[day];
      }

      function month3(moon){
        var moons = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return moons[moon];
      }

      function checkTime(i) {
        if (i < 10) {i = "0" + i};
        return i;
      }
    </script>
  </head>
  <body class="perpetua" style="background-color: #003245; height: 100%;" onload="startTime()">
    <div class="container-fluid" style="height: 100%;">
      <div class="row justify-content-center align-items-center" style="color: white; height: 80%; text-align: center;">
        <div class="col-1" style="padding: 0px;">
          <center><h2 id="jam">12</h2></center>
        </div>
        <div class="col-1" style="padding: 0px;">
          <center><h2>:</h2></center>
        </div>
        <div class="col-1" style="padding: 0px;">
          <center><h2 id="menit">12</h2></center>
        </div>
        <div class="col-1" style="padding: 0px;">
          <center><h2>:</h2></center>
        </div>
        <div class="col-1" style="padding: 0px;">
          <center><h2 id="detik">12</h2></center>
        </div>
      </div>
      <div class="row justify-content-end" style="height: 20%;">
        <div class="col-auto">
          <a class="btn btn-outline-light btn-lg btn-block" href="kalender.php" role="button" id="tanggal">12 Dec 2012</a>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>