<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 4</title>
</head>

<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>4η Επιλογή</h1>

<?php
$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n");

$result = pg_exec($link, "SELECT DISTINCT ΔΗΜΟΣ.περιφ, sum(ΠΥΡΚΑΓΙΑ.καμ_εκταση)
                  FROM ΠΥΡΚΑΓΙΑ, ΚΑΙΕΙ, ΔΗΜΟΣ
                  WHERE ΠΥΡΚΑΓΙΑ.κωδ = ΚΑΙΕΙ.κωδπυρκαγια
                  AND ΔΗΜΟΣ.κωδ = ΚΑΙΕΙ.κωδδημος
                  GROUP BY ΔΗΜΟΣ.περιφ
                  ORDER BY sum(ΠΥΡΚΑΓΙΑ.καμ_εκταση) DESC")
                	or die("Cannot execute query: $query\n");

$numrows = pg_numrows($result);
?>

<table border="1">
	<tr>
		<th>ΠΕΡΙΦΕΡΕΙΑ</th>
    <th>ΚΑΜΜΕΝΕΣ ΕΚΤΑΣΕΙΣ</th>
	</tr>
	<?php


	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["περιφ"], "</td>
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
