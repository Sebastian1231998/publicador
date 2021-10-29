<?php namespace Model;

class Like extends ActiveRecord{

    protected static $tabla = "like_user";

    protected $columnDB = ['id_like','local_like','idUsuario','idPublicacion'];

    
   
    public  function __construct($args = [])
    {
        $this->id_like = $args['id_like'] ?? '';
        $this->local_like = $args['local_like'] ?? 0;
        $this->idUsuario = $args['idUsuario'] ?? '';
        $this->idPublicacion = $args['idPublicacion'] ?? '';
    
    }


    public static function consultLike($id,){

        $consulta = "SELECT local_like,idPublicacion FROM like_user where idUsuario = ${id}";
        $resultado = self::getPropiedades($consulta);

        return $resultado;
    }

    public static function consultLikePublic($id,$id_publicacion){

        $consulta = "SELECT local_like,idPublicacion FROM like_user where idUsuario = ${id} AND idPublicacion = {$id_publicacion} ";
        $resultado = self::getPropiedades($consulta);

        return $resultado;
    }

    public function setLocal($local_like){
        

        $this->local_like = $local_like;
    }



}