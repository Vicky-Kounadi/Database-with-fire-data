<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 2</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>2η Επιλογή</h1>

<?php
$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n");

$result = pg_exec($link, "SELECT ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα, max(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ) AS max_θερμ, max(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ) AS min_θερμ, max(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο) AS max_υγρ_ποσοστο,
                  max(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο) AS min_υγρ_ποσοστο, max(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη) AS βροχη, max(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου) AS ταχ_ανεμου
                  FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                  WHERE ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                  AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                  GROUP BY ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα
                  ORDER BY ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα ASC")
                  	or die("Cannot execute query: $query\n");

$numrows = pg_numrows($result);
?>

<table border="1">
	<tr>
		<th>ΟΝΟΜΑ</th>
    <th>ΜΑΞ ΘΕΡΜ</th>
		<th>ΜΙΝ ΘΕΡΜ</th>
		<th>ΜΑΧ ΥΓΡ ΠΟΣΟΣΤΟ</th>
		<th>ΜΙΝ ΥΓΡ ΠΟΣΟΣΤΟ</th>
    <th>ΒΡΟΧΗ</th>
		<th>ΤΑΧ ΑΝΕΜΟΥ</th>
	</tr>
	<?php


	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["ονομα"], "</td>
    <td>", $row["max_θερμ"], "</td>
		<td>", $row["min_θερμ"], "</td>
		<td>", $row["max_υγρ_ποσοστο"], "</td>
		<td>", $row["min_υγρ_ποσοστο"], "</td>
    <td>", $row["βροχη"], "</td>
    <td>", $row["ταχ_ανεμου"], "</td>
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
