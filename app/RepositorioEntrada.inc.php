<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'Entrada.inc.php';

class RepositorioEntrada{
    
    public static function insertar_entrada($conexion, $entrada){
         $entrada_insertada = false;
        
        if(isset($conexion)){
            try {
                
                $sql = "INSERT INTO entradas(autor_id, titulo, texto, fecha, activa) VALUES(:autor_id, :titulo, :texto, NOW(), 0)";
                
                $sentencia = $conexion -> prepare($sql);                               
                
                $autor_idbp = $entrada -> obtener_autor_id();
                $titulobp = $entrada -> obtener_titulo();
                $textobp = $entrada -> obtener_texto();
                
                $sentencia -> bindParam(':autor_id', $autor_idbp, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $titulobp, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto', $textobp, PDO::PARAM_STR);
                
                $entrada_insertada = $sentencia -> execute();
                        
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        return $entrada_insertada;
    }
    
    public static function obtener_todas_por_fecha_descendiente($conexion){
        $entradas = [];
        if (isset($conexion)){
            try {
                $sql = 'SELECT * FROM entradas ORDER BY fecha DESC LIMIT 10';
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)){
                    foreach ($resultado as $fila){
                        $entradas[] = new Entrada(
                                $fila['id'], $fila['autor_id'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']
                                );
                    }
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        return $entradas;
    }
}
