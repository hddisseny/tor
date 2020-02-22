<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TOR Installer</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500|Wire+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo TOR_CMS_CORE_URL; ?>/views/installer/style.css">

    <?php $database = new tor\core\Database(); ?>

</head>

    <body>

        <div class="tor-installer">

            <h1>tOR</h1>

            <b>Bienvenido\a a la instalación de tOR</b>

            <p>Se va a realizar la instalación utilizando los siguientes datos:</p>

            <ul>
                <li>Servidor: <span><?php echo $database->getHost(); ?></span></li>

                <li>Base de datos: <span><?php echo $database->getDBName(); ?></span></li>

                <li>Usuario: <span><?php echo $database->getUser(); ?></span></li>

                <li>Contraseña: <span>***</span></li>

            </ul>

            <form action="" method="post">
                
                <div class="input">
                    
                    <input name="submit" type="submit" value="Instalar"/>
                
                </div>
            
            </form>

            <div class="log">

 