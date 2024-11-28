<html>
<head>
   <link href="test.css" rel="stylesheet" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-7">
   <meta name="author" content="GG EZ name">
   <title>Insert Files Data</title>
</head>


<?php
$host = "localhost";
$user = "db1u23";
$pass = "zfS9SUpC";
$db = $user;
?>

<body>
<h1>Εισαγωγή Αρχείων</h1>

<?php
$link = pg_connect("host=$host dbname=$db user=$user password=$pass")
	or die ("Could not connect to server\n");

  $query4 = "DROP TABLE IF EXISTS fire_tmp;
              DROP TABLE IF EXISTS meteo_tmp;
              DROP TABLE IF EXISTS locations_tmp;
              DROP TABLE IF EXISTS stations_tmp;";

  $result4 = pg_query($link,$query4)
    or die("Cannot execute query4: $query4\n");

  $query = "DROP TABLE ΠΑΡΑΓΕΙ;
            DROP TABLE ΠΛΗΡΟΦΟΡΕΙΤΑΙ;
            DROP TABLE ΚΑΙΕΙ;
            DROP TABLE ΣΒΗΝΕΙ;
            DROP TABLE ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ;
            DROP TABLE ΠΥΡ_ΤΜΗΜΑ;
            DROP TABLE ΠΥΡΚΑΓΙΑ;
            DROP TABLE ΔΗΜΟΣ;
            DROP TABLE ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ;
            DROP TABLE ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ;";

  $result = pg_query($link,$query)
    or die("Cannot execute query: $query\n");

  $query0 = "CREATE TABLE IF NOT EXISTS ΠΥΡ_ΤΜΗΜΑ (
              κωδ SERIAL,
              ονομα VARCHAR(100),
              PRIMARY KEY( κωδ )
              );

              CREATE TABLE IF NOT EXISTS ΠΥΡΚΑΓΙΑ (
              κωδ SERIAL,
              ωρα_εναρξ TIME,
              ημερ_εναρξ DATE,
              ωρα_τελ TIME,
              ημερ_τελ DATE,
              καμ_εκταση FLOAT,
              PRIMARY KEY( κωδ )
              );

              CREATE TABLE IF NOT EXISTS ΔΗΜΟΣ (
              κωδ SERIAL,
              ονομα VARCHAR(100),
              περιφ VARCHAR(100),
              νομος VARCHAR(100),
              γεωγρ_μηκος FLOAT,
              γεωγρ_πλατος FLOAT,
              PRIMARY KEY( κωδ )
              );

              CREATE TABLE IF NOT EXISTS ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ (
              κωδ SERIAL,
              ονομα VARCHAR(100),
              γεωγρ_μηκος FLOAT,
              γεωγρ_πλατος FLOAT,
              υψομετρο FLOAT,
              PRIMARY KEY( κωδ )
              );

              CREATE TABLE IF NOT EXISTS ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ (
              κωδ SERIAL,
              ημερ DATE,
              max_θερμ FLOAT NULL,
              avrg_θερμ FLOAT NULL,
              min_θερμ FLOAT NULL,
              max_υγρ_ποσοστο FLOAT NULL,
              avrg_υγρ_ποσοστο FLOAT NULL,
              min_υγρ_ποσοστο FLOAT NULL,
              max_πιεση FLOAT NULL,
              avrg_πιεση FLOAT NULL,
              min_πιεση FLOAT NULL,
              βροχη FLOAT NULL,
              ταχ_ανεμου FLOAT NULL,
              κατ_ανεμου VARCHAR(4) NULL,
              ριπη_ανεμου FLOAT NULL,
              PRIMARY KEY( κωδ )
              );

              CREATE TABLE IF NOT EXISTS ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ (
              κωδπυρκαγια INTEGER,
              αριθμ_ανδρων INTEGER,
              αριθμ_οχημ INTEGER,
              αριθμ_αερ INTEGER,
              FOREIGN KEY( κωδπυρκαγια ) REFERENCES ΠΥΡΚΑΓΙΑ ( κωδ )
              );

              CREATE TABLE IF NOT EXISTS ΣΒΗΝΕΙ (
              κωδπυρ_τμημα INTEGER,
              κωδπυρκαγια INTEGER,
              FOREIGN KEY( κωδπυρ_τμημα ) REFERENCES ΠΥΡ_ΤΜΗΜΑ ( κωδ ),
              FOREIGN KEY( κωδπυρκαγια ) REFERENCES ΠΥΡΚΑΓΙΑ ( κωδ )
              );

              CREATE TABLE IF NOT EXISTS ΚΑΙΕΙ (
              κωδπυρκαγια INTEGER,
              κωδδημος INTEGER,
              FOREIGN KEY( κωδπυρκαγια ) REFERENCES ΠΥΡΚΑΓΙΑ ( κωδ ) ,
              FOREIGN KEY( κωδδημος ) REFERENCES ΔΗΜΟΣ ( κωδ )
              );

              CREATE TABLE IF NOT EXISTS ΠΛΗΡΟΦΟΡΕΙΤΑΙ (
              κωδδημος INTEGER,
              κωδμετεωρ_σταθμος INTEGER,
              FOREIGN KEY( κωδδημος ) REFERENCES ΔΗΜΟΣ ( κωδ ) ,
              FOREIGN KEY( κωδμετεωρ_σταθμος ) REFERENCES ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ(κωδ)
              );

              CREATE TABLE IF NOT EXISTS ΠΑΡΑΓΕΙ (
              κωδμετεωρ_σταθμος INTEGER,
              κωδμετεωρ_δεδομενα INTEGER,
              FOREIGN KEY(κωδμετεωρ_σταθμος) REFERENCES ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ(κωδ),
              FOREIGN KEY(κωδμετεωρ_δεδομενα) REFERENCES ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ(κωδ)
              );";

  $result0 = pg_query($link,$query0)
    or die("Cannot execute query0: $query0\n");

  $query1 = "CREATE TABLE fire_tmp(
                          τμήμα VARCHAR(100),
                          νομός VARCHAR(100),
                          δήμος VARCHAR(100),
                          ημερομηνία_έναρξης DATE,
                          ώρα_έναρξης TIME,
                          ημερομηνία_κατάσβεσης DATE,
                          ώρα_κατάσβεσης TIME,
                          καμμένη_έκταση_στρ FLOAT,
                          προσωπικό INTEGER,
                          οχήματα INTEGER,
                          εναέρια INTEGER
                          );

                          CREATE TABLE meteo_tmp(
                          station_name VARCHAR(100),
                          date DATE,
                          avg_temp_C FLOAT NULL,
                          max_temp_C FLOAT NULL,
                          min_temp_C FLOAT NULL,
                          avg_hum_perc FLOAT NULL,
                          max_hum_perc FLOAT NULL,
                          min_hum_perc FLOAT NULL,
                          avg_atm_hPa FLOAT NULL,
                          max_atm_hPa FLOAT NULL,
                          min_atm_hPa FLOAT NULL,
                          rain_mm FLOAT NULL,
                          wind_speed_kmh FLOAT NULL,
                          wind_dir VARCHAR(4) NULL,
                          wind_gust_kmh FLOAT NULL
                          );


                          CREATE TABLE stations_tmp(
                          station_name VARCHAR(100),
                          latitude FLOAT,
                          longitude FLOAT,
                          altitude FLOAT
                          );


                          CREATE TABLE locations_tmp(
                          περιφέρεια VARCHAR(100),
                          νομός VARCHAR(100),
                          δήμος VARCHAR(100),
                          latitude FLOAT,
                          longitude FLOAT,
                          station_of_reference VARCHAR(100)
                          );";

  $result1 = pg_query($link,$query1)
    or die("Cannot execute query1: $query1\n");

    $com = exec('./copy_files/copy_files.sh') or die("Error");
    echo "<br>$com<br>";

    $query2 = "INSERT INTO ΠΥΡ_ΤΜΗΜΑ(ονομα)
                            SELECT DISTINCT τμήμα
                            FROM fire_tmp;

                            INSERT INTO ΠΥΡΚΑΓΙΑ (ωρα_εναρξ, ημερ_εναρξ, ωρα_τελ, ημερ_τελ, καμ_εκταση)
                            SELECT ώρα_έναρξης, ημερομηνία_έναρξης, ώρα_κατάσβεσης, ημερομηνία_κατάσβεσης, καμμένη_έκταση_στρ
                            FROM fire_tmp;

                            INSERT INTO ΔΗΜΟΣ (ονομα, περιφ, νομος , γεωγρ_μηκος, γεωγρ_πλατος)
                            SELECT δήμος, περιφέρεια, νομός,  longitude, latitude
                            FROM locations_tmp;

                            INSERT INTO ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ (ονομα, γεωγρ_μηκος, γεωγρ_πλατος, υψομετρο)
                            SELECT station_name, longitude, latitude, altitude
                            FROM stations_tmp;

                            INSERT INTO ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ (ημερ, max_θερμ, avrg_θερμ, min_θερμ, max_υγρ_ποσοστο, avrg_υγρ_ποσοστο, min_υγρ_ποσοστο, max_πιεση, avrg_πιεση, min_πιεση, βροχη, ταχ_ανεμου, κατ_ανεμου, ριπη_ανεμου)
                            SELECT date, max_temp_C, avg_temp_C, min_temp_C, max_hum_perc, avg_hum_perc, min_hum_perc, max_atm_hPa, avg_atm_hPa, min_atm_hPa, rain_mm, wind_speed_kmh, wind_dir, wind_gust_kmh
                            FROM meteo_tmp;


                            INSERT INTO ΣΒΗΝΕΙ_ΠΡΟΣΩΠΙΚΟ (κωδπυρκαγια, αριθμ_ανδρων, αριθμ_οχημ, αριθμ_αερ)
                            SELECT DISTINCT ΠΥΡΚΑΓΙΑ.κωδ, fire_tmp.προσωπικό, fire_tmp.οχήματα, fire_tmp.εναέρια
                            FROM ΠΥΡΚΑΓΙΑ, fire_tmp
                            WHERE fire_tmp.ώρα_έναρξης= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ
                            AND fire_tmp.ημερομηνία_έναρξης= ΠΥΡΚΑΓΙΑ.ημερ_εναρξ
                            AND fire_tmp.ώρα_κατάσβεσης= ΠΥΡΚΑΓΙΑ.ωρα_τελ
                            AND fire_tmp.ημερομηνία_κατάσβεσης= ΠΥΡΚΑΓΙΑ.ημερ_τελ
                            AND fire_tmp.καμμένη_έκταση_στρ= ΠΥΡΚΑΓΙΑ.καμ_εκταση;

                            INSERT INTO ΣΒΗΝΕΙ (κωδπυρ_τμημα, κωδπυρκαγια)
                            SELECT DISTINCT ΠΥΡ_ΤΜΗΜΑ.κωδ, ΠΥΡΚΑΓΙΑ.κωδ
                            FROM ΠΥΡΚΑΓΙΑ, ΠΥΡ_ΤΜΗΜΑ, fire_tmp
                            WHERE fire_tmp.τμήμα= ΠΥΡ_ΤΜΗΜΑ.ονομα
                            AND fire_tmp.ώρα_έναρξης= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ
                            AND fire_tmp.ημερομηνία_έναρξης= ΠΥΡΚΑΓΙΑ.ημερ_εναρξ
                            AND fire_tmp.ώρα_κατάσβεσης= ΠΥΡΚΑΓΙΑ.ωρα_τελ
                            AND fire_tmp.ημερομηνία_κατάσβεσης= ΠΥΡΚΑΓΙΑ.ημερ_τελ
                            AND fire_tmp.καμμένη_έκταση_στρ= ΠΥΡΚΑΓΙΑ.καμ_εκταση;

                            INSERT INTO ΚΑΙΕΙ (κωδπυρκαγια, κωδδημος)
                            SELECT DISTINCT ΠΥΡΚΑΓΙΑ.κωδ, ΔΗΜΟΣ.κωδ
                            FROM fire_tmp, ΔΗΜΟΣ, ΠΥΡΚΑΓΙΑ
                            WHERE fire_tmp.νομός=ΔΗΜΟΣ.νομος
                            AND fire_tmp.δήμος=ΔΗΜΟΣ.ονομα
                            AND fire_tmp.ώρα_έναρξης= ΠΥΡΚΑΓΙΑ.ωρα_εναρξ
                            AND fire_tmp.ημερομηνία_έναρξης= ΠΥΡΚΑΓΙΑ.ημερ_εναρξ
                            AND fire_tmp.ώρα_κατάσβεσης= ΠΥΡΚΑΓΙΑ.ωρα_τελ
                            AND fire_tmp.ημερομηνία_κατάσβεσης= ΠΥΡΚΑΓΙΑ.ημερ_τελ
                            AND fire_tmp.καμμένη_έκταση_στρ= ΠΥΡΚΑΓΙΑ.καμ_εκταση;

                            INSERT INTO ΠΛΗΡΟΦΟΡΕΙΤΑΙ (κωδδημος, κωδμετεωρ_σταθμος)
                            SELECT DISTINCT ΔΗΜΟΣ.κωδ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ
                            FROM ΔΗΜΟΣ, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, locations_tmp
                            WHERE locations_tmp.station_of_reference= ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα
                            AND locations_tmp.δήμος= ΔΗΜΟΣ.ονομα
                            AND locations_tmp.νομός=ΔΗΜΟΣ.νομος;

                            INSERT INTO ΠΑΡΑΓΕΙ (κωδμετεωρ_σταθμος, κωδμετεωρ_δεδομενα)
                            SELECT DISTINCT ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.κωδ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κωδ
                            FROM meteo_tmp, ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ, ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ
                            WHERE meteo_tmp.station_name=ΜΕΤΕΩΡ_ΣΤΑΘΜΟΣ.ονομα
                            AND meteo_tmp.date=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ημερ
                            AND (meteo_tmp.max_temp_C=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_θερμ IS NULL AND meteo_tmp.max_temp_C IS NULL))
                            AND (meteo_tmp.avg_temp_C=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_θερμ IS NULL AND meteo_tmp.avg_temp_C IS NULL))
                            AND (meteo_tmp.min_temp_C=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_θερμ IS NULL AND meteo_tmp.min_temp_C IS NULL))
                            AND (meteo_tmp.max_hum_perc=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_υγρ_ποσοστο IS NULL AND meteo_tmp.max_hum_perc IS NULL))
                            AND (meteo_tmp.avg_hum_perc=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_υγρ_ποσοστο IS NULL AND meteo_tmp.avg_hum_perc IS NULL))
                            AND (meteo_tmp.min_hum_perc=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_υγρ_ποσοστο IS NULL AND meteo_tmp.min_hum_perc IS NULL))
                            AND (meteo_tmp.max_atm_hPa=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.max_πιεση IS NULL AND meteo_tmp.max_atm_hPa IS NULL))
                            AND (meteo_tmp.avg_atm_hPa=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.avrg_πιεση IS NULL AND meteo_tmp.avg_atm_hPa IS NULL))
                            AND (meteo_tmp.min_atm_hPa=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.min_πιεση IS NULL AND meteo_tmp.min_atm_hPa IS NULL))
                            AND (meteo_tmp.rain_mm=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.βροχη IS NULL AND meteo_tmp.rain_mm IS NULL))
                            AND (meteo_tmp.wind_speed_kmh=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ταχ_ανεμου IS NULL AND meteo_tmp.wind_speed_kmh IS NULL))
                            AND (meteo_tmp.wind_dir=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.κατ_ανεμου IS NULL AND meteo_tmp.wind_dir IS NULL))
                            AND (meteo_tmp.wind_gust_kmh=ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου OR (ΜΕΤΕΩΡ_ΔΕΔΟΜΕΝΑ.ριπη_ανεμου IS NULL AND meteo_tmp.wind_gust_kmh IS NULL));";

    $result2 = pg_query($link,$query2)
      or die("Cannot execute query2: $query2\n");

    $query3 = "DROP TABLE fire_tmp;
                DROP TABLE meteo_tmp;
                DROP TABLE locations_tmp;
                DROP TABLE stations_tmp;";

    $result3 = pg_query($link,$query3)
      or die("Cannot execute query3: $query3\n");


    echo "File loaded successfully";
	pg_close($link);
?>

<h2> <a href="http://hilon.dit.uop.gr/~db1u23/index.php">Αρχική Σελίδα</a></h2>


</body>
</html>
