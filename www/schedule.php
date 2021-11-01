<html>
<head>
<?php include "./header.html" ?>
<meta http-equiv="refresh" content="86400">  <!-- Page refresh in seconds -->
<script type="text/javascript" src="java_scripts/addrow-v2.js"></script>
<title>Schedule</title>
<style>
         table, th, td {
            border: 4px solid black; text-align: center;
         }
</style>
</head>
<body>
<?php
	//print_r($_POST);
	$systemfile = "state/systemstate.txt";
	$systemstatus = file_get_contents($systemfile);
	if($systemstatus == '1') {
								//System in auto;
								echo '<h3><p style="color:darkgreen">Auto Schedule</p></h3>';
								echo '<table><tr><th>Day of the Week</th><th>Time</th><th><p style="color:red">Heat</p></th><th><p style="color:#0096FF">Cool</p></th></tr>';
								//Reads the sorted file line by line and prints it on screen showing the saved schedule
								$textCnt  = "schedules/schedule_auto.txt";
								$contents = file_get_contents($textCnt);
								$text_line = explode("\n",$contents);
								for ($start=0; $start < count($text_line); $start++) {
																						//print $text_line[$start] . "<BR>";
																						$line = explode(",",$text_line[$start]);
																						if($line[1] === NULL){
																											//do nothing becasue it is empty
																										}
																						else{
																								echo '<tr><td>'.date('l', strtotime("Sunday +{$line[0]} days")).'</td><td>'.$line[1].'</td><td><p style="color:red">'. $line[2].'</p></td><td><p style="color:#0096FF">'.$line[3].'</p></td><tr>';
																							}

																					}
							}
	if($systemstatus == '2') {
								//System in heat;
								echo '<h3><p style="color:red"> Heating Schedule </p></h3>';
								echo '<table><tr><th>Day of the Week</th><th>Time</th><th><p style="color:red">Heat</p></th></tr>';
								//Reads the sorted file line by line and prints it on screen showing the saved schedule
								$textCnt  = "schedules/schedule_heat.txt";
								$contents = file_get_contents($textCnt);
								$text_line = explode("\n",$contents);
								for ($start=0; $start < count($text_line); $start++) {
																						//print $text_line[$start] . "<BR>";
																						$line = explode(",",$text_line[$start]);
																						if($line[1] === NULL){
																											//do nothing becasue it is empty
																										}
																						else{
																								echo '<tr><td>'.date('l', strtotime("Sunday +{$line[0]} days")).'</td><td>'.$line[1].'</td><td><p style="color:red">'. $line[2].'</p></td><tr>';
																							}

																					}
							}
	if($systemstatus == '3') {
								//System in cool;
								echo '<h3><p style="color:#0096FF">Cooling Schedule</p></h3>';
								echo '<table><tr><th>Day of the Week</th><th>Time</th><th><p style="color:#0096FF">Cool</p></th></tr>';
								//Reads the sorted file line by line and prints it on screen showing the saved schedule
								$textCnt  = "schedules/schedule_cool.txt";
								$contents = file_get_contents($textCnt);
								$text_line = explode("\n",$contents);
								for ($start=0; $start < count($text_line); $start++) {
																						//print $text_line[$start] . "<BR>";
																						$line = explode(",",$text_line[$start]);
																						if($line[1] === NULL){
																											//do nothing becasue it is empty
																										}
																						else{
																								echo '<tr><td>'.date('l', strtotime("Sunday +{$line[0]} days")).'</td><td>'.$line[1].'</td><td><p style="color:#0096FF">'. $line[2].'</p></td><tr></p>';
																							}

																					}
							}
?>
</table>
<form action="/schedule_edit.php">
    <input type="submit" value="Edit Schedule" />
</form>
</body>