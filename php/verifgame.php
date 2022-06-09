<?php

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
            header("Location:importgame.php?id=$chemin");
        }
        else{
            header("Location:index.php");
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