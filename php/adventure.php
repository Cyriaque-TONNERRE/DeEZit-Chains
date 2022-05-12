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
        exec("randomGenerate $seed 5", $tab);
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
                    echo "<td class=nordgauchebas>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($droite == false) && ($gauche == false) && ($bas == false)){
                    echo "<td class=droitegauchebas>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($droite == false) && ($nord == false) && ($bas == false)){
                    echo "<td class=droitenordbas>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($droite == false) && ($nord == false) && ($gauche == false)){
                    echo "<td class=droitenordgauche>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($nord == false) && ($gauche == false)){
                    echo "<td class=nordgauche>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($nord == false) && ($droite == false)){
                    echo "<td class=norddroite>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($nord == false) && ($bas == false)){
                    echo "<td class=nordbas>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($gauche == false) && ($bas == false)){
                    echo "<td class=gauchebas>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($gauche == false) && ($nord == false)){
                    echo "<td class=gauchenord>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($gauche == false) && ($droite == false)){
                    echo "<td class=gauchedroite>".$tab[$colonne][$ligne]."</td>";
                }
                else if(($bas == false) && ($droite == false)){
                    echo "<td class=basdroite>".$tab[$colonne][$ligne]."</td>";
                }
                else if($gauche == false){
                    echo "<td class=gauche>".$tab[$colonne][$ligne]."</td>";
                }
                else if($droite == false){
                    echo "<td class=droite>".$tab[$colonne][$ligne]."</td>";
                }
                else if($nord == false){
                    echo "<td class=nord>".$tab[$colonne][$ligne]."</td>";
                }
                else if($bas == false){
                    echo "<td class=bas>".$tab[$colonne][$ligne]."</td>";
                }
                else{
                    echo "<td>".$tab[$colonne][$ligne]."</td>";
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
</main>
	

<footer>

</footer>

</body>
</html>
