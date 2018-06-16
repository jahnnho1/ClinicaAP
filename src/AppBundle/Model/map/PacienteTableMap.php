<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'paciente' table.
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
class PacienteTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.PacienteTableMap';

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
        $this->setName('paciente');
        $this->setPhpName('Paciente');
        $this->setClassname('AppBundle\\Model\\Paciente');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('pac_id', 'PacId', 'INTEGER', true, null, null);
        $this->addColumn('pac_nombres', 'PacNombres', 'VARCHAR', false, 100, null);
        $this->addColumn('pac_apellidos', 'PacApellidos', 'VARCHAR', false, 100, null);
        $this->addColumn('pac_fecha_nacimiento', 'PacFechaNacimiento', 'TIMESTAMP', false, null, null);
        $this->addColumn('pac_sexo', 'PacSexo', 'SMALLINT', false, null, null);
        $this->addColumn('pac_rut', 'PacRut', 'VARCHAR', false, 20, null);
        $this->addColumn('pac_documento', 'PacDocumento', 'VARCHAR', false, 30, null);
        $this->addColumn('pac_estado', 'PacEstado', 'SMALLINT', false, null, null);
        $this->addColumn('pac_eliminado', 'PacEliminado', 'SMALLINT', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PacienteFichamedica', 'AppBundle\\Model\\PacienteFichamedica', RelationMap::ONE_TO_MANY, array('pac_id' => 'pac_id', ), null, null, 'PacienteFichamedicas');
        $this->addRelation('Recurso', 'AppBundle\\Model\\Recurso', RelationMap::ONE_TO_MANY, array('pac_id' => 'pac_id', ), null, null, 'Recursos');
        $this->addRelation('UsuariopadrePaciente', 'AppBundle\\Model\\UsuariopadrePaciente', RelationMap::ONE_TO_MANY, array('pac_id' => 'pac_id', ), null, null, 'UsuariopadrePacientes');
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

} // PacienteTableMap
