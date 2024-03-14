<form method="POST">
    <input name="username" type="text" placeholder="username"><br><br>
    <input name="Name" type="text" placeholder="Name"><br><br>
    <input name="Alter" type="number" placeholder="Alter"><br><br>
    <input name="Mail" type="text" placeholder="Mail"><br><br>
    <input name="Wohnort" type="text"placeholder="Wohnort" ><br><br>
    <input type="submit">
</form>

<?php

if($_POST) {
    preg_match("/^[A-Za-z0-9._]+@.*\.\w+$/",$_POST["Mail"], $matches);
    if(empty($matches)) {
        echo "BItte überprüfen sie ihre Mail-Adesse.";
    }
    if(isset($_POST["username"]) && !empty($_POST["username"]) &&
        isset($_POST["Name"]) && !empty($_POST["Name"]) &&
        isset($_POST["Alter"]) && !empty($_POST["Alter"]) &&
        isset($_POST["Mail"]) && !empty($_POST["Mail"]) &&
        isset($_POST["Wohnort"]) && !empty($_POST["Wohnort"])) {
        $json_string = json_encode($_POST);
        if(!empty($json_string)) {

            $bytes = file_put_contents("user.json", $json_string.",\n", FILE_APPEND);
            if($bytes != false) {
                echo "Die Aktion war erfolgreich";
                echo "Es wurden " . $bytes . "Bytes geschrieben.";
            } else {
                echo "Es ist ein Fehler aufgetreten";
            }
        }else {
            echo "Es ist ein Fehler aufgetreten";
        }
    } else {

        echo "Bitte alles ausfüllen";
    }
}






















exit;
#$_GET - Superglobale
if($_GET["seite"] == "Premium") {
    echo "Hier ist die Premium-Seite";
}


echo $_GET["username"];
echo $_GET["passwort"];

#$_POST - Superglobale
echo $_POST["username"];
echo $_POST["passwort"];

var_dump($_POST);

exit;


#PHP Basics

# Schleifen - for


$monate_eins = array("Jan", "Feb", "Apr");

for ($i=0; $i < 2; $i++) {
    echo $monate_eins[$i];
}

echo "<br><br>";
echo "<br><br>";
echo "Hello CoBa";
echo "<br><br>";
echo "<br><br>";
# Schleifen - foreach

$monate = array(
"jan" => "Januar",
"feb" => "Febuar",
"maer" => "März",
"apr" => "April",
"mai" => "Mai",
"jun" => "Juni",
"jul" => "Juli");

    #Asso. Array Wert hinzufügen
    $monate["aug"] = "August";
    $monate["sep"] = "September";
    var_dump($monate);

    #Element entfernen
    unset($monate["apr"]);
    echo "<br><br>";
    var_dump($monate);

    #get array keys
    echo "<br><br>";
    var_dump(array_keys($monate));

    #get array keys
    echo "<br><br>";
    (array_values($monate));

echo "<br><br>";echo "<br><br>";
foreach($monate as $kuerzel => $monat) {
    echo $kuerzel . " => ". $monat . "<br>";
}


# Schleifen - while 

$i = 1;
while ($i <= 10) {
    echo $i++;
}

# Arrays
echo "<br><br>";
echo "<br><br>";
$array = array("2020","2021","2022");
echo $array[1];

    #Wert ändern 
    $array[1] = "2030";
    echo $array[1];

    $monate["jan"] = "Jannika";

    #Wert hinzufügen
    $array[] = "2023";

    $monate["Bak"] = "Bakhtiyar";
    var_dump($array);

    #count 
    echo count($array);
    echo $array[count($array)-1];

    #Element entfernen
    unset($array[1]);
    echo "<br><br>";
    var_dump($array);

#Variable setzen
$name = "Chris";
$alter = 22;


#Augaben
echo "<p>".$name."<p>";
print($alter);
echo "<br><br>";

#Zwei Variblen verbidnen

$nachname = "Schreck";

#Option Eins
echo $name." ".$nachname;

#2
$name .= " Schreck";
echo $name;
echo "<br><br>";
#Rechnen

    $zahl = 5;
    $zahl2 = 10;

    #Addieren
    $erb = $zahl + $zahl2;

    #Subtrahieren
    $erb = $zahl - $zahl2;

    #Multiplizieren
    $erb = $zahl * $zahl2;

    #Dividieren
    $erb = $zahl / $zahl2;

#Kurzschreibweise Rechnen
echo "HIERRR<br>";
$zahl =+ $zahl2;
echo $zahl2."<br>";
$zahl -= $zahl2;
$zahl *= $zahl2;
$zahl /= $zahl2;

#Dekrementieren und Inkrementieren

$meineZahl = 1;
$meineZahl++;
echo $meineZahl;
echo "<br><br>";


$string = "String";
$string2 = "String";


# = --> Zuweiung
# == Vergleich,aber nur den Value 
# === --> Vergleicht er auch den Typ
#------------------------------------------
$zahl1 = 1;
$zahl2 = "1";

if($zahl1 != $zahl2) {
    echo "RICHTIG";
} else {
    echo "FALASCH";
}

if($zahl1 !== $zahl2) {
    echo "RICHTIG";
} else {
    echo "FALASCH";
}
#------------------------------------------
if($string == "String" && is_string($string)) {
    return true;
} else {
    return false;
}

#------------------------------------------------------------------------------------------------------------------------------
