<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 13</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>13η Επιλογή</h1>

<form action = "<?php $_PHP_SELF ?>" method = "GET">

<p>Θερμοκρασία X (C): <input class="form-control" name='x_temp_C' autocomplete="off" type="number" step = 0.1 placeholder="" size=50 value=0.0>

<p>Θερμοκρασία Y (C): <input class="form-control" name='y_temp_C' autocomplete="off" type="number" step = 0.1 placeholder="" size=50 value=0.0>

<p><button type="reset">Clean Form</button> <input type="Submit" value="Submit" name="Submit1">
</form>

<?php

if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['x_temp_C'];
    $a2 = $_GET['y_temp_C'];

      $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
      or die ("Could not connect to server\n");

      $result = pg_exec($link, "SELECT DISTINCT ΔΗΜΟΣ.περιφ
                        FROM ΔΗΜΟΣ, ΠΛΗΡΟΦΟΡΕΙΤΑΙ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                        WHERE ΔΗΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδδημος
                        AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ >= '$a1'
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ <= '$a2'")
                        or die("Cannot execute query: $query\n");

      $numrows = pg_numrows($result);
      ?>

      <table border="1">
        <tr>
          <th>ΠΕΡΙΦΕΡΕΙΑ</th>
        </tr>
        <?php


        for($ri = 0; $ri < $numrows; $ri++) {
          echo "<tr>\n";
          $row = pg_fetch_array($result, $ri);
          echo " <td>", $row["περιφ"], "</td>
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
