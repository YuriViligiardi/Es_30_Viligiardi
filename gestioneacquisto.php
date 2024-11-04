<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestioneacquisto.php</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js"></script>
</head>
<body>
    <?php
        $listCf = array();

        $nome = $_GET["name"];
        $cognome = $_GET["surname"];
        $cf = $_GET["cf"];
        $settore = $_GET["sector"];
        $codiceSconto = $_GET["codDiscount"];
        $listCfAgg = getCf($listCf);

        $numPers = searchNumPers($listCfAgg);
        
        $cost = ticketCost($settore, $numPers);
        $sconto = discount($codiceSconto, $cost);
        $costTot = calculateCostTot($codiceSconto, $cost, $settore, $numPers);

        $listData = array("Nome" => $nome, "Cognome" => $cognome, "Codice fiscale Acquirente" => $cf, "Data dell'acquisto" => date("Y/m/d"), "Orario dell'acquisto" => date("h:i:sa"), "ListCfAgg" => $listCfAgg, "Costo" => $cost, "Sconto" => $sconto, "Costo totale" => $costTot);

        showData($listData);

        function getCf($lCf){
            for ($i=1; $i < 5; $i++) { 
                $cfPers = "cfPers" . $i;
                if (isset($_GET[$cfPers])) {
                    $newCf = $_GET[$cfPers];
                    $lCf[$i] = $newCf;
                }
            }
            return $lCf;
        }

        function searchNumPers($lCfA){
            $num = count($lCfA);
            if($num == 0){
                return 1;
            } else {
                return $num + 1;
            }
        }

        function discount($cs, $c){
            if ($cs == "FIRENZE5") {
                return ($c / 100) * 5;
            } else if (isset($cs)) {
                return "Nessun codice inserito";
            } else {
                return "Codice inesistente";
            }
        }

        function ticketCost($set, $numPers){
           switch ($set) {
            case "curva":
                return 30 * $numPers;

            case "tribuna centrale":
                return 80 * $numPers;

            case "tribuna d'onore":
                return 120 * $numPers;
            
            default:
                break;
           }
        }

        function calculateCostTot($cs, $c, $set, $n){
            $cost = ticketCost($set, $n);
            $sconto = discount($cs, $c);
            if ($sconto == "Codice inesistente") {
                return $cost;
            } elseif ($sconto == "Nessun codice inserito") {
                return $cost;
            } else {
                return $cost - $sconto; 
            }
            
        }

        function showData($ld){
            echo "<div id='showData'>";
                echo "<h1>DATI DEL BIGLIETTO</h1>"; 
                foreach ($ld as $key => $value) {
                    if ($key == "ListCfAgg") {
                        echo "<p><b><i>Lista codici fiscali persone Aggiunte</i></b></p>";
                        // echo "<ul>";
                            for ($i=1; $i <= count($value); $i++) { 
                                //echo "<li>" . $value[$i] . "</li>";
                                echo "<p>- " . $value[$i] . "</p>";
                            }
                            echo "<p> ... </p>";
                        //echo "</ul>";
                    } elseif ($key == "Costo" || $key == "Sconto" || $key == "Costo totale") {
                        echo "<p>";
                        echo "<span><b><i>$key: </i></b></span>"; 
                        echo $value . " euro"; 
                        echo "</p>";
                    } else {
                        echo "<p>";
                        echo "<span><b><i>$key: </i></b></span>"; 
                        echo $value; 
                        echo "</p>";
                    }
                }
            echo "</div>";
        }
    ?>
</body>
</html>