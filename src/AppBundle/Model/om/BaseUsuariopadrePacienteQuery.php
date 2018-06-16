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
use AppBundle\Model\Paciente;
use AppBundle\Model\UsuarioPadre;
use AppBundle\Model\UsuarioProfesional;
use AppBundle\Model\UsuariopadrePaciente;
use AppBundle\Model\UsuariopadrePacientePeer;
use AppBundle\Model\UsuariopadrePacienteQuery;

/**
 * @method UsuariopadrePacienteQuery orderByPacId($order = Criteria::ASC) Order by the pac_id column
 * @method UsuariopadrePacienteQuery orderByUpaId($order = Criteria::ASC) Order by the upa_id column
 * @method UsuariopadrePacienteQuery orderByUprId($order = Criteria::ASC) Order by the upr_id column
 * @method UsuariopadrePacienteQuery orderByUppDescripcion($order = Criteria::ASC) Order by the upp_descripcion column
 * @method UsuariopadrePacienteQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method UsuariopadrePacienteQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method UsuariopadrePacienteQuery groupByPacId() Group by the pac_id column
 * @method UsuariopadrePacienteQuery groupByUpaId() Group by the upa_id column
 * @method UsuariopadrePacienteQuery groupByUprId() Group by the upr_id column
 * @method UsuariopadrePacienteQuery groupByUppDescripcion() Group by the upp_descripcion column
 * @method UsuariopadrePacienteQuery groupByCreatedAt() Group by the created_at column
 * @method UsuariopadrePacienteQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method UsuariopadrePacienteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UsuariopadrePacienteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UsuariopadrePacienteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UsuariopadrePacienteQuery leftJoinPaciente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Paciente relation
 * @method UsuariopadrePacienteQuery rightJoinPaciente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Paciente relation
 * @method UsuariopadrePacienteQuery innerJoinPaciente($relationAlias = null) Adds a INNER JOIN clause to the query using the Paciente relation
 *
 * @method UsuariopadrePacienteQuery leftJoinUsuarioPadre($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioPadre relation
 * @method UsuariopadrePacienteQuery rightJoinUsuarioPadre($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioPadre relation
 * @method UsuariopadrePacienteQuery innerJoinUsuarioPadre($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioPadre relation
 *
 * @method UsuariopadrePacienteQuery leftJoinUsuarioProfesional($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioProfesional relation
 * @method UsuariopadrePacienteQuery rightJoinUsuarioProfesional($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioProfesional relation
 * @method UsuariopadrePacienteQuery innerJoinUsuarioProfesional($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioProfesional relation
 *
 * @method UsuariopadrePaciente findOne(PropelPDO $con = null) Return the first UsuariopadrePaciente matching the query
 * @method UsuariopadrePaciente findOneOrCreate(PropelPDO $con = null) Return the first UsuariopadrePaciente matching the query, or a new UsuariopadrePaciente object populated from the query conditions when no match is found
 *
 * @method UsuariopadrePaciente findOneByPacId(int $pac_id) Return the first UsuariopadrePaciente filtered by the pac_id column
 * @method UsuariopadrePaciente findOneByUpaId(int $upa_id) Return the first UsuariopadrePaciente filtered by the upa_id column
 * @method UsuariopadrePaciente findOneByUprId(int $upr_id) Return the first UsuariopadrePaciente filtered by the upr_id column
 * @method UsuariopadrePaciente findOneByUppDescripcion(string $upp_descripcion) Return the first UsuariopadrePaciente filtered by the upp_descripcion column
 * @method UsuariopadrePaciente findOneByCreatedAt(string $created_at) Return the first UsuariopadrePaciente filtered by the created_at column
 * @method UsuariopadrePaciente findOneByUpdatedAt(string $updated_at) Return the first UsuariopadrePaciente filtered by the updated_at column
 *
 * @method array findByPacId(int $pac_id) Return UsuariopadrePaciente objects filtered by the pac_id column
 * @method array findByUpaId(int $upa_id) Return UsuariopadrePaciente objects filtered by the upa_id column
 * @method array findByUprId(int $upr_id) Return UsuariopadrePaciente objects filtered by the upr_id column
 * @method array findByUppDescripcion(string $upp_descripcion) Return UsuariopadrePaciente objects filtered by the upp_descripcion column
 * @method array findByCreatedAt(string $created_at) Return UsuariopadrePaciente objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return UsuariopadrePaciente objects filtered by the updated_at column
 */
abstract class BaseUsuariopadrePacienteQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUsuariopadrePacienteQuery object.
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
            $modelName = 'AppBundle\\Model\\UsuariopadrePaciente';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UsuariopadrePacienteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UsuariopadrePacienteQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UsuariopadrePacienteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UsuariopadrePacienteQuery) {
            return $criteria;
        }
        $query = new UsuariopadrePacienteQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$pac_id, $upa_id, $upr_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   UsuariopadrePaciente|UsuariopadrePaciente[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsuariopadrePacientePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UsuariopadrePacientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 UsuariopadrePaciente A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `pac_id`, `upa_id`, `upr_id`, `upp_descripcion`, `created_at`, `updated_at` FROM `usuariopadre_paciente` WHERE `pac_id` = :p0 AND `upa_id` = :p1 AND `upr_id` = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new UsuariopadrePaciente();
            $obj->hydrate($row);
            UsuariopadrePacientePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
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
     * @return UsuariopadrePaciente|UsuariopadrePaciente[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|UsuariopadrePaciente[]|mixed the list of results, formatted by the current formatter
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UsuariopadrePacientePeer::PAC_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UsuariopadrePacientePeer::UPA_ID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(UsuariopadrePacientePeer::UPR_ID, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UsuariopadrePacientePeer::PAC_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UsuariopadrePacientePeer::UPA_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(UsuariopadrePacientePeer::UPR_ID, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function filterByPacId($pacId = null, $comparison = null)
    {
        if (is_array($pacId)) {
            $useMinMax = false;
            if (isset($pacId['min'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::PAC_ID, $pacId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacId['max'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::PAC_ID, $pacId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariopadrePacientePeer::PAC_ID, $pacId, $comparison);
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function filterByUpaId($upaId = null, $comparison = null)
    {
        if (is_array($upaId)) {
            $useMinMax = false;
            if (isset($upaId['min'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::UPA_ID, $upaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upaId['max'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::UPA_ID, $upaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariopadrePacientePeer::UPA_ID, $upaId, $comparison);
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function filterByUprId($uprId = null, $comparison = null)
    {
        if (is_array($uprId)) {
            $useMinMax = false;
            if (isset($uprId['min'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::UPR_ID, $uprId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uprId['max'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::UPR_ID, $uprId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariopadrePacientePeer::UPR_ID, $uprId, $comparison);
    }

    /**
     * Filter the query on the upp_descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByUppDescripcion('fooValue');   // WHERE upp_descripcion = 'fooValue'
     * $query->filterByUppDescripcion('%fooValue%'); // WHERE upp_descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uppDescripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function filterByUppDescripcion($uppDescripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uppDescripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uppDescripcion)) {
                $uppDescripcion = str_replace('*', '%', $uppDescripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuariopadrePacientePeer::UPP_DESCRIPCION, $uppDescripcion, $comparison);
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariopadrePacientePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsuariopadrePacientePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariopadrePacientePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Paciente object
     *
     * @param   Paciente|PropelObjectCollection $paciente The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuariopadrePacienteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPaciente($paciente, $comparison = null)
    {
        if ($paciente instanceof Paciente) {
            return $this
                ->addUsingAlias(UsuariopadrePacientePeer::PAC_ID, $paciente->getPacId(), $comparison);
        } elseif ($paciente instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuariopadrePacientePeer::PAC_ID, $paciente->toKeyValue('PrimaryKey', 'PacId'), $comparison);
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
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
     * Filter the query by a related UsuarioPadre object
     *
     * @param   UsuarioPadre|PropelObjectCollection $usuarioPadre The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuariopadrePacienteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioPadre($usuarioPadre, $comparison = null)
    {
        if ($usuarioPadre instanceof UsuarioPadre) {
            return $this
                ->addUsingAlias(UsuariopadrePacientePeer::UPA_ID, $usuarioPadre->getUpaId(), $comparison);
        } elseif ($usuarioPadre instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuariopadrePacientePeer::UPA_ID, $usuarioPadre->toKeyValue('PrimaryKey', 'UpaId'), $comparison);
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function joinUsuarioPadre($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useUsuarioPadreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuarioPadre($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioPadre', '\AppBundle\Model\UsuarioPadreQuery');
    }

    /**
     * Filter the query by a related UsuarioProfesional object
     *
     * @param   UsuarioProfesional|PropelObjectCollection $usuarioProfesional The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuariopadrePacienteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioProfesional($usuarioProfesional, $comparison = null)
    {
        if ($usuarioProfesional instanceof UsuarioProfesional) {
            return $this
                ->addUsingAlias(UsuariopadrePacientePeer::UPR_ID, $usuarioProfesional->getUprId(), $comparison);
        } elseif ($usuarioProfesional instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuariopadrePacientePeer::UPR_ID, $usuarioProfesional->toKeyValue('PrimaryKey', 'UprId'), $comparison);
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
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   UsuariopadrePaciente $usuariopadrePaciente Object to remove from the list of results
     *
     * @return UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function prune($usuariopadrePaciente = null)
    {
        if ($usuariopadrePaciente) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UsuariopadrePacientePeer::PAC_ID), $usuariopadrePaciente->getPacId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UsuariopadrePacientePeer::UPA_ID), $usuariopadrePaciente->getUpaId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(UsuariopadrePacientePeer::UPR_ID), $usuariopadrePaciente->getUprId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuariopadrePacientePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuariopadrePacientePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuariopadrePacientePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuariopadrePacientePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuariopadrePacientePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     UsuariopadrePacienteQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuariopadrePacientePeer::CREATED_AT);
    }
}
