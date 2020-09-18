<?php
namespace Libs\Actions;

use Lig\Db\ComponentMysql;

class Actividad1
{
    private $post;
    private $keys;

    private $errors = [];
    private $errfield = "titulo";

    public function __construct(array $post)
    {
        //var_dump("post:",$_POST);
/*
 'titulo' => string 'aa' (length=2)
  'director' => string 'bb' (length=2)
  'anio' => string '' (length=0)
  'pais' => string 'DE' (length=2)
 */
        $this->_trimpost($post);
        $this->post = $post;
        $this->keys = array_keys($post);
    }

    private function _scape(&$value){$value = str_replace("'","\'",$value);}

    private function _get_insert_sql()
    {
        list($titulo,$director,$anio,$pais) = array_values($this->post);

        $this->_scape($titulo);
        $this->_scape($director);
        $this->_scape($pais);
        $anio = ($anio==="") ? "NULL" : (int) $anio;

        $sql = "
        INSERT INTO peliculas (titulo, director, anio, pais) VALUES ('$titulo','$director',$anio,'$pais')
        ";
        return $sql;
    }

    private function _trimpost(&$post){
        foreach ($post as $k =>$value){
            $post[$k] = trim($value);
        }
    }

    private function _get_post($key){
        if(!in_array($key,$this->keys)) return null;
        return $this->post[$key];
    }

    private function _validate_input()
    {
        if(!trim($this->_get_post("titulo"))) {
            $this->errfield = "titulo";
            return $this->errors[] = "El título es obligatorio";
        }

        if(strlen($this->_get_post("director"))>255) {
            $this->errfield = "director";
            return $this->errors[] = "El nombre del director no puede superar los 255 caractéres";
        }

        if(
            $this->_get_post("anio")!=="" &&
            (!is_numeric($this->_get_post("anio")) || strlen($this->_get_post("anio"))<4)
        ) {
            $this->errfield = "anio";
            return $this->errors[] = "El año debe ser entero de 4 dígitos";
        }

        if(strlen($this->_get_post("pais"))>2) {
            $this->errfield = "pais";
            return $this->errors[] = "El código de país no debe superar los dos caractéres";
        }
    }

    public function save(){
        if(!$this->post) return;
        $this->_validate_input();

        //si se ha detectado un error en la validación nos salimos
        if($this->is_error()) return;

        $sql = $this->_get_insert_sql();
        $r = [];
        try{
            $db = new ComponentMysql();
            $r = $db->exec($sql);
            //si todo ha ido bien limpio el POST
            $_POST = [];
        }
        catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }
        catch (\Error $err){
            $this->errors[] = $err->getMessage();
        }
        finally {
            return $r;
        }
    }

    public function is_post(){return count($this->keys)>0;}

    public function is_error(){ return count($this->errors)>0;}

    public function get_errors(){return $this->errors;}

    public function get_errfield(){return $this->errfield;}
}