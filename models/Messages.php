<?php namespace Model;

class Messages extends ActiveRecord{

    protected static $tabla = "messages";

    protected $columnDB = ['id_messages','contenido','idUsuarioRecibe','idUsuarioEnvia', 'fecha_creacion'];

   
    public  function __construct($args = [])
    {
        $this->id_messages = $args['id_messages'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->idUsuarioRecibe = $args['idUsuarioRecibe'] ?? '';
        $this->idUsuarioEnvia = $args['idUsuarioEnvia'] ?? '';
        $this->fecha_creacion = $args['fecha_creacion'] ?? '';
    
    }


}