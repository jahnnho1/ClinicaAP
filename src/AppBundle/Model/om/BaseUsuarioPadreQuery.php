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
use AppBundle\Model\Comentario;
use AppBundle\Model\Device;
use AppBundle\Model\Recurso;
use AppBundle\Model\UsuarioPadre;
use AppBundle\Model\UsuarioPadrePeer;
use AppBundle\Model\UsuarioPadreQuery;
use AppBundle\Model\UsuariopadrePaciente;

/**
 * @method UsuarioPadreQuery orderByUpaId($order = Criteria::ASC) Order by the upa_id column
 * @method UsuarioPadreQuery orderByUpaEmail($order = Criteria::ASC) Order by the upa_email column
 * @method UsuarioPadreQuery orderByUpaNombres($order = Criteria::ASC) Order by the upa_nombres column
 * @method UsuarioPadreQuery orderByUpaApellidos($order = Criteria::ASC) Order by the upa_apellidos column
 * @method UsuarioPadreQuery orderByUpaRut($order = Criteria::ASC) Order by the upa_rut column
 * @method UsuarioPadreQuery orderByUpaDocumento($order = Criteria::ASC) Order by the upa_documento column
 * @method UsuarioPadreQuery orderByUpaClave($order = Criteria::ASC) Order by the upa_clave column
 * @method UsuarioPadreQuery orderByUpaEstado($order = Criteria::ASC) Order by the upa_estado column
 * @method UsuarioPadreQuery orderByUpaEliminado($order = Criteria::ASC) Order by the upa_eliminado column
 * @method UsuarioPadreQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method UsuarioPadreQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method UsuarioPadreQuery groupByUpaId() Group by the upa_id column
 * @method UsuarioPadreQuery groupByUpaEmail() Group by the upa_email column
 * @method UsuarioPadreQuery groupByUpaNombres() Group by the upa_nombres column
 * @method UsuarioPadreQuery groupByUpaApellidos() Group by the upa_apellidos column
 * @method UsuarioPadreQuery groupByUpaRut() Group by the upa_rut column
 * @method UsuarioPadreQuery groupByUpaDocumento() Group by the upa_documento column
 * @method UsuarioPadreQuery groupByUpaClave() Group by the upa_clave column
 * @method UsuarioPadreQuery groupByUpaEstado() Group by the upa_estado column
 * @method UsuarioPadreQuery groupByUpaEliminado() Group by the upa_eliminado column
 * @method UsuarioPadreQuery groupByCreatedAt() Group by the created_at column
 * @method UsuarioPadreQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method UsuarioPadreQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UsuarioPadreQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UsuarioPadreQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UsuarioPadreQuery leftJoinComentario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comentario relation
 * @method UsuarioPadreQuery rightJoinComentario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comentario relation
 * @method UsuarioPadreQuery innerJoinComentario($relationAlias = null) Adds a INNER JOIN clause to the query using the Comentario relation
 *
 * @method UsuarioPadreQuery leftJoinDevice($relationAlias = null) Adds a LEFT JOIN clause to the query using the Device relation
 * @method UsuarioPadreQuery rightJoinDevice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Device relation
 * @method UsuarioPadreQuery innerJoinDevice($relationAlias = null) Adds a INNER JOIN clause to the query using the Device relation
 *
 * @method UsuarioPadreQuery leftJoinRecurso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recurso relation
 * @method UsuarioPadreQuery rightJoinRecurso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recurso relation
 * @method UsuarioPadreQuery innerJoinRecurso($relationAlias = null) Adds a INNER JOIN clause to the query using the Recurso relation
 *
 * @method UsuarioPadreQuery leftJoinUsuariopadrePaciente($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuariopadrePaciente relation
 * @method UsuarioPadreQuery rightJoinUsuariopadrePaciente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuariopadrePaciente relation
 * @method UsuarioPadreQuery innerJoinUsuariopadrePaciente($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuariopadrePaciente relation
 *
 * @method UsuarioPadre findOne(PropelPDO $con = null) Return the first UsuarioPadre matching the query
 * @method UsuarioPadre findOneOrCreate(PropelPDO $con = null) Return the first UsuarioPadre matching the query, or a new UsuarioPadre object populated from the query conditions when no match is found
 *
 * @method UsuarioPadre findOneByUpaEmail(string $upa_email) Return the first UsuarioPadre filtered by the upa_email column
 * @method UsuarioPadre findOneByUpaNombres(string $upa_nombres) Return the first UsuarioPadre filtered by the upa_nombres column
 * @method UsuarioPadre findOneByUpaApellidos(string $upa_apellidos) Return the first UsuarioPadre filtered by the upa_apellidos column
 * @method UsuarioPadre findOneByUpaRut(string $upa_rut) Return the first UsuarioPadre filtered by the upa_rut column
 * @method UsuarioPadre findOneByUpaDocumento(string $upa_documento) Return the first UsuarioPadre filtered by the upa_documento column
 * @method UsuarioPadre findOneByUpaClave(string $upa_clave) Return the first UsuarioPadre filtered by the upa_clave column
 * @method UsuarioPadre findOneByUpaEstado(int $upa_estado) Return the first UsuarioPadre filtered by the upa_estado column
 * @method UsuarioPadre findOneByUpaEliminado(int $upa_eliminado) Return the first UsuarioPadre filtered by the upa_eliminado column
 * @method UsuarioPadre findOneByCreatedAt(string $created_at) Return the first UsuarioPadre filtered by the created_at column
 * @method UsuarioPadre findOneByUpdatedAt(string $updated_at) Return the first UsuarioPadre filtered by the updated_at column
 *
 * @method array findByUpaId(int $upa_id) Return UsuarioPadre objects filtered by the upa_id column
 * @method array findByUpaEmail(string $upa_email) Return UsuarioPadre objects filtered by the upa_email column
 * @method array findByUpaNombres(string $upa_nombres) Return UsuarioPadre objects filtered by the upa_nombres column
 * @method array findByUpaApellidos(string $upa_apellidos) Return UsuarioPadre objects filtered by the upa_apellidos column
 * @method array findByUpaRut(string $upa_rut) Return UsuarioPadre objects filtered by the upa_rut column
 * @method array findByUpaDocumento(string $upa_documento) Return UsuarioPadre objects filtered by the upa_documento column
 * @method array findByUpaClave(string $upa_clave) Return UsuarioPadre objects filtered by the upa_clave column
 * @method array findByUpaEstado(int $upa_estado) Return UsuarioPadre objects filtered by the upa_estado column
 * @method array findByUpaEliminado(int $upa_eliminado) Return UsuarioPadre objects filtered by the upa_eliminado column
 * @method array findByCreatedAt(string $created_at) Return UsuarioPadre objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return UsuarioPadre objects filtered by the updated_at column
 */
abstract class BaseUsuarioPadreQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUsuarioPadreQuery object.
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
            $modelName = 'AppBundle\\Model\\UsuarioPadre';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UsuarioPadreQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UsuarioPadreQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UsuarioPadreQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UsuarioPadreQuery) {
            return $criteria;
        }
        $query = new UsuarioPadreQuery(null, null, $modelAlias);

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
     * @return   UsuarioPadre|UsuarioPadre[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsuarioPadrePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UsuarioPadrePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 UsuarioPadre A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByUpaId($key, $con = null)
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
     * @return                 UsuarioPadre A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `upa_id`, `upa_email`, `upa_nombres`, `upa_apellidos`, `upa_rut`, `upa_documento`, `upa_clave`, `upa_estado`, `upa_eliminado`, `created_at`, `updated_at` FROM `usuario_padre` WHERE `upa_id` = :p0';
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
            $obj = new UsuarioPadre();
            $obj->hydrate($row);
            UsuarioPadrePeer::addInstanceToPool($obj, (string) $key);
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
     * @return UsuarioPadre|UsuarioPadre[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|UsuarioPadre[]|mixed the list of results, formatted by the current formatter
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
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_ID, $keys, Criteria::IN);
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
     * @param     mixed $upaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaId($upaId = null, $comparison = null)
    {
        if (is_array($upaId)) {
            $useMinMax = false;
            if (isset($upaId['min'])) {
                $this->addUsingAlias(UsuarioPadrePeer::UPA_ID, $upaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upaId['max'])) {
                $this->addUsingAlias(UsuarioPadrePeer::UPA_ID, $upaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_ID, $upaId, $comparison);
    }

    /**
     * Filter the query on the upa_email column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaEmail('fooValue');   // WHERE upa_email = 'fooValue'
     * $query->filterByUpaEmail('%fooValue%'); // WHERE upa_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $upaEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaEmail($upaEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($upaEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $upaEmail)) {
                $upaEmail = str_replace('*', '%', $upaEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_EMAIL, $upaEmail, $comparison);
    }

    /**
     * Filter the query on the upa_nombres column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaNombres('fooValue');   // WHERE upa_nombres = 'fooValue'
     * $query->filterByUpaNombres('%fooValue%'); // WHERE upa_nombres LIKE '%fooValue%'
     * </code>
     *
     * @param     string $upaNombres The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaNombres($upaNombres = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($upaNombres)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $upaNombres)) {
                $upaNombres = str_replace('*', '%', $upaNombres);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_NOMBRES, $upaNombres, $comparison);
    }

    /**
     * Filter the query on the upa_apellidos column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaApellidos('fooValue');   // WHERE upa_apellidos = 'fooValue'
     * $query->filterByUpaApellidos('%fooValue%'); // WHERE upa_apellidos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $upaApellidos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaApellidos($upaApellidos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($upaApellidos)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $upaApellidos)) {
                $upaApellidos = str_replace('*', '%', $upaApellidos);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_APELLIDOS, $upaApellidos, $comparison);
    }

    /**
     * Filter the query on the upa_rut column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaRut('fooValue');   // WHERE upa_rut = 'fooValue'
     * $query->filterByUpaRut('%fooValue%'); // WHERE upa_rut LIKE '%fooValue%'
     * </code>
     *
     * @param     string $upaRut The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaRut($upaRut = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($upaRut)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $upaRut)) {
                $upaRut = str_replace('*', '%', $upaRut);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_RUT, $upaRut, $comparison);
    }

    /**
     * Filter the query on the upa_documento column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaDocumento('fooValue');   // WHERE upa_documento = 'fooValue'
     * $query->filterByUpaDocumento('%fooValue%'); // WHERE upa_documento LIKE '%fooValue%'
     * </code>
     *
     * @param     string $upaDocumento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaDocumento($upaDocumento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($upaDocumento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $upaDocumento)) {
                $upaDocumento = str_replace('*', '%', $upaDocumento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_DOCUMENTO, $upaDocumento, $comparison);
    }

    /**
     * Filter the query on the upa_clave column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaClave('fooValue');   // WHERE upa_clave = 'fooValue'
     * $query->filterByUpaClave('%fooValue%'); // WHERE upa_clave LIKE '%fooValue%'
     * </code>
     *
     * @param     string $upaClave The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaClave($upaClave = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($upaClave)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $upaClave)) {
                $upaClave = str_replace('*', '%', $upaClave);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_CLAVE, $upaClave, $comparison);
    }

    /**
     * Filter the query on the upa_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaEstado(1234); // WHERE upa_estado = 1234
     * $query->filterByUpaEstado(array(12, 34)); // WHERE upa_estado IN (12, 34)
     * $query->filterByUpaEstado(array('min' => 12)); // WHERE upa_estado >= 12
     * $query->filterByUpaEstado(array('max' => 12)); // WHERE upa_estado <= 12
     * </code>
     *
     * @param     mixed $upaEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaEstado($upaEstado = null, $comparison = null)
    {
        if (is_array($upaEstado)) {
            $useMinMax = false;
            if (isset($upaEstado['min'])) {
                $this->addUsingAlias(UsuarioPadrePeer::UPA_ESTADO, $upaEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upaEstado['max'])) {
                $this->addUsingAlias(UsuarioPadrePeer::UPA_ESTADO, $upaEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_ESTADO, $upaEstado, $comparison);
    }

    /**
     * Filter the query on the upa_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByUpaEliminado(1234); // WHERE upa_eliminado = 1234
     * $query->filterByUpaEliminado(array(12, 34)); // WHERE upa_eliminado IN (12, 34)
     * $query->filterByUpaEliminado(array('min' => 12)); // WHERE upa_eliminado >= 12
     * $query->filterByUpaEliminado(array('max' => 12)); // WHERE upa_eliminado <= 12
     * </code>
     *
     * @param     mixed $upaEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpaEliminado($upaEliminado = null, $comparison = null)
    {
        if (is_array($upaEliminado)) {
            $useMinMax = false;
            if (isset($upaEliminado['min'])) {
                $this->addUsingAlias(UsuarioPadrePeer::UPA_ELIMINADO, $upaEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upaEliminado['max'])) {
                $this->addUsingAlias(UsuarioPadrePeer::UPA_ELIMINADO, $upaEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPA_ELIMINADO, $upaEliminado, $comparison);
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
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UsuarioPadrePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsuarioPadrePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsuarioPadrePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsuarioPadrePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPadrePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Comentario object
     *
     * @param   Comentario|PropelObjectCollection $comentario  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioPadreQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByComentario($comentario, $comparison = null)
    {
        if ($comentario instanceof Comentario) {
            return $this
                ->addUsingAlias(UsuarioPadrePeer::UPA_ID, $comentario->getUpaId(), $comparison);
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
     * @return UsuarioPadreQuery The current query, for fluid interface
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
     * @return                 UsuarioPadreQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDevice($device, $comparison = null)
    {
        if ($device instanceof Device) {
            return $this
                ->addUsingAlias(UsuarioPadrePeer::UPA_ID, $device->getUpaId(), $comparison);
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
     * @return UsuarioPadreQuery The current query, for fluid interface
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
     * Filter the query by a related Recurso object
     *
     * @param   Recurso|PropelObjectCollection $recurso  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioPadreQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRecurso($recurso, $comparison = null)
    {
        if ($recurso instanceof Recurso) {
            return $this
                ->addUsingAlias(UsuarioPadrePeer::UPA_ID, $recurso->getUpaId(), $comparison);
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
     * @return UsuarioPadreQuery The current query, for fluid interface
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
     * @return                 UsuarioPadreQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuariopadrePaciente($usuariopadrePaciente, $comparison = null)
    {
        if ($usuariopadrePaciente instanceof UsuariopadrePaciente) {
            return $this
                ->addUsingAlias(UsuarioPadrePeer::UPA_ID, $usuariopadrePaciente->getUpaId(), $comparison);
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
     * @return UsuarioPadreQuery The current query, for fluid interface
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
     * @param   UsuarioPadre $usuarioPadre Object to remove from the list of results
     *
     * @return UsuarioPadreQuery The current query, for fluid interface
     */
    public function prune($usuarioPadre = null)
    {
        if ($usuarioPadre) {
            $this->addUsingAlias(UsuarioPadrePeer::UPA_ID, $usuarioPadre->getUpaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UsuarioPadreQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioPadrePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UsuarioPadreQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioPadrePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     UsuarioPadreQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioPadrePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UsuarioPadreQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioPadrePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UsuarioPadreQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioPadrePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     UsuarioPadreQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioPadrePeer::CREATED_AT);
    }
}
