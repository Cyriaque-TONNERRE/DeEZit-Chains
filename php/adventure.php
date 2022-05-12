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

    $seed = "Test";
    $tab = array();
    if (DIRECTORY_SEPARATOR == '\\') {
        exec("randomGenerate.exe $seed 5", $tab);
    } else {
        exec("chmod a+x ./randomGenerate");
        exec("./randomGenerate $seed 5", $tab);
    }
    $size = count($tab);
    echo "<table>";
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
                        echo "<td class='nordgauchebas case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=nordgauchebas></td>";
                    }
                }
                else if(($droite == false) && ($gauche == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droitegauchebas case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=droitegauchebas></td>";
                    }
                }
                else if(($droite == false) && ($nord == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])) {
                        echo "<td class='droitenordbas case'>" . $tab[$colonne][$ligne] . "</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=droitenordbas></td>";
                    }
                }
                else if(($droite == false) && ($nord == false) && ($gauche == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droitenordgauche case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=droitenordgauche></td>";
                    }
                }
                else if(($nord == false) && ($gauche == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nordgauche case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=nordgauche></td>";
                    }
                }
                else if(($nord == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='norddroite case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=norddroite></td>";
                    }
                }
                else if(($nord == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nordbas case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=nordbas></td>";
                    }
                }
                else if(($gauche == false) && ($bas == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchebas case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=gauchebas></td>";
                    }
                }
                else if(($gauche == false) && ($nord == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchenord case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=gauchenord></td>";
                    }
                }
                else if(($gauche == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauchedroite case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=gauchedroite></td>";
                    }
                }
                else if(($bas == false) && ($droite == false)){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='basdroite case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=basdroite></td>";
                    }
                }
                else if($gauche == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='gauche case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=gauche></td>";
                    }
                }
                else if($droite == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='droite case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' id=". $tab[$colonne][$ligne] ." class=droite></td>";
                    }
                }
                else if($nord == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='nord case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=nord></td>";
                    }
                }
                else if($bas == false){
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='bas case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ." class=bas></td>";
                    }
                }
                else{
                    if (ctype_digit($tab[$colonne][$ligne])){
                        echo "<td class='case'>".$tab[$colonne][$ligne]."</td>";
                    } else {
                        echo "<td draggable='true' class=". $tab[$colonne][$ligne] ."></td>";
                    }
                }


                    

                        
            }
            else{
                echo "<td class=invisible >".$tab[$colonne][$ligne]."</td>";
            }
        }
        echo "</tr>";
    }
    echo "<table>";

    ?>
    <script src="./js/app.js"></script>
</main>
	

<footer>

</footer>

</body>
