<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 5</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>5η Επιλογή</h1>

<form action = "<?php $_PHP_SELF ?>" method = "GET">

<p>Χρονιά: <input class="form-control" pattern="[0-9]{4}" name='date' autocomplete="off" type="text" placeholder="YYYY" size=50>

<p><button type="reset">Clean Form</button> <input type="Submit" value="Submit" name="Submit1">

</form>

<?php

if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['date'];

   	if($a1) {

      $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
      or die ("Could not connect to server\n");

      $result = pg_exec($link, "SELECT DISTINCT ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα, count(DISTINCT ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ) AS times
                        FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                        WHERE ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                        AND EXTRACT(YEAR FROM ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ) = '$a1'
                        AND (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου IS NULL
                        OR ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου IS NULL)
                        GROUP BY ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα")
                        or die("Cannot execute query: $query\n");

      $numrows = pg_numrows($result);
      ?>

      <table border="1">
        <tr>
          <th>ΜΕΤΕΩΡ ΣΤΑΘΜΟΣ</th>
          <th>ΦΟΡΕΣ ΔΥΣΛΕΙΤΟΥΡΓΙΑΣ</th>
        </tr>
        <?php


        for($ri = 0; $ri < $numrows; $ri++) {
          echo "<tr>\n";
          $row = pg_fetch_array($result, $ri);
          echo " <td>", $row["ονομα"], "</td>
          <td>", $row["times"], "</td>
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
