<?php


include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if(ControlSesion :: sesion_iniciada()){
    Redireccion :: redirigir(SERVIDOR);
}

if(isset($_POST['login'])){
    Conexion::abrir_conexion();
    $validador = new ValidadorLogin($_POST['email'], $_POST['clave'], Conexion::obtener_conexion());
    
    if($validador -> obtener_error() === "" && !is_null($validador -> obtener_usuario())){
        //iniciar sesion
        ControlSesion :: iniciar_sesion(
                $validador -> obtener_usuario() -> obtener_id(),
                $validador -> obtener_usuario() -> obtener_nombre()
                );
        //redirigir a index
        Redireccion :: redirigir(SERVIDOR); 
    }
    
    Conexion::cerrar_conexion();
    
}

$titulo = 'login';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-3">           
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4>iniciar sesion</h4>
                </div>
                <div class="panel-body">
                    <form role='form' method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
                        <h2>introduce tus datos</h2>                        
                        <br>                        
                        <label for="email" class="sr-only">Email</label>                         
                        <input type="email" name="email" id="email" class="form-control" placeholder="introduce tu email" 
                               <?php 
                               if (isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])){
                                   echo 'value="' . $_POST['email'] . '"';
                               }
                               
                               ?>
                               required autofocus>                         
                        <br>                        
                        <label for="email" class="sr-only">Contrasena</label>                         
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="introduce tu contrasena" required>
                        <br>
                        <br>
                        <?php 
                               if ($_POST ['login']){
                                   $validador -> mostrar_error();
                               }
                        ?>
                        <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">Iniciar sesion</button>
                    </form>
                    <br>
                    <br>   
                    <div class="text-center">
                        <a href="#">Olvidaste tu contrasena?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>