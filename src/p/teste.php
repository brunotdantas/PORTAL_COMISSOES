<?php
/*
foreach ($_POST as $key => $value) {
  echo '<p>'.$key.'</p>';
    foreach($value as $k => $v){
     echo '<p>'.$k.'</p>';
     echo '<p>'.$v.'</p>';
     echo '<hr />';
    }
}
*/
include '../config/configdb.php';
$flag = 2;//erro
//var_dump($_FILES);

//--------------------------------
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
/*
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
*/
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
// só permite upload de csv
if($_FILES["fileToUpload"]["type"] != 'application/vnd.ms-excel'){
    $mensagem= "Nenhum arquivo foi selecionado";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        // lê o XML
        $file = basename($_FILES["fileToUpload"]["name"]);
        $row = 1;
        if (($handle = fopen('uploads/'.$file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                //echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                $listaDados = array();

                for ($c=0; $c < $num; $c++) {

                    //echo $data[$c] . "<br />\n";

                    // Transforma
                    $linha = explode(";",$data[$c]);

                    //0 => Loja
                    //1 => ValorMeta
                    //2 => Mes
                    //3 => Ano

                    //Insere no banco tentando deletar primeiro
                    try {

                        $loja = strval($linha[0]);

                        var_dump($linha[0]);
                        $query = "DELETE FROM   Metas WHERE
                                    idLojas = '$linha[0]'
                                    and mes     = '$linha[2]'
                                    and ano     = '$linha[3]'
                                ";
                        $result = sqlsrv_query($conn,$query);
                        if( $result === false ) {
                            //TODO Controlar o erro para retornar ao usuário die( var_dump( sqlsrv_errors(), true));
                            // --> Erro na query
                            $err = 0;

                        }

                        $query = "INSERT INTO Metas (idLojas,ValorMeta,mes,ano)
                                  values('$linha[0]','$linha[1]','$linha[2]','$linha[3]')
                                  ";
                        $result = sqlsrv_query($conn,$query);
                        if( $result === false ) {
                          //TODO Controlar o erro para retornar ao usuário die( var_dump( sqlsrv_errors(), true));
                          //$flag = 1;//sucesso
                        }else {
                          $flag = 1;//sucesso
                        }

                    } catch (Exception $e) {}
                }

            }
            fclose($handle);
        }
        // deleta o arquivo
        unlink('uploads/'.$file);

    } //else {
        //echo "Sorry, there was an error uploading your file.";
    //}
}

header("location: ../p/importa_metas.php?flag=$flag");

?>
