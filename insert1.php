<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Data Proccess</title>
</head>

<html>

<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>


<body>
<?php
b:  clearstatcache();
?>

<h1>Δεδομένα Πυρκαγιάς</h2>

<form action = "<?php $_PHP_SELF ?>" method = "GET">


  <p>Τμήμα: <input class="form-control" name='tmima' autocomplete="off" type="string" placeholder="" size=50>

  <p>Νομός: <input class="form-control" name='nomos' autocomplete="off" type="string" placeholder="" size=50> </p>

  <p>Δήμος: <input class="form-control" name='dhmos' autocomplete="off" type="string" placeholder="" size=50>

  <p>Ημερομηνία έναρξης: <input class="form-control" name='start_date' autocomplete="off" type="date" placeholder="" size=50>

  <p>Ώρα έναρξης: <input class="form-control" name='start_time' autocomplete="off" type="time" placeholder="" size=50>

  <p>Ημερομηνία κατάσβεσης: <input class="form-control" name='kill_date' autocomplete="off" type="date" placeholder="" size=50>

  <p>Ώρα κατάσβεσης: <input class="form-control" name='kill_time' autocomplete="off" type="time" placeholder="" size=50>

  <p>Καμμένη έκταση στρ: <input class="form-control" name='burned' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Προσωπικό: <input class="form-control" name='personel' autocomplete="off" type="number" placeholder="" size=50>

  <p>Οχήματα: <input class="form-control" name='cars' autocomplete="off" type="number" placeholder="" size=50>

  <p>Εναέρια: <input class="form-control" name='fly' autocomplete="off" type="number" placeholder="" size=50>


<p><button type="reset">Clean Form</button> <input type="Submit" value="Submit" name="Submit1"> <input type="Submit" value="Delete" name="Submit2">

</form>


</body>

<?php

function check_date_time($a4, $a5, $a6, $a7) {
    $startDate = new DateTime($a4);
    $killDate = new DateTime($a6);
    $interval = $startDate->diff($killDate);

    if ($interval->days == 0) {
        $startTime = new DateTime($a4 . $a5);
        $killTime = new DateTime($a6 . $a7);
        $interval = $startTime->diff($killTime);

        if ($interval->invert == 1) {
            echo "Η ώρα κατάσβεσης που εισάγατε είναι πρίν την ώρα έναρξης. Παρακαλώ επαναλάβετε την διαδικασία εισαγωγής.";
            $flag = 0;
        } else {
            $flag = 1;
        }
    }
    else {
        if ($interval->invert == 1) {
            echo "Η ημέρα κατάσβεσης που εισάγατε είναι πρίν την ημέρα έναρξης. Παρακαλώ επαναλάβετε την διαδικασία εισαγωγής.";
            $flag = 0;
        } else {
            $flag = 1;
        }
    }
    return $flag;
}

?>


<?php
if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['tmima'];
  	$a2 = $_GET['nomos'];
  	$a3 = $_GET['dhmos'];
    $a4 = $_GET['start_date'];
    $a5 = $_GET['start_time'];
    $a6 = $_GET['kill_date'];
    $a7 = $_GET['kill_time'];
    $a8 = $_GET['burned'];
    $a9 = $_GET['personel'];
    $a10 = $_GET['cars'];
    $a11 = $_GET['fly'];

   	if($a1 && $a2 && $a3 && $a4 && $a5 && $a6 && $a7 && $a8 && $a9) {
      	$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
        	or die ("Could not connect to server\n");

          $flag = check_date_time($a4, $a5, $a6, $a7);

          if($flag == 1) {

            $result3 = pg_exec($link, "SELECT * FROM ΔΗΜΟΣ WHERE '$a3'= ΔΗΜΟΣ.ονομα AND '$a2' = ΔΗΜΟΣ.νομος")
            or die("Cannot execute query1.1: $query3\n");

            if(pg_num_rows($result3) == 0)
            {
              echo "Ο Δήμος που ορίσατε δεν υπάρχει στη βάση. Παρακαλώ ακολουθήστε τον παρακάτω σύνδεσμο:";
              echo'<a href="http://hilon.dit.uop.gr/~db1u23/insert2.php">Εισαγωγή ή Διαγραφή Δεδομένων Τοποθεσιών</a>';
            }
            else {

              $result1 = pg_exec($link, "SELECT * FROM ΠΥΡΚΑΓΙΑ WHERE '$a5'= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ AND '$a4' = ΠΥΡΚΑΓΙΑ.ημερ_εναρξ AND '$a7'= ΠΥΡΚΑΓΙΑ.ωρα_τελ AND '$a6'= ΠΥΡΚΑΓΙΑ.ημερ_τελ AND '$a8'= ΠΥΡΚΑΓΙΑ.καμ_εκταση")
              or die("Cannot execute query1.1: $query1\n");

              if(pg_num_rows($result1) == 0)
              {

                $sqlp1 = "INSERT INTO ΠΥΡΚΑΓΙΑ(ωρα_εναρξ, ημερ_εναρξ, ωρα_τελ, ημερ_τελ, καμ_εκταση) VALUES ('$a5', '$a4', '$a7', '$a6', '$a8');";
                $rsap1 = pg_query($link, $sqlp1)  or die("Cannot execute query1: $sqlp1\n");

                $result2 = pg_exec($link, "SELECT * FROM ΠΥΡ_ΤΜΗΜΑ WHERE '$a1'=ΠΥΡ_ΤΜΗΜΑ.ονομα")
                or die("Cannot execute query1.1: $query2\n");

                if(pg_num_rows($result2) == 0)
                {
                  $sqlp2 = "INSERT INTO ΠΥΡ_ΤΜΗΜΑ(ονομα) VALUES ('$a1');";
                  $rsap2 = pg_query($link, $sqlp2)  or die("Cannot execute query2: $sqlp2\n");
                }

                $sqlp4 = "INSERT INTO ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ (κωδπυρκαγια,αριθμ_ανδρων, αριθμ_οχημ, αριθμ_αερ) VALUES ((SELECT DISTINCT ΠΥΡΚΑΓΙΑ.κωδ FROM ΠΥΡΚΑΓΙΑ WHERE '$a5'= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ AND '$a4'= ΠΥΡΚΑΓΙΑ.ημερ_εναρξ AND '$a7'= ΠΥΡΚΑΓΙΑ.ωρα_τελ AND '$a6'= ΠΥΡΚΑΓΙΑ.ημερ_τελ AND '$a8'= ΠΥΡΚΑΓΙΑ.καμ_εκταση),'$a9','$a10','$a11');";
                $sqlp5 = "INSERT INTO ΣΒΗΝΕΙ (κωδπυρ_τμημα, κωδπυρκαγια) SELECT DISTINCT ΠΥΡ_ΤΜΗΜΑ.κωδ, ΠΥΡΚΑΓΙΑ.κωδ FROM ΠΥΡΚΑΓΙΑ, ΠΥΡ_ΤΜΗΜΑ WHERE '$a1'= ΠΥΡ_ΤΜΗΜΑ.ονομα AND '$a5'= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ AND '$a4'= ΠΥΡΚΑΓΙΑ.ημερ_εναρξ AND '$a7'= ΠΥΡΚΑΓΙΑ.ωρα_τελ AND '$a6'= ΠΥΡΚΑΓΙΑ.ημερ_τελ AND '$a8'= ΠΥΡΚΑΓΙΑ.καμ_εκταση;";
                $sqlp6 = "INSERT INTO ΚΑΙΕΙ (κωδπυρκαγια, κωδδημος) SELECT DISTINCT ΠΥΡΚΑΓΙΑ.κωδ, ΔΗΜΟΣ.κωδ FROM ΔΗΜΟΣ, ΠΥΡΚΑΓΙΑ WHERE '$a2'=ΔΗΜΟΣ.νομος AND '$a3'=ΔΗΜΟΣ.ονομα AND '$a5'= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ AND '$a4'= ΠΥΡΚΑΓΙΑ.ημερ_εναρξ AND '$a7'= ΠΥΡΚΑΓΙΑ.ωρα_τελ AND '$a6'= ΠΥΡΚΑΓΙΑ.ημερ_τελ AND '$a8'= ΠΥΡΚΑΓΙΑ.καμ_εκταση;";
                $rsap4 = pg_query($link, $sqlp4)  or die("Cannot execute query4: $sqlp4\n");
                $rsap5 = pg_query($link, $sqlp5)  or die("Cannot execute query6: $sqlp5\n");
                $rsap6 = pg_query($link, $sqlp6)  or die("Cannot execute query7: $sqlp6\n");

              }

            }

          }

		  pg_close($link);
    }
}
?>

<?php
if (isset($_GET["Submit2"])){

  error_reporting(0);
    $a1 = $_GET['tmima'];
    $a2 = $_GET['nomos'];
    $a3 = $_GET['dhmos'];
    $a4 = $_GET['start_date'];
    $a5 = $_GET['start_time'];
    $a6 = $_GET['kill_date'];
    $a7 = $_GET['kill_time'];
    $a8 = $_GET['burned'];
    $a9 = $_GET['personel'];
    $a10 = $_GET['cars'];
    $a11 = $_GET['fly'];

    if($a1 && $a2 && $a3 && $a4 && $a5 && $a6 && $a7 && $a8 && $a9) {
        $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
          or die ("Could not connect to server\n");

          $result1 = pg_exec($link, "SELECT * FROM ΠΥΡΚΑΓΙΑ WHERE '$a5'= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ AND '$a4' = ΠΥΡΚΑΓΙΑ.ημερ_εναρξ AND '$a7'= ΠΥΡΚΑΓΙΑ.ωρα_τελ AND '$a6'= ΠΥΡΚΑΓΙΑ.ημερ_τελ AND '$a8'= ΠΥΡΚΑΓΙΑ.καμ_εκταση")
          	or die("Cannot execute query1.1.1: $query1\n");

          if(pg_num_rows($result1) == 1)
          {
            $result2 = pg_exec($link, "SELECT ΠΥΡΚΑΓΙΑ.κωδ FROM ΠΥΡΚΑΓΙΑ WHERE '$a5'= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ AND '$a4' = ΠΥΡΚΑΓΙΑ.ημερ_εναρξ AND '$a7'= ΠΥΡΚΑΓΙΑ.ωρα_τελ AND '$a6'= ΠΥΡΚΑΓΙΑ.ημερ_τελ AND '$a8'= ΠΥΡΚΑΓΙΑ.καμ_εκταση")
            	or die("Cannot execute query1.1.2: $query1\n");

              $row = pg_fetch_row($result2);

              $sqlp1 = "DELETE FROM ΚΑΙΕΙ WHERE ΚΑΙΕΙ.κωδπυρκαγια='$row[0]';";
              $sqlp2 = "DELETE FROM ΣΒΗΝΕΙ WHERE ΣΒΗΝΕΙ.κωδπυρκαγια='$row[0]';";
              $sqlp3 = "DELETE FROM ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ WHERE ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.κωδπυρκαγια='$row[0]';";
              $sqlp4 = "DELETE FROM ΠΥΡΚΑΓΙΑ WHERE ΠΥΡΚΑΓΙΑ.κωδ='$row[0]';";
              $rsap1 = pg_query($link, $sqlp1)  or die("Cannot execute query1.1: $sqlp1\n");
              $rsap2 = pg_query($link, $sqlp2)  or die("Cannot execute query1.2: $sqlp2\n");
              $rsap3 = pg_query($link, $sqlp3)  or die("Cannot execute query1.3: $sqlp3\n");
              $rsap4 = pg_query($link, $sqlp4)  or die("Cannot execute query1.4: $sqlp4\n");

          }

          pg_close($link);
        }
}
?>


</body>
<body>
<?php
  clearstatcache();

?>

<h3> <a href="http://hilon.dit.uop.gr/~db1u23/index.php">Αρχική Σελίδα</a></h3>

</html>
