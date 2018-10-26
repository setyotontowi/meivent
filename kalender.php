<!doctype html>
<html lang="en" style="height: 100%;">
  <head>
    <title>Meivent</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="fa/css/fontawesome-all.css">

    <style type="text/css">
      @font-face {
        font-family: "Perpetua";
        src: url('fonts/PER_____.ttf');
      }
     
      .perpetua {
        font-family: "Perpetua";
      }
      
      #calendar table tbody td:hover{
        cursor: pointer;
        background-color: #00c0ef !important;
        color: white !important;
      }
    </style>

    <script type="text/javascript">
      function setDate() {
        var today = new Date();
        var d = today.getDate();
        var moon = datetostring(today.getMonth()+1);
        var y = today.getFullYear();
        document.getElementById('tahun').innerHTML = y;
        document.getElementById('bulan').innerHTML = moon;
        document.getElementById('tanggal').innerHTML = d + " " + moon + " " + y;
        isi(moon, y);
      }

      function datetostring(moon){
        var moons = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return moons[moon-1];
      }

      function isi(month, year){
        var dayEnd = setdayend(month, year);
        var date = new Date(month + year);
        var daySelect = date.getDay();
        var day = 1;
        var monthEnd = 0;
        var n = 0;
        var today = new Date();
        $('#tubuh').empty();
        for(var i=0; i<6; i++){
          var tr = "<tr class='inside' style='text-align: center; height: 16.6666%;'></tr>";
          $('#tubuh').append(tr);
          for(var j=0; j<7; j++){
            var penentu = 0;
            var style = document.createAttribute('style');
            var onclick = document.createAttribute('onclick');
            
            if(day > dayEnd){
              day = 1;
              monthEnd++;
            }
            
            if(monthEnd > 0){
              style.value = "background-color: #cecece;";
              penentu = 1;
            }

            var td = document.createElement('td');
            var dayValue = document.createTextNode(day);

            if(n < daySelect){
              style.value = "background-color : #cecece;";
              var monthNum = datedisplay(month)-1;
              if(monthNum == 0){
                monthNum = 12;
              }
              var dte = setdayend(datetostring(monthNum), year);
              day = dte - daySelect + 1 + n;
              dayValue = document.createTextNode(day);
              penentu = -1;
              day = 0;
              n++;
            }

            if(day == today.getDate() && month == datetostring(today.getMonth()+1) && year == today.getFullYear() && monthEnd == 0){
              style.value = "color: #00c0ef; border: 1px solid #00c0ef;";
            }

            var str1 = "getValue(";
            var str2 = ")";
            var ma = datedisplay(month);
            onclick.value = str1.concat(dayValue.textContent,",", ma,",",year,",",penentu, str2);
            td.appendChild(dayValue);
            td.setAttributeNode(onclick);
            td.setAttributeNode(style);
            document.getElementsByClassName('inside')[i].appendChild(td);
            day++;
          }
        }
      }

      function setdayend(month, year){
        month = month.toUpperCase();
        var day = 0;
        switch(month){
          case 'JANUARY'  : day = 31; break;
          case 'FEBRUARY' : 
            if((year % 4) == 0){
              day = 29;
            }
            else if((year % 4) != 0){
              day = 28;
            }
            break;  
          case 'MARCH'    : day = 31; break;
          case 'APRIL'    : day = 30; break;
          case 'MAY'      : day = 31; break;
          case 'JUNE'     : day = 30; break;
          case 'JULY'     : day = 31; break;
          case 'AUGUST'   : day = 31; break;
          case 'SEPTEMBER': day = 30; break;
          case 'OCTOBER'  : day = 31; break;
          case 'NOVEMBER' : day = 30; break;
          case 'DECEMBER' : day = 31; break;
        }
        return day;  
      }

      function datedisplay(month){
        var val;
        month = month.toUpperCase();
        var moons = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];
        for (var i = 0; i < moons.length; i++) {
          if(month == moons[i]){
            val = i+1;
            break;
          }
        }
        return val;
      }

      function getValue(date, month, year, penentu){
        month = month + penentu;
        if(month == 0){
          month = 12;
          year = year - 1;
        }
        else if(month == 13){
          month = 1;
          year = year + 1;
        }
        month = datetostring(month);
        document.getElementById('tanggal').innerHTML = date + " " + month + " " + year;
      }

      function prev(){
        year = parseInt($('#tahun').html());
        month = $('#bulan').html().toUpperCase();
        var moon = datedisplay(month);
        moon = moon - 1;
        switch(moon){
          case 0 :
            month = 'December';
            moon = 12;
            year = year - 1;
            break;
          case 1 : month = 'January';  break;
          case 2 : month = 'February'; break;
          case 3 : month = 'March';    break;
          case 4 : month = 'April';    break;
          case 5 : month = 'May';      break;
          case 6 : month = 'June';     break;
          case 7 : month = 'July';     break;
          case 8 : month = 'August';   break;
          case 9 : month = 'September';break;
          case 10: month = 'October';  break;
          case 11: month = 'November'; break;
          case 12: month = 'December'; break;
          case 13:
            month = 'January';
            moon = 1;
            year = year + 1;
            break;
        }
        isi(month, year);
        document.getElementById('tahun').innerHTML = year;
        document.getElementById('bulan').innerHTML = month;
      }

      function next(){
        year = parseInt($('#tahun').html());
        month = $('#bulan').html().toUpperCase();
        var moon = datedisplay(month);
        moon = moon + 1;
        switch(moon){
          case 0 :
            month = 'December';
            moon = 12;
            year = year - 1;
            break;
          case 1 : month = 'January';  break;
          case 2 : month = 'February'; break;
          case 3 : month = 'March';    break;
          case 4 : month = 'April';    break;
          case 5 : month = 'May';      break;
          case 6 : month = 'June';     break;
          case 7 : month = 'July';     break;
          case 8 : month = 'August';   break;
          case 9 : month = 'September';break;
          case 10: month = 'October';  break;
          case 11: month = 'November'; break;
          case 12: month = 'December'; break;
          case 13:
            month = 'January';
            moon = 1;
            year = year + 1;
            break;
        }
        isi(month, year);
        document.getElementById('tahun').innerHTML = year;
        document.getElementById('bulan').innerHTML = month;
      }

      function bulan(){
        var year = parseInt($('#tahun').html());
        $('#judul').empty();
        $('#judul').html(
          '<div class="col-2" style="text-align: center; cursor: pointer;" onclick="prevTahun()"><h5 style="margin:0;"><i class="fa fa-chevron-left"></i></h5></div><div class="col-8" style="text-align: center;"><h5 id="tahun">' + year +'</h5></div><div class="col-2" style="text-align: center; cursor: pointer;" onclick="nextTahun()"><h5 style="margin:0;"><i class="fa fa-chevron-right"></i></h5></div>'
        );
        $('#calendar>table>thead').empty();
        isi2();
      }

      function isi2(){
        var year = parseInt($('#tahun').html());
        var moon = 1;
        var today = new Date();
        $('#tubuh').empty();
        for(var i=0; i<3; i++){
          var tr = "<tr class='inside' style='text-align: center; height: 30%;'></tr>";
          $('#tubuh').append(tr);
          for(var j=0; j<4; j++){
            var style = document.createAttribute('style');
            var onclick = document.createAttribute('onclick');
            var td = document.createElement('td');
            var moonValue = document.createTextNode(datetostring(moon));
            style.value = "width: 25%;";
            if(moon == today.getMonth()+1 && year == today.getFullYear()){
              style.value = "color: #00c0ef; border: 1px solid #00c0ef; width: 25%;";
            }
            var str1 = "monthchange(";
            var str2 = ")";
            onclick.value = str1.concat(moon,str2);
            td.appendChild(moonValue);
            td.setAttributeNode(onclick);
            td.setAttributeNode(style);
            document.getElementsByClassName('inside')[i].appendChild(td);
            moon++;
          }
        }
      }

      function monthchange(a){
        var year = parseInt($('#tahun').html());
        var month = datetostring(a);
        $('#judul').empty();
        $('#judul').html(
          '<div class="col-2" style="text-align: center; cursor: pointer;" onclick="prev()"><h5 style="margin:0;"><i class="fa fa-chevron-left"></i></h5></div><div class="col-8"><div class="row justify-content-center align-items-center"><div class="col-2"></div><div class="col-8" style="text-align: center; cursor: pointer;" onclick="bulan()"><h5 id="tahun">' + year + '</h5><h5 id="bulan">' + month + '</h5></div><div class="col-2" style="text-align: center; cursor: pointer;" onclick="setDate()"><i class="fa fa-calendar"></i></div></div></div><div class="col-2" style="text-align: center; cursor: pointer;" onclick="next()"><h5 style="margin:0;"><i class="fa fa-chevron-right"></i></h5></div>'
        );
        $('#calendar>table>thead').html(
          '<tr style="text-align: center; height: 100%;"><td style="width: 14.285714286%;">Su</td><td style="width: 14.285714286%;">Mo</td><td style="width: 14.285714286%;">Tu</td><td style="width: 14.285714286%;">We</td><td style="width: 14.285714286%;">Th</td><td style="width: 14.285714286%;">Fr</td><td style="width: 14.285714286%;">Sa</td></tr>'
        );
        isi(month, year);
      }

      function prevTahun(){
        var year = parseInt($('#tahun').html())-1;
        document.getElementById('tahun').innerHTML = year;
        isi2();
      }

      function nextTahun(){
        year = parseInt($('#tahun').html())+1;
        document.getElementById('tahun').innerHTML = year;
        isi2();
      }

      function login(){
        $('#aksi').empty();
        $('#aksi').html(
          '<table style="width: 100%; height: 100%; background-color: #f8f8f8;"><form action="#" method="post"><tr style="height: 10%;"><td style="padding-left: 15px; width: 25%; height: 30px;">Username</td><td colspan="2" style="padding-left: 15px; width: 75%; height: 30px;"><input type="text" name="username" required style="width: 100%; height: 25px; border: 0px;"></td></tr><tr style="height: 10%;"><td style="padding-left: 15px; width: 25%; height: 30px;">Password</td><td colspan="2" style="padding-left: 15px; width: 75%; height: 30px;"><input type="password" name="password" required style="width: 100%; height: 25px; border: 0px;"></td></tr><tr style="height: 10%;"><td style="padding-left: 15px; width: 25%; height: 30px;"></td><td colspan="2" style="padding-left: 15px; width: 75%; height: 30px;"><button type="submit" style="width: 100%; height: 25px; border: 0px; background-color: #00c0ef; color: white;">SIGN IN</button></td></tr></form><tr style="height: 5%;"><td colspan="3"><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr><form action="#" method="post"><tr style="height: 10%;"><td style="padding-left: 15px; width: 25%; height: 30px;">Username</td><td colspan="2" style="padding-left: 15px; width: 75%; height: 30px;"><input type="text" name="username" required style="width: 100%; height: 25px; border: 0px;"></td></tr><tr style="height: 10%;"><td style="padding-left: 15px; width: 25%; height: 30px;">Password</td><td colspan="2" style="padding-left: 15px; width: 75%; height: 30px;"><input type="password" name="password" required style="width: 100%; height: 25px; border: 0px;"></td></tr><tr style="height: 10%;"><td style="padding-left: 15px; width: 25%; height: 30px;">Full Name</td><td colspan="2" style="padding-left: 15px; width: 75%; height: 30px;"><input type="text" name="fullname" required style="width: 100%; height: 25px; border: 0px;"></td></tr><tr style="height: 10%;"><td style="padding-left: 15px; width: 25%; height: 30px;">Gender</td><td style="padding-left: 15px; width: 37.5%; height: 30px;">Male</td><td style="padding-left: 15px; width: 37.5%; height: 30px;">Female</td></tr><tr style="height: 10%;"><td style="padding-left: 15px; width: 25%; height: 30px;"></td><td colspan="2" style="padding-left: 15px; width: 75%; height: 30px;"><button type="submit" style="width: 100%; height: 25px; border: 0px; background-color: #003245; color: white;">SIGN UP</button></td></tr></form></table>'
        );
        $('#menu').empty();
        $('#menu').html(
          '<h6 style="margin: 0px;"><i><u onclick="note()" style="cursor: pointer;">Back</u> to your notes.</i></h6>'
        );
      }

      function note(){
        $('#aksi').empty();
        $('#aksi').html(
          '<table style="width: 100%;"><thead style="background-color: #e5e5e5;"><tr><td style="padding-left: 15px; text-align: left; width: 100%; height: 30px;">Task</td></tr></thead><tbody><tr><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Meivent</td></tr><tr><td><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr><tr><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Meivent</td></tr><tr><td><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr><tr><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;"><input type="text" name="task" placeholder="Task" style="width: 100%; height: 25px; border: 0px;"></td></tr></tbody></table><table style="width: 100%;"><thead style="background-color: #e5e5e5;"><tr><td style="padding-left: 15px; text-align: left; width: 25%; height: 30px;">Time</td><td style="padding-left: 15px; text-align: left; width: 75%; height: 30px;">Schedule</td></tr></thead><tbody><tr><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Morning</td><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Coding</td></tr><tr><td colspan="2"><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr><tr><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Morning</td><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Coding</td></tr><tr><td colspan="2"><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr><tr><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;"><input type="text" name="time" placeholder="Time" style="width: 100%; height: 25px; border: 0px;"></td><td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;"><input type="text" name="schedule" placeholder="Schedule" style="width: 100%; height: 25px; border: 0px;"></td></tr></tbody></table>'
        );
        $('#menu').empty();
        $('#menu').html(
          '<h6 style="margin: 0px;"><i><u onclick="login()" style="cursor: pointer;">Login</u> for save your notes.</i></h6>'
        );
      }
    </script>
  </head>
  <body class="perpetua" style="/*background-color: #003245;*/ height: 100%;" onload="setDate()">
    <div class="container" style="height: 100%;  ">
      <div class="row justify-content-center align-items-center" style="height: 100%;">
        <div class="col-xl-8" style="height: 90%; padding: 15px;">
          <div class="col-12" style="background-color: #00c0ef; box-shadow:0 0 40px #d4d4d4; border-radius: 5px; height: 100%;">
            <div class="row justify-content-center align-items-center" style="color: white; height: 20%;" id="judul">
              <div class="col-2" style="text-align: center; cursor: pointer;" onclick="prev()">
                <h5 style="margin:0"><i class="fa fa-chevron-left"></i></h5>
              </div>
              <div class="col-8">
                <div class="row justify-content-center align-items-center">
                  <div class="col-2">
                  </div>
                  <div class="col-8" style="text-align: center; cursor: pointer;" onclick="bulan()">
                    <h5 id="tahun">2012</h5>
                    <h5 id="bulan">December</h5>
                  </div>
                  <div class="col-2" style="text-align: center; cursor: pointer;" onclick="setDate()">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
              <div class="col-2" style="text-align: center; cursor: pointer;" onclick="next()">
                <h5 style="margin:0"><i class="fa fa-chevron-right"></i></h5>
              </div>
            </div>
            <div id="calendar" class="row" style="background-color: #FFFFFF; height: 80%; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
              <table style="width: 100%; height: 100%;">
                <thead style="background-color: #e5e5e5; height: 14.285714286%;">
                  <tr style="text-align: center; height: 100%;">
                    <td style="width: 14.285714286%;">Su</td>
                    <td style="width: 14.285714286%;">Mo</td>
                    <td style="width: 14.285714286%;">Tu</td>
                    <td style="width: 14.285714286%;">We</td>
                    <td style="width: 14.285714286%;">Th</td>
                    <td style="width: 14.285714286%;">Fr</td>
                    <td style="width: 14.285714286%;">Sa</td>
                  </tr>
                </thead>
                <tbody id="tubuh" style="height: 85.71428571%;">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-4" style="height: 90%; padding: 15px;">
          <div class="col-12" style="background-color: #00c0ef; box-shadow: 0 0 40px #d4d4d4; border-radius: 5px; height: 100%;">
            <div class="row justify-content-center align-items-center" style="height: 20%;">
              <h5 id="tanggal" style="color: white;">12 December 2012</h5>
            </div>
            <div class="row" style="background-color: #FFFFFF; height: 70%; overflow-y: auto; overflow-x: auto;" id="aksi">
              <table style="width: 100%;">
                <thead style="background-color: #e5e5e5;">
                  <tr>
                    <td style="padding-left: 15px; text-align: left; width: 100%; height: 30px;">Task</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Meivent</td>
                  </tr>
                  <tr><td><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr>
                  <tr>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Meivent</td>
                  </tr>
                  <tr><td><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr>
                  <tr>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;"><input type="text" name="task" placeholder="Task" style="width: 100%; height: 25px; border: 0px;"></td>
                  </tr>
                </tbody>
              </table>
              <table style="width: 100%;">
                <thead style="background-color: #e5e5e5;">
                  <tr>
                    <td style="padding-left: 15px; text-align: left; width: 25%; height: 30px;">Time</td>
                    <td style="padding-left: 15px; text-align: left; width: 75%; height: 30px;">Schedule</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Morning</td>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Coding</td>
                  </tr>
                  <tr><td colspan="2"><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr>
                  <tr>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Morning</td>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;">Coding</td>
                  </tr>
                  <tr><td colspan="2"><hr style="border-color: #e5e5e5; margin: 0px;"></td></tr>
                  <tr>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;"><input type="text" name="time" placeholder="Time" style="width: 100%; height: 25px; border: 0px;"></td>
                    <td style="padding-left: 15px; background-color: #f8f8f8; height: 30px;"><input type="text" name="schedule" placeholder="Schedule" style="width: 100%; height: 25px; border: 0px;"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="row justify-content-center align-items-center" style="background-color: #e5e5e5; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; height: 10%;">
              <div class="col-2" style="text-align: center;">
                <a href="index.php"><i class="fa fa-home" title="Go to home"></i></a>
              </div>
              <div class="col-8" style="text-align: center;" id="menu">
                <h6 style="margin: 0px;"><i><u onclick="login()" style="cursor: pointer;">Login</u> for save your notes.</i></h6>
              </div>
              <div class="col-2" style="text-align: center;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>