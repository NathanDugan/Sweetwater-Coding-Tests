<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Connection Variables
$server = "localhost";
$username = "root";
$password = "";
$database = "sweetwater";

$sqlConnection = new mysqli($server, $username, $password, $database);
if ($sqlConnection->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$selectComments = "SELECT comments FROM sweetwater.sweetwater_test";
$selectCommentsResults = $sqlConnection->query($selectComments);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			Sweetwater Coding Test
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
		<meta name="robots" content="index, nofollow" />
		<style type="text/css">
/*<![CDATA[*/
						body {
								background-color: #fff;
								color: #000;
								font-size: 0.9em;
								font-family: sans-serif,helvetica;
								margin: 0;
								padding: 0;
						}
						:link {
								color: #0000FF;
						}
						:visited {
								color: #0000FF;
						}
						a:hover {
								color: #3399FF;
						}
						h1 {
								text-align: center;
								margin: 0;
								padding: 0.6em 2em 0.4em;
								background-color: olivedrab;
								color: #ffffff;
								font-weight: normal;
								font-size: 1.75em;
								border-bottom: 2px solid #000;
						}
						h1 strong {
								font-weight: bold;
						}
						h2 {
								font-size: 1.1em;
								font-weight: bold;
						}
						.content {
								padding: 1em 5em;
						}
						.content-columns {
								/* Setting relative positioning allows for 
								absolute positioning for sub-classes */
								position: relative;
								padding-top: 1em;
						}
						.content-column-left {
								/* Value for IE/Win; will be overwritten for other browsers */
								width: 47%;
								padding-right: 3%;
								float: left;
								padding-bottom: 2em;
						}
						.content-column-right {
								/* Values for IE/Win; will be overwritten for other browsers */
								width: 47%;
								padding-left: 3%;
								float: left;
								padding-bottom: 2em;
						}
						img {
								border: 2px solid #fff;
								padding: 2px;
								margin: 2px;
						}
						a:hover img {
								border: 2px solid #3399FF;
						}
		/*]]>*/
		</style>
	</head>
	<body>
		<h1>
			Sweetwater Coding Test
		</h1>
		<div class="content">
			<div class="content-middle">
			</div>
			<hr />
			<div class="content-columns">
				<div class="content-column-left">
					<h2>
						Task #1
					</h2>
					<p>
					Display the comments and group them into the following sections based on what the comment was about:
					<br>- Comments about candy
					<br>- Comments about call me / don't call me
					<br>- Comments about who referred me
					<br>- Comments about signature requirements upon delivery
					<br>- Miscellaneous comments (everything else)
					</p>
				</div>
				<div class="content-column-right">
					<h2>
						Comments About Candy:
					</h2>
						<?php while($row = $selectCommentsResults->fetch_assoc()) {
							if(stripos($row["comments"], "candy") !== false)
								echo "<p>" . $row["comments"] . "</p>";
						}?> 
					<br>							
				</div>
			</div>
		</div>
		<div class="content"></div>
	</body>
</html>
