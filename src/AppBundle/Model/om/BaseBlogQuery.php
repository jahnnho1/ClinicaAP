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
use AppBundle\Model\BlogPeer;
use AppBundle\Model\BlogQuery;
use AppBundle\Model\Clinica;
use AppBundle\Model\Comentario;
use AppBundle\Model\Recurso;
use AppBundle\Model\TipoPublicacion;

/**
 * @method BlogQuery orderByBloId($order = Criteria::ASC) Order by the blo_id column
 * @method BlogQuery orderByCliId($order = Criteria::ASC) Order by the cli_id column
 * @method BlogQuery orderByTpuId($order = Criteria::ASC) Order by the tpu_id column
 * @method BlogQuery orderByBloTitulo($order = Criteria::ASC) Order by the blo_titulo column
 * @method BlogQuery orderByBloAutor($order = Criteria::ASC) Order by the blo_autor column
 * @method BlogQuery orderByBloBreveDescripcion($order = Criteria::ASC) Order by the blo_breve_descripcion column
 * @method BlogQuery orderByBloDescripcion($order = Criteria::ASC) Order by the blo_descripcion column
 * @method BlogQuery orderByBloEstado($order = Criteria::ASC) Order by the blo_estado column
 * @method BlogQuery orderByBloEliminado($order = Criteria::ASC) Order by the blo_eliminado column
 * @method BlogQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method BlogQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method BlogQuery groupByBloId() Group by the blo_id column
 * @method BlogQuery groupByCliId() Group by the cli_id column
 * @method BlogQuery groupByTpuId() Group by the tpu_id column
 * @method BlogQuery groupByBloTitulo() Group by the blo_titulo column
 * @method BlogQuery groupByBloAutor() Group by the blo_autor column
 * @method BlogQuery groupByBloBreveDescripcion() Group by the blo_breve_descripcion column
 * @method BlogQuery groupByBloDescripcion() Group by the blo_descripcion column
 * @method BlogQuery groupByBloEstado() Group by the blo_estado column
 * @method BlogQuery groupByBloEliminado() Group by the blo_eliminado column
 * @method BlogQuery groupByCreatedAt() Group by the created_at column
 * @method BlogQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method BlogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BlogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BlogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BlogQuery leftJoinClinica($relationAlias = null) Adds a LEFT JOIN clause to the query using the Clinica relation
 * @method BlogQuery rightJoinClinica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Clinica relation
 * @method BlogQuery innerJoinClinica($relationAlias = null) Adds a INNER JOIN clause to the query using the Clinica relation
 *
 * @method BlogQuery leftJoinTipoPublicacion($relationAlias = null) Adds a LEFT JOIN clause to the query using the TipoPublicacion relation
 * @method BlogQuery rightJoinTipoPublicacion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TipoPublicacion relation
 * @method BlogQuery innerJoinTipoPublicacion($relationAlias = null) Adds a INNER JOIN clause to the query using the TipoPublicacion relation
 *
 * @method BlogQuery leftJoinComentario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comentario relation
 * @method BlogQuery rightJoinComentario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comentario relation
 * @method BlogQuery innerJoinComentario($relationAlias = null) Adds a INNER JOIN clause to the query using the Comentario relation
 *
 * @method BlogQuery leftJoinRecurso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recurso relation
 * @method BlogQuery rightJoinRecurso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recurso relation
 * @method BlogQuery innerJoinRecurso($relationAlias = null) Adds a INNER JOIN clause to the query using the Recurso relation
 *
 * @method Blog findOne(PropelPDO $con = null) Return the first Blog matching the query
 * @method Blog findOneOrCreate(PropelPDO $con = null) Return the first Blog matching the query, or a new Blog object populated from the query conditions when no match is found
 *
 * @method Blog findOneByCliId(int $cli_id) Return the first Blog filtered by the cli_id column
 * @method Blog findOneByTpuId(int $tpu_id) Return the first Blog filtered by the tpu_id column
 * @method Blog findOneByBloTitulo(string $blo_titulo) Return the first Blog filtered by the blo_titulo column
 * @method Blog findOneByBloAutor(string $blo_autor) Return the first Blog filtered by the blo_autor column
 * @method Blog findOneByBloBreveDescripcion(string $blo_breve_descripcion) Return the first Blog filtered by the blo_breve_descripcion column
 * @method Blog findOneByBloDescripcion(string $blo_descripcion) Return the first Blog filtered by the blo_descripcion column
 * @method Blog findOneByBloEstado(int $blo_estado) Return the first Blog filtered by the blo_estado column
 * @method Blog findOneByBloEliminado(int $blo_eliminado) Return the first Blog filtered by the blo_eliminado column
 * @method Blog findOneByCreatedAt(string $created_at) Return the first Blog filtered by the created_at column
 * @method Blog findOneByUpdatedAt(string $updated_at) Return the first Blog filtered by the updated_at column
 *
 * @method array findByBloId(int $blo_id) Return Blog objects filtered by the blo_id column
 * @method array findByCliId(int $cli_id) Return Blog objects filtered by the cli_id column
 * @method array findByTpuId(int $tpu_id) Return Blog objects filtered by the tpu_id column
 * @method array findByBloTitulo(string $blo_titulo) Return Blog objects filtered by the blo_titulo column
 * @method array findByBloAutor(string $blo_autor) Return Blog objects filtered by the blo_autor column
 * @method array findByBloBreveDescripcion(string $blo_breve_descripcion) Return Blog objects filtered by the blo_breve_descripcion column
 * @method array findByBloDescripcion(string $blo_descripcion) Return Blog objects filtered by the blo_descripcion column
 * @method array findByBloEstado(int $blo_estado) Return Blog objects filtered by the blo_estado column
 * @method array findByBloEliminado(int $blo_eliminado) Return Blog objects filtered by the blo_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Blog objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Blog objects filtered by the updated_at column
 */
abstract class BaseBlogQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBlogQuery object.
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
            $modelName = 'AppBundle\\Model\\Blog';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BlogQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BlogQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BlogQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BlogQuery) {
            return $criteria;
        }
        $query = new BlogQuery(null, null, $modelAlias);

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
     * @return   Blog|Blog[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BlogPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Blog A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByBloId($key, $con = null)
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
     * @return                 Blog A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `blo_id`, `cli_id`, `tpu_id`, `blo_titulo`, `blo_autor`, `blo_breve_descripcion`, `blo_descripcion`, `blo_estado`, `blo_eliminado`, `created_at`, `updated_at` FROM `blog` WHERE `blo_id` = :p0';
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
            $obj = new Blog();
            $obj->hydrate($row);
            BlogPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Blog|Blog[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Blog[]|mixed the list of results, formatted by the current formatter
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
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BlogPeer::BLO_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BlogPeer::BLO_ID, $keys, Criteria::IN);
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
     * @param     mixed $bloId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByBloId($bloId = null, $comparison = null)
    {
        if (is_array($bloId)) {
            $useMinMax = false;
            if (isset($bloId['min'])) {
                $this->addUsingAlias(BlogPeer::BLO_ID, $bloId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bloId['max'])) {
                $this->addUsingAlias(BlogPeer::BLO_ID, $bloId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BlogPeer::BLO_ID, $bloId, $comparison);
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
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByCliId($cliId = null, $comparison = null)
    {
        if (is_array($cliId)) {
            $useMinMax = false;
            if (isset($cliId['min'])) {
                $this->addUsingAlias(BlogPeer::CLI_ID, $cliId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cliId['max'])) {
                $this->addUsingAlias(BlogPeer::CLI_ID, $cliId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BlogPeer::CLI_ID, $cliId, $comparison);
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
     * @see       filterByTipoPublicacion()
     *
     * @param     mixed $tpuId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByTpuId($tpuId = null, $comparison = null)
    {
        if (is_array($tpuId)) {
            $useMinMax = false;
            if (isset($tpuId['min'])) {
                $this->addUsingAlias(BlogPeer::TPU_ID, $tpuId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpuId['max'])) {
                $this->addUsingAlias(BlogPeer::TPU_ID, $tpuId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BlogPeer::TPU_ID, $tpuId, $comparison);
    }

    /**
     * Filter the query on the blo_titulo column
     *
     * Example usage:
     * <code>
     * $query->filterByBloTitulo('fooValue');   // WHERE blo_titulo = 'fooValue'
     * $query->filterByBloTitulo('%fooValue%'); // WHERE blo_titulo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bloTitulo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByBloTitulo($bloTitulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bloTitulo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bloTitulo)) {
                $bloTitulo = str_replace('*', '%', $bloTitulo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BlogPeer::BLO_TITULO, $bloTitulo, $comparison);
    }

    /**
     * Filter the query on the blo_autor column
     *
     * Example usage:
     * <code>
     * $query->filterByBloAutor('fooValue');   // WHERE blo_autor = 'fooValue'
     * $query->filterByBloAutor('%fooValue%'); // WHERE blo_autor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bloAutor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByBloAutor($bloAutor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bloAutor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bloAutor)) {
                $bloAutor = str_replace('*', '%', $bloAutor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BlogPeer::BLO_AUTOR, $bloAutor, $comparison);
    }

    /**
     * Filter the query on the blo_breve_descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByBloBreveDescripcion('fooValue');   // WHERE blo_breve_descripcion = 'fooValue'
     * $query->filterByBloBreveDescripcion('%fooValue%'); // WHERE blo_breve_descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bloBreveDescripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByBloBreveDescripcion($bloBreveDescripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bloBreveDescripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bloBreveDescripcion)) {
                $bloBreveDescripcion = str_replace('*', '%', $bloBreveDescripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BlogPeer::BLO_BREVE_DESCRIPCION, $bloBreveDescripcion, $comparison);
    }

    /**
     * Filter the query on the blo_descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByBloDescripcion('fooValue');   // WHERE blo_descripcion = 'fooValue'
     * $query->filterByBloDescripcion('%fooValue%'); // WHERE blo_descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bloDescripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByBloDescripcion($bloDescripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bloDescripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bloDescripcion)) {
                $bloDescripcion = str_replace('*', '%', $bloDescripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BlogPeer::BLO_DESCRIPCION, $bloDescripcion, $comparison);
    }

    /**
     * Filter the query on the blo_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByBloEstado(1234); // WHERE blo_estado = 1234
     * $query->filterByBloEstado(array(12, 34)); // WHERE blo_estado IN (12, 34)
     * $query->filterByBloEstado(array('min' => 12)); // WHERE blo_estado >= 12
     * $query->filterByBloEstado(array('max' => 12)); // WHERE blo_estado <= 12
     * </code>
     *
     * @param     mixed $bloEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByBloEstado($bloEstado = null, $comparison = null)
    {
        if (is_array($bloEstado)) {
            $useMinMax = false;
            if (isset($bloEstado['min'])) {
                $this->addUsingAlias(BlogPeer::BLO_ESTADO, $bloEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bloEstado['max'])) {
                $this->addUsingAlias(BlogPeer::BLO_ESTADO, $bloEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BlogPeer::BLO_ESTADO, $bloEstado, $comparison);
    }

    /**
     * Filter the query on the blo_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByBloEliminado(1234); // WHERE blo_eliminado = 1234
     * $query->filterByBloEliminado(array(12, 34)); // WHERE blo_eliminado IN (12, 34)
     * $query->filterByBloEliminado(array('min' => 12)); // WHERE blo_eliminado >= 12
     * $query->filterByBloEliminado(array('max' => 12)); // WHERE blo_eliminado <= 12
     * </code>
     *
     * @param     mixed $bloEliminado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByBloEliminado($bloEliminado = null, $comparison = null)
    {
        if (is_array($bloEliminado)) {
            $useMinMax = false;
            if (isset($bloEliminado['min'])) {
                $this->addUsingAlias(BlogPeer::BLO_ELIMINADO, $bloEliminado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bloEliminado['max'])) {
                $this->addUsingAlias(BlogPeer::BLO_ELIMINADO, $bloEliminado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BlogPeer::BLO_ELIMINADO, $bloEliminado, $comparison);
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
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(BlogPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BlogPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BlogPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return BlogQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(BlogPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BlogPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BlogPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Clinica object
     *
     * @param   Clinica|PropelObjectCollection $clinica The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BlogQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByClinica($clinica, $comparison = null)
    {
        if ($clinica instanceof Clinica) {
            return $this
                ->addUsingAlias(BlogPeer::CLI_ID, $clinica->getCliId(), $comparison);
        } elseif ($clinica instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BlogPeer::CLI_ID, $clinica->toKeyValue('PrimaryKey', 'CliId'), $comparison);
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
     * @return BlogQuery The current query, for fluid interface
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
     * Filter the query by a related TipoPublicacion object
     *
     * @param   TipoPublicacion|PropelObjectCollection $tipoPublicacion The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BlogQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTipoPublicacion($tipoPublicacion, $comparison = null)
    {
        if ($tipoPublicacion instanceof TipoPublicacion) {
            return $this
                ->addUsingAlias(BlogPeer::TPU_ID, $tipoPublicacion->getTpuId(), $comparison);
        } elseif ($tipoPublicacion instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BlogPeer::TPU_ID, $tipoPublicacion->toKeyValue('PrimaryKey', 'TpuId'), $comparison);
        } else {
            throw new PropelException('filterByTipoPublicacion() only accepts arguments of type TipoPublicacion or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TipoPublicacion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function joinTipoPublicacion($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TipoPublicacion');

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
            $this->addJoinObject($join, 'TipoPublicacion');
        }

        return $this;
    }

    /**
     * Use the TipoPublicacion relation TipoPublicacion object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\TipoPublicacionQuery A secondary query class using the current class as primary query
     */
    public function useTipoPublicacionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTipoPublicacion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TipoPublicacion', '\AppBundle\Model\TipoPublicacionQuery');
    }

    /**
     * Filter the query by a related Comentario object
     *
     * @param   Comentario|PropelObjectCollection $comentario  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BlogQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByComentario($comentario, $comparison = null)
    {
        if ($comentario instanceof Comentario) {
            return $this
                ->addUsingAlias(BlogPeer::BLO_ID, $comentario->getBloId(), $comparison);
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
     * @return BlogQuery The current query, for fluid interface
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
     * Filter the query by a related Recurso object
     *
     * @param   Recurso|PropelObjectCollection $recurso  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BlogQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRecurso($recurso, $comparison = null)
    {
        if ($recurso instanceof Recurso) {
            return $this
                ->addUsingAlias(BlogPeer::BLO_ID, $recurso->getBloId(), $comparison);
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
     * @return BlogQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Blog $blog Object to remove from the list of results
     *
     * @return BlogQuery The current query, for fluid interface
     */
    public function prune($blog = null)
    {
        if ($blog) {
            $this->addUsingAlias(BlogPeer::BLO_ID, $blog->getBloId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     BlogQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(BlogPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     BlogQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(BlogPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     BlogQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(BlogPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     BlogQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(BlogPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     BlogQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(BlogPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     BlogQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(BlogPeer::CREATED_AT);
    }
}
