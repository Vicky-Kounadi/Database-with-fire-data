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

<h1>Μετεωρολογικά Δεδομένα</h2>

<form action = "<?php $_PHP_SELF ?>" method = "GET">


  <p>Όνομα Μετ. Σταθμού: <input class="form-control" name='station_name' autocomplete="off" type="string" placeholder="" size=50>

  <p>Ημερομηνία: <input class="form-control" name='date' autocomplete="off" type="date" placeholder="" size=50> </p>

  <p>Μέση Θερμοκρασία (C): <input class="form-control" name='avg_temp_C' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Μαξ Θερμοκρασία (C): <input class="form-control" name='max_temp_C' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Μιν Θερμοκρασία (C): <input class="form-control" name='min_temp_C' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Μέση Υγρασία (%): <input class="form-control" name='avg_hum_perc' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Μαξ Υγρασία (%): <input class="form-control" name='max_hum_perc' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Μιν Υγρασία (%): <input class="form-control" name='min_hum_perc' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Μέση Πίεση (hPa): <input class="form-control" name='avg_atm_hPa' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Μαξ Πίεση (hPa): <input class="form-control" name='max_atm_hPa' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Μιν Πίεση (hPa): <input class="form-control" name='min_atm_hPa' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Βροχή (mm): <input class="form-control" name='rain_mm' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Ταχ. Ανέμου (kmh): <input class="form-control" name='wind_speed_kmh' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>

  <p>Κατεύθ. Ανέμου: <input class="form-control" name='wind_dir' autocomplete="off" type="string" placeholder="" size=50>

  <p>Ριπή Ανέμου (kmh): <input class="form-control" name='wind_gust_kmh' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>


<p><button type="reset">Clean Form</button> <input type="Submit" value="submit" name="Submit1"> <input type="Submit" value="Delete" name="Submit2">

</form>


</body>


<?php
if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['station_name'];
  	$a2 = $_GET['date'];
  	$a3 = $_GET['avg_temp_C'];
    $a4 = $_GET['max_temp_C'];
    $a5 = $_GET['min_temp_C'];
    $a6 = $_GET['avg_hum_perc'];
    $a7 = $_GET['max_hum_perc'];
    $a8 = $_GET['min_hum_perc'];
    $a9 = $_GET['avg_atm_hPa'];
    $a10 = $_GET['max_atm_hPa'];
    $a11 = $_GET['min_atm_hPa'];
    $a12 = $_GET['rain_mm'];
    $a13 = $_GET['wind_speed_kmh'];
    $a14 = $_GET['wind_dir'];
    $a15 = $_GET['wind_gust_kmh'];

    if(!isset($a3) || $a3 == ""){
      $a3 = "NULL";
    }
    else{
        $a3="'".$a3."'";
    }
    if(!isset($a4) || $a4 == ""){
      $a4 = "NULL";
    }
    else{
        $a4="'".$a4."'";
    }
    if(!isset($a5) || $a5 == ""){
      $a5 = "NULL";
    }
    else{
        $a5="'".$a5."'";
    }
    if(!isset($a6) || $a6 == ""){
      $a6 = "NULL";
    }
    else{
        $a6="'".$a6."'";
    }
    if(!isset($a7) || $a7 == ""){
      $a7 = "NULL";
    }
    else{
        $a7="'".$a7."'";
    }
    if(!isset($a8) || $a8 == ""){
      $a8 = "NULL";
    }
    else{
        $a8="'".$a8."'";
    }

    if(!isset($a9) || $a9 == ""){
      $a9 = "NULL";
    }
    else{
        $a9="'".$a9."'";
    }
    if(!isset($a10) || $a10 == ""){
      $a10 = "NULL";
    }
    else{
        $a10="'".$a10."'";
    }

    if(!isset($a11) || $a11 == ""){
      $a11 = "NULL";
    }
    else{
        $a11="'".$a11."'";
    }
    if(!isset($a12) || $a12 == ""){
      $a12 = "NULL";
    }
    else{
        $a12="'".$a12."'";
    }
    if(!isset($a13) || $a13 == ""){
      $a13 = "NULL";
    }
    else{
        $a13="'".$a13."'";
    }
    if(!isset($a14) || $a14 == ""){
      $a14 = "NULL";
    }
    else{
        $a14="'".$a14."'";
    }
    if(!isset($a15) || $a15 == ""){
      $a15 = "NULL";
    }
    else{
        $a15="'".$a15."'";
    }


   	if($a1 && $a2) {
      	$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
        	or die ("Could not connect to server\n");

          $result2 = pg_exec($link, "SELECT * FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ WHERE '$a1'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα")
          or die("Cannot execute query1.2: $query2\n");

          if(pg_num_rows($result2) == 0)
          {
            echo "Ο Μετεωρολογικός Σταθμός που ορίσατε δεν υπάρχει στη βάση. Παρακαλώ ακολουθήστε τον παρακάτω σύνδεσμο:";
            echo'<a href="http://hilon.dit.uop.gr/~db1u23/insert4.php">Εισαγωγή ή Διαγραφή Μετεωρολογικών Σταθμών</a>';
          }
          else {
            $result1 = pg_exec($link, "SELECT * FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ WHERE '$a1'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα AND '$a2'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ")
              or die("Cannot execute query1.1: $query1\n");

              if(pg_num_rows($result1) == 0)
            {
                $sqlp1="INSERT INTO ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ (ημερ, max_θερμ, avrg_θερμ, min_θερμ, max_υγρ_ποσοστο, avrg_υγρ_ποσοστο, min_υγρ_ποσοστο, max_πιεση, avrg_πιεση, min_πιεση, βροχη, ταχ_ανεμου, κατ_ανεμου, ριπη_ανεμου) VALUES ('$a2', ".$a4.", ".$a3.", ".$a5.", ".$a7.", ".$a6.", ".$a8.", ".$a10.", ".$a9.", ".$a11.", ".$a12.", ".$a13.", ".$a14.", ".$a15.");";
                $rsap1 = pg_query($link, $sqlp1)  or die("Cannot execute query1: $sqlp1\n");
                $sqlp3="INSERT INTO ΠΑΡΑΓΕΙ(κωδμετεωρ_σταθμος, κωδμετεωρ_δεδομενα) SELECT DISTINCT ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ WHERE '$a1'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα AND '$a2'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ;";
                $rsap3 = pg_query($link, $sqlp3)  or die("Cannot execute query3: $sqlp3\n");
            }
          }

		  pg_close($link);
    }
}
?>

<?php
if (isset($_GET["Submit2"]))
{
  error_reporting(0);
  	$a1 = $_GET['station_name'];
  	$a2 = $_GET['date'];
  	$a3 = $_GET['avg_temp_C'];
    $a4 = $_GET['max_temp_C'];
    $a5 = $_GET['min_temp_C'];
    $a6 = $_GET['avg_hum_perc'];
    $a7 = $_GET['max_hum_perc'];
    $a8 = $_GET['min_hum_perc'];
    $a9 = $_GET['avg_atm_hPa'];
    $a10 = $_GET['max_atm_hPa'];
    $a11 = $_GET['min_atm_hPa'];
    $a12 = $_GET['rain_mm'];
    $a13 = $_GET['wind_speed_kmh'];
    $a14 = $_GET['wind_dir'];
    $a15 = $_GET['wind_gust_kmh'];

   	if($a1 && $a2) {
      	$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
        	or die ("Could not connect to server\n");

          $result1 = pg_exec($link, "SELECT * FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ WHERE '$a1'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα AND '$a2'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ AND ('$a4'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ IS NULL AND '$a4' IS NULL)) AND ('$a3'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ IS NULL AND '$a3' IS NULL)) AND ('$a5'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ IS NULL AND '$a5' IS NULL)) AND ('$a7'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο IS NULL AND '$a7' IS NULL)) AND ('$a6'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο IS NULL AND '$a6' IS NULL)) AND ('$a8'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο IS NULL AND '$a8' IS NULL)) AND ('$a10'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση IS NULL AND '$a10' IS NULL)) AND ('$a9'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση IS NULL AND '$a9' IS NULL)) AND ('$a11'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση IS NULL AND '$a11' IS NULL)) AND ('$a12'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη IS NULL AND '$a12' IS NULL)) AND ('$a13'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου IS NULL AND '$a13' IS NULL)) AND ('$a14'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου IS NULL AND '$a14' IS NULL)) AND ('$a15'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου IS NULL AND '$a15' IS NULL))")
          	or die("Cannot execute query1.1.1: $query1\n");

          if(pg_num_rows($result1) == 1)
          {
            $result2 = pg_exec($link, "SELECT ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ WHERE '$a1'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα AND '$a2'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ AND ('$a4'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ IS NULL AND '$a4' IS NULL)) AND ('$a3'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ IS NULL AND '$a3' IS NULL)) AND ('$a5'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ IS NULL AND '$a5' IS NULL)) AND ('$a7'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο IS NULL AND '$a7' IS NULL)) AND ('$a6'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο IS NULL AND '$a6' IS NULL)) AND ('$a8'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο IS NULL AND '$a8' IS NULL)) AND ('$a10'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση IS NULL AND '$a10' IS NULL)) AND ('$a9'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση IS NULL AND '$a9' IS NULL)) AND ('$a11'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση IS NULL AND '$a11' IS NULL)) AND ('$a12'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη IS NULL AND '$a12' IS NULL)) AND ('$a13'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου IS NULL AND '$a13' IS NULL)) AND ('$a14'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου IS NULL AND '$a14' IS NULL)) AND ('$a15'=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου IS NULL AND '$a15' IS NULL))")
            	or die("Cannot execute query1.1.2: $query1\n");

              $row = pg_fetch_row($result2);

              $sqlp1 = "DELETE FROM ΠΑΡΑΓΕΙ WHERE ΠΑΡΑΓΕΙ.κωδμετεωρ_δεδομενα='$row[0]';";
              $sqlp2 = "DELETE FROM ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ WHERE ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ='$row[0]';";
              $rsap1 = pg_query($link, $sqlp1)  or die("Cannot execute query1.1: $sqlp1\n");
              $rsap2 = pg_query($link, $sqlp2)  or die("Cannot execute query1.2: $sqlp2\n");
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
