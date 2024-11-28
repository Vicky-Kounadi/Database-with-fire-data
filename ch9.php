<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 9</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>9η Επιλογή</h1>

<form action = "<?php $_PHP_SELF ?>" method = "GET">

<p>Όνομα Μετ. Σταθμού: <input class="form-control" name='station_name' autocomplete="off" type="string" placeholder="" size=50>

<p>Ημερομηνία x1: <input class="form-control" name='x1_date' autocomplete="off" type="date" placeholder="" size=50>

<p>Ημερομηνία x2: <input class="form-control" name='x2_date' autocomplete="off" type="date" placeholder="" size=50>

<p>Ημερομηνία y1: <input class="form-control" name='y1_date' autocomplete="off" type="date" placeholder="" size=50>

<p>Ημερομηνία y2: <input class="form-control" name='y2_date' autocomplete="off" type="date" placeholder="" size=50>

<p><button type="reset">Clean Form</button> <input type="Submit" value="Submit" name="Submit1">
</form>

<?php

function check_date($a1, $a2, $a3) {
    $FirstDate = new DateTime($a1);
    $SecDate = new DateTime($a2);
    $interval = $FirstDate->diff($SecDate);

    if ($interval->invert == 1) {
        if($a3 == 1){
            echo "Η ημερoμηνία X2 που εισάγατε είναι πρίν την ημερoμηνία X1. Παρακαλώ επαναλάβετε την διαδικασία εισαγωγής.";
        }
        else{
            echo "Η ημερoμηνία Y2 που εισάγατε είναι πρίν την ημερoμηνία Y1. Παρακαλώ επαναλάβετε την διαδικασία εισαγωγής.";
        }
        $flag = 0;
    } else {
        $flag = 1;
    }
    return $flag;
}

?>

<?php

if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['station_name'];
    $a2 = $_GET['x1_date'];
    $a3 = $_GET['x2_date'];
    $a4 = $_GET['y1_date'];
    $a5 = $_GET['y2_date'];

   	if($a1 && $a2 && $a3 && $a4 && $a5) {

      $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
      or die ("Could not connect to server\n");

     $flag = check_date($a2, $a3, 1); 
     $flag = check_date($a4, $a5, 2);

     if($flag == 1){

      $result = pg_exec($link, "(SELECT ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο,
                        ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση,
                        ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου
                        FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                        WHERE ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ >= '$a2'
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ <= '$a3'
                        AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα = '$a1')
                        EXCEPT
                        (SELECT ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο,
                        ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση,
                        ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου
                        FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΠΑΡΑΓΕΙ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                        WHERE ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ = ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ >= '$a4'
                        AND ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ <= '$a5'
                        AND ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα = '$a1')")
                        or die("Cannot execute query: $query\n");

      if(pg_num_rows($result) == 0)
      {
        echo "Ο Μετεωρολογικός Σταθμός που ορίσατε δεν υπάρχει στη βάση.";
      }

      $numrows = pg_numrows($result);
    }
      ?>

      <table border="1">
        <tr>
          <th>ΗΜΕΡΟΜΙΝΗΑ ΚΑΤΑΓΡΑΦΗΣ</th>
          <th>ΜΑΞ ΘΕΡΜΟΚΡΑΣΙΑ</th>
          <th>ΜΕΣΗ ΘΕΡΜΟΚΡΑΣΙΑ</th>
          <th>ΜΙΝ ΘΕΡΜΟΚΡΑΣΙΑ</th>
          <th>ΜΑΞ ΥΓΡΟ ΠΟΣΟΣΤΟ</th>
          <th>ΜΕΣΩ ΥΓΡΟ ΠΟΣΟΣΤΟ</th>
          <th>ΜΙΝ ΥΓΡΟ ΠΟΣΟΣΤΟ</th>
          <th>ΜΑΞ ΠΙΕΣΗ</th>
          <th>ΜΕΣΗ ΠΙΕΣΗ</th>
          <th>ΜΙΝ ΠΙΕΣΗ</th>
          <th>ΒΡΟΧΗ</th>
          <th>ΤΑΧ ΑΝΕΜΟΥ</th>
          <th>ΚΑΤ ΑΝΕΜΟΥ</th>
          <th>ΡΙΠΗ ΑΝΕΜΟΥ</th>
        </tr>
        <?php


        for($ri = 0; $ri < $numrows; $ri++) {
          echo "<tr>\n";
          $row = pg_fetch_array($result, $ri);
          echo " <td>", $row["ημερ"], "</td>
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
    }
}

	?>
</table>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/choices.php">Προηγούμενη Σελίδα</a></h2>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/index.php">Αρχική Σελίδα</a></h2>


</body>
</html>
