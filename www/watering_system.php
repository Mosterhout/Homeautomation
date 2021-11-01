<html>
<head>
<?php include "./header.html" ?>
<meta http-equiv="refresh" content="60"> <!-- Page refresh in seconds -->
</head>
<body>
Coming Soon
<div class="row">
	<div class="column">
		<h3>Front Yard</h3><br><br>
		<h2>Zone 1</h2>
		<table>
			<tr>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $fy__zone1_on; ?>" name="fanon" class="button">On</button>
					</form>
				</td>
				<td>
					<form action="" method="post">
						<button style="background-color:<?php print $fy_zone1_off; ?>" name="fanoff" class="button">Off</button>
					</form>
				</td>
			</tr>
		</table>
	</div>
	<div class="column">
		<h3>Back Yard</h3><br><br>
		<h2>
			Zone 1
			<table>
				<tr>
					<td>
						<form action="" method="post">
							<button style="background-color:<?php print $by_zone1_on; ?>" name="fanon" class="button">On</button>
						</form>
					</td>
					<td>
						<form action="" method="post">
							<button style="background-color:<?php print $by_zone1_off; ?>" name="fanoff" class="button">Off</button>
						</form>
					</td>
				</tr>
			</table>
			Zone 2
			<table>
				<tr>
					<td>
						<form action="" method="post">
							<button style="background-color:<?php print $by_zone2_on; ?>" name="fanon" class="button">On</button>
						</form>
					</td>
					<td>
						<form action="" method="post">
							<button style="background-color:<?php print $by_zone2_off; ?>" name="fanoff" class="button">Off</button>
						</form>
					</td>
				</tr>
			</table>
		</h2>
	</div>
</div>
</body>