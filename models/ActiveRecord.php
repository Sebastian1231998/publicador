<?php

namespace Model;


class ActiveRecord
{


    //Propiedades staticas 

    protected static $db;
    protected static $errores = [];

    protected $columnDB = [];
    protected static $tabla = '';


    public static function setDB($bd)
    {

        self::$db = $bd;
    }

    public function setImagen($imagen, $val = false)
    {

        if ($this->id_usuario && $val) {
            unlink(CARPETA_IMAGENES_PROFILE . $this->foto_perfil);
        }

        if ($imagen) {
            $this->foto_perfil = $imagen;
        }
    }


    public static function findId($id)
    {

        $query = "SELECT * FROM ";
        $query .=  static::$tabla . " ";

      
        return static::consultaQueryId( $query, $id);
    }

    public static function findCorreo($correo)
    {

        $query = "SELECT * FROM ";
        $query .=  static::$tabla . " ";
      
        return static::consultaQueryCorreo( $query, $correo);
    }


    public static function consultaQueryCorreo($query, $correo)
    {
        $query .= "where correo = '${correo}'";
        $resultado = self::$db->query($query);
        return  $resultado;
    }

    public static function consultaQueryId($query, $id)
    {
        $query .= "where id_usuario = ${id}";
        $resultado = self::getPropiedades($query);
        return  $resultado[0];
    }


    public function guardar()
    {


        $atributos = $this->santitizarDatos();

    

        if(static::$tabla == 'like_user'){
            $str = join(",", array_keys($atributos));
            $str_val = join(",", array_values($atributos));
            $query = "INSERT INTO " . static::$tabla . "($str)";
            $query .= " VALUES ($str_val)";
        }else{

            $str = join(",", array_keys($atributos));
            $str_val = join("','", array_values($atributos));
            $query = "INSERT INTO " . static::$tabla . "($str)";
            $query .= " VALUES ('$str_val')";
        }
    

  
        return self::$db->query($query);
    }


    public function eliminar_($args = [])
    {

    }

    public function identificaColumnDB()
    {

        $atributos = [];

        foreach ($this->columnDB as $column) {
            if ($column === "id_usuario" || 
            $column === "id_publicaciones" || 
            $column === "id_like" || 
            $column === "id_messages" ||
            $column === "id_comentario"

            )  continue;
            $col = $this->$column;

            $atributos[$column] = $col;
        }

        return $atributos;
    }

    public function santitizarDatos()
    {

        $atr = $this->identificaColumnDB();
        $sanitizado = [];


        foreach ($atr as $key => $value) {

            $sanitizado[$key] = self::$db->escape_string($value);
        }


        return $sanitizado;
    }

    
    

    public function validarCampos()
    {


        if (static::$tabla == "usuario") {

            if (!$this->correo) {

                self::$errores[] = "El email es obligatorio o no es valido ";
            }

            if (!$this->password) {

                self::$errores[] = "El password es obligatorio ";
            }
        }


        if (static::$tabla == "publicaciones_profile") {


            if (
                !$this->titulo ||
                !$this->contenido ||
                !$this->categoria  
                
            ) {

                self::$errores[] = "todos los campos son obligatorios";
            }
            if(!$this->imagen){
                self::$errores[] = "La imagen es obligatoria";
            }
         
        }
    }

    public static function devolverErrores()
    {

        return self::$errores;
    }


    public static function all()
    {

        $query = "SELECT * FROM ";
        $query .= static::$tabla;


        $resultado = self::getPropiedades($query);

        return $resultado;
    }

    public static function getPropiedades($query)
    {

        $array = [];
        $resultado = self::$db->query($query);
        

        while ($registro = $resultado->fetch_assoc()) {

            $array[] =  self::crearObjeto($registro);
        }

        return $array;
    }

    protected static function crearObjeto($registro)
    {

        $objeto = new static;


        foreach ($registro as $key => $value) {

            if (property_exists($objeto,  $key)) {
                $objeto->$key =  $value;
            }
        }
        return $objeto;
    }


    public function sincronizar($args = [])
    {


        foreach ($args as $key => $value) {

            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function actualizarDatos()
    {


        $atributos = $this->santitizarDatos();
        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "${key} = '{$value}'";
        }

        

        $sql = "UPDATE " . static::$tabla . " SET ";
        $sql .= join(",", $valores);


      
        if(static::$tabla == "publicaciones_profile"){

          $sql .= "where id_publicaciones = '$this->id_publicaciones'";

        }
        elseif(static::$tabla == "like_user"){

            $sql .= "where idPublicacion = $this->idPublicacion AND idUsuario=$this->idUsuario";
         

        }
        else{

            $sql .= "where id_usuario = '$this->id_usuario'";
        }

        
        $result =  self::$db->query($sql);


     
        return $result;
        
    }

    public static function propiedadesLimit($limit){

        $consulta = "SELECT * FROM propiedades LIMIT ${limit}";
        $resultado = self::getPropiedades($consulta);

        return $resultado;
    }


    public static function publicacionProfile($id){

        $consulta = "SELECT * FROM publicaciones_profile where usuarioId = ${id} ORDER BY fecha desc";
        $resultado = self::getPropiedades($consulta);

        return $resultado;
    }

    
    public static function messagesProfile($id_recibe,$id_envia){

        $consulta = "SELECT * from messages where idUsuarioRecibe = ${id_recibe} and idUsuarioEnvia = ${id_envia} or idUsuarioRecibe = ${id_envia} and idUsuarioEnvia = ${id_recibe}";
        $resultado = self::getPropiedades($consulta);

 

        
        return $resultado;
    }




    public static function publicacionProfileHome(){

        $consulta = "SELECT * , NOW() AS fecha_actual, DATEDIFF(NOW(), fecha) as diferencia from perfiles.publicaciones_profile where DATEDIFF(NOW(), fecha) < 10 ORDER BY fecha desc LIMIT 20";
        $resultado = self::getPropiedades($consulta);

        return $resultado;
    }

    public static function getIds(){

        $consulta = "SELECT idUsuarioRecibe, idUsuarioEnvia  FROM messages GROUP BY idUsuarioRecibe , idUsuarioEnvia;";
        $resultado = self::$db->query($consulta);
        
        return $resultado;
    }

    public static function getUltimateMessage($user_id, $other_user){

        
        $consulta = "SELECT contenido, 
        fecha_creacion, 
        idUsuarioRecibe,
        idUsuarioEnvia  
        from messages 
        where idUsuarioRecibe = ${user_id} and idUsuarioEnvia = $other_user 
        or idUsuarioRecibe = $other_user and idUsuarioEnvia = ${user_id} 
        ORDER BY fecha_creacion desc LIMIT 1";

        

        $resultado = self::$db->query($consulta);
        return $resultado;


    }

    
    public static function usersLikes($id_publicaciones){

        $consulta = "SELECT * from like_user INNER JOIN usuario ON like_user.idUsuario = usuario.id_usuario WHERE idPublicacion = {$id_publicaciones}";
        $resultado = self::$db->query($consulta);
        return $resultado;
    }

    public static function validarId($resultado){

    
      if( $resultado->num_rows == 0){

        header("Location: ../admin");
      }
         
    }

 



}
