<html>
<head>
<?php include "./header.html" ?>
<meta http-equiv="refresh" content="3"> <!-- Page refresh in seconds -->
<title>Thermostat</title>
</head>
<body>
<!--#######
#Scripts that the buttons interact with, this has to be above the actuall buttons/object that call the scipts so the page refeashes correctly
######-->
<?php
	//Set up all the fils and get contents in one place then i don't need to rewrite them for each POST call
	$heatfile = "set_input/set_heat.txt";
	$coolfile = "set_input/set_cool.txt";
	$set_cool = file_get_contents($coolfile);
	$set_heat = file_get_contents($heatfile);
	$fanfile = "state/fanstate.txt";
	$systemfile = "state/systemstate.txt";
	$holdfile = "state/hold.txt";
	
	function reloadpage() {
							header('Location: '.$_SERVER['REQUEST_URI']);
							ob_end_flush();
						}
	if(isset($_POST['heatuptemp'])){
								if ($set_heat > 89){
													$set_heat = 90;
													file_put_contents($heatfile, $set_heat);
													if ($set_heat+"2" > $set_cool){
																					$set_cool = $set_heat+"2";
																					file_put_contents($coolfile, $set_cool);
																				}
												}
									else {
										file_put_contents($heatfile, ++$set_heat);
										if ($set_heat+"2" > $set_cool){
																		$set_cool = $set_heat+"2";
																		file_put_contents($coolfile, $set_cool);
																	}
										}
								reloadpage();
								}
	if(isset($_POST['heatdowntemp'])){
									if ($set_heat < "61"){
															$set_heat = "60";
															file_put_contents($heatfile, $set_heat);
														}
										else {
												file_put_contents($heatfile, --$set_heat);												
											}
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
								}
	if(isset($_POST['cooluptemp'])){
								if ($set_cool > 98){
													$set_cool = 99;
													file_put_contents($coolfile, $set_cool);
												}
									else {
											file_put_contents($coolfile, ++$set_cool);
										}
								header('Location: '.$_SERVER['REQUEST_URI']);
								ob_end_flush();	
								}
	if(isset($_POST['cooldowntemp'])){
									if ($set_cool < "65"){
															$set_cool = "64";
															file_put_contents($coolfile, $set_cool);
															if ($set_cool-"2" < $set_heat){
																							$set_heat = $set_cool-"2";
																							file_put_contents($heatfile, $set_heat);
																						}
															
														}
										else {
												file_put_contents($coolfile, --$set_cool);
												if ($set_cool-"2" < $set_heat){
																				$set_heat = $set_cool-"2";
																				file_put_contents($heatfile, $set_heat);
																			}
											}
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
									
								}
	if(isset($_POST['fanauto'])){
									$set_fan_state = "2";
									file_put_contents($fanfile, $set_fan_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
								}
	if(isset($_POST['fanon'])){
									$set_fan_state = "1";
									file_put_contents($fanfile, $set_fan_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
								}
	if(isset($_POST['fanoff'])){
									$set_fan_state = "0";
									file_put_contents($fanfile, $set_fan_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
								}
	if(isset($_POST['systemoff'])){
									$set_system_state = "0";
									file_put_contents($systemfile, $set_system_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
									
								}
	if(isset($_POST['systemauto'])){
									$set_system_state = "1";
									file_put_contents($systemfile, $set_system_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
									
								}
	if(isset($_POST['systemheat'])){
									$set_system_state = "2";
									file_put_contents($systemfile, $set_system_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
									
								}
	if(isset($_POST['systemcool'])){
									$set_system_state = "3";
									file_put_contents($systemfile, $set_system_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
									
								}
	if(isset($_POST['hold'])){
									$set_hold_state = "1";
									file_put_contents($holdfile, $set_hold_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
								}
	if(isset($_POST['resume'])){
									$set_hold_state = "0";
									file_put_contents($holdfile, $set_hold_state);
									header('Location: '.$_SERVER['REQUEST_URI']);
									ob_end_flush();
								}
?>
<!--#######
#set temp section, This section is broken into different php scripts that output different html 
#code based system state, I.E. if you selete heat it will only show heat adjustment option, if
#you select auto it will show both heat and cool.
######-->
<div class="row">
		<!--#######
		#Temp Controls 
		######-->
		<?php  //Getting the current stats for system and hold
		$systemfile = "state/systemstate.txt";
		$systemstatus = file_get_contents($systemfile);
		$holdfile = "state/hold.txt";
		$holdstatus = file_get_contents($holdfile);
		if ($holdstatus == '1') {
									$hold = 'green';
								}
		else {
				$hold = '#686868';
			}
		?>
		
		<div class="column">
		<?php 
			if($systemstatus == '0') : ?>
				<h3>System: Off</h3>
		<?php endif; ?>
		
		<?php //Heat Buttons
			if($systemstatus == '1' || $systemstatus == '2') : ?>
			<table>
				<tr>
					<td>
						<h3><?php
							$heatfile = "set_input/set_heat.txt";
							$content = file_get_contents($heatfile);
							echo "Set Heat: " . $content . "<br>";
						?></h3>
					</td>
				</tr>
				<tr>
					<td>
						<!-- Heat Buttons -->
						<form action="" method="post">
							<button name="heatuptemp" class="button buttonheat">up</button>
						</form>
					</td>
					<td>
						<form action="" method="post">
							<button name="heatdowntemp" class="button buttonheat">down</button>
						</form>
					</td>
				</tr>
			</table>
		<?php endif; ?>
		
		<?php // cool buttons
			if($systemstatus == '1' || $systemstatus == '3') : ?>
			<table>
				<tr>
					<td>
						<h3><?php
							$coolfile = "set_input/set_cool.txt";
							$content = file_get_contents($coolfile);
							echo "Set Cool: " . $content . "<br>";
						?></h3>
					</td>
				</tr>
				<tr>
					<td>
						<!-- Cool Buttons -->	
						<form action="" method="post">
							<button name="cooluptemp" class="button buttoncool">up</button>
						</form>
					</td>
					<td>
						<form action="" method="post">
							<button name="cooldowntemp" class="button buttoncool">down</button>
						</form>
					</td>
				</tr>
			</table>
		<?php endif; ?>
		<?php // Hold/Resume
			if($systemstatus != '0'): ?> 
			<table>
				<tr>
					<td>
						<form action="" method="post">
							<button style="background-color:<?php print $hold; ?>" name="hold" class="button">Hold</button>
						</form>
					</td>
					<td>
						<form action="" method="post">
							<button name="resume" class="button">Resume</button>
						</form>
					</td>
				</tr>
			</table>
		<?php endif; ?>
	</div>

<!--#######
#Current Stats
######-->
	<div class="column">
	<?php 
	echo "<h6>".date("h:i A")."</h6>";
	echo "<h5>".date("l,")."<br>";
	echo date("F j Y")."</h5><br>";
	?>
	<h4 style="color:green;">Inside</h4>
	<h3><?php
		$insidetemp = "sensor/main_cur_temp_f.txt";
		$content = file_get_contents($insidetemp);
		echo "Temp: ".$content."<br>";
	?>
	<?php
		$insidehmd = "sensor/main_cur_humidity.txt";
		$content = file_get_contents($insidehmd);
		echo "Humidity: " . $content . "<br>";
		
		$insidefeelslike = "sensor/main_cur_feels_f.txt";
		$content = file_get_contents($insidefeelslike);
		echo "Feels Like: " . $content . "";
	?></h3>
	<br>
	<h4 style="color:green;">Outside</h4>
	<h3><?php
		$outsidetemp = "sensor/od_cur_temp_f.txt";
		$content = file_get_contents($outsidetemp);
		echo "Temp: " . $content . "<br>";
		
		$outsidehmd = "sensor/od_cur_humidity.txt";
		$content = file_get_contents($outsidehmd);
		echo "Humidity: " . $content . "<br>";
		
		$odfeelslike = "sensor/od_cur_feels_f.txt";
		$content = file_get_contents($odfeelslike);
		echo "Feels Like: " . $content . "";
	?></h3>
	<br><br><br>
	</div>

<!--#######
#System Controls 
######-->
	<!--#######
	#This sets the button colors based on state so you know what 
	#the system is supose to be doing 
	######-->	
<?php
	$fanfile = "state/fanstate.txt";
	$fanstatus = file_get_contents($fanfile);
	if ($fanstatus == '0') {
						$fan_int = 'green';
						$fan_on = '#686868';
						$fan_auto = '#686868';
					}
	else if ($fanstatus == '1') {
								$fan_int = '#686868';
								$fan_on = 'green';
								$fan_auto = '#686868';
							}
	else if ($fanstatus == '2') {
								$fan_int = '#686868';
								$fan_on = '#686868';
								$fan_auto = 'green';
							}
	
	$systemfile = "state/systemstate.txt";
	$systemstatus = file_get_contents($systemfile);
	if ($systemstatus == '0') {
								$system_off = 'green';
								$system_auto = '#686868';
								$system_heat = '#686868';
								$system_cool = '#686868';
								
							}
	else if ($systemstatus == '1') {
									$system_off = '#686868';
									$system_auto = 'green';
									$system_heat = '#686868';
									$system_cool = '#686868';
								}
	else if ($systemstatus == '2') {
									$system_off = '#686868';
									$system_auto = '#686868';
									$system_heat = 'green';
									$system_cool = '#686868';
								}
	else if ($systemstatus == '3') {
									$system_off = '#686868';
									$system_auto = '#686868';
									$system_heat = '#686868';
									$system_cool = 'green';
								}
	?>
	<div class="column">
		<?php
			$fanaction = "action/fan_action.txt";
			$content = file_get_contents($fanaction);
			echo "<h2>Fan: " . $content . "</h2>";
		?>
		<table>
			<tr>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $fan_auto; ?>" name="fanauto" class="button">Auto</button>
					</form>
				</td>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $fan_on; ?>" name="fanon" class="button">On</button>
					</form>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<form action="" method="post">
						<button style="background-color:<?php print $fan_int; ?>" name="fanoff" class="button">Intermittent</button>
					</form>
				</td>
			</tr>
		</table>
		<?php
			$systemaction = "action/system_action.txt";
			$content = file_get_contents($systemaction);
			echo "<h2>System: " . $content . "</h2>";
		?>
		<table>
			<tr>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $system_auto; ?>" name="systemauto" class="button">Auto</button>
					</form>
				</td>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $system_off; ?>" name="systemoff" class="button">Off</button>
					</form>
				</td>
			</tr>
			<tr>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $system_heat; ?>" name="systemheat" class="button">Heat</button>
					</form>
				</td>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $system_cool; ?>" name="systemcool" class="button">Cool</button>
					</form>
				</td>
			</tr>
		</table>
	</div>
</div>



<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</body>
</html> 