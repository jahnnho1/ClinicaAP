<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'ficha_medica' table.
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
class FichaMedicaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.FichaMedicaTableMap';

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
        $this->setName('ficha_medica');
        $this->setPhpName('FichaMedica');
        $this->setClassname('AppBundle\\Model\\FichaMedica');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('fme_id', 'FmeId', 'INTEGER', true, null, null);
        $this->addColumn('fme_descripcion', 'FmeDescripcion', 'LONGVARCHAR', false, null, null);
        $this->addColumn('fme_nombre', 'FmeNombre', 'VARCHAR', false, 100, null);
        $this->addColumn('fme_numero_ficha', 'FmeNumeroFicha', 'INTEGER', false, null, null);
        $this->addColumn('fme_estado', 'FmeEstado', 'SMALLINT', false, null, null);
        $this->addColumn('fme_eliminado', 'FmeEliminado', 'SMALLINT', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PacienteFichamedica', 'AppBundle\\Model\\PacienteFichamedica', RelationMap::ONE_TO_MANY, array('fme_id' => 'fme_id', ), null, null, 'PacienteFichamedicas');
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

} // FichaMedicaTableMap
