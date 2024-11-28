<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 8</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>8η Επιλογή</h1>

<form action = "<?php $_PHP_SELF ?>" method = "GET">

<p>Μαξ Θερμοκρασία (C): <input class="form-control" name='max_temp_C' autocomplete="off" type="number" step = 0.1 placeholder="" size=50 value=0.0>

<p>Μέση Υγρασία (%): <input class="form-control" name='avg_hum_perc' autocomplete="off" type="number" step = 0.1 placeholder="" size=50 value=0.0>

<p>Ριπή Ανέμου (kmh): <input class="form-control" name='wind_gust_kmh' autocomplete="off" type="number" step = 0.1 placeholder="" size=50 value=0.0>

<p><button type="reset">Clean Form</button> <input type="Submit" value="Submit" name="Submit1">
</form>

<?php

if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['max_temp_C'];
    $a2 = $_GET['avg_hum_perc'];
    $a3 = $_GET['wind_gust_kmh'];


      $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
      or die ("Could not connect to server\n");

      $result = pg_exec($link, "SELECT DISTINCT ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου
                        FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                        WHERE ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ >= '$a1'
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο < '$a2'
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου > '$a3'
                        ORDER BY ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα ASC")
                        or die("Cannot execute query: $query\n");

      $numrows = pg_numrows($result);
      ?>

      <table border="1">
        <tr>
          <th>ΜΕΤΕΩΡ ΣΤΑΘΜΟΣ</th>
          <th>ΗΜΕΡΟΜΙΝΗΑ ΚΑΤΑΓΡΑΦΗΣ</th>
          <th>ΜΑΞ ΘΕΡΜΟΚΡΑΣΙΑ</th>
          <th>ΜΕΣΩ ΥΓΡΟ ΠΟΣΟΣΤΟ</th>
          <th>ΡΙΠΗ ΑΝΕΜΟΥ</th>
        </tr>
        <?php


        for($ri = 0; $ri < $numrows; $ri++) {
          echo "<tr>\n";
          $row = pg_fetch_array($result, $ri);
          echo " <td>", $row["ονομα"], "</td>
          <td>", $row["ημερ"], "</td>
          <td>", $row["max_θερμ"], "</td>
          <td>", $row["avrg_υγρ_ποσοστο"], "</td>
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
