<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'paciente_fichamedica' table.
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
class PacienteFichamedicaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.PacienteFichamedicaTableMap';

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
        $this->setName('paciente_fichamedica');
        $this->setPhpName('PacienteFichamedica');
        $this->setClassname('AppBundle\\Model\\PacienteFichamedica');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('fme_id', 'FmeId', 'INTEGER' , 'ficha_medica', 'fme_id', true, null, null);
        $this->addForeignPrimaryKey('pac_id', 'PacId', 'INTEGER' , 'paciente', 'pac_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('FichaMedica', 'AppBundle\\Model\\FichaMedica', RelationMap::MANY_TO_ONE, array('fme_id' => 'fme_id', ), null, null);
        $this->addRelation('Paciente', 'AppBundle\\Model\\Paciente', RelationMap::MANY_TO_ONE, array('pac_id' => 'pac_id', ), null, null);
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

} // PacienteFichamedicaTableMap
