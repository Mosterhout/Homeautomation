<html>
<head>
<?php include "./header.html" ?>
<meta http-equiv="refresh" content="86400">  <!-- Page refresh in seconds -->
<script type="text/javascript" src="java_scripts/addrow-v2.js"></script>
<title>Edit Schedule</title>
</head>
<body>
<form action="schedule_input.php" method="post">
	<table>
		<?php
			$systemfile = "state/systemstate.txt";
			$systemstatus = file_get_contents($systemfile);
			if($systemstatus == '1') {
										//auto
										$fn = fopen("schedules/schedule_auto.txt","r");
										$tr = "0";
										echo '<tr><th>Day of the Week</th><th>Time</th><th>Heat</th><th>Cool</th></tr>';
										while(! feof($fn))  {
											$schedule = fgets($fn);
											$str_arr = explode (",", $schedule);
											$dow = $str_arr[0];
											$time = $str_arr[1];
											$heat = $str_arr[2];
											$cool = $str_arr[3];
											
											if($time === NULL){
												//do nothing becasue it is empty
											}
											else{
													echo '<tr class="row_to_clone">
															<td><select name="dow['.rtrim($tr).']" id="day">
																<option value="' . date('l', strtotime("Sunday +{$dow} days")) . '" selected >' . date('l', strtotime("Sunday +{$dow} days")) . '</option>
																<option value="Sunday">Sunday</option>
																<option value="Monday">Monday</option>
																<option value="Tuesday">Tuesday </option>
																<option value="Wednesday">Wednesday</option>
																<option value="Thursday">Thursday</option>
																<option value="Friday">Friday</option>
																<option value="Saturday">Saturday</option>
																<option value="delete">Delete Record</option>
															</select></td>
															<td><input type="time" name="time['.rtrim($tr).']" value="'.rtrim($time).'"/></td>
															<td><input type="range" name="heat['.rtrim($tr).']" value="'.rtrim($heat).'" min="61" max="90" oninput="this.nextElementSibling.value = this.value"><output>'.rtrim($heat).'</output></td>
															<td><input type="range" name="cool['.rtrim($tr).']" value="'.rtrim($cool).'" min="61" max="90" oninput="this.nextElementSibling.value = this.value"><output>'.rtrim($cool).'</output></td>
														</tr>';
													$tr++;
												}
										  }
									}
			if($systemstatus == '2') {
										//heat
										$fn = fopen("schedules/schedule_heat.txt","r");
										$tr = "0";
										echo '<tr><th>Day of the Week</th><th>Time</th><th>Heat</th></tr>';
										while(! feof($fn))  {
											$schedule = fgets($fn);
											$str_arr = explode (",", $schedule); 
											$dow = $str_arr[0];
											$time = $str_arr[1];
											$heat = $str_arr[2];
											
											if(empty($dow)){
												//do nothing becasue it is empty
											}
											else{
													echo '<tr class="row_to_clone">
															<td><select name="dow['.rtrim($tr).']" id="day">
																<option value="' . date('l', strtotime("Sunday + $dow Days")) . '" selected >' . date('l', strtotime("Sunday + $dow Days")) . '</option>
																<option value="Sunday">Sunday</option>
																<option value="Monday">Monday</option>
																<option value="Tuesday">Tuesday </option>
																<option value="Wednesday">Wednesday</option>
																<option value="Thursday">Thursday</option>
																<option value="Friday">Friday</option>
																<option value="Saturday">Saturday</option>
																<option value="delete">Delete Record</option>
															</select></td>
															<td><input type="time" name="time['.rtrim($tr).']" value="'.rtrim($time).'"/></td>
															<td><input type="range" name="heat['.rtrim($tr).']" value="'.rtrim($heat).'" min="61" max="90" oninput="this.nextElementSibling.value = this.value"><output>'.rtrim($heat).'</output></td>
															</tr>';
													$tr++;
												}
										  }
									}
			if($systemstatus == '3') {
										//cool
										$fn = fopen("schedules/schedule_cool.txt","r");
										$tr = "0";
										echo '<tr><th>Day of the Week</th><th>Time</th><th>Cool</th></tr>';
										while(! feof($fn))  {
											$schedule = fgets($fn);
											$str_arr = explode (",", $schedule); 
											$dow = $str_arr[0];
											$time = $str_arr[1];
											$cool = $str_arr[2];
											
											if(empty($dow)){
												//do nothing becasue it is empty
											}
											else{
													echo '<tr class="row_to_clone">
															<td><select name="dow['.rtrim($tr).']" id="day">
																<option value="' . date('l', strtotime("Sunday + $dow Days")) . '" selected >' . date('l', strtotime("Sunday + $dow Days")) . '</option>
																<option value="Sunday">Sunday</option>
																<option value="Monday">Monday</option>
																<option value="Tuesday">Tuesday </option>
																<option value="Wednesday">Wednesday</option>
																<option value="Thursday">Thursday</option>
																<option value="Friday">Friday</option>
																<option value="Saturday">Saturday</option>
																<option value="delete">Delete Record</option>
															</select></td>
															<td><input type="time" name="time['.rtrim($tr).']" value="'.rtrim($time).'"/></td>
															<td><input type="range" name="cool['.rtrim($tr).']" value="'.rtrim($cool).'" min="61" max="90" oninput="this.nextElementSibling.value = this.value"><output>'.rtrim($cool).'</output></td>
															</tr>';
													$tr++;	
												}
										  }
									}
			fclose($fn);
		?>
	</table>
	<br>
	<div><input type="submit" /></div>
	<br>
	<br>
	<div><a onclick="addRow(); return false;" href="#">Add Row</a></div>
</form>
</body>