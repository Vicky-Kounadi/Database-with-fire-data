<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 6</title>
</head>

<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>6η Επιλογή</h1>

<?php
$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n");

$result = pg_exec($link, "SELECT DISTINCT ΔΗΜΟΣ.ονομα, ΔΗΜΟΣ.νομος, ΔΗΜΟΣ.περιφ, count(ΠΥΡΚΑΓΙΑ.κωδ), sum(ΠΥΡΚΑΓΙΑ.καμ_εκταση)
                  FROM ΠΥΡΚΑΓΙΑ, ΚΑΙΕΙ, ΔΗΜΟΣ
                  WHERE ΠΥΡΚΑΓΙΑ.κωδ = ΚΑΙΕΙ.κωδπυρκαγια
                  AND ΔΗΜΟΣ.κωδ = ΚΑΙΕΙ.κωδδημος
                  GROUP BY (ΔΗΜΟΣ.ονομα, ΔΗΜΟΣ.νομος, ΔΗΜΟΣ.περιφ)
                  ORDER BY count(ΠΥΡΚΑΓΙΑ.κωδ) DESC
                  LIMIT 1")
                  or die("Cannot execute query: $query\n");

$numrows = pg_numrows($result);
?>

<table border="1">
	<tr>
		<th>ΔΗΜΟΣ</th>
    <th>ΝΟΜΟΣ</th>
    <th>ΠΕΡΙΦΕΡΕΙΑ</th>
    <th>ΠΛΗΘΟΣ ΠΥΡΚΑΓΙΩΝ</th>
    <th>ΚΑΜΜΕΝΗ ΕΚΤΑΣΗ</th>
	</tr>
	<?php


	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["ονομα"], "</td>
    <td>", $row["νομος"], "</td>
    <td>", $row["περιφ"], "</td>
    <td>", $row["count"], "</td>
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
