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
use AppBundle\Model\Comentario;
use AppBundle\Model\ComentarioPeer;
use AppBundle\Model\ComentarioQuery;
use AppBundle\Model\UsuarioPadre;
use AppBundle\Model\UsuarioProfesional;

/**
 * @method ComentarioQuery orderByComId($order = Criteria::ASC) Order by the com_id column
 * @method ComentarioQuery orderByUprId($order = Criteria::ASC) Order by the upr_id column
 * @method ComentarioQuery orderByUpaId($order = Criteria::ASC) Order by the upa_id column
 * @method ComentarioQuery orderByBloId($order = Criteria::ASC) Order by the blo_id column
 * @method ComentarioQuery orderByComMensaje($order = Criteria::ASC) Order by the com_mensaje column
 * @method ComentarioQuery orderByComEstado($order = Criteria::ASC) Order by the com_estado column
 * @method ComentarioQuery orderByComEliminado($order = Criteria::ASC) Order by the com_eliminado column
 * @method ComentarioQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method ComentarioQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method ComentarioQuery groupByComId() Group by the com_id column
 * @method ComentarioQuery groupByUprId() Group by the upr_id column
 * @method ComentarioQuery groupByUpaId() Group by the upa_id column
 * @method ComentarioQuery groupByBloId() Group by the blo_id column
 * @method ComentarioQuery groupByComMensaje() Group by the com_mensaje column
 * @method ComentarioQuery groupByComEstado() Group by the com_estado column
 * @method ComentarioQuery groupByComEliminado() Group by the com_eliminado column
 * @method ComentarioQuery groupByCreatedAt() Group by the created_at column
 * @method ComentarioQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method ComentarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ComentarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ComentarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ComentarioQuery leftJoinBlog($relationAlias = null) Adds a LEFT JOIN clause to the query using the Blog relation
 * @method ComentarioQuery rightJoinBlog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Blog relation
 * @method ComentarioQuery innerJoinBlog($relationAlias = null) Adds a INNER JOIN clause to the query using the Blog relation
 *
 * @method ComentarioQuery leftJoinUsuarioProfesional($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioProfesional relation
 * @method ComentarioQuery rightJoinUsuarioProfesional($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioProfesional relation
 * @method ComentarioQuery innerJoinUsuarioProfesional($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioProfesional relation
 *
 * @method ComentarioQuery leftJoinUsuarioPadre($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioPadre relation
 * @method ComentarioQuery rightJoinUsuarioPadre($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioPadre relation
 * @method ComentarioQuery innerJoinUsuarioPadre($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioPadre relation
 *
 * @method Comentario findOne(PropelPDO $con = null) Return the first Comentario matching the query
 * @method Comentario findOneOrCreate(PropelPDO $con = null) Return the first Comentario matching the query, or a new Comentario object populated from the query conditions when no match is found
 *
 * @method Comentario findOneByUprId(int $upr_id) Return the first Comentario filtered by the upr_id column
 * @method Comentario findOneByUpaId(int $upa_id) Return the first Comentario filtered by the upa_id column
 * @method Comentario findOneByBloId(int $blo_id) Return the first Comentario filtered by the blo_id column
 * @method Comentario findOneByComMensaje(string $com_mensaje) Return the first Comentario filtered by the com_mensaje column
 * @method Comentario findOneByComEstado(int $com_estado) Return the first Comentario filtered by the com_estado column
 * @method Comentario findOneByComEliminado(int $com_eliminado) Return the first Comentario filtered by the com_eliminado column
 * @method Comentario findOneByCreatedAt(string $created_at) Return the first Comentario filtered by the created_at column
 * @method Comentario findOneByUpdatedAt(string $updated_at) Return the first Comentario filtered by the updated_at column
 *
 * @method array findByComId(int $com_id) Return Comentario objects filtered by the com_id column
 * @method array findByUprId(int $upr_id) Return Comentario objects filtered by the upr_id column
 * @method array findByUpaId(int $upa_id) Return Comentario objects filtered by the upa_id column
 * @method array findByBloId(int $blo_id) Return Comentario objects filtered by the blo_id column
 * @method array findByComMensaje(string $com_mensaje) Return Comentario objects filtered by the com_mensaje column
 * @method array findByComEstado(int $com_estado) Return Comentario objects filtered by the com_estado column
 * @method array findByComEliminado(int $com_eliminado) Return Comentario objects filtered by the com_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Comentario objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Comentario objects filtered by the updated_at column
 */
abstract class BaseComentarioQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseComentarioQuery object.
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
            $modelName = 'AppBundle\\Model\\Comentario';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ComentarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ComentarioQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ComentarioQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ComentarioQuery) {
            return $criteria;
        }
        $query = new ComentarioQuery(null, null, $modelAlias);

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
     * @return   Comentario|Comentario[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ComentarioPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ComentarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Comentario A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByComId($key, $con = null)
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
     * @return                 Comentario A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `com_id`, `upr_id`, `upa_id`, `blo_id`, `com_mensaje`, `com_estado`, `com_eliminado`, `created_at`, `updated_at` FROM `comentario` WHERE `com_id` = :p0';
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
            $obj = new Comentario();
            $obj->hydrate($row);
            ComentarioPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Comentario|Comentario[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Comentario[]|mixed the list of results, formatted by the current formatter
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
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ComentarioPeer::COM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ComentarioPeer::COM_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the com_id column
     *
     * Example usage:
     * <code>
     * $query->filterByComId(1234); // WHERE com_id = 1234
     * $query->filterByComId(array(12, 34)); // WHERE com_id IN (12, 34)
     * $query->filterByComId(array('min' => 12)); // WHERE com_id >= 12
     * $query->filterByComId(array('max' => 12)); // WHERE com_id <= 12
     * </code>
     *
     * @param     mixed $comId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByComId($comId = null, $comparison = null)
    {
        if (is_array($comId)) {
            $useMinMax = false;
            if (isset($comId['min'])) {
                $this->addUsingAlias(ComentarioPeer::COM_ID, $comId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($comId['max'])) {
                $this->addUsingAlias(ComentarioPeer::COM_ID, $comId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::COM_ID, $comId, $comparison);
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
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByUprId($uprId = null, $comparison = null)
    {
        if (is_array($uprId)) {
            $useMinMax = false;
            if (isset($uprId['min'])) {
                $this->addUsingAlias(ComentarioPeer::UPR_ID, $uprId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uprId['max'])) {
                $this->addUsingAlias(ComentarioPeer::UPR_ID, $uprId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::UPR_ID, $uprId, $comparison);
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
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByUpaId($upaId = null, $comparison = null)
    {
        if (is_array($upaId)) {
            $useMinMax = false;
            if (isset($upaId['min'])) {
                $this->addUsingAlias(ComentarioPeer::UPA_ID, $upaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upaId['max'])) {
                $this->addUsingAlias(ComentarioPeer::UPA_ID, $upaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::UPA_ID, $upaId, $comparison);
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
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByBloId($bloId = null, $comparison = null)
    {
        if (is_array($bloId)) {
            $useMinMax = false;
            if (isset($bloId['min'])) {
                $this->addUsingAlias(ComentarioPeer::BLO_ID, $bloId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bloId['max'])) {
                $this->addUsingAlias(ComentarioPeer::BLO_ID, $bloId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::BLO_ID, $bloId, $comparison);
    }

    /**
     * Filter the query on the com_mensaje column
     *
     * Example usage:
     * <code>
     * $query->filterByComMensaje('fooValue');   // WHERE com_mensaje = 'fooValue'
     * $query->filterByComMensaje('%fooValue%'); // WHERE com_mensaje LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comMensaje The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByComMensaje($comMensaje = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comMensaje)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $comMensaje)) {
                $comMensaje = str_replace('*', '%', $comMensaje);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::COM_MENSAJE, $comMensaje, $comparison);
    }

    /**
     * Filter the query on the com_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByComEstado(1234); // WHERE com_estado = 1234
     * $query->filterByComEstado(array(12, 34)); // WHERE com_estado IN (12, 34)
     * $query->filterByComEstado(array('min' => 12)); // WHERE com_estado >= 12
     * $query->filterByComEstado(array('max' => 12)); // WHERE com_estado <= 12
     * </code>
     *
     * @param     mixed $comEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByComEstado($comEstado = null, $comparison = null)
    {
        if (is_array($comEstado)) {
            $useMinMax = false;
            if (isset($comEstado['min'])) {
                $this->addUsingAlias(ComentarioPeer::COM_ESTADO, $comEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($comEstado['max'])) {
                $this->addUsingAlias(ComentarioPeer::COM_ESTADO, $comEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::COM_ESTADO, $comEstado, $comparison);
    }

    /**
     * Filter the query on the com_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByComEliminado(1234); // WHERE com_eliminado = 1234
     * $query->filterByComEliminado(array(12, 34)); // WHERE com_eliminado IN (12, 34)
     * $query->filterByComEliminado(array('min' => 12)); // WHERE com_eliminado >= 12
     * $query->filterByComEliminado(array('max' => 12)); // WHERE com_eliminado <= 12
     * </code>
     *
     * @param     mixed $comEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByComEliminado($comEliminado = null, $comparison = null)
    {
        if (is_array($comEliminado)) {
            $useMinMax = false;
            if (isset($comEliminado['min'])) {
                $this->addUsingAlias(ComentarioPeer::COM_ELIMINADO, $comEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($comEliminado['max'])) {
                $this->addUsingAlias(ComentarioPeer::COM_ELIMINADO, $comEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::COM_ELIMINADO, $comEliminado, $comparison);
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
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ComentarioPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ComentarioPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ComentarioPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ComentarioPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComentarioPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Blog object
     *
     * @param   Blog|PropelObjectCollection $blog The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ComentarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBlog($blog, $comparison = null)
    {
        if ($blog instanceof Blog) {
            return $this
                ->addUsingAlias(ComentarioPeer::BLO_ID, $blog->getBloId(), $comparison);
        } elseif ($blog instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ComentarioPeer::BLO_ID, $blog->toKeyValue('PrimaryKey', 'BloId'), $comparison);
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
     * @return ComentarioQuery The current query, for fluid interface
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
     * Filter the query by a related UsuarioProfesional object
     *
     * @param   UsuarioProfesional|PropelObjectCollection $usuarioProfesional The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ComentarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioProfesional($usuarioProfesional, $comparison = null)
    {
        if ($usuarioProfesional instanceof UsuarioProfesional) {
            return $this
                ->addUsingAlias(ComentarioPeer::UPR_ID, $usuarioProfesional->getUprId(), $comparison);
        } elseif ($usuarioProfesional instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ComentarioPeer::UPR_ID, $usuarioProfesional->toKeyValue('PrimaryKey', 'UprId'), $comparison);
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
     * @return ComentarioQuery The current query, for fluid interface
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
     * @return                 ComentarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioPadre($usuarioPadre, $comparison = null)
    {
        if ($usuarioPadre instanceof UsuarioPadre) {
            return $this
                ->addUsingAlias(ComentarioPeer::UPA_ID, $usuarioPadre->getUpaId(), $comparison);
        } elseif ($usuarioPadre instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ComentarioPeer::UPA_ID, $usuarioPadre->toKeyValue('PrimaryKey', 'UpaId'), $comparison);
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
     * @return ComentarioQuery The current query, for fluid interface
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
     * @param   Comentario $comentario Object to remove from the list of results
     *
     * @return ComentarioQuery The current query, for fluid interface
     */
    public function prune($comentario = null)
    {
        if ($comentario) {
            $this->addUsingAlias(ComentarioPeer::COM_ID, $comentario->getComId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ComentarioQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ComentarioPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ComentarioQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ComentarioPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ComentarioQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ComentarioPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ComentarioQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ComentarioPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ComentarioQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ComentarioPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ComentarioQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ComentarioPeer::CREATED_AT);
    }
}
