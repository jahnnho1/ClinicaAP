<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'usuario_administrativo' table.
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
class UsuarioAdministrativoTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.UsuarioAdministrativoTableMap';

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
        $this->setName('usuario_administrativo');
        $this->setPhpName('UsuarioAdministrativo');
        $this->setClassname('AppBundle\\Model\\UsuarioAdministrativo');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('usu_id', 'UsuId', 'INTEGER', true, null, null);
        $this->addForeignKey('cli_id', 'CliId', 'INTEGER', 'clinica', 'cli_id', false, null, null);
        $this->addColumn('usu_nombre', 'UsuNombre', 'VARCHAR', false, 100, null);
        $this->addColumn('usu_apellido', 'UsuApellido', 'VARCHAR', false, 100, null);
        $this->addColumn('usu_email', 'UsuEmail', 'VARCHAR', false, 60, null);
        $this->addColumn('usu_rut', 'UsuRut', 'VARCHAR', false, 60, null);
        $this->addColumn('usu_clave', 'UsuClave', 'VARCHAR', false, 200, null);
        $this->addColumn('usu_estado', 'UsuEstado', 'SMALLINT', false, null, null);
        $this->addColumn('usu_eliminado', 'UsuEliminado', 'SMALLINT', false, null, null);
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

} // UsuarioAdministrativoTableMap
