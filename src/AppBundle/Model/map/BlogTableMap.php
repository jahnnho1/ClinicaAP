<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'blog' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.AppBundle.Model.map
 */
class BlogTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.BlogTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('blog');
        $this->setPhpName('Blog');
        $this->setClassname('AppBundle\\Model\\Blog');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('blo_id', 'BloId', 'INTEGER', true, null, null);
        $this->addForeignKey('cli_id', 'CliId', 'INTEGER', 'clinica', 'cli_id', false, null, null);
        $this->addForeignKey('tpu_id', 'TpuId', 'INTEGER', 'tipo_publicacion', 'tpu_id', false, null, null);
        $this->addColumn('blo_titulo', 'BloTitulo', 'VARCHAR', false, 200, null);
        $this->addColumn('blo_autor', 'BloAutor', 'VARCHAR', false, 100, null);
        $this->addColumn('blo_breve_descripcion', 'BloBreveDescripcion', 'VARCHAR', false, 200, null);
        $this->addColumn('blo_descripcion', 'BloDescripcion', 'LONGVARCHAR', false, null, null);
        $this->addColumn('blo_estado', 'BloEstado', 'SMALLINT', false, null, null);
        $this->addColumn('blo_eliminado', 'BloEliminado', 'SMALLINT', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Clinica', 'AppBundle\\Model\\Clinica', RelationMap::MANY_TO_ONE, array('cli_id' => 'cli_id', ), null, null);
        $this->addRelation('TipoPublicacion', 'AppBundle\\Model\\TipoPublicacion', RelationMap::MANY_TO_ONE, array('tpu_id' => 'tpu_id', ), null, null);
        $this->addRelation('Comentario', 'AppBundle\\Model\\Comentario', RelationMap::ONE_TO_MANY, array('blo_id' => 'blo_id', ), null, null, 'Comentarios');
        $this->addRelation('Recurso', 'AppBundle\\Model\\Recurso', RelationMap::ONE_TO_MANY, array('blo_id' => 'blo_id', ), null, null, 'Recursos');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // BlogTableMap
