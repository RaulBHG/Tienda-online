<?php
include "config.php";
include "funciones.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    $action = $_POST["action"];

    switch ($action) {
        case 'añadir':
            $name = $_POST["name"];
            $description = $_POST["description"];

            $tipo = $_POST["tipo"];

            $imagen = "";

            if ( 0 < $_FILES['imagen']['error'] ) {
                echo 'Error: ' . $_FILES['imagen']['error'] . '<br>';
            }
            else {
                $imagen = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../productos/' . $imagen);
            }

            //Test multiples imagenes

            $countfiles = count($_FILES['imagenes']['name']);
            $upload_location = "../productos/";
            $arrayImagenes = array();

            for($i = 0; $i < $countfiles; $i++){

                if(isset($_FILES['imagenes']['name'][$i]) && $_FILES['imagenes']['name'][$i] != ''){
                   // File name
                   $filename = $_FILES['imagenes']['name'][$i];
             
                   // Get extension
                   $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
             
                   // Valid image extension
                   $valid_ext = array("png","jpeg","jpg");
             
                   // Check extension
                   if(in_array($ext, $valid_ext)){
             
                      // File path
                      $path = $upload_location.$filename;
             
                      // Upload file
                      if(move_uploaded_file($_FILES['imagenes']['tmp_name'][$i],$path)){
                         $arrayImagenes[] = $filename;
                      }
                   }
                }
             }
             $stringImagenes = implode(",", $arrayImagenes);

            mysqli_query($con, "INSERT INTO productos (name, description, imagen, imagenes, tipo) VALUES ('$name', '$description', '$imagen', '$stringImagenes', '$tipo')");

            //Fin test
            break;


        case "eliminar":
            $id = $_POST['id'];
            mysqli_query($con, "DELETE FROM productos WHERE id=$id");
            break;

        case "portada":
            $id = $_POST['id'];
            $activo = $_POST['activo'];
            mysqli_query($con, "UPDATE productos SET portada='$activo' WHERE id=$id");
            break;

        case 'mostrarEdit':
            $qEdit = mysqli_query($con, "SELECT * FROM productos WHERE id = '$id'");
            $r = mysqli_fetch_array($qEdit);
            echo ($r["name"].";".$r["description"]);
            break;

        case 'editar':
            $id = $_POST['id'];
            $name = $_POST['name'];
		    $description = $_POST['description'];

            $imagen = "";
            $imagenes = "";

            if ( 0 < $_FILES['imagen']['error'] ) {
                echo 'Error: ' . $_FILES['imagen']['error'] . '<br>';
            }
            else {
                $imagen = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../productos/' . $imagen);
            }

            //Test multiples imagenes

            $countfiles = count($_FILES['imagenes']['name']);
            $upload_location = "../productos/";
            $arrayImagenes = array();

            for($i = 0; $i < $countfiles; $i++){

                if(isset($_FILES['imagenes']['name'][$i]) && $_FILES['imagenes']['name'][$i] != ''){
                   // File name
                   $filename = $_FILES['imagenes']['name'][$i];
             
                   // Get extension
                   $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
             
                   // Valid image extension
                   $valid_ext = array("png","jpeg","jpg");
             
                   // Check extension
                   if(in_array($ext, $valid_ext)){
             
                      // File path
                      $path = $upload_location.$filename;
             
                      // Upload file
                      if(move_uploaded_file($_FILES['imagenes']['tmp_name'][$i],$path)){
                         $arrayImagenes[] = $filename;
                      }
                   }
                }
             }

             $stringImagenes = implode(",", $arrayImagenes);
             
             $and = "";
             if ($imagen != "") {
                $and .= ", imagen='$imagen'";
             }
             if ($stringImagenes != "") {
                $and .= ", imagenes='$stringImagenes'";
            }
            echo $and;
            mysqli_query($con, "UPDATE productos SET name='$name', description='$description' $and WHERE id=$id");

            break;

        case 'email':
            
            require '../PHPMailer-master/src/Exception.php';
            require '../PHPMailer-master/src/PHPMailer.php';
            require '../PHPMailer-master/src/SMTP.php';

            $nombre = utf8_decode($_POST["nombre"]);
            $apellidos = utf8_decode($_POST["ape"]);
            $email = utf8_decode($_POST["mail"]);
            $tel = $_POST["tel"];
            $message = utf8_decode($_POST["message"]);

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Mailer = "smtp";

            $mail->SMTPDebug  = 1;  
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "trabajosifp@gmail.com";
            $mail->Password   = "raulcarlosgeo";

            $mail->IsHTML(true);
            $mail->AddAddress("raulblazquezhernangomez@gmail.com");
            $mail->SetFrom($email);
            $mail->AddReplyTo($email);
            $mail->Subject = "Comentario en la web de ".$nombre." ".$apellidos ;
            $content = "<b>Email de: ".$email."<br> Tel: ".$tel.". <br> Texto: ".$message."</b>";

            $mail->MsgHTML($content); 
            if(!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
            } else {
            echo "Email sent successfully";
            }
            break;

        case 'añadir_tipo':
            $name = $_POST["name"];


            $imagen = "";

            if ( 0 < $_FILES['imagen']['error'] ) {
                echo 'Error: ' . $_FILES['imagen']['error'] . '<br>';
            }
            else {
                $imagen = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../productos/' . $imagen);
            }

            mysqli_query($con, "INSERT INTO tipo (nombre, imagen) VALUES ('$name', '$imagen')");

            //Fin test
            break;

        case 'editar_tipos':
            $id = $_POST['id'];
            $name = $_POST['name'];

            $imagen = "";

            if ( 0 < $_FILES['imagen']['error'] ) {
                echo 'Error: ' . $_FILES['imagen']['error'] . '<br>';
            }
            else {
                $imagen = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../productos/' . $imagen);
            }

            $and = "";
            if ($imagen != "") {
            $and .= ", imagen='$imagen'";
            }

            echo $and;
            mysqli_query($con, "UPDATE tipo SET nombre='$name' $and WHERE id=$id");

            break;

        case "eliminar_tipos":
            $id = $_POST['id'];
            mysqli_query($con, "DELETE FROM tipo WHERE id=$id");
            break;

        case 'mostrarEdit_tipo':
            $qEdit = mysqli_query($con, "SELECT * FROM tipo WHERE id = '$id'");
            $r = mysqli_fetch_array($qEdit);
            echo ($r["nombre"]);
            break;

        case 'añadir_new':
            $url = $_POST["url"];


            $imagen = "";

            if ( 0 < $_FILES['imagen']['error'] ) {
                echo 'Error: ' . $_FILES['imagen']['error'] . '<br>';
            }
            else {
                $imagen = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../productos/' . $imagen);
            }

            mysqli_query($con, "INSERT INTO news (imagen, url) VALUES ('$imagen', '$url')");

            //Fin test
            break;

        case 'editar_news':
            $id = $_POST['id'];
            $url = $_POST['url'];

            $imagen = "";

            if ( 0 < $_FILES['imagen']['error'] ) {
                echo 'Error: ' . $_FILES['imagen']['error'] . '<br>';
            }
            else {
                $imagen = $_FILES['imagen']['name'];
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../productos/' . $imagen);
            }

            $and = "";
            if ($imagen != "") {
            $and .= ", imagen='$imagen'";
            }

            echo $and;
            mysqli_query($con, "UPDATE news SET url='$url' $and WHERE id=$id");

            break;

        case "eliminar_news":
            $id = $_POST['id'];
            mysqli_query($con, "DELETE FROM news WHERE id=$id");
            break;

        case 'mostrarEdit_news':
            $qEdit = mysqli_query($con, "SELECT * FROM news WHERE id = '$id'");
            $r = mysqli_fetch_array($qEdit);
            echo ($r["url"]);
            break;
    
        
        default:
            
            break;
    }
    mysqli_close($con);
    

?>