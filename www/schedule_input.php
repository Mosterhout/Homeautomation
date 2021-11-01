<html>
<head>
<?php include "./header.html" ?>
<style>
         table, th, td {
            border: 4px solid black; text-align: center;
         }
</style>
<script type="text/javascript" src="java_scripts/addrow-v2.js"></script>
<meta http-equiv="refresh" content="3;url=http://172.16.120.71/schedule.php" />  <!-- Send you back to the schedule page -->
<title>Schedule Saved!</title>
</head>
<body>
<?php
	//print_r($_POST);
	$systemfile = "state/systemstate.txt";
	$systemstatus = file_get_contents($systemfile);
	if($systemstatus == '1') {
								//System in auto;
								echo '<h3><p style="color:darkgreen"> Auto Schedule Saved! </p></h3>';
								echo '<table><tr><th>Day of the Week</th><th>Time</th><th><p style="color:red">Heat</p></th><th><p style="color:#0096FF">Cool</p></th></tr>';
								//Reading the post from the submited form on the schedule page and putting them into arrays
								$days = $_POST['dow'];
								$times = $_POST['time'];
								$heats = $_POST['heat'];
								$cools = $_POST['cool'];
								$file = fopen("schedules/schedule_auto.txt", "w") or die("Unable to open file!");
								$i = count($days);
								for($j = 0; $j < $i; $j++){
															if($days[$j] == 'delete' || is_null($days[$j]) || is_null($times[$j]) ){
																//do nothing so the line is not writen to file
															}
															else{
																//writes the arrays to the schedule file
																$daynum = date("w", strtotime("$days[$j]"));
																fwrite($file, "$daynum,$times[$j],$heats[$j],$cools[$j]\n");
															}
														}
								fclose($file);
								
								//opens the schedule and sorts it by day
								$output = shell_exec('sort -k1,2 -n -t, schedules/schedule_auto.txt');
								$sortedfile = fopen("schedules/schedule_auto.txt", "w") or die("Unable to open file!");
								fwrite($sortedfile, $output);
								fclose($sortedfile);
								
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
								echo '<h3><p style="color:red"> Heating Schedule Saved! </p></h3>';
								echo '<table><tr><th>Day of the Week</th><th>Time</th><th><p style="color:red">Heat</p></th></tr>';
								//Reading the post from the submited form on the schedule page and putting them into arrays
								$days = $_POST['dow'];
								$times = $_POST['time'];
								$heats = $_POST['heat'];
								$file = fopen("schedules/schedule_heat.txt", "w") or die("Unable to open file!");
								$i = count($days);
								for($j = 0; $j < $i; $j++){
															if($days[$j] == 'delete' || is_null($days[$j]) || is_null($times[$j]) ){
																//do nothing so the line is not writen to file
															}
															else{
																//writes the arrays to the schedule file
																$daynum = date("w", strtotime("$days[$j]"));
																fwrite($file, "$daynum,$times[$j],$heats[$j]\n");
															}
														}
								fclose($file);
								
								//opens the schedule and sorts it by day
								$output = shell_exec('sort -k1,2 -n -t, schedules/schedule_heat.txt');
								$sortedfile = fopen("schedules/schedule_heat.txt", "w") or die("Unable to open file!");
								fwrite($sortedfile, $output);
								fclose($sortedfile);
								
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
								echo '<h3><p style="color:#0096FF"> Cooling Schedule Saved! </p></h3>';
								echo '<table><tr><th>Day of the Week</th><th>Time</th><th><p style="color:#0096FF">Cool</p></th></tr>';
								//Reading the post from the submited form on the schedule page and putting them into arrays
								$days = $_POST['dow'];
								$times = $_POST['time'];
								$cools = $_POST['cool'];
								$file = fopen("schedules/schedule_cool.txt", "w") or die("Unable to open file!");
								$i = count($days);
								for($j = 0; $j < $i; $j++){
															if($days[$j] == 'delete' || is_null($days[$j]) || is_null($times[$j]) ){
																//do nothing so the line is not writen to file
															}
															else{
																//writes the arrays to the schedule file
																$daynum = date("w", strtotime("$days[$j]"));
																fwrite($file, "$daynum,$times[$j],$cools[$j]\n");
															}
														}
								fclose($file);
								
								//opens the schedule and sorts it by day
								$output = shell_exec('sort -k1,2 -n -t, schedules/schedule_cool.txt');
								$sortedfile = fopen("schedules/schedule_cool.txt", "w") or die("Unable to open file!");
								fwrite($sortedfile, $output);
								fclose($sortedfile);
								
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

</body>