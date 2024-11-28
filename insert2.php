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

<h1>Δεδομένα Τοποθεσιών</h2>

<form action = "<?php $_PHP_SELF ?>" method = "GET">


  <p>Περιφέρεια: <input class="form-control" name='periferia' autocomplete="off" type="string" placeholder="" size=50>

  <p>Νομός: <input class="form-control" name='nomos' autocomplete="off" type="string" placeholder="" size=50> </p>

  <p>Δήμος: <input class="form-control" name='dhmos' autocomplete="off" type="string" placeholder="" size=50>

  <p>Γεωγρ. Πλάτος: <input class="form-control" name='Latitude' autocomplete="off" type="number" step = 0.0000000000001 placeholder="" size=50>

  <p>Γεωγρ. Μήκος: <input class="form-control" name='Longitude' autocomplete="off" type="number" step = 0.0000000000001 placeholder="" size=50>

  <p>Σταθμός Μ.Δ.: <input class="form-control" name='Station_of_reference' autocomplete="off" type="string" placeholder="" size=50>


<p><button type="reset">Clean Form</button> <input type="Submit" value="submit" name="Submit1"> <input type="Submit" value="Delete" name="Submit2">

</form>


</body>
<?php
if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['periferia'];
  	$a2 = $_GET['nomos'];
  	$a3 = $_GET['dhmos'];
    $a4 = $_GET['Latitude'];
    $a5 = $_GET['Longitude'];
    $a6 = $_GET['Station_of_reference'];

   	if($a1 && $a2 && $a3 && $a4 && $a5 && $a6) {
      	$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
        	or die ("Could not connect to server\n");

          $result2 = pg_exec($link, "SELECT * FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ WHERE '$a6'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα")
          or die("Cannot execute query1.1: $query2\n");

          if(pg_num_rows($result2) == 0)
          {
            echo "Ο Μετεωρολογικός Σταθμός που ορίσατε δεν υπάρχει στη βάση. Παρακαλώ ακολουθήστε τον παρακάτω σύνδεσμο:";
            echo'<a href="http://hilon.dit.uop.gr/~db1u23/insert4.php">Εισαγωγή ή Διαγραφή Μετεωρολογικών Σταθμών</a>';
          }
          else {

              $result1 = pg_exec($link, "SELECT * FROM ΔΗΜΟΣ WHERE '$a2'=ΔΗΜΟΣ.νομος  AND '$a3'=ΔΗΜΟΣ.ονομα  AND ('$a1'= ΔΗΜΟΣ.περιφ) AND ('$a5'= ΔΗΜΟΣ.γεωγρ_μηκος) AND ('$a4'= ΔΗΜΟΣ.γεωγρ_πλατος)")
              	or die("Cannot execute query1.1: $query1\n");

              if(pg_num_rows($result1) == 0)
              {
                $sqlp1="INSERT INTO ΔΗΜΟΣ(ονομα, περιφ, νομος , γεωγρ_μηκος, γεωγρ_πλατος) VALUES ('$a3','$a1', '$a2', '$a5', '$a4');";
                $rsap1 = pg_query($link, $sqlp1)  or die("Cannot execute query1: $sqlp1\n");
                $sqlp3="INSERT INTO ΠΛΗΡΟΦΟΡΕΙΤΑΙ (κωδδημος, κωδμετεωρ_σταθμος) SELECT DISTINCT ΔΗΜΟΣ.κωδ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ FROM ΔΗΜΟΣ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ WHERE '$a6'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα AND '$a2'=ΔΗΜΟΣ.νομος  AND '$a3'=ΔΗΜΟΣ.ονομα  AND ('$a1'= ΔΗΜΟΣ.περιφ) AND ('$a5'= ΔΗΜΟΣ.γεωγρ_μηκος) AND ('$a4'= ΔΗΜΟΣ.γεωγρ_πλατος);";
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
  	$a1 = $_GET['periferia'];
  	$a2 = $_GET['nomos'];
  	$a3 = $_GET['dhmos'];
    $a4 = $_GET['Latitude'];
    $a5 = $_GET['Longitude'];
    $a6 = $_GET['Station_of_reference'];

   	if($a1 && $a2 && $a3 && $a4 && $a5 && $a6) {
      	$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
        	or die ("Could not connect to server\n");

          $result1 = pg_exec($link, "SELECT * FROM ΔΗΜΟΣ WHERE '$a2'=ΔΗΜΟΣ.νομος  AND '$a3'=ΔΗΜΟΣ.ονομα  AND ('$a1'= ΔΗΜΟΣ.περιφ) AND ('$a5'= ΔΗΜΟΣ.γεωγρ_μηκος) AND ('$a4'= ΔΗΜΟΣ.γεωγρ_πλατος)")
          	or die("Cannot execute query1.1.1: $query1\n");

          if(pg_num_rows($result1) == 1)
          {

            $result2 = pg_exec($link, "SELECT ΔΗΜΟΣ.κωδ FROM ΔΗΜΟΣ WHERE '$a2'=ΔΗΜΟΣ.νομος  AND '$a3'=ΔΗΜΟΣ.ονομα  AND ('$a1'= ΔΗΜΟΣ.περιφ) AND ('$a5'= ΔΗΜΟΣ.γεωγρ_μηκος) AND ('$a4'= ΔΗΜΟΣ.γεωγρ_πλατος)")
            	or die("Cannot execute query1.1.2: $query1\n");

              $row = pg_fetch_row($result2);

              $sqlp1 = "DELETE FROM ΚΑΙΕΙ WHERE ΚΑΙΕΙ.κωδδημος='$row[0]';";
              $sqlp2 = "DELETE FROM ΠΛΗΡΟΦΟΡΕΙΤΑΙ WHERE ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδδημος='$row[0]';";
              $sqlp3 = "DELETE FROM ΔΗΜΟΣ WHERE ΔΗΜΟΣ.κωδ='$row[0]';";
              $rsap1 = pg_query($link, $sqlp1)  or die("Cannot execute query1.1: $sqlp1\n");
              $rsap2 = pg_query($link, $sqlp2)  or die("Cannot execute query1.2: $sqlp2\n");
              $rsap3 = pg_query($link, $sqlp3)  or die("Cannot execute query1.3: $sqlp3\n");

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
