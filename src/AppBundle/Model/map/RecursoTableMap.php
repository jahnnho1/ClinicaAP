<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'recurso' table.
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
class RecursoTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.RecursoTableMap';

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
        $this->setName('recurso');
        $this->setPhpName('Recurso');
        $this->setClassname('AppBundle\\Model\\Recurso');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('rec_id', 'RecId', 'INTEGER', true, null, null);
        $this->addForeignKey('pac_id', 'PacId', 'INTEGER', 'paciente', 'pac_id', false, null, null);
        $this->addForeignKey('upr_id', 'UprId', 'INTEGER', 'usuario_profesional', 'upr_id', false, null, null);
        $this->addForeignKey('cli_id', 'CliId', 'INTEGER', 'clinica', 'cli_id', false, null, null);
        $this->addForeignKey('blo_id', 'BloId', 'INTEGER', 'blog', 'blo_id', false, null, null);
        $this->addForeignKey('upa_id', 'UpaId', 'INTEGER', 'usuario_padre', 'upa_id', false, null, null);
        $this->addColumn('rec_tipo', 'RecTipo', 'SMALLINT', false, null, null);
        $this->addColumn('rec_es_principal', 'RecEsPrincipal', 'SMALLINT', false, null, null);
        $this->addColumn('rec_src', 'RecSrc', 'LONGVARCHAR', false, null, null);
        $this->addColumn('rec_url', 'RecUrl', 'LONGVARCHAR', false, null, null);
        $this->addColumn('rec_orden', 'RecOrden', 'SMALLINT', false, null, null);
        $this->addColumn('rec_estado', 'RecEstado', 'SMALLINT', false, null, null);
        $this->addColumn('rec_eliminado', 'RecEliminado', 'SMALLINT', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Blog', 'AppBundle\\Model\\Blog', RelationMap::MANY_TO_ONE, array('blo_id' => 'blo_id', ), null, null);
        $this->addRelation('Clinica', 'AppBundle\\Model\\Clinica', RelationMap::MANY_TO_ONE, array('cli_id' => 'cli_id', ), null, null);
        $this->addRelation('Paciente', 'AppBundle\\Model\\Paciente', RelationMap::MANY_TO_ONE, array('pac_id' => 'pac_id', ), null, null);
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

} // RecursoTableMap
