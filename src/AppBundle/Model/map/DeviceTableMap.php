<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'device' table.
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
class DeviceTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.DeviceTableMap';

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
        $this->setName('device');
        $this->setPhpName('Device');
        $this->setClassname('AppBundle\\Model\\Device');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('dev_id', 'DevId', 'INTEGER', true, null, null);
        $this->addForeignKey('upr_id', 'UprId', 'INTEGER', 'usuario_profesional', 'upr_id', false, null, null);
        $this->addForeignKey('upa_id', 'UpaId', 'INTEGER', 'usuario_padre', 'upa_id', false, null, null);
        $this->addColumn('dev_app_version', 'DevAppVersion', 'VARCHAR', false, 20, null);
        $this->addColumn('dev_cordova', 'DevCordova', 'VARCHAR', false, 30, null);
        $this->addColumn('dev_model', 'DevModel', 'VARCHAR', false, 20, null);
        $this->addColumn('dev_platform', 'DevPlatform', 'VARCHAR', false, 30, null);
        $this->addColumn('dev_uuid', 'DevUuid', 'VARCHAR', false, 50, null);
        $this->addColumn('dev_version', 'DevVersion', 'VARCHAR', false, 50, null);
        $this->addColumn('dev_manufacturer', 'DevManufacturer', 'VARCHAR', false, 20, null);
        $this->addColumn('dev_isvirtual', 'DevIsvirtual', 'VARCHAR', false, 20, null);
        $this->addColumn('dev_serial', 'DevSerial', 'VARCHAR', false, 50, null);
        $this->addColumn('dev_token_apn', 'DevTokenApn', 'VARCHAR', false, 1000, null);
        $this->addColumn('dev_ver_app_name', 'DevVerAppName', 'VARCHAR', false, 20, null);
        $this->addColumn('dev_ver_package_name', 'DevVerPackageName', 'VARCHAR', false, 50, null);
        $this->addColumn('dev_ver_code', 'DevVerCode', 'VARCHAR', false, 20, null);
        $this->addColumn('dev_ver_number', 'DevVerNumber', 'VARCHAR', false, 20, null);
        $this->addColumn('dev_estado', 'DevEstado', 'SMALLINT', false, null, 1);
        $this->addColumn('dev_eliminado', 'DevEliminado', 'BOOLEAN', false, 1, false);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('UsuarioProfesional', 'AppBundle\\Model\\UsuarioProfesional', RelationMap::MANY_TO_ONE, array('upr_id' => 'upr_id', ), null, null);
        $this->addRelation('UsuarioPadre', 'AppBundle\\Model\\UsuarioPadre', RelationMap::MANY_TO_ONE, array('upa_id' => 'upa_id', ), null, null);
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

} // DeviceTableMap
