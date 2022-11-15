<html>
<!--<meta http-equiv="refresh" content="10">-->
<style>
td{
	text-align:center;
}
</style>

<body>

<table border="1">
<tr>
     <td>id</td>
     <td>vehicle_id</td>
     <td>vehicle Name</td>
     <td>device time</td>
     <td>server time</td>
     <td>device time difference</td>
     <td>lattitude</td>
     <td>lognitude</td>
     <td>unpluged</td>
     <td>ign_status</td>
    <!-- <td>idling</td>-->
     <td>movement</td>
     <td>speed</td>
     <td>satelite</td>
     <td>generated event</td>
     <td>generated event value</td>
     <td>acceleration</td>
     <td>hash_breaking</td>
     <td>odometer</td> 
     <td>Manual odometer</td> 
     <td>battery_power</td>
     <td>external_power</td>
      <td>Heading</td>
     <td>revstatus</td>
     <td>altitude</td>
      <td >Difference</td>
</tr>
 <?php
foreach($full_info as $full_key => $data){
	
 	print "<tr><td>".$data['id']."</td>";
	print "<td>".$data['vehicle_id']."</td>";
	print "<td>".$data['name']."</td>";
	print "<td>".$data['device_timestamp']."</td>";
	print "<td>".$data['created']."</td>";
	print "<td>".$data['duration']."</td>";
	print "<td>".$data['lattitude']."</td>";
	print "<td>".$data['lognitude']."</td>";
	print "<td>".$data['unplug']."</td>";
	print "<td>".$data['ign_status']."</td>";
	//print "<td>".$data['idling']."</td>";
	print "<td>".$data['movement']."</td>";
	print "<td>".$data['speed']."</td>";
	print "<td>".$data['satelite']."</td>";
	print "<td>".$data['generated_event']."</td>";
	print "<td>".$data['generated_event_value']."</td>";
  	print "<td>".$data['acceleration']."</td>";
	print "<td>".$data['hash_breaking']."</td>";
   	print "<td>".$data['odometer']."</td>";
	print "<td>".$data['manual_odometer']."</td>";
    print "<td>".$data['battery_power']."</td>";
	print "<td>".$data['external_power']."</td>";
  	print "<td>".$data['Heading']."</td>";
	print "<td>".$data['rev_status']."</td>";
	print "<td>".$data['altitude']."</td>";
 	print "<td>".$data['difference']."</td></tr>";
	
  
}die();
	?>
    
</table>
</body>
</html>
