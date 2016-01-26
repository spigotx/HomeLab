<html>
<head>
	<title>HomeLab Network</title>
	<link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
	<meta http-equiv="refresh" content="60" />
  
    <style>
      body {
        background: #333;
        color: #000;
        margin: 0px;
        font-family: 'Yanone Kaffeesatz', sans-serif;
        font-size: 16px;
      }

      .square {
        width: 195px;
        height: 105px;
        border: 0px;
        display: inline-block;
        margin-right: 10px;
        margin-top: 10px;
      }

      .square-graph {
        width: 300px;
        height: 165px;
        border: 0px;
        display: inline-block;
        margin-right: 10px;
        margin-top: 10px;
      }

      h1 {
        font-family: 'Yanone Kaffeesatz', sans-serif;
        font-size: 35px;
        color: #FAFAFA;
        padding: 15px;
        background: #333;
        width: 400px;
      }

      h2 {
        font-family: 'Yanone Kaffeesatz', sans-serif;
        font-size: 20px;
        color: #FAFAFA;
        padding: 15px;
        background: #333;
        width: 200px;
      }


      a:link {
        color: #222;
        text-decoration: underline;
      }

      a:visited {
        color: #222;
        text-decoration: underline;
      }

      a:hover {
        color: #222;
        text-decoration: none;
      }

      a:active {
        color: #222;
        text-decoration: underline;
      }

      .online {
        padding: 2px 5px 2px 5px;
        margin: 0;
        display: inline;
        background: green;
        color: white;
      }

      .offline {
        padding: 2px 5px 2px 5px;
        margin: 0;
        display: inline;
        background: darkred;
        color: white;
      }

      .header {
        background: #444;
        width: 100%;
        height: 30px;
        min-height: 30px;
        margin-left: 0px;
        margin-right: 0px;
        padding-top: 5px;
        color: #888;
        border-bottom: 1px solid #666;
      }

      .header a:link {
        color: #CCC;
        text-decoration: underline;
      }

      .header a:visited {
        color: #ccc;
        text-decoration: underline;
      }

      .header a:hover {
        color: #fff;
        text-decoration: none;
      }

      .header a:active {
        color: #ccc;
        text-decoration: underline;
      }

      .widget_header {
          padding: 0.8em;
          background-color: #000000;
          color: #ffffff;
          -webkit-border-top-left-radius: 4px;
           -moz-border-top-right-radius: 4px;
                border-top-left-radius: 4px;
                border-top-right-radius: 4px;
      }

      .widget_body {
          padding: 0.8em;
      }

      .gridster * {
        margin:0;
      }

      .grid ul {
        list-style-type: none;
      }

      .gridster li {
          font-size: 1em;
          text-align: center;
          line-height: 100%;
      }

      .gridster {
          margin: 0 auto;

          opacity: .8;

          -webkit-transition: opacity .6s;
          -moz-transition: opacity .6s;
          -o-transition: opacity .6s;
          -ms-transition: opacity .6s;
          transition: opacity .6s;
      }

      .col-md-12 {
          width: 100%;
      }

      .tg  {border-collapse:collapse;border-spacing:0px;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
      .tg .tg-yw4l{vertical-align:top}

    #RB2011ToInternet {
      position: absolute;
      left: 300px;
      top: 70px;
      border: 0px solid black;
    } 

    #CRS125ToRB2011 {
      position: absolute;
      left: 1050px;
      top: 130px;
      border: 0px solid black;
    }  

    #ESXi01ToCRS125 {
      position: absolute;
      left: 610px;
      top: 280px;
      border: 0px solid black;
    }    

    #ESXi02ToCRS125 {
      position: absolute;
      left: 1100px;
      top: 280px;
      border: 0px solid black;
    } 

    #ESXi01 {
      position: absolute;
      left: 300px;
      top: 450px;
      border: 2px solid #00cc00;
    } 

    #ESXi02 {
      position: absolute;
      left: 1160px;
      top: 450px;
      border: 2px solid #00cc00;
    } 

    #RB2011WAN {
      position: absolute;
      left: 300px;
      top: 50px;
      border: 2px solid black;
      background-color: white;
    } 

    #ESXi01LAN {
      position: absolute;
      left: 628px;
      top: 150px;
      border: 2px solid black;
      background-color: white;
    } 

    #ESXi02LAN {
      position: absolute;
      left: 1160px;
      top: 150px;
      border: 2px solid black;
      background-color: white;
    }  
    </style>
</head>
<body>

<!-- A PORT MUST BE OPEN FOR THIS TO WORK -->
<!-- MOST COMMON PORTS ARE 22 & 80 -->

<?php

// Unix Time values
$actualTime = time();
$past4HoursTime = time() - 3600*4;
$past8HoursTime = time() - 3600*8;
$past1DayTime = time() - 3600*24;

// Online/Offline devices
$totalon = 0;
$totaloff = 0;

function GetServerStatus($site, $port)
{
	$status = array("<div class='online'>Online</div>", "<div class='offline'>Offline</div>");
	$fp = @fsockopen($site, $port, $errno, $errstr, 2);
  
	if (!$fp) {
    	global $totaloff;
        $totaloff++;
	    return $status[1];
	} else { 
        global $totalon;
        $totalon++;
        return $status[0];
    }
}

?>

<center>
	<div align="center" style="width: 1860px;">

    <!-- BEGIN CONTENT -->

    <table class="tg">
      <tr>
        <th class="tg-yw4l">
            <div class="square" style="background: #D8D8D8;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> Internet <br />
                    <strong>IP:</strong> 255.255.255.255<br />
                    <strong>Status:</strong> <?php echo GetServerStatus('xxx.xx',80); ?><br />
                </div>
            </div>    	
        </th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>    
        <th class="tg-yw4l"></th>     
        <th class="tg-yw4l">
          <div class="square" style="background: #D8D8D8;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong>  IP_Address<br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',8291); ?><br />
                </div>
            </div>
        </th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th> 
      </tr>
      <tr>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th>    
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
      </tr>
      <tr>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th>     
        <th class="tg-yw4l">
            <div class="square" style="background: #D8D8D8;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> IP_Address<br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',80); ?><br />
                </div>
            </div>
        </th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th>    
        <th class="tg-yw4l"></th>
      </tr>
      <tr>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th>     
      </tr>
      <tr>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l">
            <div class="square" style="background: #D8D8D8;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name<br />
                    <strong>IP:</strong> IP_Address<br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',22); ?><br />
                </div>
            </div>    
        </th> 
        <th class="tg-yw4l"></th>     
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l">
        </th>
        <th class="tg-yw4l">
             <div class="square" style="background: #D8D8D8;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name<br />
                    <strong>IP:</strong> IP_Address<br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',22); ?><br />
                </div>
            </div>        
        </th> 
        <th class="tg-yw4l"></th>     
      </tr>
      <tr>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l">
          <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',3389); ?><br />
                </div>
            </div>
        </th>
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> STDL01 <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',22); ?><br />
                </div>
            </div>    
        </th> 
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',3389); ?><br />
                </div>
            </div>    
        </th>     
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',3389); ?><br />
                </div>
            </div>
        </th>
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',22); ?><br />
                </div>
            </div>    
        </th> 
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <!-- <strong>IP:</strong> <?php echo gethostbyname('STWEB01'); ?><br /> -->
                    <strong>IP:</strong> IP_Address<br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',22); ?><br />
                </div>
            </div>       
        </th>     
      </tr>
      <tr>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',3389); ?><br />
                </div>
            </div>
        </th>
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',22); ?><br />
                </div>
            </div>    
        </th> 
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',22); ?><br />
                </div>
            </div>     
        </th>     
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',3389); ?><br />
                </div>
            </div>    
        </th>
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',22); ?><br />
                </div>
            </div>             
        </th> 
        <th class="tg-yw4l"></th>     
      </tr>
      <tr>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l">
            <div class="square" style="background: #FFFFFF;">
                <div style="float: left; margin: 15px; text-align: left; line-height: 25px;">
                    <strong>Name:</strong> host_name <br />
                    <strong>IP:</strong> <?php echo gethostbyname('host_name'); ?><br />
                    <strong>Status:</strong> <?php echo GetServerStatus('IP_Address',3389); ?><br />
                </div>
            </div>
        </th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th>     
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th>     
      </tr>
      <tr>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th>     
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th>
        <th class="tg-yw4l"></th> 
        <th class="tg-yw4l"></th>     
      </tr> 
    </table>

    <!-- END CONTENT -->
    <!-- END CONTENT -->
      
    <!-- CLEAR FLOATS -->
    <div style="clear: both; min-height: 10px;"></div>
    <!-- CLEAR FLOATS -->      
      
  </div>
</center>
 
<!-- Draw lines -->
  <canvas id="RB2011ToInternet" width="650" height="5"></canvas>
      <script>
        var canvas = document.getElementById('RB2011ToInternet');
        var context = canvas.getContext('2d');

        context.beginPath();
        context.moveTo(0, 0);
        context.lineTo(650, 0);
        context.lineWidth = 5;
        // set line color
        context.strokeStyle = '#00cc00';
        context.stroke();
      </script>

  <canvas id="CRS125ToRB2011" width="5" height="40"></canvas>
      <script>
        var canvas = document.getElementById('CRS125ToRB2011');
        var context = canvas.getContext('2d');

        context.beginPath();
        context.moveTo(0, 0);
        context.lineTo(0, 40);
        context.lineWidth = 5;
        // set line color
        context.strokeStyle = '#00cc00';
        context.stroke();
      </script>

  <canvas id="ESXi01ToCRS125" width="400" height="45"></canvas>
      <script>
        var canvas = document.getElementById('ESXi01ToCRS125');
        var context = canvas.getContext('2d');

        context.beginPath();
        context.moveTo(450, 5);
        context.lineTo(0, 40);
        context.lineWidth = 3;
        // set line color
        context.strokeStyle = '#00cc00';
        context.stroke();
      </script>

  <canvas id="ESXi02ToCRS125" width="380" height="45"></canvas>
      <script>
        var canvas = document.getElementById('ESXi02ToCRS125');
        var context = canvas.getContext('2d');

        context.beginPath();
        context.moveTo(0, 8);
        context.lineTo(380, 40);
        context.lineWidth = 3;
        // set line color
        context.strokeStyle = '#00cc00';
        context.stroke();
      </script>

  <canvas id="ESXi01" width="650" height="400"></canvas>
      <script>
        var canvas = document.getElementById('ESXi01');
        var context = canvas.getContext('2d');
      </script>

  <canvas id="ESXi02" width="650" height="400"></canvas>
      <script>
        var canvas = document.getElementById('ESXi02');
        var context = canvas.getContext('2d');
      </script>

<!-- LibreNMS graphs -->
  <!-- WAN -->
  <img id="RB2011WAN" class="minigraph-image" src="http://librenms_host/graph.php?id=134&amp;from=<?php echo $past4HoursTime ?>&amp;to=<?php echo $actualTime ?>&amp;width=320&amp;height=155&amp;type=port_bits&amp;legend=yes&amp;absolute=1">

  <!-- ESXi01 -->
  <img id="ESXi01LAN" class="minigraph-image" src="http://librenms_host/graph.php?id=108&amp;from=<?php echo $past4HoursTime ?>&amp;to=<?php echo $actualTime ?>&amp;width=320&amp;height=155&amp;type=port_bits&amp;legend=yes&amp;absolute=1">

  <!-- ESXi02 -->
  <img id="ESXi02LAN" class="minigraph-image" src="http://librenms_host/graph.php?id=109&amp;from=<?php echo $past4HoursTime ?>&amp;to=<?php echo $actualTime ?>&amp;width=320&amp;height=155&amp;type=port_bits&amp;legend=yes&amp;absolute=1">

<!-- Online/Offline devices counter -->
	<?php 
		$totalcount = $totaloff + $totalon; 
		$onOffCount = "($totalon/$totalcount)";
	?>

<!-- Chage main page title -->
	<script>
		var devicesCounter = "HomeLab Network <?php echo $onOffCount; ?>";
		window.parent.document.title =  devicesCounter;
	</script>
  
  
</body>
</html>
