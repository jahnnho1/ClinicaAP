<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'usuariopadre_paciente' table.
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
class UsuariopadrePacienteTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.UsuariopadrePacienteTableMap';

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
        $this->setName('usuariopadre_paciente');
        $this->setPhpName('UsuariopadrePaciente');
        $this->setClassname('AppBundle\\Model\\UsuariopadrePaciente');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('pac_id', 'PacId', 'INTEGER' , 'paciente', 'pac_id', true, null, null);
        $this->addForeignPrimaryKey('upa_id', 'UpaId', 'INTEGER' , 'usuario_padre', 'upa_id', true, null, null);
        $this->addForeignPrimaryKey('upr_id', 'UprId', 'INTEGER' , 'usuario_profesional', 'upr_id', true, null, null);
        $this->addColumn('upp_descripcion', 'UppDescripcion', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Paciente', 'AppBundle\\Model\\Paciente', RelationMap::MANY_TO_ONE, array('pac_id' => 'pac_id', ), null, null);
        $this->addRelation('UsuarioPadre', 'AppBundle\\Model\\UsuarioPadre', RelationMap::MANY_TO_ONE, array('upa_id' => 'upa_id', ), null, null);
        $this->addRelation('UsuarioProfesional', 'AppBundle\\Model\\UsuarioProfesional', RelationMap::MANY_TO_ONE, array('upr_id' => 'upr_id', ), null, null);
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

} // UsuariopadrePacienteTableMap
