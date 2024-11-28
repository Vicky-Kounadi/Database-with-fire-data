<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 7</title>
</head>

<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>7η Επιλογή</h1>

<?php
$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n");

$result = pg_exec($link, "SELECT ΔΗΜΟΣ.νομος, sum(ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.αριθμ_αερ)
                  FROM ΠΥΡΚΑΓΙΑ, ΚΑΙΕΙ, ΔΗΜΟΣ, ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ
                  WHERE ΠΥΡΚΑΓΙΑ.κωδ = ΚΑΙΕΙ.κωδπυρκαγια
                  AND ΔΗΜΟΣ.κωδ = ΚΑΙΕΙ.κωδδημος
                  AND ΠΥΡΚΑΓΙΑ.κωδ=ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.κωδπυρκαγια
                  AND ΠΥΡΚΑΓΙΑ.ημερ_εναρξ >= '2021-06-01'
                  AND ΠΥΡΚΑΓΙΑ.ημερ_τελ <= '2021-08-31'
                  GROUP BY ΔΗΜΟΣ.νομος
                  HAVING sum(ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.αριθμ_αερ)>30")
                	or die("Cannot execute query: $query\n");

$numrows = pg_numrows($result);
?>

<table border="1">
	<tr>
		<th>ΝΟΜΟΣ</th>
    <th>ΕΝΑΕΡΙΑ ΜΕΣΑ</th>
	</tr>
	<?php


	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["νομος"], "</td>
    <td>", $row["sum"], "</td>
		</tr>
		";
	}
	pg_close($link);
	?>
</table>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/choices.php">Προηγούμενη Σελίδα</a></h2>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/index.php">Αρχική Σελίδα</a></h2>

</body>
</html>
