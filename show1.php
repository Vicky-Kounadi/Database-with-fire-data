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

$result = pg_exec($link, "SELECT ΠΥΡΚΑΓΙΑ.κωδ, ΔΗΜΟΣ.ονομα, ΔΗΜΟΣ.νομος, ΠΥΡΚΑΓΙΑ.ημερ_εναρξ, ΠΥΡΚΑΓΙΑ.ωρα_εναρξ, ΠΥΡΚΑΓΙΑ.ημερ_τελ, ΠΥΡΚΑΓΙΑ.ωρα_τελ, ΠΥΡΚΑΓΙΑ.καμ_εκταση, ΠΥΡ_ΤΜΗΜΑ.ονομα AS ονομα_πυρ, ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.αριθμ_ανδρων, ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.αριθμ_οχημ, ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.αριθμ_αερ FROM ΠΥΡΚΑΓΙΑ, ΔΗΜΟΣ, ΚΑΙΕΙ, ΠΥΡ_ΤΜΗΜΑ, ΣΒΗΝΕΙ, ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ WHERE ΠΥΡΚΑΓΙΑ.κωδ=ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.κωδπυρκαγια AND ΠΥΡΚΑΓΙΑ.κωδ=ΣΒΗΝΕΙ.κωδπυρκαγια AND ΠΥΡ_ΤΜΗΜΑ.κωδ=ΣΒΗΝΕΙ.κωδπυρ_τμημα AND ΠΥΡΚΑΓΙΑ.κωδ=ΚΑΙΕΙ.κωδπυρκαγια AND ΔΗΜΟΣ.κωδ=ΚΑΙΕΙ.κωδδημος")
	or die("Cannot execute query: $query\n");

$numrows = pg_numrows($result);
?>

<table border="1">
	<tr>
		<th>ΚΩΔ</th>
    <th>ΔΗΜΟΣ</th>
		<th>ΝΟΜΟΣ</th>
		<th>ΗΜΕΡΑ ΕΝΑΡΞΗΣ</th>
		<th>ΩΡΑ ΕΝΑΡΞΗΣ</th>
    <th>ΗΜΕΡΑ ΚΑΤΑΣΒΕΣΗΣ</th>
		<th>ΩΡΑ ΚΑΤΑΣΒΕΣΗΣ</th>
		<th>ΚΑΜΜΕΝΗ ΕΚΤΑΣΗ (στρ)</th>
		<th>ΠΥΡΟΣΒΕΣΤΙΚΟ ΤΜΗΜΑ</th>
    <th>ΠΡΟΣΩΠΙΚΟ</th>
		<th>ΟΧΗΜΑΤΑ</th>
		<th>ΕΝΑΕΡΙΑ</th>
	</tr>
	<?php
	// Loop on rows in the result set.

	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["κωδ"], "</td>
    <td>", $row["ονομα"], "</td>
		<td>", $row["νομος"], "</td>
		<td>", $row["ημερ_εναρξ"], "</td>
		<td>", $row["ωρα_εναρξ"], "</td>
    <td>", $row["ημερ_τελ"], "</td>
    <td>", $row["ωρα_τελ"], "</td>
    <td>", $row["καμ_εκταση"], "</td>
    <td>", $row["ονομα_πυρ"], "</td>
    <td>", $row["αριθμ_ανδρων"], "</td>
    <td>", $row["αριθμ_οχημ"], "</td>
    <td>", $row["αριθμ_αερ"], "</td>
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
