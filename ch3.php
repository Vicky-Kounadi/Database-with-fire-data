<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Choice 3</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>3η Επιλογή</h1>

<form action = "<?php $_PHP_SELF ?>" method = "GET">

<p>Δήμος: <input class="form-control" name='dhmos' autocomplete="off" type="string" placeholder="" size=50>

<p><button type="reset">Clean Form</button> <input type="Submit" value="Submit" name="Submit1">

</form>

<?php

if (isset($_GET["Submit1"]))
{
	error_reporting(0);
  	$a1 = $_GET['dhmos'];

   	if($a1) {

      $link = pg_connect("host=$host dbname=$db user=$user password=$pass")
      or die ("Could not connect to server\n");

      $result = pg_exec($link, "SELECT ΠΥΡΚΑΓΙΑ.κωδ, ΠΥΡΚΑΓΙΑ.ημερ_εναρξ, ΠΥΡΚΑΓΙΑ.ωρα_εναρξ, ΠΥΡΚΑΓΙΑ.ημερ_τελ, ΠΥΡΚΑΓΙΑ.ωρα_τελ, ΠΥΡΚΑΓΙΑ.καμ_εκταση, ΠΥΡ_ΤΜΗΜΑ.ονομα,
                        ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.αριθμ_ανδρων, ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.αριθμ_οχημ, ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.αριθμ_αερ
                        FROM ΠΥΡΚΑΓΙΑ, ΚΑΙΕΙ, ΔΗΜΟΣ, ΠΥΡ_ΤΜΗΜΑ, ΣΒΗΝΕΙ, ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ
                        WHERE ΠΥΡΚΑΓΙΑ.κωδ = ΚΑΙΕΙ.κωδπυρκαγια
                        AND ΔΗΜΟΣ.κωδ = ΚΑΙΕΙ.κωδδημος
                        AND ΠΥΡΚΑΓΙΑ.κωδ=ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ.κωδπυρκαγια
                        AND ΠΥΡΚΑΓΙΑ.κωδ=ΣΒΗΝΕΙ.κωδπυρκαγια
                        AND ΠΥΡ_ΤΜΗΜΑ.κωδ=ΣΒΗΝΕΙ.κωδπυρ_τμημα
                        AND ΔΗΜΟΣ.ονομα = '$a1'
                        ORDER BY ΠΥΡΚΑΓΙΑ.καμ_εκταση DESC")
                        or die("Cannot execute query: $query\n");

      if(pg_num_rows($result) == 0)
      {
        echo "Ο Δήμος που ορίσατε δεν υπάρχει στη βάση.";
      }

      $numrows = pg_numrows($result);
      ?>

      <table border="1">
        <tr>
          <th>ΚΩΔ</th>
          <th>ΗΜΕΡΑ ΕΝΑΡΞΗΣ</th>
          <th>ΩΡΑ ΕΝΑΡΞΗΣ</th>
          <th>ΗΜΕΡΑ ΚΑΤΑΣΒΕΣΗΣ</th>
          <th>ΩΡΑ ΚΑΤΑΣΒΕΣΗΣ</th>
          <th>ΚΑΜΜΕΝΗ ΕΚΤΑΣΗ</th>
          <th>ΠΥΡΟΣΒΕΣΤΙΚΟ ΤΜΗΜΑ</th>
          <th>ΠΡΟΣΩΠΙΚΟ</th>
          <th>ΟΧΗΜΑΤΑ</th>
          <th>ΕΝΑΕΡΙΑ</th>
        </tr>
        <?php


        for($ri = 0; $ri < $numrows; $ri++) {
          echo "<tr>\n";
          $row = pg_fetch_array($result, $ri);
          echo " <td>", $row["κωδ"], "</td>
          <td>", $row["ημερ_εναρξ"], "</td>
          <td>", $row["ωρα_εναρξ"], "</td>
          <td>", $row["ημερ_τελ"], "</td>
          <td>", $row["ωρα_τελ"], "</td>
          <td>", $row["καμ_εκταση"], "</td>
          <td>", $row["ονομα"], "</td>
          <td>", $row["αριθμ_ανδρων"], "</td>
          <td>", $row["αριθμ_οχημ"], "</td>
          <td>", $row["αριθμ_αερ"], "</td>
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
