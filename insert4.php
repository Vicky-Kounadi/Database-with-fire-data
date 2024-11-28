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

<h1>Λίστα Σταθμών</h2>

<form action = "<?php $_PHP_SELF ?>" method = "GET">


  <p>Όνομα Μετ. Σταθμού: <input class="form-control" name='station_name' autocomplete="off" type="string" placeholder="" size=50>

  <p>Γεωγρ. Πλάτος: <input class="form-control" name='latitude' autocomplete="off" type="number" step = 0.0000000000001 placeholder="" size=50> </p>

  <p>Γεωγρ. Μήκος: <input class="form-control" name='longitude' autocomplete="off" type="number" step = 0.0000000000001 placeholder="" size=50>

  <p>Υψόμετρο: <input class="form-control" name='altitude' autocomplete="off" type="number" step = 0.1 placeholder="" size=50>


<p><button type="reset">Clean Form</button> <input type="Submit" value="submit" name="Submit1"> <input type="Submit" value="Delete" name="Submit2">

</form>


</body>
<?php
if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['station_name'];
  	$a2 = $_GET['latitude'];
  	$a3 = $_GET['longitude'];
    $a4 = $_GET['altitude'];

   	if($a1 && $a2 && $a3 && $a4) {
      	$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
        	or die ("Could not connect to server\n");

          $result1 = pg_exec($link, "SELECT * FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ WHERE '$a1'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα  AND ('$a4'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.υψομετρο) AND ('$a3'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.γεωγρ_μηκος) AND ('$a2'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.γεωγρ_πλατος)")
            or die("Cannot execute query1.1: $query1\n");

            if(pg_num_rows($result1) == 0)
            {
              $sqlp="INSERT INTO ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ(ονομα, γεωγρ_μηκος, γεωγρ_πλατος, υψομετρο) VALUES ('$a1', '$a3', '$a2', '$a4');";
              $rsap = pg_query($link, $sqlp)  or die("Cannot execute query: $sqlp\n");
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
  	$a2 = $_GET['latitude'];
  	$a3 = $_GET['longitude'];
    $a4 = $_GET['altitude'];

   	if($a1 && $a2 && $a3 && $a4) {
      	$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
        	or die ("Could not connect to server\n");

          $result1 = pg_exec($link, "SELECT * FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ WHERE '$a1'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα  AND ('$a4'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.υψομετρο) AND ('$a3'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.γεωγρ_μηκος) AND ('$a2'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.γεωγρ_πλατος)")
          	or die("Cannot execute query1.1.1: $query1\n");

          if(pg_num_rows($result1) == 1)
          {

            $result2 = pg_exec($link, "SELECT ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ WHERE '$a1'=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα  AND ('$a4'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.υψομετρο) AND ('$a3'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.γεωγρ_μηκος) AND ('$a2'= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.γεωγρ_πλατος)")
            	or die("Cannot execute query1.1.2: $query1\n");

              $row = pg_fetch_row($result2);

              $sqlp1 = "DELETE FROM ΠΑΡΑΓΕΙ WHERE ΠΑΡΑΓΕΙ.κωδμετεωρ_σταθμος='$row[0]';";
              $sqlp2 = "DELETE FROM ΠΛΗΡΟΦΟΡΕΙΤΑΙ WHERE ΠΛΗΡΟΦΟΡΕΙΤΑΙ.κωδμετεωρ_σταθμος='$row[0]';";
              $sqlp3 = "DELETE FROM ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ WHERE ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ='$row[0]';";
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
