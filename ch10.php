<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 10</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>10η Επιλογή</h1>

<form action = "<?php $_PHP_SELF ?>" method = "GET">

<p>Περιφέρεια: <input class="form-control" name='periferia' autocomplete="off" type="string" placeholder="" size=50>

<p>Ημερομηνία: <input class="form-control" name='date' autocomplete="off" type="date" placeholder="" size=50>

<p><button type="reset">Clean Form</button> <input type="Submit" value="Submit" name="Submit1">
</form>

<?php

if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['periferia'];
    $a2 = $_GET['date'];

   	if($a1 && $a2) {

      $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
      or die ("Could not connect to server\n");

      $result = pg_exec($link, "SELECT DISTINCT ΔΗΜΟΣ.ονομα, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου
                        FROM ΔΗΜΟΣ, ΠΛΗΡΟΦΟΡΕΙΤΑΙ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                        WHERE ΔΗΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδδημος
                        AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                        AND ΔΗΜΟΣ.περιφ = '$a1'
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ = '$a2'")
                        or die("Cannot execute query: $query\n");

      if(pg_num_rows($result) == 0)
      {
        echo "Η περιφέρεια που ορίσατε δεν υπάρχει στη βάση.";
      }

      $numrows = pg_numrows($result);
      ?>

      <table border="1">
        <tr>
          <th>ΔΗΜΟΣ</th>
          <th>ΜΕΣΗ ΘΕΡΜΟΚΡΑΣΙΑ</th>
          <th>ΜΕΣΗ ΥΓΡΑΣΙΑ</th>
          <th>ΤΑΧ ΑΝΕΜΟΥ</th>
          <th>ΚΑΤ ΑΝΕΜΟΥ</th>
        </tr>
        <?php


        for($ri = 0; $ri < $numrows; $ri++) {
          echo "<tr>\n";
          $row = pg_fetch_array($result, $ri);
          echo " <td>", $row["ονομα"], "</td>
          <td>", $row["avrg_θερμ"], "</td>
          <td>", $row["avrg_υγρ_ποσοστο"], "</td>
          <td>", $row["ταχ_ανεμου"], "</td>
          <td>", $row["κατ_ανεμου"], "</td>
          </tr>
          ";
        }
        pg_close($link);
    }
}

	?>
</table>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/choices.php">Προηγούμενη Σελίδα</a></h2>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/index.php">Αρχική Σελίδα</a></h2>


</body>
</html>
