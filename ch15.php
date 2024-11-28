<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 15</title>
</head>

<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>15η Επιλογή</h1>

<?php
$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n");

$result = pg_exec($link, "(SELECT ΔΗΜΟΣ.νομος, max(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ), min(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ), avg(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ) AS decision
                  FROM ΔΗΜΟΣ, ΠΛΗΡΟΦΟΡΕΙΤΑΙ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                  WHERE ΔΗΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδδημος
                  AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδμετεωρ_σταθμος
                  AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                  AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                  GROUP BY ΔΗΜΟΣ.νομος
                  ORDER BY avg(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ) DESC
                  LIMIT 1)
                  UNION
                  (SELECT ΔΗΜΟΣ.νομος, max(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ), min(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ), avg(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ) AS decision
                  FROM ΔΗΜΟΣ, ΠΛΗΡΟΦΟΡΕΙΤΑΙ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                  WHERE ΔΗΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδδημος
                  AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδμετεωρ_σταθμος
                  AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                  AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                  GROUP BY ΔΗΜΟΣ.νομος
                  ORDER BY avg(ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ) ASC
                  LIMIT 1)")
                  or die("Cannot execute query: $query\n");

$numrows = pg_numrows($result);
?>

<table border="1">
	<tr>
		<th>ΝΟΜΟΣ</th>
    <th>ΜΑΞ</th>
    <th>ΜΙΝ</th>
    <th>Μ.Ο. ΜΕΣΩΝ ΘΕΡΜΟΚΡΑΣΙΩΝ</th>
	</tr>
	<?php


	for($ri = 0; $ri < $numrows; $ri++) {
		echo "<tr>\n";
		$row = pg_fetch_array($result, $ri);
		echo " <td>", $row["νομος"], "</td>
    <td>", $row["max"], "</td>
    <td>", $row["min"], "</td>
    <td>", $row["decision"], "</td>
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
