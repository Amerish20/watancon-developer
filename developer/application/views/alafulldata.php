<html>
<style>
td{
	text-align:center;
}
</style>
<body>

<table border="1">
<tr>
     <td>id</td>
     <td>Vehicle</td>
     <td>Device Timestamp</td>
     <td>GPS Time</td>
     <td>lattitude</td>
     <td>lognitude</td>
     <td>speed</td>
     <td>idling</td>
     <td>external_power</td>
     <td>battery_power</td>
     <td>generated_event</td>
     <td>generated_event_value</td>
     <td>satelite</td>
     <td>movement</td>
     <td>manual_odometer</td>
     <td>odometer</td> 
     <td>ign_status</td>
     <td>acceleration</td>
     <td>hash_breaking</td>
     <td>Un Pluged</td>
     <td>Heading</td>
     <td>altitude</td>
     <td>created</td>
      <td>server and device time difference</td>
 </tr>
 <?php
 
 if(count($full_info)>0){
foreach($full_info as $full_key => $data){
	
 	print "<tr><td>".$data['id']."</td>";
	print "<td>".$data['vehicle_id']."</td>";
	print "<td>".$data['device_timestamp1']."</td>";
	print "<td>".$data['device_timestamp']."</td>";
 	print "<td>".$data['lattitude']."</td>";
	print "<td>".$data['lognitude']."</td>";
	print "<td>".$data['speed']."</td>";
	print "<td>".$data['idling']."</td>";
	print "<td>".$data['external_power']."</td>";
	print "<td>".$data['battery_power']."</td>";
	print "<td>".$data['generated_event']."</td>";
	print "<td>".$data['generated_event_value']."</td>";
	print "<td>".$data['satelite']."</td>";
	print "<td>".$data['movement']."</td>";
	print "<td>".$data['manual_odometer']."</td>";
	print "<td>".$data['odometer']."</td>";
	print "<td>".$data['ign_status']."</td>";
	print "<td>".$data['acceleration']."</td>";
	print "<td>".$data['hash_breaking']."</td>";
	print "<td>".$data['unplug']."</td>";
	print "<td>".$data['Heading']."</td>";
	print "<td>".$data['altitude']."</td>";
	print "<td>".$data['created']."</td>";
	print "<td>".$data['difference']."</td>";
 	
  
}
 }else{
	 
	 print "pelase contact admin";
 }
 die();
	?>
    
</table>
</body>
</html>
