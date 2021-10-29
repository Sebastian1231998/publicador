<?php namespace Model;

class Usuario extends ActiveRecord{

    protected static $tabla = "usuario";

    protected $columnDB = ['id_usuario', 'nombre', 'apellido', 'correo','password','fecha_nacimiento','genero','foto_perfil', 'fecha_creacion'];


  
   
    public  function __construct($args = [])
    {
        $this->id_usuario = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->genero = $args['genero'] ?? '';
        $this->foto_perfil = $args['foto_perfil'] ?? '';
        $this->fecha_creacion = $args['fecha_creacion'] ?? '';
      
    }



    public function consultarUsuario($resultado){

        $result = $resultado->fetch_assoc();


 
        $auth = password_verify($this->password, $result["password"]);
 
        if ($auth) {
 
            $int_id = (int)$result["id_usuario"];
        
           session_start();
           $_SESSION["usuario"] = $this->correo;
           $_SESSION["login"] = true;
           $_SESSION['profile_id'] = $int_id;
           $_SESSION['foto_perfil'] = $result["foto_perfil"];
           
           
          
           header('Location: ./user/profile?id='. $int_id);
        } else {
 
           self::$errores[] = "El usuario o password es incorrecto ";
        }
 
     }


     public static function updateNotificacion($id_usuario,$val){

   
        if($val){
         $consulta = "UPDATE usuario SET mensajes_recibidos= mensajes_recibidos - 1  where id_usuario = ${id_usuario}";
      
        }else{

         $consulta = "UPDATE usuario SET mensajes_recibidos= mensajes_recibidos + 1  where id_usuario = ${id_usuario}";
    
        }

        $resultado = self::$db->query($consulta);
       
        return $resultado;
     }

     
     public static function consultProfileNotification($usuario){

        $consulta = "SELECT mensajes_recibidos FROM usuario WHERE id_usuario=${usuario}";
        $resultado = self::$db->query($consulta);

        return $resultado;
     }



}
   