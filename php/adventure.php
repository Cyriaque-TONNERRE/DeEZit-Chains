<!DOCTYPE html>

<html lang="fr">
<head>
    <title> DeEZit Chain </title>
    <meta name="description" content="Projet Informatique 2022">
    <meta name="keywords" content="DeEZit, Chain, Game, Ez">
    <meta name="author" content="Ez Team">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/adventure.css">
</head>
<body>
<header>

</header>

<nav>

    <?php
    
    if (isset($_COOKIE["username"])) {
        echo "<a href='logout.php'>Logout</a>";
    }
    else {
        echo "<a href='login.php'>Login</a>";
    }
    ?>

</nav>

<main>
    <?php

    $seed = "TBAA";
    $tab = array();
    if (DIRECTORY_SEPARATOR == '\\') {
        exec("randomGenerate.exe $seed 2", $tab);
    } else {
        exec("chmod a+x ./randomGenerate");
        exec("./randomGenerate $seed 2", $tab);
    }
    $size = count($tab);
    echo "<table id='tableau'>";
    for ($colonne = 0; $colonne < $size; $colonne++){
        echo "<tr>";
        for ($ligne = 0; $ligne < $size; $ligne++){
            if($tab[$colonne][$ligne] != 0){
                //Test pour savoir où placer les bordures
                $nord = false;
                $droite = false;
                $gauche = false;
                $bas = false;
                if($colonne > 0){
                    if($tab[$colonne-1][$ligne] != 0){
                        $nord = true;
                    }
                }
                if($ligne > 0){
                    if($tab[$colonne][$ligne-1] != 0){
                        $gauche = true;
                    }
                }
                if($colonne < $size-1){
                    if($tab[$colonne+1][$ligne] != 0){
                        $bas = true;
                    }
                }
                if($ligne < $size-1){
                    if($tab[$colonne][$ligne+1] != 0){
                        $droite = true;
                    }
                }
                //Une fois qu'on sait où sont les chiffres, on ajuste la class pour ajuster les bordures de la bonne façon
                if(($nord == false) && ($gauche == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nordgauchebas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." nordgauchebas' id='1'></td>";
                    }
                }
                else if(($droite == false) && ($gauche == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droitegauchebas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." droitegauchebas' id='1'></td>";
                    }
                }
                else if(($droite == false) && ($nord == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])) {
                        echo "<td class='droitenordbas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." droitenordbas' id='1'></td>";
                    }
                }
                else if(($droite == false) && ($nord == false) && ($gauche == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droitenordgauche case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]." droitenordgauche' id='1'></td>";
                    }
                }
                else if(($nord == false) && ($gauche == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nordgauche case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." nordgauche' id='1'></td>";
                    }
                }
                else if(($nord == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='norddroite case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." norddroite' id='1'></td>";
                    }
                }
                else if(($nord == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nordbas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." nordbas' id='1'></td>";
                    }
                }
                else if(($gauche == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchebas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." gauchebas' id='1'></td>";
                    }
                }
                else if(($gauche == false) && ($nord == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchenord case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." gauchenord' id='1'></td>";
                    }
                }
                else if(($gauche == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchedroite case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." gauchedroite' id='1'></td>";
                    }
                }
                else if(($bas == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='basdroite case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." basdroite' id='1'></td>";
                    }
                }
                else if($gauche == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauche case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." gauche' id='1'></td>";
                    }
                }
                else if($droite == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droite case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." droite' id='1'></td>";
                    }
                }
                else if($nord == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nord case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." nord' id='1'></td>";
                    }
                }
                else if($bas == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='bas case unused' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='". $tab[$colonne][$ligne] ." bas' id='1'></td>";
                    }
                }
                else{
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='case unused'' id=".$tab[$colonne][$ligne].">".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class='".$tab[$colonne][$ligne]."'></td>";
                    }
                }


                    

                        
            }
            else{
                echo "<td class=invisible >".$tab[$colonne][$ligne]."</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";

    ?>
    <script src="../js/red.js"></script>
    <script src="../js/green.js"></script>
    <script src="../js/purple.js"></script>
    <script src="../js/blue.js"></script>
    <script src="../js/yellow.js"></script>
</main>
	

<footer>

</footer>

</body>
