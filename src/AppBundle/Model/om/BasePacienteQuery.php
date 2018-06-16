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
use AppBundle\Model\PacienteFichamedica;
use AppBundle\Model\PacientePeer;
use AppBundle\Model\PacienteQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\UsuariopadrePaciente;

/**
 * @method PacienteQuery orderByPacId($order = Criteria::ASC) Order by the pac_id column
 * @method PacienteQuery orderByPacNombres($order = Criteria::ASC) Order by the pac_nombres column
 * @method PacienteQuery orderByPacApellidos($order = Criteria::ASC) Order by the pac_apellidos column
 * @method PacienteQuery orderByPacFechaNacimiento($order = Criteria::ASC) Order by the pac_fecha_nacimiento column
 * @method PacienteQuery orderByPacSexo($order = Criteria::ASC) Order by the pac_sexo column
 * @method PacienteQuery orderByPacRut($order = Criteria::ASC) Order by the pac_rut column
 * @method PacienteQuery orderByPacDocumento($order = Criteria::ASC) Order by the pac_documento column
 * @method PacienteQuery orderByPacEstado($order = Criteria::ASC) Order by the pac_estado column
 * @method PacienteQuery orderByPacEliminado($order = Criteria::ASC) Order by the pac_eliminado column
 * @method PacienteQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PacienteQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method PacienteQuery groupByPacId() Group by the pac_id column
 * @method PacienteQuery groupByPacNombres() Group by the pac_nombres column
 * @method PacienteQuery groupByPacApellidos() Group by the pac_apellidos column
 * @method PacienteQuery groupByPacFechaNacimiento() Group by the pac_fecha_nacimiento column
 * @method PacienteQuery groupByPacSexo() Group by the pac_sexo column
 * @method PacienteQuery groupByPacRut() Group by the pac_rut column
 * @method PacienteQuery groupByPacDocumento() Group by the pac_documento column
 * @method PacienteQuery groupByPacEstado() Group by the pac_estado column
 * @method PacienteQuery groupByPacEliminado() Group by the pac_eliminado column
 * @method PacienteQuery groupByCreatedAt() Group by the created_at column
 * @method PacienteQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method PacienteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PacienteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PacienteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PacienteQuery leftJoinPacienteFichamedica($relationAlias = null) Adds a LEFT JOIN clause to the query using the PacienteFichamedica relation
 * @method PacienteQuery rightJoinPacienteFichamedica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PacienteFichamedica relation
 * @method PacienteQuery innerJoinPacienteFichamedica($relationAlias = null) Adds a INNER JOIN clause to the query using the PacienteFichamedica relation
 *
 * @method PacienteQuery leftJoinRecurso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recurso relation
 * @method PacienteQuery rightJoinRecurso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recurso relation
 * @method PacienteQuery innerJoinRecurso($relationAlias = null) Adds a INNER JOIN clause to the query using the Recurso relation
 *
 * @method PacienteQuery leftJoinUsuariopadrePaciente($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuariopadrePaciente relation
 * @method PacienteQuery rightJoinUsuariopadrePaciente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuariopadrePaciente relation
 * @method PacienteQuery innerJoinUsuariopadrePaciente($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuariopadrePaciente relation
 *
 * @method Paciente findOne(PropelPDO $con = null) Return the first Paciente matching the query
 * @method Paciente findOneOrCreate(PropelPDO $con = null) Return the first Paciente matching the query, or a new Paciente object populated from the query conditions when no match is found
 *
 * @method Paciente findOneByPacNombres(string $pac_nombres) Return the first Paciente filtered by the pac_nombres column
 * @method Paciente findOneByPacApellidos(string $pac_apellidos) Return the first Paciente filtered by the pac_apellidos column
 * @method Paciente findOneByPacFechaNacimiento(string $pac_fecha_nacimiento) Return the first Paciente filtered by the pac_fecha_nacimiento column
 * @method Paciente findOneByPacSexo(int $pac_sexo) Return the first Paciente filtered by the pac_sexo column
 * @method Paciente findOneByPacRut(string $pac_rut) Return the first Paciente filtered by the pac_rut column
 * @method Paciente findOneByPacDocumento(string $pac_documento) Return the first Paciente filtered by the pac_documento column
 * @method Paciente findOneByPacEstado(int $pac_estado) Return the first Paciente filtered by the pac_estado column
 * @method Paciente findOneByPacEliminado(int $pac_eliminado) Return the first Paciente filtered by the pac_eliminado column
 * @method Paciente findOneByCreatedAt(string $created_at) Return the first Paciente filtered by the created_at column
 * @method Paciente findOneByUpdatedAt(string $updated_at) Return the first Paciente filtered by the updated_at column
 *
 * @method array findByPacId(int $pac_id) Return Paciente objects filtered by the pac_id column
 * @method array findByPacNombres(string $pac_nombres) Return Paciente objects filtered by the pac_nombres column
 * @method array findByPacApellidos(string $pac_apellidos) Return Paciente objects filtered by the pac_apellidos column
 * @method array findByPacFechaNacimiento(string $pac_fecha_nacimiento) Return Paciente objects filtered by the pac_fecha_nacimiento column
 * @method array findByPacSexo(int $pac_sexo) Return Paciente objects filtered by the pac_sexo column
 * @method array findByPacRut(string $pac_rut) Return Paciente objects filtered by the pac_rut column
 * @method array findByPacDocumento(string $pac_documento) Return Paciente objects filtered by the pac_documento column
 * @method array findByPacEstado(int $pac_estado) Return Paciente objects filtered by the pac_estado column
 * @method array findByPacEliminado(int $pac_eliminado) Return Paciente objects filtered by the pac_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Paciente objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Paciente objects filtered by the updated_at column
 */
abstract class BasePacienteQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePacienteQuery object.
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
            $modelName = 'AppBundle\\Model\\Paciente';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PacienteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PacienteQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PacienteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PacienteQuery) {
            return $criteria;
        }
        $query = new PacienteQuery(null, null, $modelAlias);

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
     * @return   Paciente|Paciente[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PacientePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PacientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Paciente A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByPacId($key, $con = null)
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
     * @return                 Paciente A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `pac_id`, `pac_nombres`, `pac_apellidos`, `pac_fecha_nacimiento`, `pac_sexo`, `pac_rut`, `pac_documento`, `pac_estado`, `pac_eliminado`, `created_at`, `updated_at` FROM `paciente` WHERE `pac_id` = :p0';
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
            $obj = new Paciente();
            $obj->hydrate($row);
            PacientePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Paciente|Paciente[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Paciente[]|mixed the list of results, formatted by the current formatter
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
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PacientePeer::PAC_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PacientePeer::PAC_ID, $keys, Criteria::IN);
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
     * @param     mixed $pacId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacId($pacId = null, $comparison = null)
    {
        if (is_array($pacId)) {
            $useMinMax = false;
            if (isset($pacId['min'])) {
                $this->addUsingAlias(PacientePeer::PAC_ID, $pacId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacId['max'])) {
                $this->addUsingAlias(PacientePeer::PAC_ID, $pacId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_ID, $pacId, $comparison);
    }

    /**
     * Filter the query on the pac_nombres column
     *
     * Example usage:
     * <code>
     * $query->filterByPacNombres('fooValue');   // WHERE pac_nombres = 'fooValue'
     * $query->filterByPacNombres('%fooValue%'); // WHERE pac_nombres LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pacNombres The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacNombres($pacNombres = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pacNombres)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pacNombres)) {
                $pacNombres = str_replace('*', '%', $pacNombres);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_NOMBRES, $pacNombres, $comparison);
    }

    /**
     * Filter the query on the pac_apellidos column
     *
     * Example usage:
     * <code>
     * $query->filterByPacApellidos('fooValue');   // WHERE pac_apellidos = 'fooValue'
     * $query->filterByPacApellidos('%fooValue%'); // WHERE pac_apellidos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pacApellidos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacApellidos($pacApellidos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pacApellidos)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pacApellidos)) {
                $pacApellidos = str_replace('*', '%', $pacApellidos);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_APELLIDOS, $pacApellidos, $comparison);
    }

    /**
     * Filter the query on the pac_fecha_nacimiento column
     *
     * Example usage:
     * <code>
     * $query->filterByPacFechaNacimiento('2011-03-14'); // WHERE pac_fecha_nacimiento = '2011-03-14'
     * $query->filterByPacFechaNacimiento('now'); // WHERE pac_fecha_nacimiento = '2011-03-14'
     * $query->filterByPacFechaNacimiento(array('max' => 'yesterday')); // WHERE pac_fecha_nacimiento < '2011-03-13'
     * </code>
     *
     * @param     mixed $pacFechaNacimiento The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacFechaNacimiento($pacFechaNacimiento = null, $comparison = null)
    {
        if (is_array($pacFechaNacimiento)) {
            $useMinMax = false;
            if (isset($pacFechaNacimiento['min'])) {
                $this->addUsingAlias(PacientePeer::PAC_FECHA_NACIMIENTO, $pacFechaNacimiento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacFechaNacimiento['max'])) {
                $this->addUsingAlias(PacientePeer::PAC_FECHA_NACIMIENTO, $pacFechaNacimiento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_FECHA_NACIMIENTO, $pacFechaNacimiento, $comparison);
    }

    /**
     * Filter the query on the pac_sexo column
     *
     * Example usage:
     * <code>
     * $query->filterByPacSexo(1234); // WHERE pac_sexo = 1234
     * $query->filterByPacSexo(array(12, 34)); // WHERE pac_sexo IN (12, 34)
     * $query->filterByPacSexo(array('min' => 12)); // WHERE pac_sexo >= 12
     * $query->filterByPacSexo(array('max' => 12)); // WHERE pac_sexo <= 12
     * </code>
     *
     * @param     mixed $pacSexo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacSexo($pacSexo = null, $comparison = null)
    {
        if (is_array($pacSexo)) {
            $useMinMax = false;
            if (isset($pacSexo['min'])) {
                $this->addUsingAlias(PacientePeer::PAC_SEXO, $pacSexo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacSexo['max'])) {
                $this->addUsingAlias(PacientePeer::PAC_SEXO, $pacSexo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_SEXO, $pacSexo, $comparison);
    }

    /**
     * Filter the query on the pac_rut column
     *
     * Example usage:
     * <code>
     * $query->filterByPacRut('fooValue');   // WHERE pac_rut = 'fooValue'
     * $query->filterByPacRut('%fooValue%'); // WHERE pac_rut LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pacRut The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacRut($pacRut = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pacRut)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pacRut)) {
                $pacRut = str_replace('*', '%', $pacRut);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_RUT, $pacRut, $comparison);
    }

    /**
     * Filter the query on the pac_documento column
     *
     * Example usage:
     * <code>
     * $query->filterByPacDocumento('fooValue');   // WHERE pac_documento = 'fooValue'
     * $query->filterByPacDocumento('%fooValue%'); // WHERE pac_documento LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pacDocumento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacDocumento($pacDocumento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pacDocumento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pacDocumento)) {
                $pacDocumento = str_replace('*', '%', $pacDocumento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_DOCUMENTO, $pacDocumento, $comparison);
    }

    /**
     * Filter the query on the pac_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByPacEstado(1234); // WHERE pac_estado = 1234
     * $query->filterByPacEstado(array(12, 34)); // WHERE pac_estado IN (12, 34)
     * $query->filterByPacEstado(array('min' => 12)); // WHERE pac_estado >= 12
     * $query->filterByPacEstado(array('max' => 12)); // WHERE pac_estado <= 12
     * </code>
     *
     * @param     mixed $pacEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacEstado($pacEstado = null, $comparison = null)
    {
        if (is_array($pacEstado)) {
            $useMinMax = false;
            if (isset($pacEstado['min'])) {
                $this->addUsingAlias(PacientePeer::PAC_ESTADO, $pacEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacEstado['max'])) {
                $this->addUsingAlias(PacientePeer::PAC_ESTADO, $pacEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_ESTADO, $pacEstado, $comparison);
    }

    /**
     * Filter the query on the pac_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByPacEliminado(1234); // WHERE pac_eliminado = 1234
     * $query->filterByPacEliminado(array(12, 34)); // WHERE pac_eliminado IN (12, 34)
     * $query->filterByPacEliminado(array('min' => 12)); // WHERE pac_eliminado >= 12
     * $query->filterByPacEliminado(array('max' => 12)); // WHERE pac_eliminado <= 12
     * </code>
     *
     * @param     mixed $pacEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByPacEliminado($pacEliminado = null, $comparison = null)
    {
        if (is_array($pacEliminado)) {
            $useMinMax = false;
            if (isset($pacEliminado['min'])) {
                $this->addUsingAlias(PacientePeer::PAC_ELIMINADO, $pacEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pacEliminado['max'])) {
                $this->addUsingAlias(PacientePeer::PAC_ELIMINADO, $pacEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacientePeer::PAC_ELIMINADO, $pacEliminado, $comparison);
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
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PacientePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PacientePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacientePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PacienteQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PacientePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PacientePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PacientePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related PacienteFichamedica object
     *
     * @param   PacienteFichamedica|PropelObjectCollection $pacienteFichamedica  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PacienteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPacienteFichamedica($pacienteFichamedica, $comparison = null)
    {
        if ($pacienteFichamedica instanceof PacienteFichamedica) {
            return $this
                ->addUsingAlias(PacientePeer::PAC_ID, $pacienteFichamedica->getPacId(), $comparison);
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
     * @return PacienteQuery The current query, for fluid interface
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
     * Filter the query by a related Recurso object
     *
     * @param   Recurso|PropelObjectCollection $recurso  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PacienteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRecurso($recurso, $comparison = null)
    {
        if ($recurso instanceof Recurso) {
            return $this
                ->addUsingAlias(PacientePeer::PAC_ID, $recurso->getPacId(), $comparison);
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
     * @return PacienteQuery The current query, for fluid interface
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
     * @return                 PacienteQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuariopadrePaciente($usuariopadrePaciente, $comparison = null)
    {
        if ($usuariopadrePaciente instanceof UsuariopadrePaciente) {
            return $this
                ->addUsingAlias(PacientePeer::PAC_ID, $usuariopadrePaciente->getPacId(), $comparison);
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
     * @return PacienteQuery The current query, for fluid interface
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
     * @param   Paciente $paciente Object to remove from the list of results
     *
     * @return PacienteQuery The current query, for fluid interface
     */
    public function prune($paciente = null)
    {
        if ($paciente) {
            $this->addUsingAlias(PacientePeer::PAC_ID, $paciente->getPacId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PacienteQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PacientePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PacienteQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PacientePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PacienteQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PacientePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PacienteQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PacientePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PacienteQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PacientePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PacienteQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PacientePeer::CREATED_AT);
    }
}
