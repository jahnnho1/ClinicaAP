<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'clinica' table.
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
class ClinicaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.ClinicaTableMap';

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
        $this->setName('clinica');
        $this->setPhpName('Clinica');
        $this->setClassname('AppBundle\\Model\\Clinica');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('cli_id', 'CliId', 'INTEGER', true, null, null);
        $this->addColumn('cli_nombre', 'CliNombre', 'VARCHAR', false, 100, null);
        $this->addColumn('cli_numero_mesa_central', 'CliNumeroMesaCentral', 'VARCHAR', false, 20, null);
        $this->addColumn('cli_numero_rescate', 'CliNumeroRescate', 'VARCHAR', false, 20, null);
        $this->addColumn('cli_direccion', 'CliDireccion', 'VARCHAR', false, 100, null);
        $this->addColumn('cli_estado', 'CliEstado', 'SMALLINT', false, null, null);
        $this->addColumn('cli_eliminado', 'CliEliminado', 'SMALLINT', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Blog', 'AppBundle\\Model\\Blog', RelationMap::ONE_TO_MANY, array('cli_id' => 'cli_id', ), null, null, 'Blogs');
        $this->addRelation('Recurso', 'AppBundle\\Model\\Recurso', RelationMap::ONE_TO_MANY, array('cli_id' => 'cli_id', ), null, null, 'Recursos');
        $this->addRelation('UsuarioAdministrativo', 'AppBundle\\Model\\UsuarioAdministrativo', RelationMap::ONE_TO_MANY, array('cli_id' => 'cli_id', ), null, null, 'UsuarioAdministrativos');
        $this->addRelation('UsuarioProfesional', 'AppBundle\\Model\\UsuarioProfesional', RelationMap::ONE_TO_MANY, array('cli_id' => 'cli_id', ), null, null, 'UsuarioProfesionals');
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

} // ClinicaTableMap
