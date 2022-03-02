<?php
namespace models;

/**
 * Clase Categoria
 * @author obarcia
 */
final class Categoria extends Base
{
    /**
     * Nombre de la tabla.
     * @return string Nombre de la tabla.
     */
    public static function getTablename() { return "categorias"; }

    /**
     * Validar el Categoria.
     * @return boolean true si la validación es correcta, false en caso contrario.
     */
    protected function validate()
    {
        //el nombre es olbigatorio siempre
        if (!trim($this->nombre)) return false;

        //Nombre: máximo 160 caracteres en UTF‐8
        if (strlen(utf8_encode($this->nombre))>160) return false;

        //Descripción: máximo 258 caracteres en UTF‐8
        if (strlen(utf8_encode($this->descripcion))>258) return false;

        return true;
    }

    public static function findOne($id)
    {
        if (!$object = parent::findOne($id)) return null;

        $categoria = new self();
        $categoria->setId($object->id)
            ->setNombre($object->nombre)
            ->setDescripcion($object->descripcion);

        return $categoria;
    }

    public static function findAll()
    {
        if (!$result = parent::findAll()) return [];
        $list = [];
        foreach ($result as $object) {
            $categoria = new self();
            $categoria->setId($object->id)
                ->setNombre($object->nombre)
                ->setDescripcion($object->descripcion);
            $list[] = $categoria;
        }
        return $list;
    }

    /**
     * Exportar los Categorias a XML.
     * @return string XML como string.
     */
    public static function exportXML()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString("	");
        $xml->startDocument("1.0", "UTF-8");
        $xml->startElement("categorias");
        $categorias = self::findAll();
        foreach ($categorias as $categoria) {
            $xml->startElement("categoria");
                $xml->writeAttribute("id", $categoria->getId());
                $xml->writeElement("nombre", $categoria->getNombre());
                $xml->writeElement("descripcion", $categoria->getDescripcion());
            $xml->endElement();
        }
        $xml->endElement();
        return $xml->outputMemory();
    }

    public function exportEntityInXml()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString("	");
        $xml->startDocument("1.0", "UTF-8");
        $xml->startElement("categoria");
        $xml->writeAttribute("id", $this->getId());
            $xml->writeElement("nombre", $this->getNombre());
            $xml->writeElement("descripcion", $this->getDescripcion());
        $xml->endElement();
        return $xml->outputMemory();
    }
}