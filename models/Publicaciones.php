<?php namespace Model;

use Model\Like;

class Publicaciones extends ActiveRecord{

    protected static $tabla = "publicaciones_profile";

    protected $columnDB = ['id_publicaciones', 'titulo', 'contenido', 'categoria','fecha','imagen','likes' ,'usuarioId'];

   
    public  function __construct($args = [])
    {
        $this->id_publicaciones = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->likes = $args['likes'] ?? 0;
        $this->usuarioId = $args['usuarioId'] ?? '';
       
    }


    public function setImagen($imagen, $val = false)
    {
        if ($this->id_publicaciones && $val) {
            unlink(CARPETA_IMAGENES_PROFILE . $this->foto_perfil);
        }

        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    
    public function setFecha(){

        $fechaActual = getdate();


        $formato = $fechaActual["year"] . "-0" . $fechaActual["mon"] . "-0" - ($fechaActual["mday"] - 1) . " " . $fechaActual["hours"] . ":" . $fechaActual["minutes"] . ":" . $fechaActual["seconds"] ;

        $this->fecha =  $formato;
    }

    public static function publicacionProfileLike($id_publicaciones){

        $consulta = "SELECT * FROM publicaciones_profile where id_publicaciones= ${id_publicaciones}";
        $resultado = self::getPropiedades($consulta);
        return $resultado;
    }

    
    public function setLikes($cantidad_likes,$valLike, $id_publicacion){




        if($valLike["local_like"] == 1){
            
            $cantidad_likes += 1;
            
         }else if($valLike["local_like"] == 0 && $cantidad_likes >= 1){
             
            $cantidad_likes -= 1; 

         }else if($valLike["local_like"] == 0 && $cantidad_likes == 0){
            $cantidad_likes = 1;
            $cantidad_likes -= 1; 
         }
         


         
     
         $sql = "UPDATE publicaciones_profile SET likes=${cantidad_likes} WHERE id_publicaciones = ${id_publicacion}";
    

      

        static::$db->query($sql);
         
    }   


    
    public static function consultLikeCount($id_publicaciones){

        $consulta = "SELECT likes FROM publicaciones_profile WHERE id_publicaciones=${id_publicaciones}";
        $resultado = self::$db->query($consulta);
        return $resultado;
    }




}