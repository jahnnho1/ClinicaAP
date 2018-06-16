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
use AppBundle\Model\Especialidad;
use AppBundle\Model\TipoEspecialidad;
use AppBundle\Model\TipoEspecialidadPeer;
use AppBundle\Model\TipoEspecialidadQuery;

/**
 * @method TipoEspecialidadQuery orderByTesId($order = Criteria::ASC) Order by the tes_id column
 * @method TipoEspecialidadQuery orderByTesNombre($order = Criteria::ASC) Order by the tes_nombre column
 * @method TipoEspecialidadQuery orderByTesEstado($order = Criteria::ASC) Order by the tes_estado column
 * @method TipoEspecialidadQuery orderByTesEliminado($order = Criteria::ASC) Order by the tes_eliminado column
 * @method TipoEspecialidadQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method TipoEspecialidadQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method TipoEspecialidadQuery groupByTesId() Group by the tes_id column
 * @method TipoEspecialidadQuery groupByTesNombre() Group by the tes_nombre column
 * @method TipoEspecialidadQuery groupByTesEstado() Group by the tes_estado column
 * @method TipoEspecialidadQuery groupByTesEliminado() Group by the tes_eliminado column
 * @method TipoEspecialidadQuery groupByCreatedAt() Group by the created_at column
 * @method TipoEspecialidadQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method TipoEspecialidadQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TipoEspecialidadQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TipoEspecialidadQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TipoEspecialidadQuery leftJoinEspecialidad($relationAlias = null) Adds a LEFT JOIN clause to the query using the Especialidad relation
 * @method TipoEspecialidadQuery rightJoinEspecialidad($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Especialidad relation
 * @method TipoEspecialidadQuery innerJoinEspecialidad($relationAlias = null) Adds a INNER JOIN clause to the query using the Especialidad relation
 *
 * @method TipoEspecialidad findOne(PropelPDO $con = null) Return the first TipoEspecialidad matching the query
 * @method TipoEspecialidad findOneOrCreate(PropelPDO $con = null) Return the first TipoEspecialidad matching the query, or a new TipoEspecialidad object populated from the query conditions when no match is found
 *
 * @method TipoEspecialidad findOneByTesNombre(string $tes_nombre) Return the first TipoEspecialidad filtered by the tes_nombre column
 * @method TipoEspecialidad findOneByTesEstado(int $tes_estado) Return the first TipoEspecialidad filtered by the tes_estado column
 * @method TipoEspecialidad findOneByTesEliminado(int $tes_eliminado) Return the first TipoEspecialidad filtered by the tes_eliminado column
 * @method TipoEspecialidad findOneByCreatedAt(string $created_at) Return the first TipoEspecialidad filtered by the created_at column
 * @method TipoEspecialidad findOneByUpdatedAt(string $updated_at) Return the first TipoEspecialidad filtered by the updated_at column
 *
 * @method array findByTesId(int $tes_id) Return TipoEspecialidad objects filtered by the tes_id column
 * @method array findByTesNombre(string $tes_nombre) Return TipoEspecialidad objects filtered by the tes_nombre column
 * @method array findByTesEstado(int $tes_estado) Return TipoEspecialidad objects filtered by the tes_estado column
 * @method array findByTesEliminado(int $tes_eliminado) Return TipoEspecialidad objects filtered by the tes_eliminado column
 * @method array findByCreatedAt(string $created_at) Return TipoEspecialidad objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return TipoEspecialidad objects filtered by the updated_at column
 */
abstract class BaseTipoEspecialidadQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTipoEspecialidadQuery object.
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
            $modelName = 'AppBundle\\Model\\TipoEspecialidad';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TipoEspecialidadQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TipoEspecialidadQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TipoEspecialidadQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TipoEspecialidadQuery) {
            return $criteria;
        }
        $query = new TipoEspecialidadQuery(null, null, $modelAlias);

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
     * @return   TipoEspecialidad|TipoEspecialidad[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TipoEspecialidadPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TipoEspecialidadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TipoEspecialidad A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByTesId($key, $con = null)
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
     * @return                 TipoEspecialidad A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `tes_id`, `tes_nombre`, `tes_estado`, `tes_eliminado`, `created_at`, `updated_at` FROM `tipo_especialidad` WHERE `tes_id` = :p0';
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
            $obj = new TipoEspecialidad();
            $obj->hydrate($row);
            TipoEspecialidadPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TipoEspecialidad|TipoEspecialidad[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TipoEspecialidad[]|mixed the list of results, formatted by the current formatter
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
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TipoEspecialidadPeer::TES_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TipoEspecialidadPeer::TES_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the tes_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTesId(1234); // WHERE tes_id = 1234
     * $query->filterByTesId(array(12, 34)); // WHERE tes_id IN (12, 34)
     * $query->filterByTesId(array('min' => 12)); // WHERE tes_id >= 12
     * $query->filterByTesId(array('max' => 12)); // WHERE tes_id <= 12
     * </code>
     *
     * @param     mixed $tesId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function filterByTesId($tesId = null, $comparison = null)
    {
        if (is_array($tesId)) {
            $useMinMax = false;
            if (isset($tesId['min'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::TES_ID, $tesId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tesId['max'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::TES_ID, $tesId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoEspecialidadPeer::TES_ID, $tesId, $comparison);
    }

    /**
     * Filter the query on the tes_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByTesNombre('fooValue');   // WHERE tes_nombre = 'fooValue'
     * $query->filterByTesNombre('%fooValue%'); // WHERE tes_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tesNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function filterByTesNombre($tesNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tesNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tesNombre)) {
                $tesNombre = str_replace('*', '%', $tesNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TipoEspecialidadPeer::TES_NOMBRE, $tesNombre, $comparison);
    }

    /**
     * Filter the query on the tes_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByTesEstado(1234); // WHERE tes_estado = 1234
     * $query->filterByTesEstado(array(12, 34)); // WHERE tes_estado IN (12, 34)
     * $query->filterByTesEstado(array('min' => 12)); // WHERE tes_estado >= 12
     * $query->filterByTesEstado(array('max' => 12)); // WHERE tes_estado <= 12
     * </code>
     *
     * @param     mixed $tesEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function filterByTesEstado($tesEstado = null, $comparison = null)
    {
        if (is_array($tesEstado)) {
            $useMinMax = false;
            if (isset($tesEstado['min'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::TES_ESTADO, $tesEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tesEstado['max'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::TES_ESTADO, $tesEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoEspecialidadPeer::TES_ESTADO, $tesEstado, $comparison);
    }

    /**
     * Filter the query on the tes_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByTesEliminado(1234); // WHERE tes_eliminado = 1234
     * $query->filterByTesEliminado(array(12, 34)); // WHERE tes_eliminado IN (12, 34)
     * $query->filterByTesEliminado(array('min' => 12)); // WHERE tes_eliminado >= 12
     * $query->filterByTesEliminado(array('max' => 12)); // WHERE tes_eliminado <= 12
     * </code>
     *
     * @param     mixed $tesEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function filterByTesEliminado($tesEliminado = null, $comparison = null)
    {
        if (is_array($tesEliminado)) {
            $useMinMax = false;
            if (isset($tesEliminado['min'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::TES_ELIMINADO, $tesEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tesEliminado['max'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::TES_ELIMINADO, $tesEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoEspecialidadPeer::TES_ELIMINADO, $tesEliminado, $comparison);
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
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoEspecialidadPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TipoEspecialidadPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoEspecialidadPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Especialidad object
     *
     * @param   Especialidad|PropelObjectCollection $especialidad  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TipoEspecialidadQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEspecialidad($especialidad, $comparison = null)
    {
        if ($especialidad instanceof Especialidad) {
            return $this
                ->addUsingAlias(TipoEspecialidadPeer::TES_ID, $especialidad->getTesId(), $comparison);
        } elseif ($especialidad instanceof PropelObjectCollection) {
            return $this
                ->useEspecialidadQuery()
                ->filterByPrimaryKeys($especialidad->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEspecialidad() only accepts arguments of type Especialidad or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Especialidad relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function joinEspecialidad($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Especialidad');

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
            $this->addJoinObject($join, 'Especialidad');
        }

        return $this;
    }

    /**
     * Use the Especialidad relation Especialidad object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\EspecialidadQuery A secondary query class using the current class as primary query
     */
    public function useEspecialidadQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEspecialidad($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Especialidad', '\AppBundle\Model\EspecialidadQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TipoEspecialidad $tipoEspecialidad Object to remove from the list of results
     *
     * @return TipoEspecialidadQuery The current query, for fluid interface
     */
    public function prune($tipoEspecialidad = null)
    {
        if ($tipoEspecialidad) {
            $this->addUsingAlias(TipoEspecialidadPeer::TES_ID, $tipoEspecialidad->getTesId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     TipoEspecialidadQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TipoEspecialidadPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     TipoEspecialidadQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TipoEspecialidadPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     TipoEspecialidadQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TipoEspecialidadPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     TipoEspecialidadQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TipoEspecialidadPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     TipoEspecialidadQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TipoEspecialidadPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     TipoEspecialidadQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TipoEspecialidadPeer::CREATED_AT);
    }
}
