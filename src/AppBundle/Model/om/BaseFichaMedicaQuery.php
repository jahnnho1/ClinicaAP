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
use AppBundle\Model\FichaMedica;
use AppBundle\Model\FichaMedicaPeer;
use AppBundle\Model\FichaMedicaQuery;
use AppBundle\Model\PacienteFichamedica;

/**
 * @method FichaMedicaQuery orderByFmeId($order = Criteria::ASC) Order by the fme_id column
 * @method FichaMedicaQuery orderByFmeDescripcion($order = Criteria::ASC) Order by the fme_descripcion column
 * @method FichaMedicaQuery orderByFmeNombre($order = Criteria::ASC) Order by the fme_nombre column
 * @method FichaMedicaQuery orderByFmeNumeroFicha($order = Criteria::ASC) Order by the fme_numero_ficha column
 * @method FichaMedicaQuery orderByFmeEstado($order = Criteria::ASC) Order by the fme_estado column
 * @method FichaMedicaQuery orderByFmeEliminado($order = Criteria::ASC) Order by the fme_eliminado column
 * @method FichaMedicaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method FichaMedicaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method FichaMedicaQuery groupByFmeId() Group by the fme_id column
 * @method FichaMedicaQuery groupByFmeDescripcion() Group by the fme_descripcion column
 * @method FichaMedicaQuery groupByFmeNombre() Group by the fme_nombre column
 * @method FichaMedicaQuery groupByFmeNumeroFicha() Group by the fme_numero_ficha column
 * @method FichaMedicaQuery groupByFmeEstado() Group by the fme_estado column
 * @method FichaMedicaQuery groupByFmeEliminado() Group by the fme_eliminado column
 * @method FichaMedicaQuery groupByCreatedAt() Group by the created_at column
 * @method FichaMedicaQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method FichaMedicaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FichaMedicaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FichaMedicaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FichaMedicaQuery leftJoinPacienteFichamedica($relationAlias = null) Adds a LEFT JOIN clause to the query using the PacienteFichamedica relation
 * @method FichaMedicaQuery rightJoinPacienteFichamedica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PacienteFichamedica relation
 * @method FichaMedicaQuery innerJoinPacienteFichamedica($relationAlias = null) Adds a INNER JOIN clause to the query using the PacienteFichamedica relation
 *
 * @method FichaMedica findOne(PropelPDO $con = null) Return the first FichaMedica matching the query
 * @method FichaMedica findOneOrCreate(PropelPDO $con = null) Return the first FichaMedica matching the query, or a new FichaMedica object populated from the query conditions when no match is found
 *
 * @method FichaMedica findOneByFmeDescripcion(string $fme_descripcion) Return the first FichaMedica filtered by the fme_descripcion column
 * @method FichaMedica findOneByFmeNombre(string $fme_nombre) Return the first FichaMedica filtered by the fme_nombre column
 * @method FichaMedica findOneByFmeNumeroFicha(int $fme_numero_ficha) Return the first FichaMedica filtered by the fme_numero_ficha column
 * @method FichaMedica findOneByFmeEstado(int $fme_estado) Return the first FichaMedica filtered by the fme_estado column
 * @method FichaMedica findOneByFmeEliminado(int $fme_eliminado) Return the first FichaMedica filtered by the fme_eliminado column
 * @method FichaMedica findOneByCreatedAt(string $created_at) Return the first FichaMedica filtered by the created_at column
 * @method FichaMedica findOneByUpdatedAt(string $updated_at) Return the first FichaMedica filtered by the updated_at column
 *
 * @method array findByFmeId(int $fme_id) Return FichaMedica objects filtered by the fme_id column
 * @method array findByFmeDescripcion(string $fme_descripcion) Return FichaMedica objects filtered by the fme_descripcion column
 * @method array findByFmeNombre(string $fme_nombre) Return FichaMedica objects filtered by the fme_nombre column
 * @method array findByFmeNumeroFicha(int $fme_numero_ficha) Return FichaMedica objects filtered by the fme_numero_ficha column
 * @method array findByFmeEstado(int $fme_estado) Return FichaMedica objects filtered by the fme_estado column
 * @method array findByFmeEliminado(int $fme_eliminado) Return FichaMedica objects filtered by the fme_eliminado column
 * @method array findByCreatedAt(string $created_at) Return FichaMedica objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return FichaMedica objects filtered by the updated_at column
 */
abstract class BaseFichaMedicaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFichaMedicaQuery object.
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
            $modelName = 'AppBundle\\Model\\FichaMedica';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FichaMedicaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   FichaMedicaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FichaMedicaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FichaMedicaQuery) {
            return $criteria;
        }
        $query = new FichaMedicaQuery(null, null, $modelAlias);

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
     * @return   FichaMedica|FichaMedica[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FichaMedicaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FichaMedicaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 FichaMedica A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByFmeId($key, $con = null)
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
     * @return                 FichaMedica A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `fme_id`, `fme_descripcion`, `fme_nombre`, `fme_numero_ficha`, `fme_estado`, `fme_eliminado`, `created_at`, `updated_at` FROM `ficha_medica` WHERE `fme_id` = :p0';
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
            $obj = new FichaMedica();
            $obj->hydrate($row);
            FichaMedicaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return FichaMedica|FichaMedica[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|FichaMedica[]|mixed the list of results, formatted by the current formatter
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
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FichaMedicaPeer::FME_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FichaMedicaPeer::FME_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the fme_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFmeId(1234); // WHERE fme_id = 1234
     * $query->filterByFmeId(array(12, 34)); // WHERE fme_id IN (12, 34)
     * $query->filterByFmeId(array('min' => 12)); // WHERE fme_id >= 12
     * $query->filterByFmeId(array('max' => 12)); // WHERE fme_id <= 12
     * </code>
     *
     * @param     mixed $fmeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByFmeId($fmeId = null, $comparison = null)
    {
        if (is_array($fmeId)) {
            $useMinMax = false;
            if (isset($fmeId['min'])) {
                $this->addUsingAlias(FichaMedicaPeer::FME_ID, $fmeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fmeId['max'])) {
                $this->addUsingAlias(FichaMedicaPeer::FME_ID, $fmeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichaMedicaPeer::FME_ID, $fmeId, $comparison);
    }

    /**
     * Filter the query on the fme_descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByFmeDescripcion('fooValue');   // WHERE fme_descripcion = 'fooValue'
     * $query->filterByFmeDescripcion('%fooValue%'); // WHERE fme_descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fmeDescripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByFmeDescripcion($fmeDescripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fmeDescripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fmeDescripcion)) {
                $fmeDescripcion = str_replace('*', '%', $fmeDescripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FichaMedicaPeer::FME_DESCRIPCION, $fmeDescripcion, $comparison);
    }

    /**
     * Filter the query on the fme_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByFmeNombre('fooValue');   // WHERE fme_nombre = 'fooValue'
     * $query->filterByFmeNombre('%fooValue%'); // WHERE fme_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fmeNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByFmeNombre($fmeNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fmeNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fmeNombre)) {
                $fmeNombre = str_replace('*', '%', $fmeNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FichaMedicaPeer::FME_NOMBRE, $fmeNombre, $comparison);
    }

    /**
     * Filter the query on the fme_numero_ficha column
     *
     * Example usage:
     * <code>
     * $query->filterByFmeNumeroFicha(1234); // WHERE fme_numero_ficha = 1234
     * $query->filterByFmeNumeroFicha(array(12, 34)); // WHERE fme_numero_ficha IN (12, 34)
     * $query->filterByFmeNumeroFicha(array('min' => 12)); // WHERE fme_numero_ficha >= 12
     * $query->filterByFmeNumeroFicha(array('max' => 12)); // WHERE fme_numero_ficha <= 12
     * </code>
     *
     * @param     mixed $fmeNumeroFicha The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByFmeNumeroFicha($fmeNumeroFicha = null, $comparison = null)
    {
        if (is_array($fmeNumeroFicha)) {
            $useMinMax = false;
            if (isset($fmeNumeroFicha['min'])) {
                $this->addUsingAlias(FichaMedicaPeer::FME_NUMERO_FICHA, $fmeNumeroFicha['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fmeNumeroFicha['max'])) {
                $this->addUsingAlias(FichaMedicaPeer::FME_NUMERO_FICHA, $fmeNumeroFicha['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichaMedicaPeer::FME_NUMERO_FICHA, $fmeNumeroFicha, $comparison);
    }

    /**
     * Filter the query on the fme_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByFmeEstado(1234); // WHERE fme_estado = 1234
     * $query->filterByFmeEstado(array(12, 34)); // WHERE fme_estado IN (12, 34)
     * $query->filterByFmeEstado(array('min' => 12)); // WHERE fme_estado >= 12
     * $query->filterByFmeEstado(array('max' => 12)); // WHERE fme_estado <= 12
     * </code>
     *
     * @param     mixed $fmeEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByFmeEstado($fmeEstado = null, $comparison = null)
    {
        if (is_array($fmeEstado)) {
            $useMinMax = false;
            if (isset($fmeEstado['min'])) {
                $this->addUsingAlias(FichaMedicaPeer::FME_ESTADO, $fmeEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fmeEstado['max'])) {
                $this->addUsingAlias(FichaMedicaPeer::FME_ESTADO, $fmeEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichaMedicaPeer::FME_ESTADO, $fmeEstado, $comparison);
    }

    /**
     * Filter the query on the fme_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByFmeEliminado(1234); // WHERE fme_eliminado = 1234
     * $query->filterByFmeEliminado(array(12, 34)); // WHERE fme_eliminado IN (12, 34)
     * $query->filterByFmeEliminado(array('min' => 12)); // WHERE fme_eliminado >= 12
     * $query->filterByFmeEliminado(array('max' => 12)); // WHERE fme_eliminado <= 12
     * </code>
     *
     * @param     mixed $fmeEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByFmeEliminado($fmeEliminado = null, $comparison = null)
    {
        if (is_array($fmeEliminado)) {
            $useMinMax = false;
            if (isset($fmeEliminado['min'])) {
                $this->addUsingAlias(FichaMedicaPeer::FME_ELIMINADO, $fmeEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fmeEliminado['max'])) {
                $this->addUsingAlias(FichaMedicaPeer::FME_ELIMINADO, $fmeEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichaMedicaPeer::FME_ELIMINADO, $fmeEliminado, $comparison);
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
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(FichaMedicaPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FichaMedicaPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichaMedicaPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(FichaMedicaPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(FichaMedicaPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FichaMedicaPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related PacienteFichamedica object
     *
     * @param   PacienteFichamedica|PropelObjectCollection $pacienteFichamedica  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 FichaMedicaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPacienteFichamedica($pacienteFichamedica, $comparison = null)
    {
        if ($pacienteFichamedica instanceof PacienteFichamedica) {
            return $this
                ->addUsingAlias(FichaMedicaPeer::FME_ID, $pacienteFichamedica->getFmeId(), $comparison);
        } elseif ($pacienteFichamedica instanceof PropelObjectCollection) {
            return $this
                ->usePacienteFichamedicaQuery()
                ->filterByPrimaryKeys($pacienteFichamedica->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPacienteFichamedica() only accepts arguments of type PacienteFichamedica or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PacienteFichamedica relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function joinPacienteFichamedica($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PacienteFichamedica');

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
            $this->addJoinObject($join, 'PacienteFichamedica');
        }

        return $this;
    }

    /**
     * Use the PacienteFichamedica relation PacienteFichamedica object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\PacienteFichamedicaQuery A secondary query class using the current class as primary query
     */
    public function usePacienteFichamedicaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPacienteFichamedica($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PacienteFichamedica', '\AppBundle\Model\PacienteFichamedicaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   FichaMedica $fichaMedica Object to remove from the list of results
     *
     * @return FichaMedicaQuery The current query, for fluid interface
     */
    public function prune($fichaMedica = null)
    {
        if ($fichaMedica) {
            $this->addUsingAlias(FichaMedicaPeer::FME_ID, $fichaMedica->getFmeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     FichaMedicaQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(FichaMedicaPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     FichaMedicaQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(FichaMedicaPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     FichaMedicaQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(FichaMedicaPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     FichaMedicaQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(FichaMedicaPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     FichaMedicaQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(FichaMedicaPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     FichaMedicaQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(FichaMedicaPeer::CREATED_AT);
    }
}
