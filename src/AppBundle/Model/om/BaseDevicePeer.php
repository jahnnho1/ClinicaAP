<?php

namespace AppBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use AppBundle\Model\Device;
use AppBundle\Model\DevicePeer;
use AppBundle\Model\UsuarioPadrePeer;
use AppBundle\Model\UsuarioProfesionalPeer;
use AppBundle\Model\map\DeviceTableMap;

abstract class BaseDevicePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'device';

    /** the related Propel class for this table */
    const OM_CLASS = 'AppBundle\\Model\\Device';

    /** the related TableMap class for this table */
    const TM_CLASS = 'AppBundle\\Model\\map\\DeviceTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 21;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 21;

    /** the column name for the dev_id field */
    const DEV_ID = 'device.dev_id';

    /** the column name for the upr_id field */
    const UPR_ID = 'device.upr_id';

    /** the column name for the upa_id field */
    const UPA_ID = 'device.upa_id';

    /** the column name for the dev_app_version field */
    const DEV_APP_VERSION = 'device.dev_app_version';

    /** the column name for the dev_cordova field */
    const DEV_CORDOVA = 'device.dev_cordova';

    /** the column name for the dev_model field */
    const DEV_MODEL = 'device.dev_model';

    /** the column name for the dev_platform field */
    const DEV_PLATFORM = 'device.dev_platform';

    /** the column name for the dev_uuid field */
    const DEV_UUID = 'device.dev_uuid';

    /** the column name for the dev_version field */
    const DEV_VERSION = 'device.dev_version';

    /** the column name for the dev_manufacturer field */
    const DEV_MANUFACTURER = 'device.dev_manufacturer';

    /** the column name for the dev_isvirtual field */
    const DEV_ISVIRTUAL = 'device.dev_isvirtual';

    /** the column name for the dev_serial field */
    const DEV_SERIAL = 'device.dev_serial';

    /** the column name for the dev_token_apn field */
    const DEV_TOKEN_APN = 'device.dev_token_apn';

    /** the column name for the dev_ver_app_name field */
    const DEV_VER_APP_NAME = 'device.dev_ver_app_name';

    /** the column name for the dev_ver_package_name field */
    const DEV_VER_PACKAGE_NAME = 'device.dev_ver_package_name';

    /** the column name for the dev_ver_code field */
    const DEV_VER_CODE = 'device.dev_ver_code';

    /** the column name for the dev_ver_number field */
    const DEV_VER_NUMBER = 'device.dev_ver_number';

    /** the column name for the dev_estado field */
    const DEV_ESTADO = 'device.dev_estado';

    /** the column name for the dev_eliminado field */
    const DEV_ELIMINADO = 'device.dev_eliminado';

    /** the column name for the created_at field */
    const CREATED_AT = 'device.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'device.updated_at';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of Device objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Device[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. DevicePeer::$fieldNames[DevicePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('DevId', 'UprId', 'UpaId', 'DevAppVersion', 'DevCordova', 'DevModel', 'DevPlatform', 'DevUuid', 'DevVersion', 'DevManufacturer', 'DevIsvirtual', 'DevSerial', 'DevTokenApn', 'DevVerAppName', 'DevVerPackageName', 'DevVerCode', 'DevVerNumber', 'DevEstado', 'DevEliminado', 'CreatedAt', 'UpdatedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('devId', 'uprId', 'upaId', 'devAppVersion', 'devCordova', 'devModel', 'devPlatform', 'devUuid', 'devVersion', 'devManufacturer', 'devIsvirtual', 'devSerial', 'devTokenApn', 'devVerAppName', 'devVerPackageName', 'devVerCode', 'devVerNumber', 'devEstado', 'devEliminado', 'createdAt', 'updatedAt', ),
        BasePeer::TYPE_COLNAME => array (DevicePeer::DEV_ID, DevicePeer::UPR_ID, DevicePeer::UPA_ID, DevicePeer::DEV_APP_VERSION, DevicePeer::DEV_CORDOVA, DevicePeer::DEV_MODEL, DevicePeer::DEV_PLATFORM, DevicePeer::DEV_UUID, DevicePeer::DEV_VERSION, DevicePeer::DEV_MANUFACTURER, DevicePeer::DEV_ISVIRTUAL, DevicePeer::DEV_SERIAL, DevicePeer::DEV_TOKEN_APN, DevicePeer::DEV_VER_APP_NAME, DevicePeer::DEV_VER_PACKAGE_NAME, DevicePeer::DEV_VER_CODE, DevicePeer::DEV_VER_NUMBER, DevicePeer::DEV_ESTADO, DevicePeer::DEV_ELIMINADO, DevicePeer::CREATED_AT, DevicePeer::UPDATED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('DEV_ID', 'UPR_ID', 'UPA_ID', 'DEV_APP_VERSION', 'DEV_CORDOVA', 'DEV_MODEL', 'DEV_PLATFORM', 'DEV_UUID', 'DEV_VERSION', 'DEV_MANUFACTURER', 'DEV_ISVIRTUAL', 'DEV_SERIAL', 'DEV_TOKEN_APN', 'DEV_VER_APP_NAME', 'DEV_VER_PACKAGE_NAME', 'DEV_VER_CODE', 'DEV_VER_NUMBER', 'DEV_ESTADO', 'DEV_ELIMINADO', 'CREATED_AT', 'UPDATED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('dev_id', 'upr_id', 'upa_id', 'dev_app_version', 'dev_cordova', 'dev_model', 'dev_platform', 'dev_uuid', 'dev_version', 'dev_manufacturer', 'dev_isvirtual', 'dev_serial', 'dev_token_apn', 'dev_ver_app_name', 'dev_ver_package_name', 'dev_ver_code', 'dev_ver_number', 'dev_estado', 'dev_eliminado', 'created_at', 'updated_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. DevicePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('DevId' => 0, 'UprId' => 1, 'UpaId' => 2, 'DevAppVersion' => 3, 'DevCordova' => 4, 'DevModel' => 5, 'DevPlatform' => 6, 'DevUuid' => 7, 'DevVersion' => 8, 'DevManufacturer' => 9, 'DevIsvirtual' => 10, 'DevSerial' => 11, 'DevTokenApn' => 12, 'DevVerAppName' => 13, 'DevVerPackageName' => 14, 'DevVerCode' => 15, 'DevVerNumber' => 16, 'DevEstado' => 17, 'DevEliminado' => 18, 'CreatedAt' => 19, 'UpdatedAt' => 20, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('devId' => 0, 'uprId' => 1, 'upaId' => 2, 'devAppVersion' => 3, 'devCordova' => 4, 'devModel' => 5, 'devPlatform' => 6, 'devUuid' => 7, 'devVersion' => 8, 'devManufacturer' => 9, 'devIsvirtual' => 10, 'devSerial' => 11, 'devTokenApn' => 12, 'devVerAppName' => 13, 'devVerPackageName' => 14, 'devVerCode' => 15, 'devVerNumber' => 16, 'devEstado' => 17, 'devEliminado' => 18, 'createdAt' => 19, 'updatedAt' => 20, ),
        BasePeer::TYPE_COLNAME => array (DevicePeer::DEV_ID => 0, DevicePeer::UPR_ID => 1, DevicePeer::UPA_ID => 2, DevicePeer::DEV_APP_VERSION => 3, DevicePeer::DEV_CORDOVA => 4, DevicePeer::DEV_MODEL => 5, DevicePeer::DEV_PLATFORM => 6, DevicePeer::DEV_UUID => 7, DevicePeer::DEV_VERSION => 8, DevicePeer::DEV_MANUFACTURER => 9, DevicePeer::DEV_ISVIRTUAL => 10, DevicePeer::DEV_SERIAL => 11, DevicePeer::DEV_TOKEN_APN => 12, DevicePeer::DEV_VER_APP_NAME => 13, DevicePeer::DEV_VER_PACKAGE_NAME => 14, DevicePeer::DEV_VER_CODE => 15, DevicePeer::DEV_VER_NUMBER => 16, DevicePeer::DEV_ESTADO => 17, DevicePeer::DEV_ELIMINADO => 18, DevicePeer::CREATED_AT => 19, DevicePeer::UPDATED_AT => 20, ),
        BasePeer::TYPE_RAW_COLNAME => array ('DEV_ID' => 0, 'UPR_ID' => 1, 'UPA_ID' => 2, 'DEV_APP_VERSION' => 3, 'DEV_CORDOVA' => 4, 'DEV_MODEL' => 5, 'DEV_PLATFORM' => 6, 'DEV_UUID' => 7, 'DEV_VERSION' => 8, 'DEV_MANUFACTURER' => 9, 'DEV_ISVIRTUAL' => 10, 'DEV_SERIAL' => 11, 'DEV_TOKEN_APN' => 12, 'DEV_VER_APP_NAME' => 13, 'DEV_VER_PACKAGE_NAME' => 14, 'DEV_VER_CODE' => 15, 'DEV_VER_NUMBER' => 16, 'DEV_ESTADO' => 17, 'DEV_ELIMINADO' => 18, 'CREATED_AT' => 19, 'UPDATED_AT' => 20, ),
        BasePeer::TYPE_FIELDNAME => array ('dev_id' => 0, 'upr_id' => 1, 'upa_id' => 2, 'dev_app_version' => 3, 'dev_cordova' => 4, 'dev_model' => 5, 'dev_platform' => 6, 'dev_uuid' => 7, 'dev_version' => 8, 'dev_manufacturer' => 9, 'dev_isvirtual' => 10, 'dev_serial' => 11, 'dev_token_apn' => 12, 'dev_ver_app_name' => 13, 'dev_ver_package_name' => 14, 'dev_ver_code' => 15, 'dev_ver_number' => 16, 'dev_estado' => 17, 'dev_eliminado' => 18, 'created_at' => 19, 'updated_at' => 20, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
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
        $toNames = DevicePeer::getFieldNames($toType);
        $key = isset(DevicePeer::$fieldKeys[$fromType][$name]) ? DevicePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(DevicePeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, DevicePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return DevicePeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. DevicePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(DevicePeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(DevicePeer::DEV_ID);
            $criteria->addSelectColumn(DevicePeer::UPR_ID);
            $criteria->addSelectColumn(DevicePeer::UPA_ID);
            $criteria->addSelectColumn(DevicePeer::DEV_APP_VERSION);
            $criteria->addSelectColumn(DevicePeer::DEV_CORDOVA);
            $criteria->addSelectColumn(DevicePeer::DEV_MODEL);
            $criteria->addSelectColumn(DevicePeer::DEV_PLATFORM);
            $criteria->addSelectColumn(DevicePeer::DEV_UUID);
            $criteria->addSelectColumn(DevicePeer::DEV_VERSION);
            $criteria->addSelectColumn(DevicePeer::DEV_MANUFACTURER);
            $criteria->addSelectColumn(DevicePeer::DEV_ISVIRTUAL);
            $criteria->addSelectColumn(DevicePeer::DEV_SERIAL);
            $criteria->addSelectColumn(DevicePeer::DEV_TOKEN_APN);
            $criteria->addSelectColumn(DevicePeer::DEV_VER_APP_NAME);
            $criteria->addSelectColumn(DevicePeer::DEV_VER_PACKAGE_NAME);
            $criteria->addSelectColumn(DevicePeer::DEV_VER_CODE);
            $criteria->addSelectColumn(DevicePeer::DEV_VER_NUMBER);
            $criteria->addSelectColumn(DevicePeer::DEV_ESTADO);
            $criteria->addSelectColumn(DevicePeer::DEV_ELIMINADO);
            $criteria->addSelectColumn(DevicePeer::CREATED_AT);
            $criteria->addSelectColumn(DevicePeer::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.dev_id');
            $criteria->addSelectColumn($alias . '.upr_id');
            $criteria->addSelectColumn($alias . '.upa_id');
            $criteria->addSelectColumn($alias . '.dev_app_version');
            $criteria->addSelectColumn($alias . '.dev_cordova');
            $criteria->addSelectColumn($alias . '.dev_model');
            $criteria->addSelectColumn($alias . '.dev_platform');
            $criteria->addSelectColumn($alias . '.dev_uuid');
            $criteria->addSelectColumn($alias . '.dev_version');
            $criteria->addSelectColumn($alias . '.dev_manufacturer');
            $criteria->addSelectColumn($alias . '.dev_isvirtual');
            $criteria->addSelectColumn($alias . '.dev_serial');
            $criteria->addSelectColumn($alias . '.dev_token_apn');
            $criteria->addSelectColumn($alias . '.dev_ver_app_name');
            $criteria->addSelectColumn($alias . '.dev_ver_package_name');
            $criteria->addSelectColumn($alias . '.dev_ver_code');
            $criteria->addSelectColumn($alias . '.dev_ver_number');
            $criteria->addSelectColumn($alias . '.dev_estado');
            $criteria->addSelectColumn($alias . '.dev_eliminado');
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
        $criteria->setPrimaryTableName(DevicePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevicePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(DevicePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return Device
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = DevicePeer::doSelect($critcopy, $con);
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
        return DevicePeer::populateObjects(DevicePeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            DevicePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

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
     * @param Device $obj A Device object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getDevId();
            } // if key === null
            DevicePeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Device object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Device) {
                $key = (string) $value->getDevId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Device object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(DevicePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return Device Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(DevicePeer::$instances[$key])) {
                return DevicePeer::$instances[$key];
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
        foreach (DevicePeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        DevicePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to device
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
        $cls = DevicePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = DevicePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = DevicePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DevicePeer::addInstanceToPool($obj, $key);
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
     * @return array (Device object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = DevicePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = DevicePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + DevicePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DevicePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            DevicePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related UsuarioProfesional table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUsuarioProfesional(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(DevicePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevicePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DevicePeer::UPR_ID, UsuarioProfesionalPeer::UPR_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related UsuarioPadre table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUsuarioPadre(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(DevicePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevicePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DevicePeer::UPA_ID, UsuarioPadrePeer::UPA_ID, $join_behavior);

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
     * Selects a collection of Device objects pre-filled with their UsuarioProfesional objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Device objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUsuarioProfesional(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DevicePeer::DATABASE_NAME);
        }

        DevicePeer::addSelectColumns($criteria);
        $startcol = DevicePeer::NUM_HYDRATE_COLUMNS;
        UsuarioProfesionalPeer::addSelectColumns($criteria);

        $criteria->addJoin(DevicePeer::UPR_ID, UsuarioProfesionalPeer::UPR_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DevicePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DevicePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = DevicePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DevicePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = UsuarioProfesionalPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = UsuarioProfesionalPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UsuarioProfesionalPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    UsuarioProfesionalPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Device) to $obj2 (UsuarioProfesional)
                $obj2->addDevice($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Device objects pre-filled with their UsuarioPadre objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Device objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUsuarioPadre(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DevicePeer::DATABASE_NAME);
        }

        DevicePeer::addSelectColumns($criteria);
        $startcol = DevicePeer::NUM_HYDRATE_COLUMNS;
        UsuarioPadrePeer::addSelectColumns($criteria);

        $criteria->addJoin(DevicePeer::UPA_ID, UsuarioPadrePeer::UPA_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DevicePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DevicePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = DevicePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DevicePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = UsuarioPadrePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = UsuarioPadrePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UsuarioPadrePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    UsuarioPadrePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Device) to $obj2 (UsuarioPadre)
                $obj2->addDevice($obj1);

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
        $criteria->setPrimaryTableName(DevicePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevicePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DevicePeer::UPR_ID, UsuarioProfesionalPeer::UPR_ID, $join_behavior);

        $criteria->addJoin(DevicePeer::UPA_ID, UsuarioPadrePeer::UPA_ID, $join_behavior);

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
     * Selects a collection of Device objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Device objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DevicePeer::DATABASE_NAME);
        }

        DevicePeer::addSelectColumns($criteria);
        $startcol2 = DevicePeer::NUM_HYDRATE_COLUMNS;

        UsuarioProfesionalPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UsuarioProfesionalPeer::NUM_HYDRATE_COLUMNS;

        UsuarioPadrePeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + UsuarioPadrePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(DevicePeer::UPR_ID, UsuarioProfesionalPeer::UPR_ID, $join_behavior);

        $criteria->addJoin(DevicePeer::UPA_ID, UsuarioPadrePeer::UPA_ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DevicePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DevicePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = DevicePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DevicePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined UsuarioProfesional rows

            $key2 = UsuarioProfesionalPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = UsuarioProfesionalPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UsuarioProfesionalPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UsuarioProfesionalPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Device) to the collection in $obj2 (UsuarioProfesional)
                $obj2->addDevice($obj1);
            } // if joined row not null

            // Add objects for joined UsuarioPadre rows

            $key3 = UsuarioPadrePeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = UsuarioPadrePeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = UsuarioPadrePeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    UsuarioPadrePeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (Device) to the collection in $obj3 (UsuarioPadre)
                $obj3->addDevice($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related UsuarioProfesional table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptUsuarioProfesional(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(DevicePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevicePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DevicePeer::UPA_ID, UsuarioPadrePeer::UPA_ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related UsuarioPadre table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptUsuarioPadre(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(DevicePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevicePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DevicePeer::UPR_ID, UsuarioProfesionalPeer::UPR_ID, $join_behavior);

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
     * Selects a collection of Device objects pre-filled with all related objects except UsuarioProfesional.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Device objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptUsuarioProfesional(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DevicePeer::DATABASE_NAME);
        }

        DevicePeer::addSelectColumns($criteria);
        $startcol2 = DevicePeer::NUM_HYDRATE_COLUMNS;

        UsuarioPadrePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UsuarioPadrePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(DevicePeer::UPA_ID, UsuarioPadrePeer::UPA_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DevicePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DevicePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = DevicePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DevicePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined UsuarioPadre rows

                $key2 = UsuarioPadrePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = UsuarioPadrePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = UsuarioPadrePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UsuarioPadrePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Device) to the collection in $obj2 (UsuarioPadre)
                $obj2->addDevice($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Device objects pre-filled with all related objects except UsuarioPadre.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Device objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptUsuarioPadre(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DevicePeer::DATABASE_NAME);
        }

        DevicePeer::addSelectColumns($criteria);
        $startcol2 = DevicePeer::NUM_HYDRATE_COLUMNS;

        UsuarioProfesionalPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UsuarioProfesionalPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(DevicePeer::UPR_ID, UsuarioProfesionalPeer::UPR_ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DevicePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DevicePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = DevicePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DevicePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined UsuarioProfesional rows

                $key2 = UsuarioProfesionalPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = UsuarioProfesionalPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = UsuarioProfesionalPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UsuarioProfesionalPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Device) to the collection in $obj2 (UsuarioProfesional)
                $obj2->addDevice($obj1);

            } // if joined row is not null

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
        return Propel::getDatabaseMap(DevicePeer::DATABASE_NAME)->getTable(DevicePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseDevicePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseDevicePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \AppBundle\Model\map\DeviceTableMap());
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
        return DevicePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Device or Criteria object.
     *
     * @param      mixed $values Criteria or Device object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Device object
        }

        if ($criteria->containsKey(DevicePeer::DEV_ID) && $criteria->keyContainsValue(DevicePeer::DEV_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DevicePeer::DEV_ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Device or Criteria object.
     *
     * @param      mixed $values Criteria or Device object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(DevicePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(DevicePeer::DEV_ID);
            $value = $criteria->remove(DevicePeer::DEV_ID);
            if ($value) {
                $selectCriteria->add(DevicePeer::DEV_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(DevicePeer::TABLE_NAME);
            }

        } else { // $values is Device object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the device table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(DevicePeer::TABLE_NAME, $con, DevicePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DevicePeer::clearInstancePool();
            DevicePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Device or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Device object or primary key or array of primary keys
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
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            DevicePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Device) { // it's a model object
            // invalidate the cache for this single object
            DevicePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DevicePeer::DATABASE_NAME);
            $criteria->add(DevicePeer::DEV_ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                DevicePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(DevicePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            DevicePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Device object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param Device $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(DevicePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(DevicePeer::TABLE_NAME);

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

        return BasePeer::doValidate(DevicePeer::DATABASE_NAME, DevicePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Device
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = DevicePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(DevicePeer::DATABASE_NAME);
        $criteria->add(DevicePeer::DEV_ID, $pk);

        $v = DevicePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Device[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(DevicePeer::DATABASE_NAME);
            $criteria->add(DevicePeer::DEV_ID, $pks, Criteria::IN);
            $objs = DevicePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseDevicePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseDevicePeer::buildTableMap();

