<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Datalist</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>Δεδομένα</h1>

<?php
$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n");

$result = pg_exec($link, "SELECT ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου FROM ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ WHERE ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ=ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ=ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος")
	or die("Cannot execute query: $query\n");

$numrows = pg_numrows($result);
?>

<table border="1">
	<tr>
		<th>ΚΩΔ</th>
    <th>ΜΕΤΕΩΡ ΣΤΑΘΜΟΣ</th>
		<th>ΗΜΕΡΟΜΗΝΙΑ</th>
		<th>ΜΑΞ ΘΕΡΜ (C)</th>
		<th>ΜΕΣΗ ΘΕΡΜ (C)</th>
    <th>ΜΙΝ ΘΕΡΜ (C)</th>
		<th>ΜΑΞ ΥΓΡ %</th>
		<th>ΜΕΣΗ ΥΓΡ %</th>
		<th>ΜΙΝ ΥΓΡ %</th>
    <th>ΜΑΞ ΠΙΕΣΗ (hPa)</th>
		<th>ΜΕΣΗ ΠΙΕΣΗ (hPa)</th>
		<th>ΜΙΝ ΠΙΕΣΗ (hPa)</th>
		<th>ΒΡΟΧΗ (mm)</th>
    <th>ΤΑΧ ΑΝΕΜΟΥ (kmh)</th>
		<th>ΚΑΤ ΑΝΕΜΟΥ</th>
		<th>ΡΙΠΗ ΑΝΕΜΟΥ (kmh)</th>
	</tr>
	<?php
	// Loop on rows in the result set.

	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["κωδ"], "</td>
    <td>", $row["ονομα"], "</td>
		<td>", $row["ημερ"], "</td>
		<td>", $row["max_θερμ"], "</td>
		<td>", $row["avrg_θερμ"], "</td>
    <td>", $row["min_θερμ"], "</td>
    <td>", $row["max_υγρ_ποσοστο"], "</td>
    <td>", $row["avrg_υγρ_ποσοστο"], "</td>
    <td>", $row["min_υγρ_ποσοστο"], "</td>
    <td>", $row["max_πιεση"], "</td>
    <td>", $row["avrg_πιεση"], "</td>
    <td>", $row["min_πιεση"], "</td>
    <td>", $row["βροχη"], "</td>
    <td>", $row["ταχ_ανεμου"], "</td>
    <td>", $row["κατ_ανεμου"], "</td>
    <td>", $row["ριπη_ανεμου"], "</td>
		</tr>
		";
	}
	pg_close($link);
	?>
</table>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/show.php">Προηγούμενη Σελίδα</a></h2>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/index.php">Αρχική Σελίδα</a></h2>


</body>
</html>
