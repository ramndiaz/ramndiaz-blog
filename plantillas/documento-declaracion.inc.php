   <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <?php 
        if(!isset($titulo) || empty($titulo)){
            $titulo = 'blog de ramndiazgz';
        }
            echo "<title>$titulo</title>";
        ?>
        
        <link href="<?php echo RUTA_CSS ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo RUTA_CSS ?>estilos.css" rel="stylesheet">
    </head>
    <body>

