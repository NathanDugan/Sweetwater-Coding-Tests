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


$commentsSelector = "SELECT comments FROM sweetwater.sweetwater_test WHERE comments LIKE ";

$candySelector = "'%candy%' OR comments LIKE '%tootsie%' 
							OR comments LIKE '%taffy%' 
							OR comments LIKE '%honey%' 
							OR comments LIKE '%smarties%' ";

$callSelector = "'%call me%'";
$referralSelector = "'%refer%'";
$signatureSelector = "'%signature%'";

$selectCandyComments = $commentsSelector . $candySelector;

$selectCandyResults = $sqlConnection->query($selectCandyComments);

$selectCallComments = $commentsSelector . $callSelector;
$selectCallResults = $sqlConnection->query($selectCallComments);

$selectReferralComments = $commentsSelector . $referralSelector;
$selectReferralResults = $sqlConnection->query($selectReferralComments);

$selectSignatureComments = $commentsSelector . $signatureSelector;
$selectSignatureResults = $sqlConnection->query($selectSignatureComments);

$selectEverythingElse = "SELECT comments FROM sweetwater.sweetwater_test WHERE comments NOT LIKE $candySelector AND 
																			   comments NOT LIKE $callSelector  AND 
																			   comments NOT LIKE $referralSelector AND
																		 	   comments NOT LIKE $signatureSelector";
$selectEverythingElseResults = $sqlConnection->query($selectEverythingElse);

//Get the whole row here, we want the orderid for this one.
$selectCommentsWithDates = "SELECT * FROM sweetwater.sweetwater_test WHERE comments LIKE '%Ship Date:%'";
$selectCommentsWithDatesResults = $sqlConnection->query($selectCommentsWithDates);
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
						.tab button {
							background-color: #aaa;
							border: 1px solid;
							outline: none;
							cursor: pointer;
							transition: 0.5s;
							font-size: 25px;
							}

						.tab button:hover {
						background-color: #eee;
						}

						.tabcontent {
							display: none;
							border: 1px solid #ccc;
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
			<hr />
					<h2> Task #1</h2>
					<p>
					Display the comments and group them into the following sections based on what the comment was about:
					<br>- Comments about candy
					<br>- Comments about call me / don't call me
					<br>- Comments about who referred me
					<br>- Comments about signature requirements upon delivery
					<br>- Miscellaneous comments (everything else)
					</p>

				<div class="tab">
					<button class="tabs" onclick="openTab(event, 'candytab')">Candy</button>
					<button class="tabs" onclick="openTab(event, 'callstab')">Call Me/Don't Call Me</button>
					<button class="tabs" onclick="openTab(event, 'referraltab')">Referrals</button>
					<button class="tabs" onclick="openTab(event, 'signaturetab')">Signatures</button>
					<button class="tabs" onclick="openTab(event, 'everythingElsetab')">Miscellaneous</button>
					<button class="tabs" onclick="openTab(event, '')">X</button>
				</div>
					<br>
					<br>
					<div id ="candytab" class= "tabcontent">
						<h2> Comments About Candy: </h2>
						<?php while($row = $selectCandyResults->fetch_assoc()) {
								echo "<p>" . $row["comments"] . "</p>";
						}?> 
					</div>
					<div id ="callstab"  class="tabcontent">
						<h2>Comments About Call Me /Don't Call: </h2>
						<?php while($row = $selectCallResults->fetch_assoc()) {
									echo "<p>" . $row["comments"] . "</p>";
						}?> 		
					</div>
					<div id ="referraltab"  class="tabcontent">
						<h2>Comments About Referrals: </h2>
						<?php while($row = $selectReferralResults->fetch_assoc()) {
									echo "<p>" . $row["comments"] . "</p>";
						}?>	
					</div>
					<div id ="signaturetab"  class="tabcontent">
						<h2>Comments About Signature: </h2>
						<?php while($row = $selectSignatureResults->fetch_assoc()) {
									echo "<p>" . $row["comments"] . "</p>";
						}?>	
					</div>
					<div id ="everythingElsetab"  class="tabcontent">
						<h2>Comments About Everything Else: </h2>
						<?php while($row = $selectEverythingElseResults->fetch_assoc()) {
									echo "<p>" . $row["comments"] . "</p>";
						}?>	
					</div>

					<h2> Task #2 </h2>
					<p>
					The shipdate_expected field is currently populated with no date (0000-00-00). Some of comments included an "Expected Ship Date" in the text. Please parse out the date from the text and properly update the shipdate_expected field in the table
					</p>
					<p>Any Errors will be shown below, otherwise the operation executed successfully.</p>
					<?php while($row = $selectCommentsWithDatesResults->fetch_assoc()) {
									$orderId = $row["orderid"];
									$extractedDate = substr($row["comments"], strpos($row["comments"], "Date: ") + 6, 8);
									$separatedDate = explode('/', $extractedDate);
									$date = $separatedDate[2] . $separatedDate[0] . $separatedDate[1];
									$sql = "UPDATE sweetwater.sweetwater_test SET shipdate_expected='$date' WHERE orderid=$orderId";
									$result = $sqlConnection->query($sql);
									if ($result === FALSE)
										echo "Error updating record: orderid: $orderId" .  $sqlConnection->error . "<br>";
						}?>	
					<?php {$sqlConnection->close();}?> 
			</div>
		</div>
		<div class="content"></div>

		<script>
			function openTab(evt, tabName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");

			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}

			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}

			document.getElementById(tabName).style.display = "block";
			evt.currentTarget.className += " active";
			}
		</script>

	</body>
	
</html>
