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
use AppBundle\Model\TipoPublicacion;
use AppBundle\Model\TipoPublicacionPeer;
use AppBundle\Model\TipoPublicacionQuery;

/**
 * @method TipoPublicacionQuery orderByTpuId($order = Criteria::ASC) Order by the tpu_id column
 * @method TipoPublicacionQuery orderByTpuNombre($order = Criteria::ASC) Order by the tpu_nombre column
 * @method TipoPublicacionQuery orderByTpuEstado($order = Criteria::ASC) Order by the tpu_estado column
 * @method TipoPublicacionQuery orderByTpuEliminado($order = Criteria::ASC) Order by the tpu_eliminado column
 * @method TipoPublicacionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method TipoPublicacionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method TipoPublicacionQuery groupByTpuId() Group by the tpu_id column
 * @method TipoPublicacionQuery groupByTpuNombre() Group by the tpu_nombre column
 * @method TipoPublicacionQuery groupByTpuEstado() Group by the tpu_estado column
 * @method TipoPublicacionQuery groupByTpuEliminado() Group by the tpu_eliminado column
 * @method TipoPublicacionQuery groupByCreatedAt() Group by the created_at column
 * @method TipoPublicacionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method TipoPublicacionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TipoPublicacionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TipoPublicacionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TipoPublicacionQuery leftJoinBlog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Blog relation
 * @method TipoPublicacionQuery rightJoinBlog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Blog relation
 * @method TipoPublicacionQuery innerJoinBlog($relationAlias = null) Adds a INNER JOIN clause to the query using the Blog relation
 *
 * @method TipoPublicacion findOne(PropelPDO $con = null) Return the first TipoPublicacion matching the query
 * @method TipoPublicacion findOneOrCreate(PropelPDO $con = null) Return the first TipoPublicacion matching the query, or a new TipoPublicacion object populated from the query conditions when no match is found
 *
 * @method TipoPublicacion findOneByTpuNombre(string $tpu_nombre) Return the first TipoPublicacion filtered by the tpu_nombre column
 * @method TipoPublicacion findOneByTpuEstado(int $tpu_estado) Return the first TipoPublicacion filtered by the tpu_estado column
 * @method TipoPublicacion findOneByTpuEliminado(int $tpu_eliminado) Return the first TipoPublicacion filtered by the tpu_eliminado column
 * @method TipoPublicacion findOneByCreatedAt(string $created_at) Return the first TipoPublicacion filtered by the created_at column
 * @method TipoPublicacion findOneByUpdatedAt(string $updated_at) Return the first TipoPublicacion filtered by the updated_at column
 *
 * @method array findByTpuId(int $tpu_id) Return TipoPublicacion objects filtered by the tpu_id column
 * @method array findByTpuNombre(string $tpu_nombre) Return TipoPublicacion objects filtered by the tpu_nombre column
 * @method array findByTpuEstado(int $tpu_estado) Return TipoPublicacion objects filtered by the tpu_estado column
 * @method array findByTpuEliminado(int $tpu_eliminado) Return TipoPublicacion objects filtered by the tpu_eliminado column
 * @method array findByCreatedAt(string $created_at) Return TipoPublicacion objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return TipoPublicacion objects filtered by the updated_at column
 */
abstract class BaseTipoPublicacionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTipoPublicacionQuery object.
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
            $modelName = 'AppBundle\\Model\\TipoPublicacion';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TipoPublicacionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TipoPublicacionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TipoPublicacionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TipoPublicacionQuery) {
            return $criteria;
        }
        $query = new TipoPublicacionQuery(null, null, $modelAlias);

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
     * @return   TipoPublicacion|TipoPublicacion[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TipoPublicacionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TipoPublicacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TipoPublicacion A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByTpuId($key, $con = null)
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
     * @return                 TipoPublicacion A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `tpu_id`, `tpu_nombre`, `tpu_estado`, `tpu_eliminado`, `created_at`, `updated_at` FROM `tipo_publicacion` WHERE `tpu_id` = :p0';
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
            $obj = new TipoPublicacion();
            $obj->hydrate($row);
            TipoPublicacionPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TipoPublicacion|TipoPublicacion[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TipoPublicacion[]|mixed the list of results, formatted by the current formatter
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
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TipoPublicacionPeer::TPU_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TipoPublicacionPeer::TPU_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the tpu_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTpuId(1234); // WHERE tpu_id = 1234
     * $query->filterByTpuId(array(12, 34)); // WHERE tpu_id IN (12, 34)
     * $query->filterByTpuId(array('min' => 12)); // WHERE tpu_id >= 12
     * $query->filterByTpuId(array('max' => 12)); // WHERE tpu_id <= 12
     * </code>
     *
     * @param     mixed $tpuId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function filterByTpuId($tpuId = null, $comparison = null)
    {
        if (is_array($tpuId)) {
            $useMinMax = false;
            if (isset($tpuId['min'])) {
                $this->addUsingAlias(TipoPublicacionPeer::TPU_ID, $tpuId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpuId['max'])) {
                $this->addUsingAlias(TipoPublicacionPeer::TPU_ID, $tpuId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPublicacionPeer::TPU_ID, $tpuId, $comparison);
    }

    /**
     * Filter the query on the tpu_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByTpuNombre('fooValue');   // WHERE tpu_nombre = 'fooValue'
     * $query->filterByTpuNombre('%fooValue%'); // WHERE tpu_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tpuNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function filterByTpuNombre($tpuNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tpuNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tpuNombre)) {
                $tpuNombre = str_replace('*', '%', $tpuNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TipoPublicacionPeer::TPU_NOMBRE, $tpuNombre, $comparison);
    }

    /**
     * Filter the query on the tpu_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByTpuEstado(1234); // WHERE tpu_estado = 1234
     * $query->filterByTpuEstado(array(12, 34)); // WHERE tpu_estado IN (12, 34)
     * $query->filterByTpuEstado(array('min' => 12)); // WHERE tpu_estado >= 12
     * $query->filterByTpuEstado(array('max' => 12)); // WHERE tpu_estado <= 12
     * </code>
     *
     * @param     mixed $tpuEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function filterByTpuEstado($tpuEstado = null, $comparison = null)
    {
        if (is_array($tpuEstado)) {
            $useMinMax = false;
            if (isset($tpuEstado['min'])) {
                $this->addUsingAlias(TipoPublicacionPeer::TPU_ESTADO, $tpuEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpuEstado['max'])) {
                $this->addUsingAlias(TipoPublicacionPeer::TPU_ESTADO, $tpuEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPublicacionPeer::TPU_ESTADO, $tpuEstado, $comparison);
    }

    /**
     * Filter the query on the tpu_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByTpuEliminado(1234); // WHERE tpu_eliminado = 1234
     * $query->filterByTpuEliminado(array(12, 34)); // WHERE tpu_eliminado IN (12, 34)
     * $query->filterByTpuEliminado(array('min' => 12)); // WHERE tpu_eliminado >= 12
     * $query->filterByTpuEliminado(array('max' => 12)); // WHERE tpu_eliminado <= 12
     * </code>
     *
     * @param     mixed $tpuEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function filterByTpuEliminado($tpuEliminado = null, $comparison = null)
    {
        if (is_array($tpuEliminado)) {
            $useMinMax = false;
            if (isset($tpuEliminado['min'])) {
                $this->addUsingAlias(TipoPublicacionPeer::TPU_ELIMINADO, $tpuEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpuEliminado['max'])) {
                $this->addUsingAlias(TipoPublicacionPeer::TPU_ELIMINADO, $tpuEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPublicacionPeer::TPU_ELIMINADO, $tpuEliminado, $comparison);
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
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TipoPublicacionPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TipoPublicacionPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPublicacionPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TipoPublicacionPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TipoPublicacionPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPublicacionPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Blog object
     *
     * @param   Blog|PropelObjectCollection $blog  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TipoPublicacionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBlog($blog, $comparison = null)
    {
        if ($blog instanceof Blog) {
            return $this
                ->addUsingAlias(TipoPublicacionPeer::TPU_ID, $blog->getTpuId(), $comparison);
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
     * @return TipoPublicacionQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   TipoPublicacion $tipoPublicacion Object to remove from the list of results
     *
     * @return TipoPublicacionQuery The current query, for fluid interface
     */
    public function prune($tipoPublicacion = null)
    {
        if ($tipoPublicacion) {
            $this->addUsingAlias(TipoPublicacionPeer::TPU_ID, $tipoPublicacion->getTpuId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     TipoPublicacionQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TipoPublicacionPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     TipoPublicacionQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TipoPublicacionPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     TipoPublicacionQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TipoPublicacionPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     TipoPublicacionQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TipoPublicacionPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     TipoPublicacionQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TipoPublicacionPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     TipoPublicacionQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TipoPublicacionPeer::CREATED_AT);
    }
}
