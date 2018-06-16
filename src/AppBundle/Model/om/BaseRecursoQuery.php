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
use AppBundle\Model\Paciente;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoPeer;
use AppBundle\Model\RecursoQuery;
use AppBundle\Model\UsuarioPadre;
use AppBundle\Model\UsuarioProfesional;

/**
 * @method RecursoQuery orderByRecId($order = Criteria::ASC) Order by the rec_id column
 * @method RecursoQuery orderByPacId($order = Criteria::ASC) Order by the pac_id column
 * @method RecursoQuery orderByUprId($order = Criteria::ASC) Order by the upr_id column
 * @method RecursoQuery orderByCliId($order = Criteria::ASC) Order by the cli_id column
 * @method RecursoQuery orderByBloId($order = Criteria::ASC) Order by the blo_id column
 * @method RecursoQuery orderByUpaId($order = Criteria::ASC) Order by the upa_id column
 * @method RecursoQuery orderByRecTipo($order = Criteria::ASC) Order by the rec_tipo column
 * @method RecursoQuery orderByRecEsPrincipal($order = Criteria::ASC) Order by the rec_es_principal column
 * @method RecursoQuery orderByRecSrc($order = Criteria::ASC) Order by the rec_src column
 * @method RecursoQuery orderByRecUrl($order = Criteria::ASC) Order by the rec_url column
 * @method RecursoQuery orderByRecOrden($order = Criteria::ASC) Order by the rec_orden column
 * @method RecursoQuery orderByRecEstado($order = Criteria::ASC) Order by the rec_estado column
 * @method RecursoQuery orderByRecEliminado($order = Criteria::ASC) Order by the rec_eliminado column
 * @method RecursoQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method RecursoQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method RecursoQuery groupByRecId() Group by the rec_id column
 * @method RecursoQuery groupByPacId() Group by the pac_id column
 * @method RecursoQuery groupByUprId() Group by the upr_id column
 * @method RecursoQuery groupByCliId() Group by the cli_id column
 * @method RecursoQuery groupByBloId() Group by the blo_id column
 * @method RecursoQuery groupByUpaId() Group by the upa_id column
 * @method RecursoQuery groupByRecTipo() Group by the rec_tipo column
 * @method RecursoQuery groupByRecEsPrincipal() Group by the rec_es_principal column
 * @method RecursoQuery groupByRecSrc() Group by the rec_src column
 * @method RecursoQuery groupByRecUrl() Group by the rec_url column
 * @method RecursoQuery groupByRecOrden() Group by the rec_orden column
 * @method RecursoQuery groupByRecEstado() Group by the rec_estado column
 * @method RecursoQuery groupByRecEliminado() Group by the rec_eliminado column
 * @method RecursoQuery groupByCreatedAt() Group by the created_at column
 * @method RecursoQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method RecursoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RecursoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RecursoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RecursoQuery leftJoinBlog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Blog relation
 * @method RecursoQuery rightJoinBlog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Blog relation
 * @method RecursoQuery innerJoinBlog($relationAlias = null) Adds a INNER JOIN clause to the query using the Blog relation
 *
 * @method RecursoQuery leftJoinClinica($relationAlias = null) Adds a LEFT JOIN clause to the query using the Clinica relation
 * @method RecursoQuery rightJoinClinica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Clinica relation
 * @method RecursoQuery innerJoinClinica($relationAlias = null) Adds a INNER JOIN clause to the query using the Clinica relation
 *
 * @method RecursoQuery leftJoinPaciente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Paciente relation
 * @method RecursoQuery rightJoinPaciente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Paciente relation
 * @method RecursoQuery innerJoinPaciente($relationAlias = null) Adds a INNER JOIN clause to the query using the Paciente relation
 *
 * @method RecursoQuery leftJoinUsuarioProfesional($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioProfesional relation
 * @method RecursoQuery rightJoinUsuarioProfesional($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioProfesional relation
 * @method RecursoQuery innerJoinUsuarioProfesional($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioProfesional relation
 *
 * @method RecursoQuery leftJoinUsuarioPadre($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioPadre relation
 * @method RecursoQuery rightJoinUsuarioPadre($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioPadre relation
 * @method RecursoQuery innerJoinUsuarioPadre($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioPadre relation
 *
 * @method Recurso findOne(PropelPDO $con = null) Return the first Recurso matching the query
 * @method Recurso findOneOrCreate(PropelPDO $con = null) Return the first Recurso matching the query, or a new Recurso object populated from the query conditions when no match is found
 *
 * @method Recurso findOneByPacId(int $pac_id) Return the first Recurso filtered by the pac_id column
 * @method Recurso findOneByUprId(int $upr_id) Return the first Recurso filtered by the upr_id column
 * @method Recurso findOneByCliId(int $cli_id) Return the first Recurso filtered by the cli_id column
 * @method Recurso findOneByBloId(int $blo_id) Return the first Recurso filtered by the blo_id column
 * @method Recurso findOneByUpaId(int $upa_id) Return the first Recurso filtered by the upa_id column
 * @method Recurso findOneByRecTipo(int $rec_tipo) Return the first Recurso filtered by the rec_tipo column
 * @method Recurso findOneByRecEsPrincipal(int $rec_es_principal) Return the first Recurso filtered by the rec_es_principal column
 * @method Recurso findOneByRecSrc(string $rec_src) Return the first Recurso filtered by the rec_src column
 * @method Recurso findOneByRecUrl(string $rec_url) Return the first Recurso filtered by the rec_url column
 * @method Recurso findOneByRecOrden(int $rec_orden) Return the first Recurso filtered by the rec_orden column
 * @method Recurso findOneByRecEstado(int $rec_estado) Return the first Recurso filtered by the rec_estado column
 * @method Recurso findOneByRecEliminado(int $rec_eliminado) Return the first Recurso filtered by the rec_eliminado column
 * @method Recurso findOneByCreatedAt(string $created_at) Return the first Recurso filtered by the created_at column
 * @method Recurso findOneByUpdatedAt(string $updated_at) Return the first Recurso filtered by the updated_at column
 *
 * @method array findByRecId(int $rec_id) Return Recurso objects filtered by the rec_id column
 * @method array findByPacId(int $pac_id) Return Recurso objects filtered by the pac_id column
 * @method array findByUprId(int $upr_id) Return Recurso objects filtered by the upr_id column
 * @method array findByCliId(int $cli_id) Return Recurso objects filtered by the cli_id column
 * @method array findByBloId(int $blo_id) Return Recurso objects filtered by the blo_id column
 * @method array findByUpaId(int $upa_id) Return Recurso objects filtered by the upa_id column
 * @method array findByRecTipo(int $rec_tipo) Return Recurso objects filtered by the rec_tipo column
 * @method array findByRecEsPrincipal(int $rec_es_principal) Return Recurso objects filtered by the rec_es_principal column
 * @method array findByRecSrc(string $rec_src) Return Recurso objects filtered by the rec_src column
 * @method array findByRecUrl(string $rec_url) Return Recurso objects filtered by the rec_url column
 * @method array findByRecOrden(int $rec_orden) Return Recurso objects filtered by the rec_orden column
 * @method array findByRecEstado(int $rec_estado) Return Recurso objects filtered by the rec_estado column
 * @method array findByRecEliminado(int $rec_eliminado) Return Recurso objects filtered by the rec_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Recurso objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Recurso objects filtered by the updated_at column
 */
abstract class BaseRecursoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRecursoQuery object.
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
            $modelName = 'AppBundle\\Model\\Recurso';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RecursoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   RecursoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RecursoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RecursoQuery) {
            return $criteria;
        }
        $query = new RecursoQuery(null, null, $modelAlias);

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
     * @return   Recurso|Recurso[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RecursoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RecursoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Recurso A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByRecId($key, $con = null)
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
     * @return                 Recurso A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `rec_id`, `pac_id`, `upr_id`, `cli_id`, `blo_id`, `upa_id`, `rec_tipo`, `rec_es_principal`, `rec_src`, `rec_url`, `rec_orden`, `rec_estado`, `rec_eliminado`, `created_at`, `updated_at` FROM `recurso` WHERE `rec_id` = :p0';
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
            $obj = new Recurso();
            $obj->hydrate($row);
            RecursoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Recurso|Recurso[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Recurso[]|mixed the list of results, formatted by the current formatter
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
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RecursoPeer::REC_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RecursoPeer::REC_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the rec_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRecId(1234); // WHERE rec_id = 1234
     * $query->filterByRecId(array(12, 34)); // WHERE rec_id IN (12, 34)
     * $query->filterByRecId(array('min' => 12)); // WHERE rec_id >= 12
     * $query->filterByRecId(array('max' => 12)); // WHERE rec_id <= 12
     * </code>
     *
     * @param     mixed $recId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByRecId($recId = null, $comparison = null)
    {
        if (is_array($recId)) {
            $useMinMax = false;
            if (isset($recId['min'])) {
                $this->addUsingAlias(RecursoPeer::REC_ID, $recId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recId['max'])) {
                $this->addUsingAlias(RecursoPeer::REC_ID, $recId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::REC_ID, $recId, $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByPacId($pacId = null, $comparison = null)
    {
        if (is_array($pacId)) {
            $useMinMax = false;
            if (isset($pacId['min'])) {
                $this->addUsingAlias(RecursoPeer::PAC_ID, $pacId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacId['max'])) {
                $this->addUsingAlias(RecursoPeer::PAC_ID, $pacId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::PAC_ID, $pacId, $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByUprId($uprId = null, $comparison = null)
    {
        if (is_array($uprId)) {
            $useMinMax = false;
            if (isset($uprId['min'])) {
                $this->addUsingAlias(RecursoPeer::UPR_ID, $uprId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uprId['max'])) {
                $this->addUsingAlias(RecursoPeer::UPR_ID, $uprId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::UPR_ID, $uprId, $comparison);
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
     * @see       filterByClinica()
     *
     * @param     mixed $cliId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByCliId($cliId = null, $comparison = null)
    {
        if (is_array($cliId)) {
            $useMinMax = false;
            if (isset($cliId['min'])) {
                $this->addUsingAlias(RecursoPeer::CLI_ID, $cliId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cliId['max'])) {
                $this->addUsingAlias(RecursoPeer::CLI_ID, $cliId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::CLI_ID, $cliId, $comparison);
    }

    /**
     * Filter the query on the blo_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBloId(1234); // WHERE blo_id = 1234
     * $query->filterByBloId(array(12, 34)); // WHERE blo_id IN (12, 34)
     * $query->filterByBloId(array('min' => 12)); // WHERE blo_id >= 12
     * $query->filterByBloId(array('max' => 12)); // WHERE blo_id <= 12
     * </code>
     *
     * @see       filterByBlog()
     *
     * @param     mixed $bloId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByBloId($bloId = null, $comparison = null)
    {
        if (is_array($bloId)) {
            $useMinMax = false;
            if (isset($bloId['min'])) {
                $this->addUsingAlias(RecursoPeer::BLO_ID, $bloId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bloId['max'])) {
                $this->addUsingAlias(RecursoPeer::BLO_ID, $bloId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::BLO_ID, $bloId, $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByUpaId($upaId = null, $comparison = null)
    {
        if (is_array($upaId)) {
            $useMinMax = false;
            if (isset($upaId['min'])) {
                $this->addUsingAlias(RecursoPeer::UPA_ID, $upaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upaId['max'])) {
                $this->addUsingAlias(RecursoPeer::UPA_ID, $upaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::UPA_ID, $upaId, $comparison);
    }

    /**
     * Filter the query on the rec_tipo column
     *
     * Example usage:
     * <code>
     * $query->filterByRecTipo(1234); // WHERE rec_tipo = 1234
     * $query->filterByRecTipo(array(12, 34)); // WHERE rec_tipo IN (12, 34)
     * $query->filterByRecTipo(array('min' => 12)); // WHERE rec_tipo >= 12
     * $query->filterByRecTipo(array('max' => 12)); // WHERE rec_tipo <= 12
     * </code>
     *
     * @param     mixed $recTipo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByRecTipo($recTipo = null, $comparison = null)
    {
        if (is_array($recTipo)) {
            $useMinMax = false;
            if (isset($recTipo['min'])) {
                $this->addUsingAlias(RecursoPeer::REC_TIPO, $recTipo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recTipo['max'])) {
                $this->addUsingAlias(RecursoPeer::REC_TIPO, $recTipo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::REC_TIPO, $recTipo, $comparison);
    }

    /**
     * Filter the query on the rec_es_principal column
     *
     * Example usage:
     * <code>
     * $query->filterByRecEsPrincipal(1234); // WHERE rec_es_principal = 1234
     * $query->filterByRecEsPrincipal(array(12, 34)); // WHERE rec_es_principal IN (12, 34)
     * $query->filterByRecEsPrincipal(array('min' => 12)); // WHERE rec_es_principal >= 12
     * $query->filterByRecEsPrincipal(array('max' => 12)); // WHERE rec_es_principal <= 12
     * </code>
     *
     * @param     mixed $recEsPrincipal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByRecEsPrincipal($recEsPrincipal = null, $comparison = null)
    {
        if (is_array($recEsPrincipal)) {
            $useMinMax = false;
            if (isset($recEsPrincipal['min'])) {
                $this->addUsingAlias(RecursoPeer::REC_ES_PRINCIPAL, $recEsPrincipal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recEsPrincipal['max'])) {
                $this->addUsingAlias(RecursoPeer::REC_ES_PRINCIPAL, $recEsPrincipal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::REC_ES_PRINCIPAL, $recEsPrincipal, $comparison);
    }

    /**
     * Filter the query on the rec_src column
     *
     * Example usage:
     * <code>
     * $query->filterByRecSrc('fooValue');   // WHERE rec_src = 'fooValue'
     * $query->filterByRecSrc('%fooValue%'); // WHERE rec_src LIKE '%fooValue%'
     * </code>
     *
     * @param     string $recSrc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByRecSrc($recSrc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($recSrc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $recSrc)) {
                $recSrc = str_replace('*', '%', $recSrc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RecursoPeer::REC_SRC, $recSrc, $comparison);
    }

    /**
     * Filter the query on the rec_url column
     *
     * Example usage:
     * <code>
     * $query->filterByRecUrl('fooValue');   // WHERE rec_url = 'fooValue'
     * $query->filterByRecUrl('%fooValue%'); // WHERE rec_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $recUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByRecUrl($recUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($recUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $recUrl)) {
                $recUrl = str_replace('*', '%', $recUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RecursoPeer::REC_URL, $recUrl, $comparison);
    }

    /**
     * Filter the query on the rec_orden column
     *
     * Example usage:
     * <code>
     * $query->filterByRecOrden(1234); // WHERE rec_orden = 1234
     * $query->filterByRecOrden(array(12, 34)); // WHERE rec_orden IN (12, 34)
     * $query->filterByRecOrden(array('min' => 12)); // WHERE rec_orden >= 12
     * $query->filterByRecOrden(array('max' => 12)); // WHERE rec_orden <= 12
     * </code>
     *
     * @param     mixed $recOrden The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByRecOrden($recOrden = null, $comparison = null)
    {
        if (is_array($recOrden)) {
            $useMinMax = false;
            if (isset($recOrden['min'])) {
                $this->addUsingAlias(RecursoPeer::REC_ORDEN, $recOrden['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recOrden['max'])) {
                $this->addUsingAlias(RecursoPeer::REC_ORDEN, $recOrden['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::REC_ORDEN, $recOrden, $comparison);
    }

    /**
     * Filter the query on the rec_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByRecEstado(1234); // WHERE rec_estado = 1234
     * $query->filterByRecEstado(array(12, 34)); // WHERE rec_estado IN (12, 34)
     * $query->filterByRecEstado(array('min' => 12)); // WHERE rec_estado >= 12
     * $query->filterByRecEstado(array('max' => 12)); // WHERE rec_estado <= 12
     * </code>
     *
     * @param     mixed $recEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByRecEstado($recEstado = null, $comparison = null)
    {
        if (is_array($recEstado)) {
            $useMinMax = false;
            if (isset($recEstado['min'])) {
                $this->addUsingAlias(RecursoPeer::REC_ESTADO, $recEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recEstado['max'])) {
                $this->addUsingAlias(RecursoPeer::REC_ESTADO, $recEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::REC_ESTADO, $recEstado, $comparison);
    }

    /**
     * Filter the query on the rec_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByRecEliminado(1234); // WHERE rec_eliminado = 1234
     * $query->filterByRecEliminado(array(12, 34)); // WHERE rec_eliminado IN (12, 34)
     * $query->filterByRecEliminado(array('min' => 12)); // WHERE rec_eliminado >= 12
     * $query->filterByRecEliminado(array('max' => 12)); // WHERE rec_eliminado <= 12
     * </code>
     *
     * @param     mixed $recEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByRecEliminado($recEliminado = null, $comparison = null)
    {
        if (is_array($recEliminado)) {
            $useMinMax = false;
            if (isset($recEliminado['min'])) {
                $this->addUsingAlias(RecursoPeer::REC_ELIMINADO, $recEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recEliminado['max'])) {
                $this->addUsingAlias(RecursoPeer::REC_ELIMINADO, $recEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::REC_ELIMINADO, $recEliminado, $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(RecursoPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RecursoPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(RecursoPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RecursoPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecursoPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Blog object
     *
     * @param   Blog|PropelObjectCollection $blog The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RecursoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBlog($blog, $comparison = null)
    {
        if ($blog instanceof Blog) {
            return $this
                ->addUsingAlias(RecursoPeer::BLO_ID, $blog->getBloId(), $comparison);
        } elseif ($blog instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RecursoPeer::BLO_ID, $blog->toKeyValue('PrimaryKey', 'BloId'), $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
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
     * Filter the query by a related Clinica object
     *
     * @param   Clinica|PropelObjectCollection $clinica The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RecursoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByClinica($clinica, $comparison = null)
    {
        if ($clinica instanceof Clinica) {
            return $this
                ->addUsingAlias(RecursoPeer::CLI_ID, $clinica->getCliId(), $comparison);
        } elseif ($clinica instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RecursoPeer::CLI_ID, $clinica->toKeyValue('PrimaryKey', 'CliId'), $comparison);
        } else {
            throw new PropelException('filterByClinica() only accepts arguments of type Clinica or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Clinica relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function joinClinica($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Clinica');

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
            $this->addJoinObject($join, 'Clinica');
        }

        return $this;
    }

    /**
     * Use the Clinica relation Clinica object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\ClinicaQuery A secondary query class using the current class as primary query
     */
    public function useClinicaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinClinica($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Clinica', '\AppBundle\Model\ClinicaQuery');
    }

    /**
     * Filter the query by a related Paciente object
     *
     * @param   Paciente|PropelObjectCollection $paciente The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RecursoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPaciente($paciente, $comparison = null)
    {
        if ($paciente instanceof Paciente) {
            return $this
                ->addUsingAlias(RecursoPeer::PAC_ID, $paciente->getPacId(), $comparison);
        } elseif ($paciente instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RecursoPeer::PAC_ID, $paciente->toKeyValue('PrimaryKey', 'PacId'), $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
     */
    public function joinPaciente($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function usePacienteQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPaciente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Paciente', '\AppBundle\Model\PacienteQuery');
    }

    /**
     * Filter the query by a related UsuarioProfesional object
     *
     * @param   UsuarioProfesional|PropelObjectCollection $usuarioProfesional The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RecursoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioProfesional($usuarioProfesional, $comparison = null)
    {
        if ($usuarioProfesional instanceof UsuarioProfesional) {
            return $this
                ->addUsingAlias(RecursoPeer::UPR_ID, $usuarioProfesional->getUprId(), $comparison);
        } elseif ($usuarioProfesional instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RecursoPeer::UPR_ID, $usuarioProfesional->toKeyValue('PrimaryKey', 'UprId'), $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
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
     * @return                 RecursoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioPadre($usuarioPadre, $comparison = null)
    {
        if ($usuarioPadre instanceof UsuarioPadre) {
            return $this
                ->addUsingAlias(RecursoPeer::UPA_ID, $usuarioPadre->getUpaId(), $comparison);
        } elseif ($usuarioPadre instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RecursoPeer::UPA_ID, $usuarioPadre->toKeyValue('PrimaryKey', 'UpaId'), $comparison);
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
     * @return RecursoQuery The current query, for fluid interface
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
     * @param   Recurso $recurso Object to remove from the list of results
     *
     * @return RecursoQuery The current query, for fluid interface
     */
    public function prune($recurso = null)
    {
        if ($recurso) {
            $this->addUsingAlias(RecursoPeer::REC_ID, $recurso->getRecId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     RecursoQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(RecursoPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     RecursoQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(RecursoPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     RecursoQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(RecursoPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     RecursoQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(RecursoPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     RecursoQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(RecursoPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     RecursoQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(RecursoPeer::CREATED_AT);
    }
}
