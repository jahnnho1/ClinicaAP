<?php

namespace AppBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use AppBundle\Model\ClinicaPeer;
use AppBundle\Model\UsuarioAdministrativo;
use AppBundle\Model\UsuarioAdministrativoPeer;
use AppBundle\Model\map\UsuarioAdministrativoTableMap;

abstract class BaseUsuarioAdministrativoPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'usuario_administrativo';

    /** the related Propel class for this table */
    const OM_CLASS = 'AppBundle\\Model\\UsuarioAdministrativo';

    /** the related TableMap class for this table */
    const TM_CLASS = 'AppBundle\\Model\\map\\UsuarioAdministrativoTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 11;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 11;

    /** the column name for the usu_id field */
    const USU_ID = 'usuario_administrativo.usu_id';

    /** the column name for the cli_id field */
    const CLI_ID = 'usuario_administrativo.cli_id';

    /** the column name for the usu_nombre field */
    const USU_NOMBRE = 'usuario_administrativo.usu_nombre';

    /** the column name for the usu_apellido field */
    const USU_APELLIDO = 'usuario_administrativo.usu_apellido';

    /** the column name for the usu_email field */
    const USU_EMAIL = 'usuario_administrativo.usu_email';

    /** the column name for the usu_rut field */
    const USU_RUT = 'usuario_administrativo.usu_rut';

    /** the column name for the usu_clave field */
    const USU_CLAVE = 'usuario_administrativo.usu_clave';

    /** the column name for the usu_estado field */
    const USU_ESTADO = 'usuario_administrativo.usu_estado';

    /** the column name for the usu_eliminado field */
    const USU_ELIMINADO = 'usuario_administrativo.usu_eliminado';

    /** the column name for the created_at field */
    const CREATED_AT = 'usuario_administrativo.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'usuario_administrativo.updated_at';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of UsuarioAdministrativo objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array UsuarioAdministrativo[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. UsuarioAdministrativoPeer::$fieldNames[UsuarioAdministrativoPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('UsuId', 'CliId', 'UsuNombre', 'UsuApellido', 'UsuEmail', 'UsuRut', 'UsuClave', 'UsuEstado', 'UsuEliminado', 'CreatedAt', 'UpdatedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('usuId', 'cliId', 'usuNombre', 'usuApellido', 'usuEmail', 'usuRut', 'usuClave', 'usuEstado', 'usuEliminado', 'createdAt', 'updatedAt', ),
        BasePeer::TYPE_COLNAME => array (UsuarioAdministrativoPeer::USU_ID, UsuarioAdministrativoPeer::CLI_ID, UsuarioAdministrativoPeer::USU_NOMBRE, UsuarioAdministrativoPeer::USU_APELLIDO, UsuarioAdministrativoPeer::USU_EMAIL, UsuarioAdministrativoPeer::USU_RUT, UsuarioAdministrativoPeer::USU_CLAVE, UsuarioAdministrativoPeer::USU_ESTADO, UsuarioAdministrativoPeer::USU_ELIMINADO, UsuarioAdministrativoPeer::CREATED_AT, UsuarioAdministrativoPeer::UPDATED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('USU_ID', 'CLI_ID', 'USU_NOMBRE', 'USU_APELLIDO', 'USU_EMAIL', 'USU_RUT', 'USU_CLAVE', 'USU_ESTADO', 'USU_ELIMINADO', 'CREATED_AT', 'UPDATED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('usu_id', 'cli_id', 'usu_nombre', 'usu_apellido', 'usu_email', 'usu_rut', 'usu_clave', 'usu_estado', 'usu_eliminado', 'created_at', 'updated_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. UsuarioAdministrativoPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('UsuId' => 0, 'CliId' => 1, 'UsuNombre' => 2, 'UsuApellido' => 3, 'UsuEmail' => 4, 'UsuRut' => 5, 'UsuClave' => 6, 'UsuEstado' => 7, 'UsuEliminado' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('usuId' => 0, 'cliId' => 1, 'usuNombre' => 2, 'usuApellido' => 3, 'usuEmail' => 4, 'usuRut' => 5, 'usuClave' => 6, 'usuEstado' => 7, 'usuEliminado' => 8, 'createdAt' => 9, 'updatedAt' => 10, ),
        BasePeer::TYPE_COLNAME => array (UsuarioAdministrativoPeer::USU_ID => 0, UsuarioAdministrativoPeer::CLI_ID => 1, UsuarioAdministrativoPeer::USU_NOMBRE => 2, UsuarioAdministrativoPeer::USU_APELLIDO => 3, UsuarioAdministrativoPeer::USU_EMAIL => 4, UsuarioAdministrativoPeer::USU_RUT => 5, UsuarioAdministrativoPeer::USU_CLAVE => 6, UsuarioAdministrativoPeer::USU_ESTADO => 7, UsuarioAdministrativoPeer::USU_ELIMINADO => 8, UsuarioAdministrativoPeer::CREATED_AT => 9, UsuarioAdministrativoPeer::UPDATED_AT => 10, ),
        BasePeer::TYPE_RAW_COLNAME => array ('USU_ID' => 0, 'CLI_ID' => 1, 'USU_NOMBRE' => 2, 'USU_APELLIDO' => 3, 'USU_EMAIL' => 4, 'USU_RUT' => 5, 'USU_CLAVE' => 6, 'USU_ESTADO' => 7, 'USU_ELIMINADO' => 8, 'CREATED_AT' => 9, 'UPDATED_AT' => 10, ),
        BasePeer::TYPE_FIELDNAME => array ('usu_id' => 0, 'cli_id' => 1, 'usu_nombre' => 2, 'usu_apellido' => 3, 'usu_email' => 4, 'usu_rut' => 5, 'usu_clave' => 6, 'usu_estado' => 7, 'usu_eliminado' => 8, 'created_at' => 9, 'updated_at' => 10, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = UsuarioAdministrativoPeer::getFieldNames($toType);
        $key = isset(UsuarioAdministrativoPeer::$fieldKeys[$fromType][$name]) ? UsuarioAdministrativoPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(UsuarioAdministrativoPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, UsuarioAdministrativoPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return UsuarioAdministrativoPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. UsuarioAdministrativoPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(UsuarioAdministrativoPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::USU_ID);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::CLI_ID);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::USU_NOMBRE);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::USU_APELLIDO);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::USU_EMAIL);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::USU_RUT);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::USU_CLAVE);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::USU_ESTADO);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::USU_ELIMINADO);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::CREATED_AT);
            $criteria->addSelectColumn(UsuarioAdministrativoPeer::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.usu_id');
            $criteria->addSelectColumn($alias . '.cli_id');
            $criteria->addSelectColumn($alias . '.usu_nombre');
            $criteria->addSelectColumn($alias . '.usu_apellido');
            $criteria->addSelectColumn($alias . '.usu_email');
            $criteria->addSelectColumn($alias . '.usu_rut');
            $criteria->addSelectColumn($alias . '.usu_clave');
            $criteria->addSelectColumn($alias . '.usu_estado');
            $criteria->addSelectColumn($alias . '.usu_eliminado');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(UsuarioAdministrativoPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UsuarioAdministrativoPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return UsuarioAdministrativo
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = UsuarioAdministrativoPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return UsuarioAdministrativoPeer::populateObjects(UsuarioAdministrativoPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            UsuarioAdministrativoPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param UsuarioAdministrativo $obj A UsuarioAdministrativo object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getUsuId();
            } // if key === null
            UsuarioAdministrativoPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A UsuarioAdministrativo object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof UsuarioAdministrativo) {
                $key = (string) $value->getUsuId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or UsuarioAdministrativo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(UsuarioAdministrativoPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return UsuarioAdministrativo Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(UsuarioAdministrativoPeer::$instances[$key])) {
                return UsuarioAdministrativoPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references) {
        foreach (UsuarioAdministrativoPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        UsuarioAdministrativoPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to usuario_administrativo
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = UsuarioAdministrativoPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = UsuarioAdministrativoPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = UsuarioAdministrativoPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsuarioAdministrativoPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (UsuarioAdministrativo object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = UsuarioAdministrativoPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = UsuarioAdministrativoPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + UsuarioAdministrativoPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsuarioAdministrativoPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            UsuarioAdministrativoPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Clinica table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinClinica(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(UsuarioAdministrativoPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UsuarioAdministrativoPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(UsuarioAdministrativoPeer::CLI_ID, ClinicaPeer::CLI_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of UsuarioAdministrativo objects pre-filled with their Clinica objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of UsuarioAdministrativo objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinClinica(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME);
        }

        UsuarioAdministrativoPeer::addSelectColumns($criteria);
        $startcol = UsuarioAdministrativoPeer::NUM_HYDRATE_COLUMNS;
        ClinicaPeer::addSelectColumns($criteria);

        $criteria->addJoin(UsuarioAdministrativoPeer::CLI_ID, ClinicaPeer::CLI_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = UsuarioAdministrativoPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = UsuarioAdministrativoPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = UsuarioAdministrativoPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                UsuarioAdministrativoPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ClinicaPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ClinicaPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ClinicaPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ClinicaPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (UsuarioAdministrativo) to $obj2 (Clinica)
                $obj2->addUsuarioAdministrativo($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(UsuarioAdministrativoPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UsuarioAdministrativoPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(UsuarioAdministrativoPeer::CLI_ID, ClinicaPeer::CLI_ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of UsuarioAdministrativo objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of UsuarioAdministrativo objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME);
        }

        UsuarioAdministrativoPeer::addSelectColumns($criteria);
        $startcol2 = UsuarioAdministrativoPeer::NUM_HYDRATE_COLUMNS;

        ClinicaPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ClinicaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(UsuarioAdministrativoPeer::CLI_ID, ClinicaPeer::CLI_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = UsuarioAdministrativoPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = UsuarioAdministrativoPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = UsuarioAdministrativoPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                UsuarioAdministrativoPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Clinica rows

            $key2 = ClinicaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = ClinicaPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ClinicaPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ClinicaPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (UsuarioAdministrativo) to the collection in $obj2 (Clinica)
                $obj2->addUsuarioAdministrativo($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(UsuarioAdministrativoPeer::DATABASE_NAME)->getTable(UsuarioAdministrativoPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseUsuarioAdministrativoPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseUsuarioAdministrativoPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \AppBundle\Model\map\UsuarioAdministrativoTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return UsuarioAdministrativoPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a UsuarioAdministrativo or Criteria object.
     *
     * @param      mixed $values Criteria or UsuarioAdministrativo object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from UsuarioAdministrativo object
        }

        if ($criteria->containsKey(UsuarioAdministrativoPeer::USU_ID) && $criteria->keyContainsValue(UsuarioAdministrativoPeer::USU_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsuarioAdministrativoPeer::USU_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a UsuarioAdministrativo or Criteria object.
     *
     * @param      mixed $values Criteria or UsuarioAdministrativo object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(UsuarioAdministrativoPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(UsuarioAdministrativoPeer::USU_ID);
            $value = $criteria->remove(UsuarioAdministrativoPeer::USU_ID);
            if ($value) {
                $selectCriteria->add(UsuarioAdministrativoPeer::USU_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(UsuarioAdministrativoPeer::TABLE_NAME);
            }

        } else { // $values is UsuarioAdministrativo object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the usuario_administrativo table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(UsuarioAdministrativoPeer::TABLE_NAME, $con, UsuarioAdministrativoPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuarioAdministrativoPeer::clearInstancePool();
            UsuarioAdministrativoPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a UsuarioAdministrativo or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or UsuarioAdministrativo object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            UsuarioAdministrativoPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof UsuarioAdministrativo) { // it's a model object
            // invalidate the cache for this single object
            UsuarioAdministrativoPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsuarioAdministrativoPeer::DATABASE_NAME);
            $criteria->add(UsuarioAdministrativoPeer::USU_ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                UsuarioAdministrativoPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(UsuarioAdministrativoPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            UsuarioAdministrativoPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given UsuarioAdministrativo object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param UsuarioAdministrativo $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(UsuarioAdministrativoPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(UsuarioAdministrativoPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(UsuarioAdministrativoPeer::DATABASE_NAME, UsuarioAdministrativoPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return UsuarioAdministrativo
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = UsuarioAdministrativoPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(UsuarioAdministrativoPeer::DATABASE_NAME);
        $criteria->add(UsuarioAdministrativoPeer::USU_ID, $pk);

        $v = UsuarioAdministrativoPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return UsuarioAdministrativo[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(UsuarioAdministrativoPeer::DATABASE_NAME);
            $criteria->add(UsuarioAdministrativoPeer::USU_ID, $pks, Criteria::IN);
            $objs = UsuarioAdministrativoPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseUsuarioAdministrativoPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseUsuarioAdministrativoPeer::buildTableMap();

