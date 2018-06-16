<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'usuario_profesional' table.
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
class UsuarioProfesionalTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.UsuarioProfesionalTableMap';

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
        $this->setName('usuario_profesional');
        $this->setPhpName('UsuarioProfesional');
        $this->setClassname('AppBundle\\Model\\UsuarioProfesional');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('upr_id', 'UprId', 'INTEGER', true, null, null);
        $this->addForeignKey('cli_id', 'CliId', 'INTEGER', 'clinica', 'cli_id', false, null, null);
        $this->addColumn('upr_nombres', 'UprNombres', 'VARCHAR', false, 100, null);
        $this->addColumn('upr_apellidos', 'UprApellidos', 'VARCHAR', false, 100, null);
        $this->addColumn('upr_email', 'UprEmail', 'VARCHAR', false, 60, null);
        $this->addColumn('upr_clave', 'UprClave', 'VARCHAR', false, 200, null);
        $this->addColumn('upr_rut', 'UprRut', 'VARCHAR', false, 20, null);
        $this->addColumn('upr_documento', 'UprDocumento', 'VARCHAR', false, 30, null);
        $this->addColumn('upr_estado', 'UprEstado', 'SMALLINT', false, null, null);
        $this->addColumn('upr_eliminado', 'UprEliminado', 'SMALLINT', false, null, null);
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
        $this->addRelation('Comentario', 'AppBundle\\Model\\Comentario', RelationMap::ONE_TO_MANY, array('upr_id' => 'upr_id', ), null, null, 'Comentarios');
        $this->addRelation('Device', 'AppBundle\\Model\\Device', RelationMap::ONE_TO_MANY, array('upr_id' => 'upr_id', ), null, null, 'Devices');
        $this->addRelation('Especialidad', 'AppBundle\\Model\\Especialidad', RelationMap::ONE_TO_MANY, array('upr_id' => 'upr_id', ), null, null, 'Especialidads');
        $this->addRelation('Recurso', 'AppBundle\\Model\\Recurso', RelationMap::ONE_TO_MANY, array('upr_id' => 'upr_id', ), null, null, 'Recursos');
        $this->addRelation('UsuariopadrePaciente', 'AppBundle\\Model\\UsuariopadrePaciente', RelationMap::ONE_TO_MANY, array('upr_id' => 'upr_id', ), null, null, 'UsuariopadrePacientes');
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

} // UsuarioProfesionalTableMap
