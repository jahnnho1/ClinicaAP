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
use AppBundle\Model\UsuarioAdministrativo;
use AppBundle\Model\UsuarioAdministrativoPeer;
use AppBundle\Model\UsuarioAdministrativoQuery;

/**
 * @method UsuarioAdministrativoQuery orderByUsuId($order = Criteria::ASC) Order by the usu_id column
 * @method UsuarioAdministrativoQuery orderByCliId($order = Criteria::ASC) Order by the cli_id column
 * @method UsuarioAdministrativoQuery orderByUsuNombre($order = Criteria::ASC) Order by the usu_nombre column
 * @method UsuarioAdministrativoQuery orderByUsuApellido($order = Criteria::ASC) Order by the usu_apellido column
 * @method UsuarioAdministrativoQuery orderByUsuEmail($order = Criteria::ASC) Order by the usu_email column
 * @method UsuarioAdministrativoQuery orderByUsuRut($order = Criteria::ASC) Order by the usu_rut column
 * @method UsuarioAdministrativoQuery orderByUsuClave($order = Criteria::ASC) Order by the usu_clave column
 * @method UsuarioAdministrativoQuery orderByUsuEstado($order = Criteria::ASC) Order by the usu_estado column
 * @method UsuarioAdministrativoQuery orderByUsuEliminado($order = Criteria::ASC) Order by the usu_eliminado column
 * @method UsuarioAdministrativoQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method UsuarioAdministrativoQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method UsuarioAdministrativoQuery groupByUsuId() Group by the usu_id column
 * @method UsuarioAdministrativoQuery groupByCliId() Group by the cli_id column
 * @method UsuarioAdministrativoQuery groupByUsuNombre() Group by the usu_nombre column
 * @method UsuarioAdministrativoQuery groupByUsuApellido() Group by the usu_apellido column
 * @method UsuarioAdministrativoQuery groupByUsuEmail() Group by the usu_email column
 * @method UsuarioAdministrativoQuery groupByUsuRut() Group by the usu_rut column
 * @method UsuarioAdministrativoQuery groupByUsuClave() Group by the usu_clave column
 * @method UsuarioAdministrativoQuery groupByUsuEstado() Group by the usu_estado column
 * @method UsuarioAdministrativoQuery groupByUsuEliminado() Group by the usu_eliminado column
 * @method UsuarioAdministrativoQuery groupByCreatedAt() Group by the created_at column
 * @method UsuarioAdministrativoQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method UsuarioAdministrativoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UsuarioAdministrativoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UsuarioAdministrativoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UsuarioAdministrativoQuery leftJoinClinica($relationAlias = null) Adds a LEFT JOIN clause to the query using the Clinica relation
 * @method UsuarioAdministrativoQuery rightJoinClinica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Clinica relation
 * @method UsuarioAdministrativoQuery innerJoinClinica($relationAlias = null) Adds a INNER JOIN clause to the query using the Clinica relation
 *
 * @method UsuarioAdministrativo findOne(PropelPDO $con = null) Return the first UsuarioAdministrativo matching the query
 * @method UsuarioAdministrativo findOneOrCreate(PropelPDO $con = null) Return the first UsuarioAdministrativo matching the query, or a new UsuarioAdministrativo object populated from the query conditions when no match is found
 *
 * @method UsuarioAdministrativo findOneByCliId(int $cli_id) Return the first UsuarioAdministrativo filtered by the cli_id column
 * @method UsuarioAdministrativo findOneByUsuNombre(string $usu_nombre) Return the first UsuarioAdministrativo filtered by the usu_nombre column
 * @method UsuarioAdministrativo findOneByUsuApellido(string $usu_apellido) Return the first UsuarioAdministrativo filtered by the usu_apellido column
 * @method UsuarioAdministrativo findOneByUsuEmail(string $usu_email) Return the first UsuarioAdministrativo filtered by the usu_email column
 * @method UsuarioAdministrativo findOneByUsuRut(string $usu_rut) Return the first UsuarioAdministrativo filtered by the usu_rut column
 * @method UsuarioAdministrativo findOneByUsuClave(string $usu_clave) Return the first UsuarioAdministrativo filtered by the usu_clave column
 * @method UsuarioAdministrativo findOneByUsuEstado(int $usu_estado) Return the first UsuarioAdministrativo filtered by the usu_estado column
 * @method UsuarioAdministrativo findOneByUsuEliminado(int $usu_eliminado) Return the first UsuarioAdministrativo filtered by the usu_eliminado column
 * @method UsuarioAdministrativo findOneByCreatedAt(string $created_at) Return the first UsuarioAdministrativo filtered by the created_at column
 * @method UsuarioAdministrativo findOneByUpdatedAt(string $updated_at) Return the first UsuarioAdministrativo filtered by the updated_at column
 *
 * @method array findByUsuId(int $usu_id) Return UsuarioAdministrativo objects filtered by the usu_id column
 * @method array findByCliId(int $cli_id) Return UsuarioAdministrativo objects filtered by the cli_id column
 * @method array findByUsuNombre(string $usu_nombre) Return UsuarioAdministrativo objects filtered by the usu_nombre column
 * @method array findByUsuApellido(string $usu_apellido) Return UsuarioAdministrativo objects filtered by the usu_apellido column
 * @method array findByUsuEmail(string $usu_email) Return UsuarioAdministrativo objects filtered by the usu_email column
 * @method array findByUsuRut(string $usu_rut) Return UsuarioAdministrativo objects filtered by the usu_rut column
 * @method array findByUsuClave(string $usu_clave) Return UsuarioAdministrativo objects filtered by the usu_clave column
 * @method array findByUsuEstado(int $usu_estado) Return UsuarioAdministrativo objects filtered by the usu_estado column
 * @method array findByUsuEliminado(int $usu_eliminado) Return UsuarioAdministrativo objects filtered by the usu_eliminado column
 * @method array findByCreatedAt(string $created_at) Return UsuarioAdministrativo objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return UsuarioAdministrativo objects filtered by the updated_at column
 */
abstract class BaseUsuarioAdministrativoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUsuarioAdministrativoQuery object.
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
            $modelName = 'AppBundle\\Model\\UsuarioAdministrativo';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UsuarioAdministrativoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UsuarioAdministrativoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UsuarioAdministrativoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UsuarioAdministrativoQuery) {
            return $criteria;
        }
        $query = new UsuarioAdministrativoQuery(null, null, $modelAlias);

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
     * @return   UsuarioAdministrativo|UsuarioAdministrativo[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsuarioAdministrativoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UsuarioAdministrativoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 UsuarioAdministrativo A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByUsuId($key, $con = null)
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
     * @return                 UsuarioAdministrativo A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `usu_id`, `cli_id`, `usu_nombre`, `usu_apellido`, `usu_email`, `usu_rut`, `usu_clave`, `usu_estado`, `usu_eliminado`, `created_at`, `updated_at` FROM `usuario_administrativo` WHERE `usu_id` = :p0';
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
            $obj = new UsuarioAdministrativo();
            $obj->hydrate($row);
            UsuarioAdministrativoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return UsuarioAdministrativo|UsuarioAdministrativo[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|UsuarioAdministrativo[]|mixed the list of results, formatted by the current formatter
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
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the usu_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuId(1234); // WHERE usu_id = 1234
     * $query->filterByUsuId(array(12, 34)); // WHERE usu_id IN (12, 34)
     * $query->filterByUsuId(array('min' => 12)); // WHERE usu_id >= 12
     * $query->filterByUsuId(array('max' => 12)); // WHERE usu_id <= 12
     * </code>
     *
     * @param     mixed $usuId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUsuId($usuId = null, $comparison = null)
    {
        if (is_array($usuId)) {
            $useMinMax = false;
            if (isset($usuId['min'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ID, $usuId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuId['max'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ID, $usuId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ID, $usuId, $comparison);
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
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByCliId($cliId = null, $comparison = null)
    {
        if (is_array($cliId)) {
            $useMinMax = false;
            if (isset($cliId['min'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::CLI_ID, $cliId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cliId['max'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::CLI_ID, $cliId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::CLI_ID, $cliId, $comparison);
    }

    /**
     * Filter the query on the usu_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuNombre('fooValue');   // WHERE usu_nombre = 'fooValue'
     * $query->filterByUsuNombre('%fooValue%'); // WHERE usu_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUsuNombre($usuNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuNombre)) {
                $usuNombre = str_replace('*', '%', $usuNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_NOMBRE, $usuNombre, $comparison);
    }

    /**
     * Filter the query on the usu_apellido column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuApellido('fooValue');   // WHERE usu_apellido = 'fooValue'
     * $query->filterByUsuApellido('%fooValue%'); // WHERE usu_apellido LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuApellido The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUsuApellido($usuApellido = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuApellido)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuApellido)) {
                $usuApellido = str_replace('*', '%', $usuApellido);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_APELLIDO, $usuApellido, $comparison);
    }

    /**
     * Filter the query on the usu_email column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuEmail('fooValue');   // WHERE usu_email = 'fooValue'
     * $query->filterByUsuEmail('%fooValue%'); // WHERE usu_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUsuEmail($usuEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuEmail)) {
                $usuEmail = str_replace('*', '%', $usuEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_EMAIL, $usuEmail, $comparison);
    }

    /**
     * Filter the query on the usu_rut column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuRut('fooValue');   // WHERE usu_rut = 'fooValue'
     * $query->filterByUsuRut('%fooValue%'); // WHERE usu_rut LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuRut The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUsuRut($usuRut = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuRut)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuRut)) {
                $usuRut = str_replace('*', '%', $usuRut);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_RUT, $usuRut, $comparison);
    }

    /**
     * Filter the query on the usu_clave column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuClave('fooValue');   // WHERE usu_clave = 'fooValue'
     * $query->filterByUsuClave('%fooValue%'); // WHERE usu_clave LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuClave The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUsuClave($usuClave = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuClave)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuClave)) {
                $usuClave = str_replace('*', '%', $usuClave);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_CLAVE, $usuClave, $comparison);
    }

    /**
     * Filter the query on the usu_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuEstado(1234); // WHERE usu_estado = 1234
     * $query->filterByUsuEstado(array(12, 34)); // WHERE usu_estado IN (12, 34)
     * $query->filterByUsuEstado(array('min' => 12)); // WHERE usu_estado >= 12
     * $query->filterByUsuEstado(array('max' => 12)); // WHERE usu_estado <= 12
     * </code>
     *
     * @param     mixed $usuEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUsuEstado($usuEstado = null, $comparison = null)
    {
        if (is_array($usuEstado)) {
            $useMinMax = false;
            if (isset($usuEstado['min'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ESTADO, $usuEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuEstado['max'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ESTADO, $usuEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ESTADO, $usuEstado, $comparison);
    }

    /**
     * Filter the query on the usu_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuEliminado(1234); // WHERE usu_eliminado = 1234
     * $query->filterByUsuEliminado(array(12, 34)); // WHERE usu_eliminado IN (12, 34)
     * $query->filterByUsuEliminado(array('min' => 12)); // WHERE usu_eliminado >= 12
     * $query->filterByUsuEliminado(array('max' => 12)); // WHERE usu_eliminado <= 12
     * </code>
     *
     * @param     mixed $usuEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUsuEliminado($usuEliminado = null, $comparison = null)
    {
        if (is_array($usuEliminado)) {
            $useMinMax = false;
            if (isset($usuEliminado['min'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ELIMINADO, $usuEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuEliminado['max'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ELIMINADO, $usuEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ELIMINADO, $usuEliminado, $comparison);
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
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsuarioAdministrativoPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioAdministrativoPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Clinica object
     *
     * @param   Clinica|PropelObjectCollection $clinica The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioAdministrativoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByClinica($clinica, $comparison = null)
    {
        if ($clinica instanceof Clinica) {
            return $this
                ->addUsingAlias(UsuarioAdministrativoPeer::CLI_ID, $clinica->getCliId(), $comparison);
        } elseif ($clinica instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuarioAdministrativoPeer::CLI_ID, $clinica->toKeyValue('PrimaryKey', 'CliId'), $comparison);
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
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   UsuarioAdministrativo $usuarioAdministrativo Object to remove from the list of results
     *
     * @return UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function prune($usuarioAdministrativo = null)
    {
        if ($usuarioAdministrativo) {
            $this->addUsingAlias(UsuarioAdministrativoPeer::USU_ID, $usuarioAdministrativo->getUsuId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioAdministrativoPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioAdministrativoPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioAdministrativoPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioAdministrativoPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioAdministrativoPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     UsuarioAdministrativoQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioAdministrativoPeer::CREATED_AT);
    }
}
