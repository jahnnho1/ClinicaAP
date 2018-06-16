<?php

namespace AppBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use AppBundle\Model\Device;
use AppBundle\Model\DevicePeer;
use AppBundle\Model\DeviceQuery;
use AppBundle\Model\UsuarioPadre;
use AppBundle\Model\UsuarioProfesional;

/**
 * @method DeviceQuery orderByDevId($order = Criteria::ASC) Order by the dev_id column
 * @method DeviceQuery orderByUprId($order = Criteria::ASC) Order by the upr_id column
 * @method DeviceQuery orderByUpaId($order = Criteria::ASC) Order by the upa_id column
 * @method DeviceQuery orderByDevAppVersion($order = Criteria::ASC) Order by the dev_app_version column
 * @method DeviceQuery orderByDevCordova($order = Criteria::ASC) Order by the dev_cordova column
 * @method DeviceQuery orderByDevModel($order = Criteria::ASC) Order by the dev_model column
 * @method DeviceQuery orderByDevPlatform($order = Criteria::ASC) Order by the dev_platform column
 * @method DeviceQuery orderByDevUuid($order = Criteria::ASC) Order by the dev_uuid column
 * @method DeviceQuery orderByDevVersion($order = Criteria::ASC) Order by the dev_version column
 * @method DeviceQuery orderByDevManufacturer($order = Criteria::ASC) Order by the dev_manufacturer column
 * @method DeviceQuery orderByDevIsvirtual($order = Criteria::ASC) Order by the dev_isvirtual column
 * @method DeviceQuery orderByDevSerial($order = Criteria::ASC) Order by the dev_serial column
 * @method DeviceQuery orderByDevTokenApn($order = Criteria::ASC) Order by the dev_token_apn column
 * @method DeviceQuery orderByDevVerAppName($order = Criteria::ASC) Order by the dev_ver_app_name column
 * @method DeviceQuery orderByDevVerPackageName($order = Criteria::ASC) Order by the dev_ver_package_name column
 * @method DeviceQuery orderByDevVerCode($order = Criteria::ASC) Order by the dev_ver_code column
 * @method DeviceQuery orderByDevVerNumber($order = Criteria::ASC) Order by the dev_ver_number column
 * @method DeviceQuery orderByDevEstado($order = Criteria::ASC) Order by the dev_estado column
 * @method DeviceQuery orderByDevEliminado($order = Criteria::ASC) Order by the dev_eliminado column
 * @method DeviceQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method DeviceQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method DeviceQuery groupByDevId() Group by the dev_id column
 * @method DeviceQuery groupByUprId() Group by the upr_id column
 * @method DeviceQuery groupByUpaId() Group by the upa_id column
 * @method DeviceQuery groupByDevAppVersion() Group by the dev_app_version column
 * @method DeviceQuery groupByDevCordova() Group by the dev_cordova column
 * @method DeviceQuery groupByDevModel() Group by the dev_model column
 * @method DeviceQuery groupByDevPlatform() Group by the dev_platform column
 * @method DeviceQuery groupByDevUuid() Group by the dev_uuid column
 * @method DeviceQuery groupByDevVersion() Group by the dev_version column
 * @method DeviceQuery groupByDevManufacturer() Group by the dev_manufacturer column
 * @method DeviceQuery groupByDevIsvirtual() Group by the dev_isvirtual column
 * @method DeviceQuery groupByDevSerial() Group by the dev_serial column
 * @method DeviceQuery groupByDevTokenApn() Group by the dev_token_apn column
 * @method DeviceQuery groupByDevVerAppName() Group by the dev_ver_app_name column
 * @method DeviceQuery groupByDevVerPackageName() Group by the dev_ver_package_name column
 * @method DeviceQuery groupByDevVerCode() Group by the dev_ver_code column
 * @method DeviceQuery groupByDevVerNumber() Group by the dev_ver_number column
 * @method DeviceQuery groupByDevEstado() Group by the dev_estado column
 * @method DeviceQuery groupByDevEliminado() Group by the dev_eliminado column
 * @method DeviceQuery groupByCreatedAt() Group by the created_at column
 * @method DeviceQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method DeviceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DeviceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DeviceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DeviceQuery leftJoinUsuarioProfesional($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioProfesional relation
 * @method DeviceQuery rightJoinUsuarioProfesional($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioProfesional relation
 * @method DeviceQuery innerJoinUsuarioProfesional($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioProfesional relation
 *
 * @method DeviceQuery leftJoinUsuarioPadre($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioPadre relation
 * @method DeviceQuery rightJoinUsuarioPadre($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioPadre relation
 * @method DeviceQuery innerJoinUsuarioPadre($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioPadre relation
 *
 * @method Device findOne(PropelPDO $con = null) Return the first Device matching the query
 * @method Device findOneOrCreate(PropelPDO $con = null) Return the first Device matching the query, or a new Device object populated from the query conditions when no match is found
 *
 * @method Device findOneByUprId(int $upr_id) Return the first Device filtered by the upr_id column
 * @method Device findOneByUpaId(int $upa_id) Return the first Device filtered by the upa_id column
 * @method Device findOneByDevAppVersion(string $dev_app_version) Return the first Device filtered by the dev_app_version column
 * @method Device findOneByDevCordova(string $dev_cordova) Return the first Device filtered by the dev_cordova column
 * @method Device findOneByDevModel(string $dev_model) Return the first Device filtered by the dev_model column
 * @method Device findOneByDevPlatform(string $dev_platform) Return the first Device filtered by the dev_platform column
 * @method Device findOneByDevUuid(string $dev_uuid) Return the first Device filtered by the dev_uuid column
 * @method Device findOneByDevVersion(string $dev_version) Return the first Device filtered by the dev_version column
 * @method Device findOneByDevManufacturer(string $dev_manufacturer) Return the first Device filtered by the dev_manufacturer column
 * @method Device findOneByDevIsvirtual(string $dev_isvirtual) Return the first Device filtered by the dev_isvirtual column
 * @method Device findOneByDevSerial(string $dev_serial) Return the first Device filtered by the dev_serial column
 * @method Device findOneByDevTokenApn(string $dev_token_apn) Return the first Device filtered by the dev_token_apn column
 * @method Device findOneByDevVerAppName(string $dev_ver_app_name) Return the first Device filtered by the dev_ver_app_name column
 * @method Device findOneByDevVerPackageName(string $dev_ver_package_name) Return the first Device filtered by the dev_ver_package_name column
 * @method Device findOneByDevVerCode(string $dev_ver_code) Return the first Device filtered by the dev_ver_code column
 * @method Device findOneByDevVerNumber(string $dev_ver_number) Return the first Device filtered by the dev_ver_number column
 * @method Device findOneByDevEstado(int $dev_estado) Return the first Device filtered by the dev_estado column
 * @method Device findOneByDevEliminado(boolean $dev_eliminado) Return the first Device filtered by the dev_eliminado column
 * @method Device findOneByCreatedAt(string $created_at) Return the first Device filtered by the created_at column
 * @method Device findOneByUpdatedAt(string $updated_at) Return the first Device filtered by the updated_at column
 *
 * @method array findByDevId(int $dev_id) Return Device objects filtered by the dev_id column
 * @method array findByUprId(int $upr_id) Return Device objects filtered by the upr_id column
 * @method array findByUpaId(int $upa_id) Return Device objects filtered by the upa_id column
 * @method array findByDevAppVersion(string $dev_app_version) Return Device objects filtered by the dev_app_version column
 * @method array findByDevCordova(string $dev_cordova) Return Device objects filtered by the dev_cordova column
 * @method array findByDevModel(string $dev_model) Return Device objects filtered by the dev_model column
 * @method array findByDevPlatform(string $dev_platform) Return Device objects filtered by the dev_platform column
 * @method array findByDevUuid(string $dev_uuid) Return Device objects filtered by the dev_uuid column
 * @method array findByDevVersion(string $dev_version) Return Device objects filtered by the dev_version column
 * @method array findByDevManufacturer(string $dev_manufacturer) Return Device objects filtered by the dev_manufacturer column
 * @method array findByDevIsvirtual(string $dev_isvirtual) Return Device objects filtered by the dev_isvirtual column
 * @method array findByDevSerial(string $dev_serial) Return Device objects filtered by the dev_serial column
 * @method array findByDevTokenApn(string $dev_token_apn) Return Device objects filtered by the dev_token_apn column
 * @method array findByDevVerAppName(string $dev_ver_app_name) Return Device objects filtered by the dev_ver_app_name column
 * @method array findByDevVerPackageName(string $dev_ver_package_name) Return Device objects filtered by the dev_ver_package_name column
 * @method array findByDevVerCode(string $dev_ver_code) Return Device objects filtered by the dev_ver_code column
 * @method array findByDevVerNumber(string $dev_ver_number) Return Device objects filtered by the dev_ver_number column
 * @method array findByDevEstado(int $dev_estado) Return Device objects filtered by the dev_estado column
 * @method array findByDevEliminado(boolean $dev_eliminado) Return Device objects filtered by the dev_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Device objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Device objects filtered by the updated_at column
 */
abstract class BaseDeviceQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDeviceQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'AppBundle\\Model\\Device';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DeviceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   DeviceQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DeviceQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DeviceQuery) {
            return $criteria;
        }
        $query = new DeviceQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Device|Device[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DevicePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Device A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByDevId($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Device A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `dev_id`, `upr_id`, `upa_id`, `dev_app_version`, `dev_cordova`, `dev_model`, `dev_platform`, `dev_uuid`, `dev_version`, `dev_manufacturer`, `dev_isvirtual`, `dev_serial`, `dev_token_apn`, `dev_ver_app_name`, `dev_ver_package_name`, `dev_ver_code`, `dev_ver_number`, `dev_estado`, `dev_eliminado`, `created_at`, `updated_at` FROM `device` WHERE `dev_id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Device();
            $obj->hydrate($row);
            DevicePeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Device|Device[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Device[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DevicePeer::DEV_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DevicePeer::DEV_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the dev_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDevId(1234); // WHERE dev_id = 1234
     * $query->filterByDevId(array(12, 34)); // WHERE dev_id IN (12, 34)
     * $query->filterByDevId(array('min' => 12)); // WHERE dev_id >= 12
     * $query->filterByDevId(array('max' => 12)); // WHERE dev_id <= 12
     * </code>
     *
     * @param     mixed $devId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevId($devId = null, $comparison = null)
    {
        if (is_array($devId)) {
            $useMinMax = false;
            if (isset($devId['min'])) {
                $this->addUsingAlias(DevicePeer::DEV_ID, $devId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($devId['max'])) {
                $this->addUsingAlias(DevicePeer::DEV_ID, $devId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_ID, $devId, $comparison);
    }

    /**
     * Filter the query on the upr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUprId(1234); // WHERE upr_id = 1234
     * $query->filterByUprId(array(12, 34)); // WHERE upr_id IN (12, 34)
     * $query->filterByUprId(array('min' => 12)); // WHERE upr_id >= 12
     * $query->filterByUprId(array('max' => 12)); // WHERE upr_id <= 12
     * </code>
     *
     * @see       filterByUsuarioProfesional()
     *
     * @param     mixed $uprId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByUprId($uprId = null, $comparison = null)
    {
        if (is_array($uprId)) {
            $useMinMax = false;
            if (isset($uprId['min'])) {
                $this->addUsingAlias(DevicePeer::UPR_ID, $uprId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uprId['max'])) {
                $this->addUsingAlias(DevicePeer::UPR_ID, $uprId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevicePeer::UPR_ID, $uprId, $comparison);
    }

    /**
     * Filter the query on the upa_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaId(1234); // WHERE upa_id = 1234
     * $query->filterByUpaId(array(12, 34)); // WHERE upa_id IN (12, 34)
     * $query->filterByUpaId(array('min' => 12)); // WHERE upa_id >= 12
     * $query->filterByUpaId(array('max' => 12)); // WHERE upa_id <= 12
     * </code>
     *
     * @see       filterByUsuarioPadre()
     *
     * @param     mixed $upaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByUpaId($upaId = null, $comparison = null)
    {
        if (is_array($upaId)) {
            $useMinMax = false;
            if (isset($upaId['min'])) {
                $this->addUsingAlias(DevicePeer::UPA_ID, $upaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upaId['max'])) {
                $this->addUsingAlias(DevicePeer::UPA_ID, $upaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevicePeer::UPA_ID, $upaId, $comparison);
    }

    /**
     * Filter the query on the dev_app_version column
     *
     * Example usage:
     * <code>
     * $query->filterByDevAppVersion('fooValue');   // WHERE dev_app_version = 'fooValue'
     * $query->filterByDevAppVersion('%fooValue%'); // WHERE dev_app_version LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devAppVersion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevAppVersion($devAppVersion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devAppVersion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devAppVersion)) {
                $devAppVersion = str_replace('*', '%', $devAppVersion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_APP_VERSION, $devAppVersion, $comparison);
    }

    /**
     * Filter the query on the dev_cordova column
     *
     * Example usage:
     * <code>
     * $query->filterByDevCordova('fooValue');   // WHERE dev_cordova = 'fooValue'
     * $query->filterByDevCordova('%fooValue%'); // WHERE dev_cordova LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devCordova The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevCordova($devCordova = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devCordova)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devCordova)) {
                $devCordova = str_replace('*', '%', $devCordova);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_CORDOVA, $devCordova, $comparison);
    }

    /**
     * Filter the query on the dev_model column
     *
     * Example usage:
     * <code>
     * $query->filterByDevModel('fooValue');   // WHERE dev_model = 'fooValue'
     * $query->filterByDevModel('%fooValue%'); // WHERE dev_model LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devModel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevModel($devModel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devModel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devModel)) {
                $devModel = str_replace('*', '%', $devModel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_MODEL, $devModel, $comparison);
    }

    /**
     * Filter the query on the dev_platform column
     *
     * Example usage:
     * <code>
     * $query->filterByDevPlatform('fooValue');   // WHERE dev_platform = 'fooValue'
     * $query->filterByDevPlatform('%fooValue%'); // WHERE dev_platform LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devPlatform The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevPlatform($devPlatform = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devPlatform)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devPlatform)) {
                $devPlatform = str_replace('*', '%', $devPlatform);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_PLATFORM, $devPlatform, $comparison);
    }

    /**
     * Filter the query on the dev_uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByDevUuid('fooValue');   // WHERE dev_uuid = 'fooValue'
     * $query->filterByDevUuid('%fooValue%'); // WHERE dev_uuid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devUuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevUuid($devUuid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devUuid)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devUuid)) {
                $devUuid = str_replace('*', '%', $devUuid);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_UUID, $devUuid, $comparison);
    }

    /**
     * Filter the query on the dev_version column
     *
     * Example usage:
     * <code>
     * $query->filterByDevVersion('fooValue');   // WHERE dev_version = 'fooValue'
     * $query->filterByDevVersion('%fooValue%'); // WHERE dev_version LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devVersion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevVersion($devVersion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devVersion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devVersion)) {
                $devVersion = str_replace('*', '%', $devVersion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_VERSION, $devVersion, $comparison);
    }

    /**
     * Filter the query on the dev_manufacturer column
     *
     * Example usage:
     * <code>
     * $query->filterByDevManufacturer('fooValue');   // WHERE dev_manufacturer = 'fooValue'
     * $query->filterByDevManufacturer('%fooValue%'); // WHERE dev_manufacturer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devManufacturer The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevManufacturer($devManufacturer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devManufacturer)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devManufacturer)) {
                $devManufacturer = str_replace('*', '%', $devManufacturer);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_MANUFACTURER, $devManufacturer, $comparison);
    }

    /**
     * Filter the query on the dev_isvirtual column
     *
     * Example usage:
     * <code>
     * $query->filterByDevIsvirtual('fooValue');   // WHERE dev_isvirtual = 'fooValue'
     * $query->filterByDevIsvirtual('%fooValue%'); // WHERE dev_isvirtual LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devIsvirtual The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevIsvirtual($devIsvirtual = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devIsvirtual)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devIsvirtual)) {
                $devIsvirtual = str_replace('*', '%', $devIsvirtual);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_ISVIRTUAL, $devIsvirtual, $comparison);
    }

    /**
     * Filter the query on the dev_serial column
     *
     * Example usage:
     * <code>
     * $query->filterByDevSerial('fooValue');   // WHERE dev_serial = 'fooValue'
     * $query->filterByDevSerial('%fooValue%'); // WHERE dev_serial LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devSerial The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevSerial($devSerial = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devSerial)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devSerial)) {
                $devSerial = str_replace('*', '%', $devSerial);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_SERIAL, $devSerial, $comparison);
    }

    /**
     * Filter the query on the dev_token_apn column
     *
     * Example usage:
     * <code>
     * $query->filterByDevTokenApn('fooValue');   // WHERE dev_token_apn = 'fooValue'
     * $query->filterByDevTokenApn('%fooValue%'); // WHERE dev_token_apn LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devTokenApn The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevTokenApn($devTokenApn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devTokenApn)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devTokenApn)) {
                $devTokenApn = str_replace('*', '%', $devTokenApn);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_TOKEN_APN, $devTokenApn, $comparison);
    }

    /**
     * Filter the query on the dev_ver_app_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDevVerAppName('fooValue');   // WHERE dev_ver_app_name = 'fooValue'
     * $query->filterByDevVerAppName('%fooValue%'); // WHERE dev_ver_app_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devVerAppName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevVerAppName($devVerAppName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devVerAppName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devVerAppName)) {
                $devVerAppName = str_replace('*', '%', $devVerAppName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_VER_APP_NAME, $devVerAppName, $comparison);
    }

    /**
     * Filter the query on the dev_ver_package_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDevVerPackageName('fooValue');   // WHERE dev_ver_package_name = 'fooValue'
     * $query->filterByDevVerPackageName('%fooValue%'); // WHERE dev_ver_package_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devVerPackageName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevVerPackageName($devVerPackageName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devVerPackageName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devVerPackageName)) {
                $devVerPackageName = str_replace('*', '%', $devVerPackageName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_VER_PACKAGE_NAME, $devVerPackageName, $comparison);
    }

    /**
     * Filter the query on the dev_ver_code column
     *
     * Example usage:
     * <code>
     * $query->filterByDevVerCode('fooValue');   // WHERE dev_ver_code = 'fooValue'
     * $query->filterByDevVerCode('%fooValue%'); // WHERE dev_ver_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devVerCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevVerCode($devVerCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devVerCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devVerCode)) {
                $devVerCode = str_replace('*', '%', $devVerCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_VER_CODE, $devVerCode, $comparison);
    }

    /**
     * Filter the query on the dev_ver_number column
     *
     * Example usage:
     * <code>
     * $query->filterByDevVerNumber('fooValue');   // WHERE dev_ver_number = 'fooValue'
     * $query->filterByDevVerNumber('%fooValue%'); // WHERE dev_ver_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $devVerNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevVerNumber($devVerNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($devVerNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $devVerNumber)) {
                $devVerNumber = str_replace('*', '%', $devVerNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_VER_NUMBER, $devVerNumber, $comparison);
    }

    /**
     * Filter the query on the dev_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByDevEstado(1234); // WHERE dev_estado = 1234
     * $query->filterByDevEstado(array(12, 34)); // WHERE dev_estado IN (12, 34)
     * $query->filterByDevEstado(array('min' => 12)); // WHERE dev_estado >= 12
     * $query->filterByDevEstado(array('max' => 12)); // WHERE dev_estado <= 12
     * </code>
     *
     * @param     mixed $devEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevEstado($devEstado = null, $comparison = null)
    {
        if (is_array($devEstado)) {
            $useMinMax = false;
            if (isset($devEstado['min'])) {
                $this->addUsingAlias(DevicePeer::DEV_ESTADO, $devEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($devEstado['max'])) {
                $this->addUsingAlias(DevicePeer::DEV_ESTADO, $devEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevicePeer::DEV_ESTADO, $devEstado, $comparison);
    }

    /**
     * Filter the query on the dev_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByDevEliminado(true); // WHERE dev_eliminado = true
     * $query->filterByDevEliminado('yes'); // WHERE dev_eliminado = true
     * </code>
     *
     * @param     boolean|string $devEliminado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByDevEliminado($devEliminado = null, $comparison = null)
    {
        if (is_string($devEliminado)) {
            $devEliminado = in_array(strtolower($devEliminado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DevicePeer::DEV_ELIMINADO, $devEliminado, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at < '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DevicePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DevicePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevicePeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at < '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DevicePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DevicePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevicePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related UsuarioProfesional object
     *
     * @param   UsuarioProfesional|PropelObjectCollection $usuarioProfesional The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DeviceQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioProfesional($usuarioProfesional, $comparison = null)
    {
        if ($usuarioProfesional instanceof UsuarioProfesional) {
            return $this
                ->addUsingAlias(DevicePeer::UPR_ID, $usuarioProfesional->getUprId(), $comparison);
        } elseif ($usuarioProfesional instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DevicePeer::UPR_ID, $usuarioProfesional->toKeyValue('PrimaryKey', 'UprId'), $comparison);
        } else {
            throw new PropelException('filterByUsuarioProfesional() only accepts arguments of type UsuarioProfesional or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioProfesional relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function joinUsuarioProfesional($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioProfesional');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UsuarioProfesional');
        }

        return $this;
    }

    /**
     * Use the UsuarioProfesional relation UsuarioProfesional object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\UsuarioProfesionalQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioProfesionalQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsuarioProfesional($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioProfesional', '\AppBundle\Model\UsuarioProfesionalQuery');
    }

    /**
     * Filter the query by a related UsuarioPadre object
     *
     * @param   UsuarioPadre|PropelObjectCollection $usuarioPadre The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DeviceQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioPadre($usuarioPadre, $comparison = null)
    {
        if ($usuarioPadre instanceof UsuarioPadre) {
            return $this
                ->addUsingAlias(DevicePeer::UPA_ID, $usuarioPadre->getUpaId(), $comparison);
        } elseif ($usuarioPadre instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DevicePeer::UPA_ID, $usuarioPadre->toKeyValue('PrimaryKey', 'UpaId'), $comparison);
        } else {
            throw new PropelException('filterByUsuarioPadre() only accepts arguments of type UsuarioPadre or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioPadre relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function joinUsuarioPadre($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioPadre');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UsuarioPadre');
        }

        return $this;
    }

    /**
     * Use the UsuarioPadre relation UsuarioPadre object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\UsuarioPadreQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioPadreQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsuarioPadre($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioPadre', '\AppBundle\Model\UsuarioPadreQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Device $device Object to remove from the list of results
     *
     * @return DeviceQuery The current query, for fluid interface
     */
    public function prune($device = null)
    {
        if ($device) {
            $this->addUsingAlias(DevicePeer::DEV_ID, $device->getDevId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     DeviceQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DevicePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     DeviceQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DevicePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     DeviceQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DevicePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     DeviceQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DevicePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     DeviceQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DevicePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     DeviceQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DevicePeer::CREATED_AT);
    }
}
