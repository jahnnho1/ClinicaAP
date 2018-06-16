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
use AppBundle\Model\Clinica;
use AppBundle\Model\Comentario;
use AppBundle\Model\Device;
use AppBundle\Model\Especialidad;
use AppBundle\Model\Recurso;
use AppBundle\Model\UsuarioProfesional;
use AppBundle\Model\UsuarioProfesionalPeer;
use AppBundle\Model\UsuarioProfesionalQuery;
use AppBundle\Model\UsuariopadrePaciente;

/**
 * @method UsuarioProfesionalQuery orderByUprId($order = Criteria::ASC) Order by the upr_id column
 * @method UsuarioProfesionalQuery orderByCliId($order = Criteria::ASC) Order by the cli_id column
 * @method UsuarioProfesionalQuery orderByUprNombres($order = Criteria::ASC) Order by the upr_nombres column
 * @method UsuarioProfesionalQuery orderByUprApellidos($order = Criteria::ASC) Order by the upr_apellidos column
 * @method UsuarioProfesionalQuery orderByUprEmail($order = Criteria::ASC) Order by the upr_email column
 * @method UsuarioProfesionalQuery orderByUprClave($order = Criteria::ASC) Order by the upr_clave column
 * @method UsuarioProfesionalQuery orderByUprRut($order = Criteria::ASC) Order by the upr_rut column
 * @method UsuarioProfesionalQuery orderByUprDocumento($order = Criteria::ASC) Order by the upr_documento column
 * @method UsuarioProfesionalQuery orderByUprEstado($order = Criteria::ASC) Order by the upr_estado column
 * @method UsuarioProfesionalQuery orderByUprEliminado($order = Criteria::ASC) Order by the upr_eliminado column
 * @method UsuarioProfesionalQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method UsuarioProfesionalQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method UsuarioProfesionalQuery groupByUprId() Group by the upr_id column
 * @method UsuarioProfesionalQuery groupByCliId() Group by the cli_id column
 * @method UsuarioProfesionalQuery groupByUprNombres() Group by the upr_nombres column
 * @method UsuarioProfesionalQuery groupByUprApellidos() Group by the upr_apellidos column
 * @method UsuarioProfesionalQuery groupByUprEmail() Group by the upr_email column
 * @method UsuarioProfesionalQuery groupByUprClave() Group by the upr_clave column
 * @method UsuarioProfesionalQuery groupByUprRut() Group by the upr_rut column
 * @method UsuarioProfesionalQuery groupByUprDocumento() Group by the upr_documento column
 * @method UsuarioProfesionalQuery groupByUprEstado() Group by the upr_estado column
 * @method UsuarioProfesionalQuery groupByUprEliminado() Group by the upr_eliminado column
 * @method UsuarioProfesionalQuery groupByCreatedAt() Group by the created_at column
 * @method UsuarioProfesionalQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method UsuarioProfesionalQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UsuarioProfesionalQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UsuarioProfesionalQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UsuarioProfesionalQuery leftJoinClinica($relationAlias = null) Adds a LEFT JOIN clause to the query using the Clinica relation
 * @method UsuarioProfesionalQuery rightJoinClinica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Clinica relation
 * @method UsuarioProfesionalQuery innerJoinClinica($relationAlias = null) Adds a INNER JOIN clause to the query using the Clinica relation
 *
 * @method UsuarioProfesionalQuery leftJoinComentario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comentario relation
 * @method UsuarioProfesionalQuery rightJoinComentario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comentario relation
 * @method UsuarioProfesionalQuery innerJoinComentario($relationAlias = null) Adds a INNER JOIN clause to the query using the Comentario relation
 *
 * @method UsuarioProfesionalQuery leftJoinDevice($relationAlias = null) Adds a LEFT JOIN clause to the query using the Device relation
 * @method UsuarioProfesionalQuery rightJoinDevice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Device relation
 * @method UsuarioProfesionalQuery innerJoinDevice($relationAlias = null) Adds a INNER JOIN clause to the query using the Device relation
 *
 * @method UsuarioProfesionalQuery leftJoinEspecialidad($relationAlias = null) Adds a LEFT JOIN clause to the query using the Especialidad relation
 * @method UsuarioProfesionalQuery rightJoinEspecialidad($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Especialidad relation
 * @method UsuarioProfesionalQuery innerJoinEspecialidad($relationAlias = null) Adds a INNER JOIN clause to the query using the Especialidad relation
 *
 * @method UsuarioProfesionalQuery leftJoinRecurso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recurso relation
 * @method UsuarioProfesionalQuery rightJoinRecurso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recurso relation
 * @method UsuarioProfesionalQuery innerJoinRecurso($relationAlias = null) Adds a INNER JOIN clause to the query using the Recurso relation
 *
 * @method UsuarioProfesionalQuery leftJoinUsuariopadrePaciente($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuariopadrePaciente relation
 * @method UsuarioProfesionalQuery rightJoinUsuariopadrePaciente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuariopadrePaciente relation
 * @method UsuarioProfesionalQuery innerJoinUsuariopadrePaciente($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuariopadrePaciente relation
 *
 * @method UsuarioProfesional findOne(PropelPDO $con = null) Return the first UsuarioProfesional matching the query
 * @method UsuarioProfesional findOneOrCreate(PropelPDO $con = null) Return the first UsuarioProfesional matching the query, or a new UsuarioProfesional object populated from the query conditions when no match is found
 *
 * @method UsuarioProfesional findOneByCliId(int $cli_id) Return the first UsuarioProfesional filtered by the cli_id column
 * @method UsuarioProfesional findOneByUprNombres(string $upr_nombres) Return the first UsuarioProfesional filtered by the upr_nombres column
 * @method UsuarioProfesional findOneByUprApellidos(string $upr_apellidos) Return the first UsuarioProfesional filtered by the upr_apellidos column
 * @method UsuarioProfesional findOneByUprEmail(string $upr_email) Return the first UsuarioProfesional filtered by the upr_email column
 * @method UsuarioProfesional findOneByUprClave(string $upr_clave) Return the first UsuarioProfesional filtered by the upr_clave column
 * @method UsuarioProfesional findOneByUprRut(string $upr_rut) Return the first UsuarioProfesional filtered by the upr_rut column
 * @method UsuarioProfesional findOneByUprDocumento(string $upr_documento) Return the first UsuarioProfesional filtered by the upr_documento column
 * @method UsuarioProfesional findOneByUprEstado(int $upr_estado) Return the first UsuarioProfesional filtered by the upr_estado column
 * @method UsuarioProfesional findOneByUprEliminado(int $upr_eliminado) Return the first UsuarioProfesional filtered by the upr_eliminado column
 * @method UsuarioProfesional findOneByCreatedAt(string $created_at) Return the first UsuarioProfesional filtered by the created_at column
 * @method UsuarioProfesional findOneByUpdatedAt(string $updated_at) Return the first UsuarioProfesional filtered by the updated_at column
 *
 * @method array findByUprId(int $upr_id) Return UsuarioProfesional objects filtered by the upr_id column
 * @method array findByCliId(int $cli_id) Return UsuarioProfesional objects filtered by the cli_id column
 * @method array findByUprNombres(string $upr_nombres) Return UsuarioProfesional objects filtered by the upr_nombres column
 * @method array findByUprApellidos(string $upr_apellidos) Return UsuarioProfesional objects filtered by the upr_apellidos column
 * @method array findByUprEmail(string $upr_email) Return UsuarioProfesional objects filtered by the upr_email column
 * @method array findByUprClave(string $upr_clave) Return UsuarioProfesional objects filtered by the upr_clave column
 * @method array findByUprRut(string $upr_rut) Return UsuarioProfesional objects filtered by the upr_rut column
 * @method array findByUprDocumento(string $upr_documento) Return UsuarioProfesional objects filtered by the upr_documento column
 * @method array findByUprEstado(int $upr_estado) Return UsuarioProfesional objects filtered by the upr_estado column
 * @method array findByUprEliminado(int $upr_eliminado) Return UsuarioProfesional objects filtered by the upr_eliminado column
 * @method array findByCreatedAt(string $created_at) Return UsuarioProfesional objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return UsuarioProfesional objects filtered by the updated_at column
 */
abstract class BaseUsuarioProfesionalQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUsuarioProfesionalQuery object.
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
            $modelName = 'AppBundle\\Model\\UsuarioProfesional';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UsuarioProfesionalQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UsuarioProfesionalQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UsuarioProfesionalQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UsuarioProfesionalQuery) {
            return $criteria;
        }
        $query = new UsuarioProfesionalQuery(null, null, $modelAlias);

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
     * @return   UsuarioProfesional|UsuarioProfesional[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsuarioProfesionalPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UsuarioProfesionalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 UsuarioProfesional A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByUprId($key, $con = null)
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
     * @return                 UsuarioProfesional A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `upr_id`, `cli_id`, `upr_nombres`, `upr_apellidos`, `upr_email`, `upr_clave`, `upr_rut`, `upr_documento`, `upr_estado`, `upr_eliminado`, `created_at`, `updated_at` FROM `usuario_profesional` WHERE `upr_id` = :p0';
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
            $obj = new UsuarioProfesional();
            $obj->hydrate($row);
            UsuarioProfesionalPeer::addInstanceToPool($obj, (string) $key);
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
     * @return UsuarioProfesional|UsuarioProfesional[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|UsuarioProfesional[]|mixed the list of results, formatted by the current formatter
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
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $keys, Criteria::IN);
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
     * @param     mixed $uprId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprId($uprId = null, $comparison = null)
    {
        if (is_array($uprId)) {
            $useMinMax = false;
            if (isset($uprId['min'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $uprId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uprId['max'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $uprId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $uprId, $comparison);
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
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByCliId($cliId = null, $comparison = null)
    {
        if (is_array($cliId)) {
            $useMinMax = false;
            if (isset($cliId['min'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::CLI_ID, $cliId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cliId['max'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::CLI_ID, $cliId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::CLI_ID, $cliId, $comparison);
    }

    /**
     * Filter the query on the upr_nombres column
     *
     * Example usage:
     * <code>
     * $query->filterByUprNombres('fooValue');   // WHERE upr_nombres = 'fooValue'
     * $query->filterByUprNombres('%fooValue%'); // WHERE upr_nombres LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uprNombres The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprNombres($uprNombres = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uprNombres)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uprNombres)) {
                $uprNombres = str_replace('*', '%', $uprNombres);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_NOMBRES, $uprNombres, $comparison);
    }

    /**
     * Filter the query on the upr_apellidos column
     *
     * Example usage:
     * <code>
     * $query->filterByUprApellidos('fooValue');   // WHERE upr_apellidos = 'fooValue'
     * $query->filterByUprApellidos('%fooValue%'); // WHERE upr_apellidos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uprApellidos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprApellidos($uprApellidos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uprApellidos)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uprApellidos)) {
                $uprApellidos = str_replace('*', '%', $uprApellidos);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_APELLIDOS, $uprApellidos, $comparison);
    }

    /**
     * Filter the query on the upr_email column
     *
     * Example usage:
     * <code>
     * $query->filterByUprEmail('fooValue');   // WHERE upr_email = 'fooValue'
     * $query->filterByUprEmail('%fooValue%'); // WHERE upr_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uprEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprEmail($uprEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uprEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uprEmail)) {
                $uprEmail = str_replace('*', '%', $uprEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_EMAIL, $uprEmail, $comparison);
    }

    /**
     * Filter the query on the upr_clave column
     *
     * Example usage:
     * <code>
     * $query->filterByUprClave('fooValue');   // WHERE upr_clave = 'fooValue'
     * $query->filterByUprClave('%fooValue%'); // WHERE upr_clave LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uprClave The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprClave($uprClave = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uprClave)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uprClave)) {
                $uprClave = str_replace('*', '%', $uprClave);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_CLAVE, $uprClave, $comparison);
    }

    /**
     * Filter the query on the upr_rut column
     *
     * Example usage:
     * <code>
     * $query->filterByUprRut('fooValue');   // WHERE upr_rut = 'fooValue'
     * $query->filterByUprRut('%fooValue%'); // WHERE upr_rut LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uprRut The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprRut($uprRut = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uprRut)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uprRut)) {
                $uprRut = str_replace('*', '%', $uprRut);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_RUT, $uprRut, $comparison);
    }

    /**
     * Filter the query on the upr_documento column
     *
     * Example usage:
     * <code>
     * $query->filterByUprDocumento('fooValue');   // WHERE upr_documento = 'fooValue'
     * $query->filterByUprDocumento('%fooValue%'); // WHERE upr_documento LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uprDocumento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprDocumento($uprDocumento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uprDocumento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uprDocumento)) {
                $uprDocumento = str_replace('*', '%', $uprDocumento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_DOCUMENTO, $uprDocumento, $comparison);
    }

    /**
     * Filter the query on the upr_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByUprEstado(1234); // WHERE upr_estado = 1234
     * $query->filterByUprEstado(array(12, 34)); // WHERE upr_estado IN (12, 34)
     * $query->filterByUprEstado(array('min' => 12)); // WHERE upr_estado >= 12
     * $query->filterByUprEstado(array('max' => 12)); // WHERE upr_estado <= 12
     * </code>
     *
     * @param     mixed $uprEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprEstado($uprEstado = null, $comparison = null)
    {
        if (is_array($uprEstado)) {
            $useMinMax = false;
            if (isset($uprEstado['min'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ESTADO, $uprEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uprEstado['max'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ESTADO, $uprEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ESTADO, $uprEstado, $comparison);
    }

    /**
     * Filter the query on the upr_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByUprEliminado(1234); // WHERE upr_eliminado = 1234
     * $query->filterByUprEliminado(array(12, 34)); // WHERE upr_eliminado IN (12, 34)
     * $query->filterByUprEliminado(array('min' => 12)); // WHERE upr_eliminado >= 12
     * $query->filterByUprEliminado(array('max' => 12)); // WHERE upr_eliminado <= 12
     * </code>
     *
     * @param     mixed $uprEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUprEliminado($uprEliminado = null, $comparison = null)
    {
        if (is_array($uprEliminado)) {
            $useMinMax = false;
            if (isset($uprEliminado['min'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ELIMINADO, $uprEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uprEliminado['max'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ELIMINADO, $uprEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ELIMINADO, $uprEliminado, $comparison);
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
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsuarioProfesionalPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioProfesionalPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Clinica object
     *
     * @param   Clinica|PropelObjectCollection $clinica The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioProfesionalQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByClinica($clinica, $comparison = null)
    {
        if ($clinica instanceof Clinica) {
            return $this
                ->addUsingAlias(UsuarioProfesionalPeer::CLI_ID, $clinica->getCliId(), $comparison);
        } elseif ($clinica instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuarioProfesionalPeer::CLI_ID, $clinica->toKeyValue('PrimaryKey', 'CliId'), $comparison);
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
     * @return UsuarioProfesionalQuery The current query, for fluid interface
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
     * Filter the query by a related Comentario object
     *
     * @param   Comentario|PropelObjectCollection $comentario  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioProfesionalQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByComentario($comentario, $comparison = null)
    {
        if ($comentario instanceof Comentario) {
            return $this
                ->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $comentario->getUprId(), $comparison);
        } elseif ($comentario instanceof PropelObjectCollection) {
            return $this
                ->useComentarioQuery()
                ->filterByPrimaryKeys($comentario->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByComentario() only accepts arguments of type Comentario or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Comentario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function joinComentario($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Comentario');

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
            $this->addJoinObject($join, 'Comentario');
        }

        return $this;
    }

    /**
     * Use the Comentario relation Comentario object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\ComentarioQuery A secondary query class using the current class as primary query
     */
    public function useComentarioQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinComentario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Comentario', '\AppBundle\Model\ComentarioQuery');
    }

    /**
     * Filter the query by a related Device object
     *
     * @param   Device|PropelObjectCollection $device  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioProfesionalQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDevice($device, $comparison = null)
    {
        if ($device instanceof Device) {
            return $this
                ->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $device->getUprId(), $comparison);
        } elseif ($device instanceof PropelObjectCollection) {
            return $this
                ->useDeviceQuery()
                ->filterByPrimaryKeys($device->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDevice() only accepts arguments of type Device or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Device relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function joinDevice($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Device');

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
            $this->addJoinObject($join, 'Device');
        }

        return $this;
    }

    /**
     * Use the Device relation Device object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\DeviceQuery A secondary query class using the current class as primary query
     */
    public function useDeviceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDevice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Device', '\AppBundle\Model\DeviceQuery');
    }

    /**
     * Filter the query by a related Especialidad object
     *
     * @param   Especialidad|PropelObjectCollection $especialidad  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioProfesionalQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEspecialidad($especialidad, $comparison = null)
    {
        if ($especialidad instanceof Especialidad) {
            return $this
                ->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $especialidad->getUprId(), $comparison);
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
     * @return UsuarioProfesionalQuery The current query, for fluid interface
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
     * Filter the query by a related Recurso object
     *
     * @param   Recurso|PropelObjectCollection $recurso  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioProfesionalQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRecurso($recurso, $comparison = null)
    {
        if ($recurso instanceof Recurso) {
            return $this
                ->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $recurso->getUprId(), $comparison);
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
     * @return UsuarioProfesionalQuery The current query, for fluid interface
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
     * Filter the query by a related UsuariopadrePaciente object
     *
     * @param   UsuariopadrePaciente|PropelObjectCollection $usuariopadrePaciente  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioProfesionalQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuariopadrePaciente($usuariopadrePaciente, $comparison = null)
    {
        if ($usuariopadrePaciente instanceof UsuariopadrePaciente) {
            return $this
                ->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $usuariopadrePaciente->getUprId(), $comparison);
        } elseif ($usuariopadrePaciente instanceof PropelObjectCollection) {
            return $this
                ->useUsuariopadrePacienteQuery()
                ->filterByPrimaryKeys($usuariopadrePaciente->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuariopadrePaciente() only accepts arguments of type UsuariopadrePaciente or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuariopadrePaciente relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function joinUsuariopadrePaciente($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuariopadrePaciente');

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
            $this->addJoinObject($join, 'UsuariopadrePaciente');
        }

        return $this;
    }

    /**
     * Use the UsuariopadrePaciente relation UsuariopadrePaciente object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\UsuariopadrePacienteQuery A secondary query class using the current class as primary query
     */
    public function useUsuariopadrePacienteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuariopadrePaciente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuariopadrePaciente', '\AppBundle\Model\UsuariopadrePacienteQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   UsuarioProfesional $usuarioProfesional Object to remove from the list of results
     *
     * @return UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function prune($usuarioProfesional = null)
    {
        if ($usuarioProfesional) {
            $this->addUsingAlias(UsuarioProfesionalPeer::UPR_ID, $usuarioProfesional->getUprId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioProfesionalPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioProfesionalPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioProfesionalPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioProfesionalPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioProfesionalPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     UsuarioProfesionalQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioProfesionalPeer::CREATED_AT);
    }
}
