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
use AppBundle\Model\Paciente;
use AppBundle\Model\PacienteFichamedica;
use AppBundle\Model\PacienteFichamedicaPeer;
use AppBundle\Model\PacienteFichamedicaQuery;

/**
 * @method PacienteFichamedicaQuery orderByFmeId($order = Criteria::ASC) Order by the fme_id column
 * @method PacienteFichamedicaQuery orderByPacId($order = Criteria::ASC) Order by the pac_id column
 * @method PacienteFichamedicaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PacienteFichamedicaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method PacienteFichamedicaQuery groupByFmeId() Group by the fme_id column
 * @method PacienteFichamedicaQuery groupByPacId() Group by the pac_id column
 * @method PacienteFichamedicaQuery groupByCreatedAt() Group by the created_at column
 * @method PacienteFichamedicaQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method PacienteFichamedicaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PacienteFichamedicaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PacienteFichamedicaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PacienteFichamedicaQuery leftJoinFichaMedica($relationAlias = null) Adds a LEFT JOIN clause to the query using the FichaMedica relation
 * @method PacienteFichamedicaQuery rightJoinFichaMedica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FichaMedica relation
 * @method PacienteFichamedicaQuery innerJoinFichaMedica($relationAlias = null) Adds a INNER JOIN clause to the query using the FichaMedica relation
 *
 * @method PacienteFichamedicaQuery leftJoinPaciente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Paciente relation
 * @method PacienteFichamedicaQuery rightJoinPaciente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Paciente relation
 * @method PacienteFichamedicaQuery innerJoinPaciente($relationAlias = null) Adds a INNER JOIN clause to the query using the Paciente relation
 *
 * @method PacienteFichamedica findOne(PropelPDO $con = null) Return the first PacienteFichamedica matching the query
 * @method PacienteFichamedica findOneOrCreate(PropelPDO $con = null) Return the first PacienteFichamedica matching the query, or a new PacienteFichamedica object populated from the query conditions when no match is found
 *
 * @method PacienteFichamedica findOneByFmeId(int $fme_id) Return the first PacienteFichamedica filtered by the fme_id column
 * @method PacienteFichamedica findOneByPacId(int $pac_id) Return the first PacienteFichamedica filtered by the pac_id column
 * @method PacienteFichamedica findOneByCreatedAt(string $created_at) Return the first PacienteFichamedica filtered by the created_at column
 * @method PacienteFichamedica findOneByUpdatedAt(string $updated_at) Return the first PacienteFichamedica filtered by the updated_at column
 *
 * @method array findByFmeId(int $fme_id) Return PacienteFichamedica objects filtered by the fme_id column
 * @method array findByPacId(int $pac_id) Return PacienteFichamedica objects filtered by the pac_id column
 * @method array findByCreatedAt(string $created_at) Return PacienteFichamedica objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return PacienteFichamedica objects filtered by the updated_at column
 */
abstract class BasePacienteFichamedicaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePacienteFichamedicaQuery object.
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
            $modelName = 'AppBundle\\Model\\PacienteFichamedica';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PacienteFichamedicaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PacienteFichamedicaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PacienteFichamedicaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PacienteFichamedicaQuery) {
            return $criteria;
        }
        $query = new PacienteFichamedicaQuery(null, null, $modelAlias);

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
                         A Primary key composition: [$fme_id, $pac_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   PacienteFichamedica|PacienteFichamedica[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PacienteFichamedicaPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PacienteFichamedicaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 PacienteFichamedica A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `fme_id`, `pac_id`, `created_at`, `updated_at` FROM `paciente_fichamedica` WHERE `fme_id` = :p0 AND `pac_id` = :p1';
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
            $obj = new PacienteFichamedica();
            $obj->hydrate($row);
            PacienteFichamedicaPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return PacienteFichamedica|PacienteFichamedica[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PacienteFichamedica[]|mixed the list of results, formatted by the current formatter
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
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PacienteFichamedicaPeer::FME_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PacienteFichamedicaPeer::PAC_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PacienteFichamedicaPeer::FME_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PacienteFichamedicaPeer::PAC_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByFichaMedica()
     *
     * @param     mixed $fmeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function filterByFmeId($fmeId = null, $comparison = null)
    {
        if (is_array($fmeId)) {
            $useMinMax = false;
            if (isset($fmeId['min'])) {
                $this->addUsingAlias(PacienteFichamedicaPeer::FME_ID, $fmeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fmeId['max'])) {
                $this->addUsingAlias(PacienteFichamedicaPeer::FME_ID, $fmeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacienteFichamedicaPeer::FME_ID, $fmeId, $comparison);
    }

    /**
     * Filter the query on the pac_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPacId(1234); // WHERE pac_id = 1234
     * $query->filterByPacId(array(12, 34)); // WHERE pac_id IN (12, 34)
     * $query->filterByPacId(array('min' => 12)); // WHERE pac_id >= 12
     * $query->filterByPacId(array('max' => 12)); // WHERE pac_id <= 12
     * </code>
     *
     * @see       filterByPaciente()
     *
     * @param     mixed $pacId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function filterByPacId($pacId = null, $comparison = null)
    {
        if (is_array($pacId)) {
            $useMinMax = false;
            if (isset($pacId['min'])) {
                $this->addUsingAlias(PacienteFichamedicaPeer::PAC_ID, $pacId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacId['max'])) {
                $this->addUsingAlias(PacienteFichamedicaPeer::PAC_ID, $pacId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacienteFichamedicaPeer::PAC_ID, $pacId, $comparison);
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
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PacienteFichamedicaPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PacienteFichamedicaPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacienteFichamedicaPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PacienteFichamedicaPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PacienteFichamedicaPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacienteFichamedicaPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related FichaMedica object
     *
     * @param   FichaMedica|PropelObjectCollection $fichaMedica The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PacienteFichamedicaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByFichaMedica($fichaMedica, $comparison = null)
    {
        if ($fichaMedica instanceof FichaMedica) {
            return $this
                ->addUsingAlias(PacienteFichamedicaPeer::FME_ID, $fichaMedica->getFmeId(), $comparison);
        } elseif ($fichaMedica instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PacienteFichamedicaPeer::FME_ID, $fichaMedica->toKeyValue('PrimaryKey', 'FmeId'), $comparison);
        } else {
            throw new PropelException('filterByFichaMedica() only accepts arguments of type FichaMedica or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FichaMedica relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function joinFichaMedica($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FichaMedica');

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
            $this->addJoinObject($join, 'FichaMedica');
        }

        return $this;
    }

    /**
     * Use the FichaMedica relation FichaMedica object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\FichaMedicaQuery A secondary query class using the current class as primary query
     */
    public function useFichaMedicaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFichaMedica($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FichaMedica', '\AppBundle\Model\FichaMedicaQuery');
    }

    /**
     * Filter the query by a related Paciente object
     *
     * @param   Paciente|PropelObjectCollection $paciente The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PacienteFichamedicaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPaciente($paciente, $comparison = null)
    {
        if ($paciente instanceof Paciente) {
            return $this
                ->addUsingAlias(PacienteFichamedicaPeer::PAC_ID, $paciente->getPacId(), $comparison);
        } elseif ($paciente instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PacienteFichamedicaPeer::PAC_ID, $paciente->toKeyValue('PrimaryKey', 'PacId'), $comparison);
        } else {
            throw new PropelException('filterByPaciente() only accepts arguments of type Paciente or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Paciente relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function joinPaciente($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Paciente');

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
            $this->addJoinObject($join, 'Paciente');
        }

        return $this;
    }

    /**
     * Use the Paciente relation Paciente object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\PacienteQuery A secondary query class using the current class as primary query
     */
    public function usePacienteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPaciente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Paciente', '\AppBundle\Model\PacienteQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PacienteFichamedica $pacienteFichamedica Object to remove from the list of results
     *
     * @return PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function prune($pacienteFichamedica = null)
    {
        if ($pacienteFichamedica) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PacienteFichamedicaPeer::FME_ID), $pacienteFichamedica->getFmeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PacienteFichamedicaPeer::PAC_ID), $pacienteFichamedica->getPacId(), Criteria::NOT_EQUAL);
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
     * @return     PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PacienteFichamedicaPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PacienteFichamedicaPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PacienteFichamedicaPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PacienteFichamedicaPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PacienteFichamedicaPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PacienteFichamedicaQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PacienteFichamedicaPeer::CREATED_AT);
    }
}
