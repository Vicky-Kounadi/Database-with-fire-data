<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 14</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>14η Επιλογή</h1>

<form action = "<?php $_PHP_SELF ?>" method = "GET">

<p>Δώστε ένα αριθμό για να δείτε τις πιο καταστροφικές δασικές πυρκαγιές μέχρι και το 2020: <input class="form-control" name='top' autocomplete="off" type="number" placeholder="" size=50>

<p><button type="reset">Clean Form</button> <input type="Submit" value="Submit" name="Submit1">

</form>

<?php

if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['top'];

      $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
      or die ("Could not connect to server\n");

      $result = pg_exec($link, "SELECT DISTINCT ΠΥΡΚΑΓΙΑ.κωδ, ΠΥΡΚΑΓΙΑ.ημερ_εναρξ, ΠΥΡΚΑΓΙΑ.ωρα_εναρξ, ΔΗΜΟΣ.ονομα, ΔΗΜΟΣ.νομος, ΠΥΡΚΑΓΙΑ.καμ_εκταση,
                        ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου
                        FROM ΠΥΡΚΑΓΙΑ, ΚΑΙΕΙ, ΔΗΜΟΣ, ΠΛΗΡΟΦΟΡΕΙΤΑΙ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                        WHERE ΠΥΡΚΑΓΙΑ.κωδ = ΚΑΙΕΙ.κωδπυρκαγια
                        AND ΔΗΜΟΣ.κωδ = ΚΑΙΕΙ.κωδδημος
                        AND ΔΗΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδδημος
                        AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                        AND EXTRACT(YEAR FROM ΠΥΡΚΑΓΙΑ.ημερ_εναρξ) <= 2020
                        AND ΠΥΡΚΑΓΙΑ.ημερ_εναρξ = ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ
                        ORDER BY ΠΥΡΚΑΓΙΑ.καμ_εκταση DESC
                        LIMIT '$a1'")
                        or die("Cannot execute query: $query\n");

      $numrows = pg_numrows($result);
      ?>

      <table border="1">
        <tr>
          <th>ΚΩΔ</th>
          <th>ΗΜΕΡΑ ΕΝΑΡΞΗΣ</th>
          <th>ΩΡΑ ΕΝΑΡΞΗΣ</th>
          <th>ΔΗΜΟΣ</th>
          <th>ΝΟΜΟΣ</th>
          <th>ΚΑΜΜΕΝΗ ΕΚΤΑΣΗ</th>
          <th>ΜΑΞ ΘΕΡΜΟΚΡΑΣΙΑ</th>
          <th>ΜΕΣΗ ΥΓΡΑΣΙΑ</th>
          <th>ΤΑΧ ΑΝΕΜΟΥ</th>
          <th>ΚΑΤ ΑΝΕΜΟΥ</th>
        </tr>
        <?php


        for($ri = 0; $ri < $numrows; $ri++) {
          echo "<tr>\n";
          $row = pg_fetch_array($result, $ri);
          echo " <td>", $row["κωδ"], "</td>
          <td>", $row["ημερ_εναρξ"], "</td>
          <td>", $row["ωρα_εναρξ"], "</td>
          <td>", $row["ονομα"], "</td>
          <td>", $row["νομος"], "</td>
          <td>", $row["καμ_εκταση"], "</td>
          <td>", $row["max_θερμ"], "</td>
          <td>", $row["avrg_υγρ_ποσοστο"], "</td>
          <td>", $row["ταχ_ανεμου"], "</td>
          <td>", $row["ριπη_ανεμου"], "</td>
          </tr>
          ";
        }
        pg_close($link);
}

	?>
</table>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/choices.php">Προηγούμενη Σελίδα</a></h2>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/index.php">Αρχική Σελίδα</a></h2>


</body>
</html>
