<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'Comentario.inc.php';

class RepositorioComentario{
     public static function insertar_comentario($conexion, $comentario){
         $comentario_insertado = false;
        
        if(isset($conexion)){
            try {
                
                $sql = "INSERT INTO comentarios(autor_id, entrada_id, titulo, texto, fecha) VALUES(:autor_id, :entrada_id, :titulo, :texto, NOW())";
                
                $sentencia = $conexion -> prepare($sql);                               
                
                $autor_idbp = $comentario -> obtener_autor_id();
                $entrada_idbp = $comentario -> obtener_entrada_id();
                $titulobp = $comentario -> obtener_titulo();
                $textobp = $comentario -> obtener_texto();
                
                $sentencia -> bindParam(':autor_id', $autor_idbp, PDO::PARAM_STR);
                $sentencia -> bindParam(':entrada_id', $entrada_idbp, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $titulobp, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto', $textobp, PDO::PARAM_STR);
                
                $comentario_insertado = $sentencia -> execute();
                        
            } catch (PDOException $ex) { 
                print 'ERROR999' . $ex -> getMessage();
            }
        }
        return $comentario_insertado;
    }
}