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

$result = pg_exec($link, "SELECT ΔΗΜΟΣ.κωδ, ΔΗΜΟΣ.ονομα, ΔΗΜΟΣ.νομος, ΔΗΜΟΣ.περιφ, ΔΗΜΟΣ.γεωγρ_μηκος, ΔΗΜΟΣ.γεωγρ_πλατος, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα AS ονομα_μετ FROM ΔΗΜΟΣ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΛΗΡΟΦΟΡΕΙΤΑΙ WHERE ΔΗΜΟΣ.κωδ=ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδδημος AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ=ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδμετεωρ_σταθμος")
	or die("Cannot execute query: $query\n");

$numrows = pg_numrows($result);
?>

<table border="1">
	<tr>
		<th>ΚΩΔ</th>
    <th>ΔΗΜΟΣ</th>
		<th>ΝΟΜΟΣ</th>
		<th>ΠΕΡΙΦΕΡΕΙΑ</th>
		<th>ΓΕΩΓΡ ΜΗΚΟΣ</th>
    <th>ΓΕΩΓΡ ΠΛΑΤΟΣ</th>
		<th>ΜΕΤΕΩΡ ΣΤΑΘΜΟΣ</th>
	</tr>
	<?php
	// Loop on rows in the result set.

	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["κωδ"], "</td>
    <td>", $row["ονομα"], "</td>
		<td>", $row["νομος"], "</td>
		<td>", $row["περιφ"], "</td>
		<td>", $row["γεωγρ_μηκος"], "</td>
    <td>", $row["γεωγρ_πλατος"], "</td>
    <td>", $row["ονομα_μετ"], "</td>
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
