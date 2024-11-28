<html>
<head>
   <link href="test2.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 1</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>1η Επιλογή</h1>

<?php
$i = 0;
$j = 0;
$z = 0;

$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n");

$result = pg_exec($link, "SELECT DISTINCT ΔΗΜΟΣ.περιφ FROM ΔΗΜΟΣ ORDER BY ΔΗΜΟΣ.περιφ ASC")
            or die("Cannot execute query: $query\n");

//$row = pg_fetch_row($result);
$numrows = pg_numrows($result);

for($i = 0; $i < $numrows; $i++){
  $row = pg_fetch_array($result, $i);
  echo nl2br($row[0]." ".($i+1)."\n");

  $result1 = pg_exec($link, "SELECT DISTINCT ΔΗΜΟΣ.νομος FROM ΔΗΜΟΣ WHERE ΔΗΜΟΣ.περιφ = '$row[0]' ORDER BY ΔΗΜΟΣ.νομος ASC")
              or die("Cannot execute query1: $query1\n");

//  $row1 = pg_fetch_row($result1);
  $numrows1 = pg_numrows($result1);

  for($j = 0; $j < $numrows1; $j++){
    $row1 = pg_fetch_array($result1, $j);
    echo "<div style='padding-left:40px; white-space:pre'>".$row1[0]." ".($i+1).".".($j+1)."</div>";

    $result2 = pg_exec($link, "SELECT DISTINCT ΔΗΜΟΣ.ονομα, ΔΗΜΟΣ.γεωγρ_μηκος, ΔΗΜΟΣ.γεωγρ_πλατος FROM ΔΗΜΟΣ WHERE ΔΗΜΟΣ.νομος = '$row1[0]' ORDER BY ΔΗΜΟΣ.ονομα ASC")
                or die("Cannot execute query2: $query2\n");

    //$row2 = pg_fetch_row($result2);
    $numrows2 = pg_numrows($result2);

    for($z = 0; $z < $numrows2; $z++){
      $row2 = pg_fetch_array($result2, $z);
      echo "<div style='padding-left:80px; white-space:pre'>".$row2[0]." ".($i+1).".".($j+1).".".($z+1)." : ".$row2[1].", ".$row2[2]."</div>";
    }
  }
}

pg_close($link);
?>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/choices.php">Προηγούμενη Σελίδα</a></h2>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/index.php">Αρχική Σελίδα</a></h2>


</body>
</html>
