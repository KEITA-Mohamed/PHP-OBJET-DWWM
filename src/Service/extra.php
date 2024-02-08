<?php 

function charger($class){

    $fileClass = str_replace("App","src",$class).".php";
    $fileClass = str_replace("\\","/",$fileClass);

    if(file_exists($fileClass)){

        $page = new $fileClass();
    }
}

function charger_old($class){  // le parametre $class contient le nom de la class à instancier avec new
        $fileModel="Model/$class.php"; // Exemple si  $class="Arctile" alors $fileModel="Model/Article.php"
        $fileController="Controller/$class.php";
        $fileView="View/$class.php";
        $fileService="Service/$class.php";
        $files=[$fileModel,$fileController,$fileView,$fileService];
        foreach($files as $file){
            if(file_exists($file)){
                require_once($file);
            }
        }
    }



        function printr($array){
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }