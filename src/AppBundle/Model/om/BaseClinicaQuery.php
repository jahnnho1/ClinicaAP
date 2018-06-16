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
use AppBundle\Model\Blog;
use AppBundle\Model\Clinica;
use AppBundle\Model\ClinicaPeer;
use AppBundle\Model\ClinicaQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\UsuarioAdministrativo;
use AppBundle\Model\UsuarioProfesional;

/**
 * @method ClinicaQuery orderByCliId($order = Criteria::ASC) Order by the cli_id column
 * @method ClinicaQuery orderByCliNombre($order = Criteria::ASC) Order by the cli_nombre column
 * @method ClinicaQuery orderByCliNumeroMesaCentral($order = Criteria::ASC) Order by the cli_numero_mesa_central column
 * @method ClinicaQuery orderByCliNumeroRescate($order = Criteria::ASC) Order by the cli_numero_rescate column
 * @method ClinicaQuery orderByCliDireccion($order = Criteria::ASC) Order by the cli_direccion column
 * @method ClinicaQuery orderByCliEstado($order = Criteria::ASC) Order by the cli_estado column
 * @method ClinicaQuery orderByCliEliminado($order = Criteria::ASC) Order by the cli_eliminado column
 * @method ClinicaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method ClinicaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method ClinicaQuery groupByCliId() Group by the cli_id column
 * @method ClinicaQuery groupByCliNombre() Group by the cli_nombre column
 * @method ClinicaQuery groupByCliNumeroMesaCentral() Group by the cli_numero_mesa_central column
 * @method ClinicaQuery groupByCliNumeroRescate() Group by the cli_numero_rescate column
 * @method ClinicaQuery groupByCliDireccion() Group by the cli_direccion column
 * @method ClinicaQuery groupByCliEstado() Group by the cli_estado column
 * @method ClinicaQuery groupByCliEliminado() Group by the cli_eliminado column
 * @method ClinicaQuery groupByCreatedAt() Group by the created_at column
 * @method ClinicaQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method ClinicaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ClinicaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ClinicaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ClinicaQuery leftJoinBlog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Blog relation
 * @method ClinicaQuery rightJoinBlog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Blog relation
 * @method ClinicaQuery innerJoinBlog($relationAlias = null) Adds a INNER JOIN clause to the query using the Blog relation
 *
 * @method ClinicaQuery leftJoinRecurso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recurso relation
 * @method ClinicaQuery rightJoinRecurso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recurso relation
 * @method ClinicaQuery innerJoinRecurso($relationAlias = null) Adds a INNER JOIN clause to the query using the Recurso relation
 *
 * @method ClinicaQuery leftJoinUsuarioAdministrativo($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioAdministrativo relation
 * @method ClinicaQuery rightJoinUsuarioAdministrativo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioAdministrativo relation
 * @method ClinicaQuery innerJoinUsuarioAdministrativo($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioAdministrativo relation
 *
 * @method ClinicaQuery leftJoinUsuarioProfesional($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioProfesional relation
 * @method ClinicaQuery rightJoinUsuarioProfesional($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioProfesional relation
 * @method ClinicaQuery innerJoinUsuarioProfesional($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioProfesional relation
 *
 * @method Clinica findOne(PropelPDO $con = null) Return the first Clinica matching the query
 * @method Clinica findOneOrCreate(PropelPDO $con = null) Return the first Clinica matching the query, or a new Clinica object populated from the query conditions when no match is found
 *
 * @method Clinica findOneByCliNombre(string $cli_nombre) Return the first Clinica filtered by the cli_nombre column
 * @method Clinica findOneByCliNumeroMesaCentral(string $cli_numero_mesa_central) Return the first Clinica filtered by the cli_numero_mesa_central column
 * @method Clinica findOneByCliNumeroRescate(string $cli_numero_rescate) Return the first Clinica filtered by the cli_numero_rescate column
 * @method Clinica findOneByCliDireccion(string $cli_direccion) Return the first Clinica filtered by the cli_direccion column
 * @method Clinica findOneByCliEstado(int $cli_estado) Return the first Clinica filtered by the cli_estado column
 * @method Clinica findOneByCliEliminado(int $cli_eliminado) Return the first Clinica filtered by the cli_eliminado column
 * @method Clinica findOneByCreatedAt(string $created_at) Return the first Clinica filtered by the created_at column
 * @method Clinica findOneByUpdatedAt(string $updated_at) Return the first Clinica filtered by the updated_at column
 *
 * @method array findByCliId(int $cli_id) Return Clinica objects filtered by the cli_id column
 * @method array findByCliNombre(string $cli_nombre) Return Clinica objects filtered by the cli_nombre column
 * @method array findByCliNumeroMesaCentral(string $cli_numero_mesa_central) Return Clinica objects filtered by the cli_numero_mesa_central column
 * @method array findByCliNumeroRescate(string $cli_numero_rescate) Return Clinica objects filtered by the cli_numero_rescate column
 * @method array findByCliDireccion(string $cli_direccion) Return Clinica objects filtered by the cli_direccion column
 * @method array findByCliEstado(int $cli_estado) Return Clinica objects filtered by the cli_estado column
 * @method array findByCliEliminado(int $cli_eliminado) Return Clinica objects filtered by the cli_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Clinica objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Clinica objects filtered by the updated_at column
 */
abstract class BaseClinicaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseClinicaQuery object.
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
            $modelName = 'AppBundle\\Model\\Clinica';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ClinicaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ClinicaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ClinicaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ClinicaQuery) {
            return $criteria;
        }
        $query = new ClinicaQuery(null, null, $modelAlias);

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
     * @return   Clinica|Clinica[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ClinicaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ClinicaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Clinica A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByCliId($key, $con = null)
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
     * @return                 Clinica A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `cli_id`, `cli_nombre`, `cli_numero_mesa_central`, `cli_numero_rescate`, `cli_direccion`, `cli_estado`, `cli_eliminado`, `created_at`, `updated_at` FROM `clinica` WHERE `cli_id` = :p0';
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
            $obj = new Clinica();
            $obj->hydrate($row);
            ClinicaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Clinica|Clinica[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Clinica[]|mixed the list of results, formatted by the current formatter
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
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ClinicaPeer::CLI_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ClinicaPeer::CLI_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the cli_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCliId(1234); // WHERE cli_id = 1234
     * $query->filterByCliId(array(12, 34)); // WHERE cli_id IN (12, 34)
     * $query->filterByCliId(array('min' => 12)); // WHERE cli_id >= 12
     * $query->filterByCliId(array('max' => 12)); // WHERE cli_id <= 12
     * </code>
     *
     * @param     mixed $cliId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByCliId($cliId = null, $comparison = null)
    {
        if (is_array($cliId)) {
            $useMinMax = false;
            if (isset($cliId['min'])) {
                $this->addUsingAlias(ClinicaPeer::CLI_ID, $cliId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cliId['max'])) {
                $this->addUsingAlias(ClinicaPeer::CLI_ID, $cliId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::CLI_ID, $cliId, $comparison);
    }

    /**
     * Filter the query on the cli_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByCliNombre('fooValue');   // WHERE cli_nombre = 'fooValue'
     * $query->filterByCliNombre('%fooValue%'); // WHERE cli_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cliNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByCliNombre($cliNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cliNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cliNombre)) {
                $cliNombre = str_replace('*', '%', $cliNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::CLI_NOMBRE, $cliNombre, $comparison);
    }

    /**
     * Filter the query on the cli_numero_mesa_central column
     *
     * Example usage:
     * <code>
     * $query->filterByCliNumeroMesaCentral('fooValue');   // WHERE cli_numero_mesa_central = 'fooValue'
     * $query->filterByCliNumeroMesaCentral('%fooValue%'); // WHERE cli_numero_mesa_central LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cliNumeroMesaCentral The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByCliNumeroMesaCentral($cliNumeroMesaCentral = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cliNumeroMesaCentral)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cliNumeroMesaCentral)) {
                $cliNumeroMesaCentral = str_replace('*', '%', $cliNumeroMesaCentral);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::CLI_NUMERO_MESA_CENTRAL, $cliNumeroMesaCentral, $comparison);
    }

    /**
     * Filter the query on the cli_numero_rescate column
     *
     * Example usage:
     * <code>
     * $query->filterByCliNumeroRescate('fooValue');   // WHERE cli_numero_rescate = 'fooValue'
     * $query->filterByCliNumeroRescate('%fooValue%'); // WHERE cli_numero_rescate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cliNumeroRescate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByCliNumeroRescate($cliNumeroRescate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cliNumeroRescate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cliNumeroRescate)) {
                $cliNumeroRescate = str_replace('*', '%', $cliNumeroRescate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::CLI_NUMERO_RESCATE, $cliNumeroRescate, $comparison);
    }

    /**
     * Filter the query on the cli_direccion column
     *
     * Example usage:
     * <code>
     * $query->filterByCliDireccion('fooValue');   // WHERE cli_direccion = 'fooValue'
     * $query->filterByCliDireccion('%fooValue%'); // WHERE cli_direccion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cliDireccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByCliDireccion($cliDireccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cliDireccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cliDireccion)) {
                $cliDireccion = str_replace('*', '%', $cliDireccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::CLI_DIRECCION, $cliDireccion, $comparison);
    }

    /**
     * Filter the query on the cli_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByCliEstado(1234); // WHERE cli_estado = 1234
     * $query->filterByCliEstado(array(12, 34)); // WHERE cli_estado IN (12, 34)
     * $query->filterByCliEstado(array('min' => 12)); // WHERE cli_estado >= 12
     * $query->filterByCliEstado(array('max' => 12)); // WHERE cli_estado <= 12
     * </code>
     *
     * @param     mixed $cliEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByCliEstado($cliEstado = null, $comparison = null)
    {
        if (is_array($cliEstado)) {
            $useMinMax = false;
            if (isset($cliEstado['min'])) {
                $this->addUsingAlias(ClinicaPeer::CLI_ESTADO, $cliEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cliEstado['max'])) {
                $this->addUsingAlias(ClinicaPeer::CLI_ESTADO, $cliEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::CLI_ESTADO, $cliEstado, $comparison);
    }

    /**
     * Filter the query on the cli_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByCliEliminado(1234); // WHERE cli_eliminado = 1234
     * $query->filterByCliEliminado(array(12, 34)); // WHERE cli_eliminado IN (12, 34)
     * $query->filterByCliEliminado(array('min' => 12)); // WHERE cli_eliminado >= 12
     * $query->filterByCliEliminado(array('max' => 12)); // WHERE cli_eliminado <= 12
     * </code>
     *
     * @param     mixed $cliEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByCliEliminado($cliEliminado = null, $comparison = null)
    {
        if (is_array($cliEliminado)) {
            $useMinMax = false;
            if (isset($cliEliminado['min'])) {
                $this->addUsingAlias(ClinicaPeer::CLI_ELIMINADO, $cliEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cliEliminado['max'])) {
                $this->addUsingAlias(ClinicaPeer::CLI_ELIMINADO, $cliEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::CLI_ELIMINADO, $cliEliminado, $comparison);
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
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ClinicaPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ClinicaPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ClinicaPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ClinicaPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClinicaPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Blog object
     *
     * @param   Blog|PropelObjectCollection $blog  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ClinicaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBlog($blog, $comparison = null)
    {
        if ($blog instanceof Blog) {
            return $this
                ->addUsingAlias(ClinicaPeer::CLI_ID, $blog->getCliId(), $comparison);
        } elseif ($blog instanceof PropelObjectCollection) {
            return $this
                ->useBlogQuery()
                ->filterByPrimaryKeys($blog->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBlog() only accepts arguments of type Blog or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Blog relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function joinBlog($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Blog');

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
            $this->addJoinObject($join, 'Blog');
        }

        return $this;
    }

    /**
     * Use the Blog relation Blog object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\BlogQuery A secondary query class using the current class as primary query
     */
    public function useBlogQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBlog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Blog', '\AppBundle\Model\BlogQuery');
    }

    /**
     * Filter the query by a related Recurso object
     *
     * @param   Recurso|PropelObjectCollection $recurso  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ClinicaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRecurso($recurso, $comparison = null)
    {
        if ($recurso instanceof Recurso) {
            return $this
                ->addUsingAlias(ClinicaPeer::CLI_ID, $recurso->getCliId(), $comparison);
        } elseif ($recurso instanceof PropelObjectCollection) {
            return $this
                ->useRecursoQuery()
                ->filterByPrimaryKeys($recurso->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRecurso() only accepts arguments of type Recurso or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Recurso relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function joinRecurso($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Recurso');

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
            $this->addJoinObject($join, 'Recurso');
        }

        return $this;
    }

    /**
     * Use the Recurso relation Recurso object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\RecursoQuery A secondary query class using the current class as primary query
     */
    public function useRecursoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRecurso($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Recurso', '\AppBundle\Model\RecursoQuery');
    }

    /**
     * Filter the query by a related UsuarioAdministrativo object
     *
     * @param   UsuarioAdministrativo|PropelObjectCollection $usuarioAdministrativo  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ClinicaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioAdministrativo($usuarioAdministrativo, $comparison = null)
    {
        if ($usuarioAdministrativo instanceof UsuarioAdministrativo) {
            return $this
                ->addUsingAlias(ClinicaPeer::CLI_ID, $usuarioAdministrativo->getCliId(), $comparison);
        } elseif ($usuarioAdministrativo instanceof PropelObjectCollection) {
            return $this
                ->useUsuarioAdministrativoQuery()
                ->filterByPrimaryKeys($usuarioAdministrativo->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuarioAdministrativo() only accepts arguments of type UsuarioAdministrativo or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioAdministrativo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function joinUsuarioAdministrativo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioAdministrativo');

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
            $this->addJoinObject($join, 'UsuarioAdministrativo');
        }

        return $this;
    }

    /**
     * Use the UsuarioAdministrativo relation UsuarioAdministrativo object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\UsuarioAdministrativoQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioAdministrativoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsuarioAdministrativo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioAdministrativo', '\AppBundle\Model\UsuarioAdministrativoQuery');
    }

    /**
     * Filter the query by a related UsuarioProfesional object
     *
     * @param   UsuarioProfesional|PropelObjectCollection $usuarioProfesional  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ClinicaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioProfesional($usuarioProfesional, $comparison = null)
    {
        if ($usuarioProfesional instanceof UsuarioProfesional) {
            return $this
                ->addUsingAlias(ClinicaPeer::CLI_ID, $usuarioProfesional->getCliId(), $comparison);
        } elseif ($usuarioProfesional instanceof PropelObjectCollection) {
            return $this
                ->useUsuarioProfesionalQuery()
                ->filterByPrimaryKeys($usuarioProfesional->getPrimaryKeys())
                ->endUse();
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
     * @return ClinicaQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Clinica $clinica Object to remove from the list of results
     *
     * @return ClinicaQuery The current query, for fluid interface
     */
    public function prune($clinica = null)
    {
        if ($clinica) {
            $this->addUsingAlias(ClinicaPeer::CLI_ID, $clinica->getCliId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ClinicaQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ClinicaPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ClinicaQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ClinicaPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ClinicaQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ClinicaPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ClinicaQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ClinicaPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ClinicaQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ClinicaPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ClinicaQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ClinicaPeer::CREATED_AT);
    }
}
