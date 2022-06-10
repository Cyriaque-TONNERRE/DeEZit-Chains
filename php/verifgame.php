<?php require './header.php';

if(isset($_GET["id"])){
    if (file_exists($_GET["id"])) {
        $chemin = $_GET["id"];
        
        $json = file_get_contents($_GET["id"]);
        $data = json_decode($json, false);
        $size = count($data->level);
        $lvl = "";
        for ($i = 0; $i < $size; $i++){
            $lvl = $lvl . $data->level[$i];
            if($i < $size - 1){
                $lvl = $lvl . " ";
            }

        }
        if (DIRECTORY_SEPARATOR == '\\') {
            exec("solver.exe $lvl", $tab,$t);
        } else {
            exec("chmod a+x ./solver");
            exec("./solver $lvl", $tab,$t);
        }
        if($tab[0] == "solved"){
            echo "<div class='reponse'>Level is solvable.
            <br>
            <a class='dark' href='importgame.php?id=$chemin'>Ok</a>
            </div>";
        }
        else{
            echo "<div class='reponse'>Level is not solvable.
            <br>
            <a class='dark' href='index.php'>Ok</a>
            </div>";
        }
    }
    else{
        header("Location:index.php");
    }
}
else{
    header("Location:index.php");
}




    ?>