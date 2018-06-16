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
use AppBundle\Model\EspecialidadPeer;
use AppBundle\Model\EspecialidadQuery;
use AppBundle\Model\TipoEspecialidad;
use AppBundle\Model\UsuarioProfesional;

/**
 * @method EspecialidadQuery orderByUprId($order = Criteria::ASC) Order by the upr_id column
 * @method EspecialidadQuery orderByTesId($order = Criteria::ASC) Order by the tes_id column
 * @method EspecialidadQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method EspecialidadQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method EspecialidadQuery groupByUprId() Group by the upr_id column
 * @method EspecialidadQuery groupByTesId() Group by the tes_id column
 * @method EspecialidadQuery groupByCreatedAt() Group by the created_at column
 * @method EspecialidadQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method EspecialidadQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EspecialidadQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EspecialidadQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EspecialidadQuery leftJoinUsuarioProfesional($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioProfesional relation
 * @method EspecialidadQuery rightJoinUsuarioProfesional($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioProfesional relation
 * @method EspecialidadQuery innerJoinUsuarioProfesional($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioProfesional relation
 *
 * @method EspecialidadQuery leftJoinTipoEspecialidad($relationAlias = null) Adds a LEFT JOIN clause to the query using the TipoEspecialidad relation
 * @method EspecialidadQuery rightJoinTipoEspecialidad($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TipoEspecialidad relation
 * @method EspecialidadQuery innerJoinTipoEspecialidad($relationAlias = null) Adds a INNER JOIN clause to the query using the TipoEspecialidad relation
 *
 * @method Especialidad findOne(PropelPDO $con = null) Return the first Especialidad matching the query
 * @method Especialidad findOneOrCreate(PropelPDO $con = null) Return the first Especialidad matching the query, or a new Especialidad object populated from the query conditions when no match is found
 *
 * @method Especialidad findOneByUprId(int $upr_id) Return the first Especialidad filtered by the upr_id column
 * @method Especialidad findOneByTesId(int $tes_id) Return the first Especialidad filtered by the tes_id column
 * @method Especialidad findOneByCreatedAt(string $created_at) Return the first Especialidad filtered by the created_at column
 * @method Especialidad findOneByUpdatedAt(string $updated_at) Return the first Especialidad filtered by the updated_at column
 *
 * @method array findByUprId(int $upr_id) Return Especialidad objects filtered by the upr_id column
 * @method array findByTesId(int $tes_id) Return Especialidad objects filtered by the tes_id column
 * @method array findByCreatedAt(string $created_at) Return Especialidad objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Especialidad objects filtered by the updated_at column
 */
abstract class BaseEspecialidadQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEspecialidadQuery object.
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
            $modelName = 'AppBundle\\Model\\Especialidad';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EspecialidadQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   EspecialidadQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EspecialidadQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EspecialidadQuery) {
            return $criteria;
        }
        $query = new EspecialidadQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$upr_id, $tes_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Especialidad|Especialidad[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EspecialidadPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EspecialidadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Especialidad A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `upr_id`, `tes_id`, `created_at`, `updated_at` FROM `especialidad` WHERE `upr_id` = :p0 AND `tes_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Especialidad();
            $obj->hydrate($row);
            EspecialidadPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return Especialidad|Especialidad[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Especialidad[]|mixed the list of results, formatted by the current formatter
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
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EspecialidadPeer::UPR_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EspecialidadPeer::TES_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EspecialidadPeer::UPR_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EspecialidadPeer::TES_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function filterByUprId($uprId = null, $comparison = null)
    {
        if (is_array($uprId)) {
            $useMinMax = false;
            if (isset($uprId['min'])) {
                $this->addUsingAlias(EspecialidadPeer::UPR_ID, $uprId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uprId['max'])) {
                $this->addUsingAlias(EspecialidadPeer::UPR_ID, $uprId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EspecialidadPeer::UPR_ID, $uprId, $comparison);
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
     * @see       filterByTipoEspecialidad()
     *
     * @param     mixed $tesId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function filterByTesId($tesId = null, $comparison = null)
    {
        if (is_array($tesId)) {
            $useMinMax = false;
            if (isset($tesId['min'])) {
                $this->addUsingAlias(EspecialidadPeer::TES_ID, $tesId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tesId['max'])) {
                $this->addUsingAlias(EspecialidadPeer::TES_ID, $tesId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EspecialidadPeer::TES_ID, $tesId, $comparison);
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
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(EspecialidadPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EspecialidadPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EspecialidadPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(EspecialidadPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EspecialidadPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EspecialidadPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related UsuarioProfesional object
     *
     * @param   UsuarioProfesional|PropelObjectCollection $usuarioProfesional The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EspecialidadQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioProfesional($usuarioProfesional, $comparison = null)
    {
        if ($usuarioProfesional instanceof UsuarioProfesional) {
            return $this
                ->addUsingAlias(EspecialidadPeer::UPR_ID, $usuarioProfesional->getUprId(), $comparison);
        } elseif ($usuarioProfesional instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EspecialidadPeer::UPR_ID, $usuarioProfesional->toKeyValue('PrimaryKey', 'UprId'), $comparison);
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
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function joinUsuarioProfesional($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useUsuarioProfesionalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuarioProfesional($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioProfesional', '\AppBundle\Model\UsuarioProfesionalQuery');
    }

    /**
     * Filter the query by a related TipoEspecialidad object
     *
     * @param   TipoEspecialidad|PropelObjectCollection $tipoEspecialidad The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EspecialidadQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTipoEspecialidad($tipoEspecialidad, $comparison = null)
    {
        if ($tipoEspecialidad instanceof TipoEspecialidad) {
            return $this
                ->addUsingAlias(EspecialidadPeer::TES_ID, $tipoEspecialidad->getTesId(), $comparison);
        } elseif ($tipoEspecialidad instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EspecialidadPeer::TES_ID, $tipoEspecialidad->toKeyValue('PrimaryKey', 'TesId'), $comparison);
        } else {
            throw new PropelException('filterByTipoEspecialidad() only accepts arguments of type TipoEspecialidad or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TipoEspecialidad relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function joinTipoEspecialidad($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TipoEspecialidad');

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
            $this->addJoinObject($join, 'TipoEspecialidad');
        }

        return $this;
    }

    /**
     * Use the TipoEspecialidad relation TipoEspecialidad object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\TipoEspecialidadQuery A secondary query class using the current class as primary query
     */
    public function useTipoEspecialidadQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTipoEspecialidad($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TipoEspecialidad', '\AppBundle\Model\TipoEspecialidadQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Especialidad $especialidad Object to remove from the list of results
     *
     * @return EspecialidadQuery The current query, for fluid interface
     */
    public function prune($especialidad = null)
    {
        if ($especialidad) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EspecialidadPeer::UPR_ID), $especialidad->getUprId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EspecialidadPeer::TES_ID), $especialidad->getTesId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     EspecialidadQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(EspecialidadPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     EspecialidadQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(EspecialidadPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     EspecialidadQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(EspecialidadPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     EspecialidadQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(EspecialidadPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     EspecialidadQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(EspecialidadPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     EspecialidadQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(EspecialidadPeer::CREATED_AT);
    }
}
