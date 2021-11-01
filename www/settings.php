<html>
<head>
<?php include "./header.html" ?>
<meta http-equiv="refresh" content="86400"> <!-- Page refresh in seconds -->
<meta charset="utf-8">
<title>Settings</title>
</head>
<body>
<div class="row">
	<div class="column">
		<?php
			$filterlife = "settings/filter_life.txt";
			$content = file_get_contents($filterlife);
			echo "<h2>Remaing Filter Life: " . $content . " days</h2>";
		?>
		<table>
			<tr>
				<td>
					<!-- Reset Filter Life button -->
					<form action="" method="post">
						<button name="filterreset" class="button buttonreset">Reset</button>
					</form>
				</td>
				<?php
					//<!-- Filter Life ack button so it stops warning till the next day-->
					$filterlife = "settings/filter_life.txt";
					$content = file_get_contents($filterlife);
					if($content < '11' && $ack_content == '0' ) {
																echo'
																<td>
																	<form action="" method="post">
																		<button name="filterlifeack" class="button">Filter Life Ack</button>
																	</form>
																</td>';
															}
				?>
			</tr>
		</table>

		<h2>Set Filter Reminder</h2>
		<?php
			$set_filter_reminder = "settings/set_filter_reminder.txt";
			$filter_reminder = file_get_contents($set_filter_reminder);
			if ($filter_reminder == '30') {
								$filter_30 = 'green';
								$filter_60 = '#686868';
								$filter_90 = '#686868';
							}
			else if ($filter_reminder == '60') {
										$filter_30 = '#686868';
										$filter_60 = 'green';
										$filter_90 = '#686868';
									}
			else if ($filter_reminder == '90') {
										$filter_30 = '#686868';
										$filter_60 = '#686868';
										$filter_90 = 'green';
									}
		?>
		<table>
			<tr>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $filter_30; ?>" name="filter30" class="button">30</button>
					</form>
				</td>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $filter_60; ?>" name="filter60" class="button">60</button>
					</form>
				</td>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $filter_90; ?>" name="filter90" class="button">90</button>
					</form>
				</td>
			</tr>
		</table>
		<?php
		$fan_int_time = "settings/fan_int_time.txt";
		$fan_int_content = file_get_contents($fan_int_time);
		
		echo'
		<form action="" method="post">
			<label for="fan_int_time"><h2>Fan Intermittent Time(mins)</h2></label>
			<input type="text" value="'.$fan_int_content.'" id="fan_int_time" name="fan_int_time"><br><br>
		<input type="submit" value="Submit">
		</form>';
		
		
		?>
	</div>
	
	<div class="column">
		<h2>Unit</h2>
		<?php
			$get_unit = "settings/unit.txt";
			$unit = file_get_contents($get_unit);
			if ($unit == 'us') {
								$us = 'green';
								$metric = '#686868';
							}
			else if ($unit == 'metric') {
										$us = '#686868';
										$metric = 'green';
									}
		?>
		<table>
			<tr>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $us; ?>" name="us" class="button">F&#176;</button>
					</form>
				</td>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $metric; ?>" name="metric" class="button">C&#176;</button>
					</form>
				</td>
			</tr>
		</table>
		<?php
			$main_temp_cal = "settings/main_temp_calabration_f.txt";
			$main_temp_content = file_get_contents($main_temp_cal);
			$main_hum_cal = "settings/main_hum_calabration_f.txt";
			$main_hum_content = file_get_contents($main_hum_cal);
			
			$od_temp_cal = "settings/od_temp_calabration_f.txt";
			$od_temp_content = file_get_contents($od_temp_cal);
			$od_hum_cal = "settings/od_hum_calabration_f.txt";
			$od_hum_content = file_get_contents($od_hum_cal);
		
		echo'
		<form action="" method="post">
			<label for="main_temp_calabration_f"><h2>Inside Temp Calabration</h2></label>
			<input type="text" value="'.$main_temp_content.'" id="main_temp_calabration_f" name="main_temp_calabration_f"><br>
			<label for="od_temp_calabration_f"><h2>Outside Temp Calabration</h2></label>
			<input type="text" value="'.$od_temp_content.'" id="od_temp_calabration_f" name="od_temp_calabration_f"><br>
			
			<label for="main_hum_calabration_f"><h2>Inside Humidity Calabration</h2></label>
			<input type="text" value="'.$main_hum_content.'" id="main_hum_calabration_f" name="main_hum_calabration_f"><br>
			
			<label for="od_hum_calabration_f"><h2>Outside Humidity Calabration</h2></label>
			<input type="text" value="'.$od_hum_content.'" id="od_hum_calabration_f" name="od_hum_calabration_f"><br>
			
			<input type="submit" value="Submit">
		</form>';
		?>
	</div>
</div>


<!--#######
#Scripts that the buttons interact with
######-->
<?php
if(isset($_POST['filter30'])){
								$filter_reminder = "settings/set_filter_reminder.txt";
								$set_filter_reminder = "30";
								file_put_contents($filter_reminder, $set_filter_reminder);
								header('Location: '.$_SERVER['REQUEST_URI']);
								ob_end_flush();
								
							}
if(isset($_POST['filter60'])){
								$filter_reminder = "settings/set_filter_reminder.txt";
								$set_filter_reminder = "60";
								file_put_contents($filter_reminder, $set_filter_reminder);
								header('Location: '.$_SERVER['REQUEST_URI']);
								ob_end_flush();
								
							}
if(isset($_POST['filter90'])){
								$filter_reminder = "settings/set_filter_reminder.txt";
								$set_filter_reminder = "90";
								file_put_contents($filter_reminder, $set_filter_reminder);
								header('Location: '.$_SERVER['REQUEST_URI']);
								ob_end_flush();
								
							}
if(isset($_POST['filterreset'])){
								$filter_reminder = "settings/set_filter_reminder.txt";
								$get_filter_reminder = file_get_contents($filter_reminder);
								$filterlife = "settings/filter_life.txt";
								$set_filter_life = $get_filter_reminder;
								file_put_contents($filterlife, $set_filter_life);
								header('Location: '.$_SERVER['REQUEST_URI']);
								ob_end_flush();
								
							}
if(isset($_POST['filterlifeack'])){
								$filter_ack = "settings/filter_life_ack.txt";
								$set_filter_ack = "1";
								file_put_contents($filter_ack, $set_filter_ack);
								header('Location: '.$_SERVER['REQUEST_URI']);
								ob_end_flush();
								
							}							
if(isset($_POST['main_temp_calabration_f'])){
											$MainTempCal = "settings/main_temp_calabration_f.txt";
											$set_MainTempCal = ($_POST['main_temp_calabration_f']);
											file_put_contents($MainTempCal, $set_MainTempCal);
											header('Location: '.$_SERVER['REQUEST_URI']);
											ob_end_flush();
											}
if(isset($_POST['main_hum_calabration_f'])){
											$MainHumCal = "settings/main_hum_calabration_f.txt";
											$set_MainHumCal = ($_POST['main_hum_calabration_f']);
											file_put_contents($MainHumCal, $set_MainHumCal);
											header('Location: '.$_SERVER['REQUEST_URI']);
											ob_end_flush();
											}
if(isset($_POST['od_temp_calabration_f'])){
											$ODTempCal = "settings/od_temp_calabration_f.txt";
											$set_ODTempCal = ($_POST['od_temp_calabration_f']);
											file_put_contents($ODTempCal, $set_ODTempCal);
											header('Location: '.$_SERVER['REQUEST_URI']);
											ob_end_flush();
											}
if(isset($_POST['od_hum_calabration_f'])){
											$ODHumCal = "settings/od_hum_calabration_f.txt";
											$set_ODHumCal = ($_POST['od_hum_calabration_f']);
											file_put_contents($ODHumCal, $set_ODHumCal);
											header('Location: '.$_SERVER['REQUEST_URI']);
											ob_end_flush();
											}
if(isset($_POST['fan_int_time'])){
											$fan_int_time = "settings/fan_int_time.txt";
											$set_fan_int_time = ($_POST['fan_int_time']);
											file_put_contents($fan_int_time, $set_fan_int_time);
											header('Location: '.$_SERVER['REQUEST_URI']);
											ob_end_flush();
											}											

if(isset($_POST['us'])){
								$unitfile = "settings/unit.txt";
								$set_unit = "us";
								file_put_contents($unitfile, $set_unit);
								header('Location: '.$_SERVER['REQUEST_URI']);
								ob_end_flush();
								
							}
if(isset($_POST['metric'])){
								$unitfile = "settings/unit.txt";
								$set_unit = "metric";
								file_put_contents($unitfile, $set_unit);
								header('Location: '.$_SERVER['REQUEST_URI']);
								ob_end_flush();
								
								}
?>
</body>
</html>