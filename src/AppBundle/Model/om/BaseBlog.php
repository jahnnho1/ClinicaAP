<?php

namespace AppBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use AppBundle\Model\Blog;
use AppBundle\Model\BlogPeer;
use AppBundle\Model\BlogQuery;
use AppBundle\Model\Clinica;
use AppBundle\Model\ClinicaQuery;
use AppBundle\Model\Comentario;
use AppBundle\Model\ComentarioQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoQuery;
use AppBundle\Model\TipoPublicacion;
use AppBundle\Model\TipoPublicacionQuery;

abstract class BaseBlog extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\BlogPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BlogPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the blo_id field.
     * @var        int
     */
    protected $blo_id;

    /**
     * The value for the cli_id field.
     * @var        int
     */
    protected $cli_id;

    /**
     * The value for the tpu_id field.
     * @var        int
     */
    protected $tpu_id;

    /**
     * The value for the blo_titulo field.
     * @var        string
     */
    protected $blo_titulo;

    /**
     * The value for the blo_autor field.
     * @var        string
     */
    protected $blo_autor;

    /**
     * The value for the blo_breve_descripcion field.
     * @var        string
     */
    protected $blo_breve_descripcion;

    /**
     * The value for the blo_descripcion field.
     * @var        string
     */
    protected $blo_descripcion;

    /**
     * The value for the blo_estado field.
     * @var        int
     */
    protected $blo_estado;

    /**
     * The value for the blo_eliminado field.
     * @var        int
     */
    protected $blo_eliminado;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        Clinica
     */
    protected $aClinica;

    /**
     * @var        TipoPublicacion
     */
    protected $aTipoPublicacion;

    /**
     * @var        PropelObjectCollection|Comentario[] Collection to store aggregation of Comentario objects.
     */
    protected $collComentarios;
    protected $collComentariosPartial;

    /**
     * @var        PropelObjectCollection|Recurso[] Collection to store aggregation of Recurso objects.
     */
    protected $collRecursos;
    protected $collRecursosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $comentariosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $recursosScheduledForDeletion = null;

    /**
     * Get the [blo_id] column value.
     *
     * @return int
     */
    public function getBloId()
    {

        return $this->blo_id;
    }

    /**
     * Get the [cli_id] column value.
     *
     * @return int
     */
    public function getCliId()
    {

        return $this->cli_id;
    }

    /**
     * Get the [tpu_id] column value.
     *
     * @return int
     */
    public function getTpuId()
    {

        return $this->tpu_id;
    }

    /**
     * Get the [blo_titulo] column value.
     *
     * @return string
     */
    public function getBloTitulo()
    {

        return $this->blo_titulo;
    }

    /**
     * Get the [blo_autor] column value.
     *
     * @return string
     */
    public function getBloAutor()
    {

        return $this->blo_autor;
    }

    /**
     * Get the [blo_breve_descripcion] column value.
     *
     * @return string
     */
    public function getBloBreveDescripcion()
    {

        return $this->blo_breve_descripcion;
    }

    /**
     * Get the [blo_descripcion] column value.
     *
     * @return string
     */
    public function getBloDescripcion()
    {

        return $this->blo_descripcion;
    }

    /**
     * Get the [blo_estado] column value.
     *
     * @return int
     */
    public function getBloEstado()
    {

        return $this->blo_estado;
    }

    /**
     * Get the [blo_eliminado] column value.
     *
     * @return int
     */
    public function getBloEliminado()
    {

        return $this->blo_eliminado;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = null)
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = null)
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->updated_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [blo_id] column.
     *
     * @param  int $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setBloId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->blo_id !== $v) {
            $this->blo_id = $v;
            $this->modifiedColumns[] = BlogPeer::BLO_ID;
        }


        return $this;
    } // setBloId()

    /**
     * Set the value of [cli_id] column.
     *
     * @param  int $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setCliId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->cli_id !== $v) {
            $this->cli_id = $v;
            $this->modifiedColumns[] = BlogPeer::CLI_ID;
        }

        if ($this->aClinica !== null && $this->aClinica->getCliId() !== $v) {
            $this->aClinica = null;
        }


        return $this;
    } // setCliId()

    /**
     * Set the value of [tpu_id] column.
     *
     * @param  int $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setTpuId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->tpu_id !== $v) {
            $this->tpu_id = $v;
            $this->modifiedColumns[] = BlogPeer::TPU_ID;
        }

        if ($this->aTipoPublicacion !== null && $this->aTipoPublicacion->getTpuId() !== $v) {
            $this->aTipoPublicacion = null;
        }


        return $this;
    } // setTpuId()

    /**
     * Set the value of [blo_titulo] column.
     *
     * @param  string $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setBloTitulo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->blo_titulo !== $v) {
            $this->blo_titulo = $v;
            $this->modifiedColumns[] = BlogPeer::BLO_TITULO;
        }


        return $this;
    } // setBloTitulo()

    /**
     * Set the value of [blo_autor] column.
     *
     * @param  string $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setBloAutor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->blo_autor !== $v) {
            $this->blo_autor = $v;
            $this->modifiedColumns[] = BlogPeer::BLO_AUTOR;
        }


        return $this;
    } // setBloAutor()

    /**
     * Set the value of [blo_breve_descripcion] column.
     *
     * @param  string $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setBloBreveDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->blo_breve_descripcion !== $v) {
            $this->blo_breve_descripcion = $v;
            $this->modifiedColumns[] = BlogPeer::BLO_BREVE_DESCRIPCION;
        }


        return $this;
    } // setBloBreveDescripcion()

    /**
     * Set the value of [blo_descripcion] column.
     *
     * @param  string $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setBloDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->blo_descripcion !== $v) {
            $this->blo_descripcion = $v;
            $this->modifiedColumns[] = BlogPeer::BLO_DESCRIPCION;
        }


        return $this;
    } // setBloDescripcion()

    /**
     * Set the value of [blo_estado] column.
     *
     * @param  int $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setBloEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->blo_estado !== $v) {
            $this->blo_estado = $v;
            $this->modifiedColumns[] = BlogPeer::BLO_ESTADO;
        }


        return $this;
    } // setBloEstado()

    /**
     * Set the value of [blo_eliminado] column.
     *
     * @param  int $v new value
     * @return Blog The current object (for fluent API support)
     */
    public function setBloEliminado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->blo_eliminado !== $v) {
            $this->blo_eliminado = $v;
            $this->modifiedColumns[] = BlogPeer::BLO_ELIMINADO;
        }


        return $this;
    } // setBloEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Blog The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = BlogPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Blog The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = BlogPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->blo_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->cli_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->tpu_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->blo_titulo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->blo_autor = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->blo_breve_descripcion = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->blo_descripcion = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->blo_estado = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->blo_eliminado = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->created_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->updated_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 11; // 11 = BlogPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Blog object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aClinica !== null && $this->cli_id !== $this->aClinica->getCliId()) {
            $this->aClinica = null;
        }
        if ($this->aTipoPublicacion !== null && $this->tpu_id !== $this->aTipoPublicacion->getTpuId()) {
            $this->aTipoPublicacion = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BlogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BlogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aClinica = null;
            $this->aTipoPublicacion = null;
            $this->collComentarios = null;

            $this->collRecursos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BlogQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BlogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(BlogPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(BlogPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(BlogPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                BlogPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aClinica !== null) {
                if ($this->aClinica->isModified() || $this->aClinica->isNew()) {
                    $affectedRows += $this->aClinica->save($con);
                }
                $this->setClinica($this->aClinica);
            }

            if ($this->aTipoPublicacion !== null) {
                if ($this->aTipoPublicacion->isModified() || $this->aTipoPublicacion->isNew()) {
                    $affectedRows += $this->aTipoPublicacion->save($con);
                }
                $this->setTipoPublicacion($this->aTipoPublicacion);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->comentariosScheduledForDeletion !== null) {
                if (!$this->comentariosScheduledForDeletion->isEmpty()) {
                    foreach ($this->comentariosScheduledForDeletion as $comentario) {
                        // need to save related object because we set the relation to null
                        $comentario->save($con);
                    }
                    $this->comentariosScheduledForDeletion = null;
                }
            }

            if ($this->collComentarios !== null) {
                foreach ($this->collComentarios as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->recursosScheduledForDeletion !== null) {
                if (!$this->recursosScheduledForDeletion->isEmpty()) {
                    foreach ($this->recursosScheduledForDeletion as $recurso) {
                        // need to save related object because we set the relation to null
                        $recurso->save($con);
                    }
                    $this->recursosScheduledForDeletion = null;
                }
            }

            if ($this->collRecursos !== null) {
                foreach ($this->collRecursos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = BlogPeer::BLO_ID;
        if (null !== $this->blo_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BlogPeer::BLO_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BlogPeer::BLO_ID)) {
            $modifiedColumns[':p' . $index++]  = '`blo_id`';
        }
        if ($this->isColumnModified(BlogPeer::CLI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`cli_id`';
        }
        if ($this->isColumnModified(BlogPeer::TPU_ID)) {
            $modifiedColumns[':p' . $index++]  = '`tpu_id`';
        }
        if ($this->isColumnModified(BlogPeer::BLO_TITULO)) {
            $modifiedColumns[':p' . $index++]  = '`blo_titulo`';
        }
        if ($this->isColumnModified(BlogPeer::BLO_AUTOR)) {
            $modifiedColumns[':p' . $index++]  = '`blo_autor`';
        }
        if ($this->isColumnModified(BlogPeer::BLO_BREVE_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = '`blo_breve_descripcion`';
        }
        if ($this->isColumnModified(BlogPeer::BLO_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = '`blo_descripcion`';
        }
        if ($this->isColumnModified(BlogPeer::BLO_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`blo_estado`';
        }
        if ($this->isColumnModified(BlogPeer::BLO_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`blo_eliminado`';
        }
        if ($this->isColumnModified(BlogPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(BlogPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `blog` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`blo_id`':
                        $stmt->bindValue($identifier, $this->blo_id, PDO::PARAM_INT);
                        break;
                    case '`cli_id`':
                        $stmt->bindValue($identifier, $this->cli_id, PDO::PARAM_INT);
                        break;
                    case '`tpu_id`':
                        $stmt->bindValue($identifier, $this->tpu_id, PDO::PARAM_INT);
                        break;
                    case '`blo_titulo`':
                        $stmt->bindValue($identifier, $this->blo_titulo, PDO::PARAM_STR);
                        break;
                    case '`blo_autor`':
                        $stmt->bindValue($identifier, $this->blo_autor, PDO::PARAM_STR);
                        break;
                    case '`blo_breve_descripcion`':
                        $stmt->bindValue($identifier, $this->blo_breve_descripcion, PDO::PARAM_STR);
                        break;
                    case '`blo_descripcion`':
                        $stmt->bindValue($identifier, $this->blo_descripcion, PDO::PARAM_STR);
                        break;
                    case '`blo_estado`':
                        $stmt->bindValue($identifier, $this->blo_estado, PDO::PARAM_INT);
                        break;
                    case '`blo_eliminado`':
                        $stmt->bindValue($identifier, $this->blo_eliminado, PDO::PARAM_INT);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setBloId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aClinica !== null) {
                if (!$this->aClinica->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aClinica->getValidationFailures());
                }
            }

            if ($this->aTipoPublicacion !== null) {
                if (!$this->aTipoPublicacion->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTipoPublicacion->getValidationFailures());
                }
            }


            if (($retval = BlogPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collComentarios !== null) {
                    foreach ($this->collComentarios as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRecursos !== null) {
                    foreach ($this->collRecursos as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = BlogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getBloId();
                break;
            case 1:
                return $this->getCliId();
                break;
            case 2:
                return $this->getTpuId();
                break;
            case 3:
                return $this->getBloTitulo();
                break;
            case 4:
                return $this->getBloAutor();
                break;
            case 5:
                return $this->getBloBreveDescripcion();
                break;
            case 6:
                return $this->getBloDescripcion();
                break;
            case 7:
                return $this->getBloEstado();
                break;
            case 8:
                return $this->getBloEliminado();
                break;
            case 9:
                return $this->getCreatedAt();
                break;
            case 10:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Blog'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Blog'][$this->getPrimaryKey()] = true;
        $keys = BlogPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getBloId(),
            $keys[1] => $this->getCliId(),
            $keys[2] => $this->getTpuId(),
            $keys[3] => $this->getBloTitulo(),
            $keys[4] => $this->getBloAutor(),
            $keys[5] => $this->getBloBreveDescripcion(),
            $keys[6] => $this->getBloDescripcion(),
            $keys[7] => $this->getBloEstado(),
            $keys[8] => $this->getBloEliminado(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aClinica) {
                $result['Clinica'] = $this->aClinica->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTipoPublicacion) {
                $result['TipoPublicacion'] = $this->aTipoPublicacion->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collComentarios) {
                $result['Comentarios'] = $this->collComentarios->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRecursos) {
                $result['Recursos'] = $this->collRecursos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = BlogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setBloId($value);
                break;
            case 1:
                $this->setCliId($value);
                break;
            case 2:
                $this->setTpuId($value);
                break;
            case 3:
                $this->setBloTitulo($value);
                break;
            case 4:
                $this->setBloAutor($value);
                break;
            case 5:
                $this->setBloBreveDescripcion($value);
                break;
            case 6:
                $this->setBloDescripcion($value);
                break;
            case 7:
                $this->setBloEstado($value);
                break;
            case 8:
                $this->setBloEliminado($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = BlogPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setBloId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCliId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setTpuId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setBloTitulo($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setBloAutor($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setBloBreveDescripcion($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setBloDescripcion($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setBloEstado($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setBloEliminado($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BlogPeer::DATABASE_NAME);

        if ($this->isColumnModified(BlogPeer::BLO_ID)) $criteria->add(BlogPeer::BLO_ID, $this->blo_id);
        if ($this->isColumnModified(BlogPeer::CLI_ID)) $criteria->add(BlogPeer::CLI_ID, $this->cli_id);
        if ($this->isColumnModified(BlogPeer::TPU_ID)) $criteria->add(BlogPeer::TPU_ID, $this->tpu_id);
        if ($this->isColumnModified(BlogPeer::BLO_TITULO)) $criteria->add(BlogPeer::BLO_TITULO, $this->blo_titulo);
        if ($this->isColumnModified(BlogPeer::BLO_AUTOR)) $criteria->add(BlogPeer::BLO_AUTOR, $this->blo_autor);
        if ($this->isColumnModified(BlogPeer::BLO_BREVE_DESCRIPCION)) $criteria->add(BlogPeer::BLO_BREVE_DESCRIPCION, $this->blo_breve_descripcion);
        if ($this->isColumnModified(BlogPeer::BLO_DESCRIPCION)) $criteria->add(BlogPeer::BLO_DESCRIPCION, $this->blo_descripcion);
        if ($this->isColumnModified(BlogPeer::BLO_ESTADO)) $criteria->add(BlogPeer::BLO_ESTADO, $this->blo_estado);
        if ($this->isColumnModified(BlogPeer::BLO_ELIMINADO)) $criteria->add(BlogPeer::BLO_ELIMINADO, $this->blo_eliminado);
        if ($this->isColumnModified(BlogPeer::CREATED_AT)) $criteria->add(BlogPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(BlogPeer::UPDATED_AT)) $criteria->add(BlogPeer::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(BlogPeer::DATABASE_NAME);
        $criteria->add(BlogPeer::BLO_ID, $this->blo_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getBloId();
    }

    /**
     * Generic method to set the primary key (blo_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setBloId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getBloId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Blog (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCliId($this->getCliId());
        $copyObj->setTpuId($this->getTpuId());
        $copyObj->setBloTitulo($this->getBloTitulo());
        $copyObj->setBloAutor($this->getBloAutor());
        $copyObj->setBloBreveDescripcion($this->getBloBreveDescripcion());
        $copyObj->setBloDescripcion($this->getBloDescripcion());
        $copyObj->setBloEstado($this->getBloEstado());
        $copyObj->setBloEliminado($this->getBloEliminado());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getComentarios() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addComentario($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRecursos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRecurso($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBloId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Blog Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return BlogPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BlogPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Clinica object.
     *
     * @param                  Clinica $v
     * @return Blog The current object (for fluent API support)
     * @throws PropelException
     */
    public function setClinica(Clinica $v = null)
    {
        if ($v === null) {
            $this->setCliId(NULL);
        } else {
            $this->setCliId($v->getCliId());
        }

        $this->aClinica = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Clinica object, it will not be re-added.
        if ($v !== null) {
            $v->addBlog($this);
        }


        return $this;
    }


    /**
     * Get the associated Clinica object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Clinica The associated Clinica object.
     * @throws PropelException
     */
    public function getClinica(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aClinica === null && ($this->cli_id !== null) && $doQuery) {
            $this->aClinica = ClinicaQuery::create()->findPk($this->cli_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aClinica->addBlogs($this);
             */
        }

        return $this->aClinica;
    }

    /**
     * Declares an association between this object and a TipoPublicacion object.
     *
     * @param                  TipoPublicacion $v
     * @return Blog The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTipoPublicacion(TipoPublicacion $v = null)
    {
        if ($v === null) {
            $this->setTpuId(NULL);
        } else {
            $this->setTpuId($v->getTpuId());
        }

        $this->aTipoPublicacion = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TipoPublicacion object, it will not be re-added.
        if ($v !== null) {
            $v->addBlog($this);
        }


        return $this;
    }


    /**
     * Get the associated TipoPublicacion object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return TipoPublicacion The associated TipoPublicacion object.
     * @throws PropelException
     */
    public function getTipoPublicacion(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTipoPublicacion === null && ($this->tpu_id !== null) && $doQuery) {
            $this->aTipoPublicacion = TipoPublicacionQuery::create()->findPk($this->tpu_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTipoPublicacion->addBlogs($this);
             */
        }

        return $this->aTipoPublicacion;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Comentario' == $relationName) {
            $this->initComentarios();
        }
        if ('Recurso' == $relationName) {
            $this->initRecursos();
        }
    }

    /**
     * Clears out the collComentarios collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Blog The current object (for fluent API support)
     * @see        addComentarios()
     */
    public function clearComentarios()
    {
        $this->collComentarios = null; // important to set this to null since that means it is uninitialized
        $this->collComentariosPartial = null;

        return $this;
    }

    /**
     * reset is the collComentarios collection loaded partially
     *
     * @return void
     */
    public function resetPartialComentarios($v = true)
    {
        $this->collComentariosPartial = $v;
    }

    /**
     * Initializes the collComentarios collection.
     *
     * By default this just sets the collComentarios collection to an empty array (like clearcollComentarios());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initComentarios($overrideExisting = true)
    {
        if (null !== $this->collComentarios && !$overrideExisting) {
            return;
        }
        $this->collComentarios = new PropelObjectCollection();
        $this->collComentarios->setModel('Comentario');
    }

    /**
     * Gets an array of Comentario objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Blog is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Comentario[] List of Comentario objects
     * @throws PropelException
     */
    public function getComentarios($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collComentariosPartial && !$this->isNew();
        if (null === $this->collComentarios || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collComentarios) {
                // return empty collection
                $this->initComentarios();
            } else {
                $collComentarios = ComentarioQuery::create(null, $criteria)
                    ->filterByBlog($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collComentariosPartial && count($collComentarios)) {
                      $this->initComentarios(false);

                      foreach ($collComentarios as $obj) {
                        if (false == $this->collComentarios->contains($obj)) {
                          $this->collComentarios->append($obj);
                        }
                      }

                      $this->collComentariosPartial = true;
                    }

                    $collComentarios->getInternalIterator()->rewind();

                    return $collComentarios;
                }

                if ($partial && $this->collComentarios) {
                    foreach ($this->collComentarios as $obj) {
                        if ($obj->isNew()) {
                            $collComentarios[] = $obj;
                        }
                    }
                }

                $this->collComentarios = $collComentarios;
                $this->collComentariosPartial = false;
            }
        }

        return $this->collComentarios;
    }

    /**
     * Sets a collection of Comentario objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $comentarios A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Blog The current object (for fluent API support)
     */
    public function setComentarios(PropelCollection $comentarios, PropelPDO $con = null)
    {
        $comentariosToDelete = $this->getComentarios(new Criteria(), $con)->diff($comentarios);


        $this->comentariosScheduledForDeletion = $comentariosToDelete;

        foreach ($comentariosToDelete as $comentarioRemoved) {
            $comentarioRemoved->setBlog(null);
        }

        $this->collComentarios = null;
        foreach ($comentarios as $comentario) {
            $this->addComentario($comentario);
        }

        $this->collComentarios = $comentarios;
        $this->collComentariosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Comentario objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Comentario objects.
     * @throws PropelException
     */
    public function countComentarios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collComentariosPartial && !$this->isNew();
        if (null === $this->collComentarios || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collComentarios) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getComentarios());
            }
            $query = ComentarioQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBlog($this)
                ->count($con);
        }

        return count($this->collComentarios);
    }

    /**
     * Method called to associate a Comentario object to this object
     * through the Comentario foreign key attribute.
     *
     * @param    Comentario $l Comentario
     * @return Blog The current object (for fluent API support)
     */
    public function addComentario(Comentario $l)
    {
        if ($this->collComentarios === null) {
            $this->initComentarios();
            $this->collComentariosPartial = true;
        }

        if (!in_array($l, $this->collComentarios->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddComentario($l);

            if ($this->comentariosScheduledForDeletion and $this->comentariosScheduledForDeletion->contains($l)) {
                $this->comentariosScheduledForDeletion->remove($this->comentariosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Comentario $comentario The comentario object to add.
     */
    protected function doAddComentario($comentario)
    {
        $this->collComentarios[]= $comentario;
        $comentario->setBlog($this);
    }

    /**
     * @param	Comentario $comentario The comentario object to remove.
     * @return Blog The current object (for fluent API support)
     */
    public function removeComentario($comentario)
    {
        if ($this->getComentarios()->contains($comentario)) {
            $this->collComentarios->remove($this->collComentarios->search($comentario));
            if (null === $this->comentariosScheduledForDeletion) {
                $this->comentariosScheduledForDeletion = clone $this->collComentarios;
                $this->comentariosScheduledForDeletion->clear();
            }
            $this->comentariosScheduledForDeletion[]= $comentario;
            $comentario->setBlog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Blog is new, it will return
     * an empty collection; or if this Blog has previously
     * been saved, it will retrieve related Comentarios from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Blog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Comentario[] List of Comentario objects
     */
    public function getComentariosJoinUsuarioProfesional($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ComentarioQuery::create(null, $criteria);
        $query->joinWith('UsuarioProfesional', $join_behavior);

        return $this->getComentarios($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Blog is new, it will return
     * an empty collection; or if this Blog has previously
     * been saved, it will retrieve related Comentarios from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Blog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Comentario[] List of Comentario objects
     */
    public function getComentariosJoinUsuarioPadre($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ComentarioQuery::create(null, $criteria);
        $query->joinWith('UsuarioPadre', $join_behavior);

        return $this->getComentarios($query, $con);
    }

    /**
     * Clears out the collRecursos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Blog The current object (for fluent API support)
     * @see        addRecursos()
     */
    public function clearRecursos()
    {
        $this->collRecursos = null; // important to set this to null since that means it is uninitialized
        $this->collRecursosPartial = null;

        return $this;
    }

    /**
     * reset is the collRecursos collection loaded partially
     *
     * @return void
     */
    public function resetPartialRecursos($v = true)
    {
        $this->collRecursosPartial = $v;
    }

    /**
     * Initializes the collRecursos collection.
     *
     * By default this just sets the collRecursos collection to an empty array (like clearcollRecursos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRecursos($overrideExisting = true)
    {
        if (null !== $this->collRecursos && !$overrideExisting) {
            return;
        }
        $this->collRecursos = new PropelObjectCollection();
        $this->collRecursos->setModel('Recurso');
    }

    /**
     * Gets an array of Recurso objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Blog is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     * @throws PropelException
     */
    public function getRecursos($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRecursosPartial && !$this->isNew();
        if (null === $this->collRecursos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRecursos) {
                // return empty collection
                $this->initRecursos();
            } else {
                $collRecursos = RecursoQuery::create(null, $criteria)
                    ->filterByBlog($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRecursosPartial && count($collRecursos)) {
                      $this->initRecursos(false);

                      foreach ($collRecursos as $obj) {
                        if (false == $this->collRecursos->contains($obj)) {
                          $this->collRecursos->append($obj);
                        }
                      }

                      $this->collRecursosPartial = true;
                    }

                    $collRecursos->getInternalIterator()->rewind();

                    return $collRecursos;
                }

                if ($partial && $this->collRecursos) {
                    foreach ($this->collRecursos as $obj) {
                        if ($obj->isNew()) {
                            $collRecursos[] = $obj;
                        }
                    }
                }

                $this->collRecursos = $collRecursos;
                $this->collRecursosPartial = false;
            }
        }

        return $this->collRecursos;
    }

    /**
     * Sets a collection of Recurso objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $recursos A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Blog The current object (for fluent API support)
     */
    public function setRecursos(PropelCollection $recursos, PropelPDO $con = null)
    {
        $recursosToDelete = $this->getRecursos(new Criteria(), $con)->diff($recursos);


        $this->recursosScheduledForDeletion = $recursosToDelete;

        foreach ($recursosToDelete as $recursoRemoved) {
            $recursoRemoved->setBlog(null);
        }

        $this->collRecursos = null;
        foreach ($recursos as $recurso) {
            $this->addRecurso($recurso);
        }

        $this->collRecursos = $recursos;
        $this->collRecursosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Recurso objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Recurso objects.
     * @throws PropelException
     */
    public function countRecursos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRecursosPartial && !$this->isNew();
        if (null === $this->collRecursos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRecursos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRecursos());
            }
            $query = RecursoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBlog($this)
                ->count($con);
        }

        return count($this->collRecursos);
    }

    /**
     * Method called to associate a Recurso object to this object
     * through the Recurso foreign key attribute.
     *
     * @param    Recurso $l Recurso
     * @return Blog The current object (for fluent API support)
     */
    public function addRecurso(Recurso $l)
    {
        if ($this->collRecursos === null) {
            $this->initRecursos();
            $this->collRecursosPartial = true;
        }

        if (!in_array($l, $this->collRecursos->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRecurso($l);

            if ($this->recursosScheduledForDeletion and $this->recursosScheduledForDeletion->contains($l)) {
                $this->recursosScheduledForDeletion->remove($this->recursosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Recurso $recurso The recurso object to add.
     */
    protected function doAddRecurso($recurso)
    {
        $this->collRecursos[]= $recurso;
        $recurso->setBlog($this);
    }

    /**
     * @param	Recurso $recurso The recurso object to remove.
     * @return Blog The current object (for fluent API support)
     */
    public function removeRecurso($recurso)
    {
        if ($this->getRecursos()->contains($recurso)) {
            $this->collRecursos->remove($this->collRecursos->search($recurso));
            if (null === $this->recursosScheduledForDeletion) {
                $this->recursosScheduledForDeletion = clone $this->collRecursos;
                $this->recursosScheduledForDeletion->clear();
            }
            $this->recursosScheduledForDeletion[]= $recurso;
            $recurso->setBlog(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Blog is new, it will return
     * an empty collection; or if this Blog has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Blog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     */
    public function getRecursosJoinClinica($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RecursoQuery::create(null, $criteria);
        $query->joinWith('Clinica', $join_behavior);

        return $this->getRecursos($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Blog is new, it will return
     * an empty collection; or if this Blog has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Blog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     */
    public function getRecursosJoinPaciente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RecursoQuery::create(null, $criteria);
        $query->joinWith('Paciente', $join_behavior);

        return $this->getRecursos($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Blog is new, it will return
     * an empty collection; or if this Blog has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Blog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     */
    public function getRecursosJoinUsuarioProfesional($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RecursoQuery::create(null, $criteria);
        $query->joinWith('UsuarioProfesional', $join_behavior);

        return $this->getRecursos($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Blog is new, it will return
     * an empty collection; or if this Blog has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Blog.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     */
    public function getRecursosJoinUsuarioPadre($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RecursoQuery::create(null, $criteria);
        $query->joinWith('UsuarioPadre', $join_behavior);

        return $this->getRecursos($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->blo_id = null;
        $this->cli_id = null;
        $this->tpu_id = null;
        $this->blo_titulo = null;
        $this->blo_autor = null;
        $this->blo_breve_descripcion = null;
        $this->blo_descripcion = null;
        $this->blo_estado = null;
        $this->blo_eliminado = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collComentarios) {
                foreach ($this->collComentarios as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRecursos) {
                foreach ($this->collRecursos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aClinica instanceof Persistent) {
              $this->aClinica->clearAllReferences($deep);
            }
            if ($this->aTipoPublicacion instanceof Persistent) {
              $this->aTipoPublicacion->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collComentarios instanceof PropelCollection) {
            $this->collComentarios->clearIterator();
        }
        $this->collComentarios = null;
        if ($this->collRecursos instanceof PropelCollection) {
            $this->collRecursos->clearIterator();
        }
        $this->collRecursos = null;
        $this->aClinica = null;
        $this->aTipoPublicacion = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BlogPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Blog The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = BlogPeer::UPDATED_AT;

        return $this;
    }

}
