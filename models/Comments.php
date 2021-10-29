<?php namespace Model;


class Comments extends ActiveRecord{

    protected static $tabla = "comentarios_publicaciones";

    protected $columnDB = ['id_comentario', 'descripcion_comentario','idUsuario','idPublicacion'];

   
    public  function __construct($args = [])
    {
        $this->id_comentario = $args['id_comentario'] ?? '';
        $this->descripcion_comentario = $args['descripcion_comentario'] ?? '';
        $this->idUsuario = $args['idUsuario'] ?? '';
        $this->idPublicacion = $args['idPublicacion'] ?? '';
     
    }



    public static function consultaComment($id_publicacion){

        $consulta = "SELECT nombre,apellido,foto_perfil,descripcion_comentario from usuario INNER JOIN comentarios_publicaciones ON usuario.id_usuario = comentarios_publicaciones.idUsuario WHERE idPublicacion = ${id_publicacion} ORDER BY descripcion_comentario asc";
        $resultado = self::$db->query($consulta);


        return $resultado;
    }



}