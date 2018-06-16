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
use AppBundle\Model\BlogQuery;
use AppBundle\Model\Clinica;
use AppBundle\Model\ClinicaPeer;
use AppBundle\Model\ClinicaQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoQuery;
use AppBundle\Model\UsuarioAdministrativo;
use AppBundle\Model\UsuarioAdministrativoQuery;
use AppBundle\Model\UsuarioProfesional;
use AppBundle\Model\UsuarioProfesionalQuery;

abstract class BaseClinica extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\ClinicaPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ClinicaPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the cli_id field.
     * @var        int
     */
    protected $cli_id;

    /**
     * The value for the cli_nombre field.
     * @var        string
     */
    protected $cli_nombre;

    /**
     * The value for the cli_numero_mesa_central field.
     * @var        string
     */
    protected $cli_numero_mesa_central;

    /**
     * The value for the cli_numero_rescate field.
     * @var        string
     */
    protected $cli_numero_rescate;

    /**
     * The value for the cli_direccion field.
     * @var        string
     */
    protected $cli_direccion;

    /**
     * The value for the cli_estado field.
     * @var        int
     */
    protected $cli_estado;

    /**
     * The value for the cli_eliminado field.
     * @var        int
     */
    protected $cli_eliminado;

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
     * @var        PropelObjectCollection|Blog[] Collection to store aggregation of Blog objects.
     */
    protected $collBlogs;
    protected $collBlogsPartial;

    /**
     * @var        PropelObjectCollection|Recurso[] Collection to store aggregation of Recurso objects.
     */
    protected $collRecursos;
    protected $collRecursosPartial;

    /**
     * @var        PropelObjectCollection|UsuarioAdministrativo[] Collection to store aggregation of UsuarioAdministrativo objects.
     */
    protected $collUsuarioAdministrativos;
    protected $collUsuarioAdministrativosPartial;

    /**
     * @var        PropelObjectCollection|UsuarioProfesional[] Collection to store aggregation of UsuarioProfesional objects.
     */
    protected $collUsuarioProfesionals;
    protected $collUsuarioProfesionalsPartial;

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
    protected $blogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $recursosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usuarioAdministrativosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usuarioProfesionalsScheduledForDeletion = null;

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
     * Get the [cli_nombre] column value.
     *
     * @return string
     */
    public function getCliNombre()
    {

        return $this->cli_nombre;
    }

    /**
     * Get the [cli_numero_mesa_central] column value.
     *
     * @return string
     */
    public function getCliNumeroMesaCentral()
    {

        return $this->cli_numero_mesa_central;
    }

    /**
     * Get the [cli_numero_rescate] column value.
     *
     * @return string
     */
    public function getCliNumeroRescate()
    {

        return $this->cli_numero_rescate;
    }

    /**
     * Get the [cli_direccion] column value.
     *
     * @return string
     */
    public function getCliDireccion()
    {

        return $this->cli_direccion;
    }

    /**
     * Get the [cli_estado] column value.
     *
     * @return int
     */
    public function getCliEstado()
    {

        return $this->cli_estado;
    }

    /**
     * Get the [cli_eliminado] column value.
     *
     * @return int
     */
    public function getCliEliminado()
    {

        return $this->cli_eliminado;
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
     * Set the value of [cli_id] column.
     *
     * @param  int $v new value
     * @return Clinica The current object (for fluent API support)
     */
    public function setCliId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->cli_id !== $v) {
            $this->cli_id = $v;
            $this->modifiedColumns[] = ClinicaPeer::CLI_ID;
        }


        return $this;
    } // setCliId()

    /**
     * Set the value of [cli_nombre] column.
     *
     * @param  string $v new value
     * @return Clinica The current object (for fluent API support)
     */
    public function setCliNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cli_nombre !== $v) {
            $this->cli_nombre = $v;
            $this->modifiedColumns[] = ClinicaPeer::CLI_NOMBRE;
        }


        return $this;
    } // setCliNombre()

    /**
     * Set the value of [cli_numero_mesa_central] column.
     *
     * @param  string $v new value
     * @return Clinica The current object (for fluent API support)
     */
    public function setCliNumeroMesaCentral($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cli_numero_mesa_central !== $v) {
            $this->cli_numero_mesa_central = $v;
            $this->modifiedColumns[] = ClinicaPeer::CLI_NUMERO_MESA_CENTRAL;
        }


        return $this;
    } // setCliNumeroMesaCentral()

    /**
     * Set the value of [cli_numero_rescate] column.
     *
     * @param  string $v new value
     * @return Clinica The current object (for fluent API support)
     */
    public function setCliNumeroRescate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cli_numero_rescate !== $v) {
            $this->cli_numero_rescate = $v;
            $this->modifiedColumns[] = ClinicaPeer::CLI_NUMERO_RESCATE;
        }


        return $this;
    } // setCliNumeroRescate()

    /**
     * Set the value of [cli_direccion] column.
     *
     * @param  string $v new value
     * @return Clinica The current object (for fluent API support)
     */
    public function setCliDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cli_direccion !== $v) {
            $this->cli_direccion = $v;
            $this->modifiedColumns[] = ClinicaPeer::CLI_DIRECCION;
        }


        return $this;
    } // setCliDireccion()

    /**
     * Set the value of [cli_estado] column.
     *
     * @param  int $v new value
     * @return Clinica The current object (for fluent API support)
     */
    public function setCliEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->cli_estado !== $v) {
            $this->cli_estado = $v;
            $this->modifiedColumns[] = ClinicaPeer::CLI_ESTADO;
        }


        return $this;
    } // setCliEstado()

    /**
     * Set the value of [cli_eliminado] column.
     *
     * @param  int $v new value
     * @return Clinica The current object (for fluent API support)
     */
    public function setCliEliminado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->cli_eliminado !== $v) {
            $this->cli_eliminado = $v;
            $this->modifiedColumns[] = ClinicaPeer::CLI_ELIMINADO;
        }


        return $this;
    } // setCliEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Clinica The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = ClinicaPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Clinica The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = ClinicaPeer::UPDATED_AT;
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

            $this->cli_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->cli_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->cli_numero_mesa_central = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->cli_numero_rescate = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->cli_direccion = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->cli_estado = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->cli_eliminado = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->created_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 9; // 9 = ClinicaPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Clinica object", $e);
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
            $con = Propel::getConnection(ClinicaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ClinicaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBlogs = null;

            $this->collRecursos = null;

            $this->collUsuarioAdministrativos = null;

            $this->collUsuarioProfesionals = null;

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
            $con = Propel::getConnection(ClinicaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ClinicaQuery::create()
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
            $con = Propel::getConnection(ClinicaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(ClinicaPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(ClinicaPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(ClinicaPeer::UPDATED_AT)) {
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
                ClinicaPeer::addInstanceToPool($this);
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

            if ($this->blogsScheduledForDeletion !== null) {
                if (!$this->blogsScheduledForDeletion->isEmpty()) {
                    foreach ($this->blogsScheduledForDeletion as $blog) {
                        // need to save related object because we set the relation to null
                        $blog->save($con);
                    }
                    $this->blogsScheduledForDeletion = null;
                }
            }

            if ($this->collBlogs !== null) {
                foreach ($this->collBlogs as $referrerFK) {
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

            if ($this->usuarioAdministrativosScheduledForDeletion !== null) {
                if (!$this->usuarioAdministrativosScheduledForDeletion->isEmpty()) {
                    foreach ($this->usuarioAdministrativosScheduledForDeletion as $usuarioAdministrativo) {
                        // need to save related object because we set the relation to null
                        $usuarioAdministrativo->save($con);
                    }
                    $this->usuarioAdministrativosScheduledForDeletion = null;
                }
            }

            if ($this->collUsuarioAdministrativos !== null) {
                foreach ($this->collUsuarioAdministrativos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usuarioProfesionalsScheduledForDeletion !== null) {
                if (!$this->usuarioProfesionalsScheduledForDeletion->isEmpty()) {
                    foreach ($this->usuarioProfesionalsScheduledForDeletion as $usuarioProfesional) {
                        // need to save related object because we set the relation to null
                        $usuarioProfesional->save($con);
                    }
                    $this->usuarioProfesionalsScheduledForDeletion = null;
                }
            }

            if ($this->collUsuarioProfesionals !== null) {
                foreach ($this->collUsuarioProfesionals as $referrerFK) {
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

        $this->modifiedColumns[] = ClinicaPeer::CLI_ID;
        if (null !== $this->cli_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ClinicaPeer::CLI_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ClinicaPeer::CLI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`cli_id`';
        }
        if ($this->isColumnModified(ClinicaPeer::CLI_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = '`cli_nombre`';
        }
        if ($this->isColumnModified(ClinicaPeer::CLI_NUMERO_MESA_CENTRAL)) {
            $modifiedColumns[':p' . $index++]  = '`cli_numero_mesa_central`';
        }
        if ($this->isColumnModified(ClinicaPeer::CLI_NUMERO_RESCATE)) {
            $modifiedColumns[':p' . $index++]  = '`cli_numero_rescate`';
        }
        if ($this->isColumnModified(ClinicaPeer::CLI_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = '`cli_direccion`';
        }
        if ($this->isColumnModified(ClinicaPeer::CLI_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`cli_estado`';
        }
        if ($this->isColumnModified(ClinicaPeer::CLI_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`cli_eliminado`';
        }
        if ($this->isColumnModified(ClinicaPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(ClinicaPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `clinica` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`cli_id`':
                        $stmt->bindValue($identifier, $this->cli_id, PDO::PARAM_INT);
                        break;
                    case '`cli_nombre`':
                        $stmt->bindValue($identifier, $this->cli_nombre, PDO::PARAM_STR);
                        break;
                    case '`cli_numero_mesa_central`':
                        $stmt->bindValue($identifier, $this->cli_numero_mesa_central, PDO::PARAM_STR);
                        break;
                    case '`cli_numero_rescate`':
                        $stmt->bindValue($identifier, $this->cli_numero_rescate, PDO::PARAM_STR);
                        break;
                    case '`cli_direccion`':
                        $stmt->bindValue($identifier, $this->cli_direccion, PDO::PARAM_STR);
                        break;
                    case '`cli_estado`':
                        $stmt->bindValue($identifier, $this->cli_estado, PDO::PARAM_INT);
                        break;
                    case '`cli_eliminado`':
                        $stmt->bindValue($identifier, $this->cli_eliminado, PDO::PARAM_INT);
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
        $this->setCliId($pk);

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


            if (($retval = ClinicaPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBlogs !== null) {
                    foreach ($this->collBlogs as $referrerFK) {
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

                if ($this->collUsuarioAdministrativos !== null) {
                    foreach ($this->collUsuarioAdministrativos as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsuarioProfesionals !== null) {
                    foreach ($this->collUsuarioProfesionals as $referrerFK) {
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
        $pos = ClinicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCliId();
                break;
            case 1:
                return $this->getCliNombre();
                break;
            case 2:
                return $this->getCliNumeroMesaCentral();
                break;
            case 3:
                return $this->getCliNumeroRescate();
                break;
            case 4:
                return $this->getCliDireccion();
                break;
            case 5:
                return $this->getCliEstado();
                break;
            case 6:
                return $this->getCliEliminado();
                break;
            case 7:
                return $this->getCreatedAt();
                break;
            case 8:
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
        if (isset($alreadyDumpedObjects['Clinica'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Clinica'][$this->getPrimaryKey()] = true;
        $keys = ClinicaPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCliId(),
            $keys[1] => $this->getCliNombre(),
            $keys[2] => $this->getCliNumeroMesaCentral(),
            $keys[3] => $this->getCliNumeroRescate(),
            $keys[4] => $this->getCliDireccion(),
            $keys[5] => $this->getCliEstado(),
            $keys[6] => $this->getCliEliminado(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collBlogs) {
                $result['Blogs'] = $this->collBlogs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRecursos) {
                $result['Recursos'] = $this->collRecursos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsuarioAdministrativos) {
                $result['UsuarioAdministrativos'] = $this->collUsuarioAdministrativos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsuarioProfesionals) {
                $result['UsuarioProfesionals'] = $this->collUsuarioProfesionals->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ClinicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCliId($value);
                break;
            case 1:
                $this->setCliNombre($value);
                break;
            case 2:
                $this->setCliNumeroMesaCentral($value);
                break;
            case 3:
                $this->setCliNumeroRescate($value);
                break;
            case 4:
                $this->setCliDireccion($value);
                break;
            case 5:
                $this->setCliEstado($value);
                break;
            case 6:
                $this->setCliEliminado($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
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
        $keys = ClinicaPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setCliId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCliNombre($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCliNumeroMesaCentral($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCliNumeroRescate($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCliDireccion($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCliEstado($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCliEliminado($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ClinicaPeer::DATABASE_NAME);

        if ($this->isColumnModified(ClinicaPeer::CLI_ID)) $criteria->add(ClinicaPeer::CLI_ID, $this->cli_id);
        if ($this->isColumnModified(ClinicaPeer::CLI_NOMBRE)) $criteria->add(ClinicaPeer::CLI_NOMBRE, $this->cli_nombre);
        if ($this->isColumnModified(ClinicaPeer::CLI_NUMERO_MESA_CENTRAL)) $criteria->add(ClinicaPeer::CLI_NUMERO_MESA_CENTRAL, $this->cli_numero_mesa_central);
        if ($this->isColumnModified(ClinicaPeer::CLI_NUMERO_RESCATE)) $criteria->add(ClinicaPeer::CLI_NUMERO_RESCATE, $this->cli_numero_rescate);
        if ($this->isColumnModified(ClinicaPeer::CLI_DIRECCION)) $criteria->add(ClinicaPeer::CLI_DIRECCION, $this->cli_direccion);
        if ($this->isColumnModified(ClinicaPeer::CLI_ESTADO)) $criteria->add(ClinicaPeer::CLI_ESTADO, $this->cli_estado);
        if ($this->isColumnModified(ClinicaPeer::CLI_ELIMINADO)) $criteria->add(ClinicaPeer::CLI_ELIMINADO, $this->cli_eliminado);
        if ($this->isColumnModified(ClinicaPeer::CREATED_AT)) $criteria->add(ClinicaPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(ClinicaPeer::UPDATED_AT)) $criteria->add(ClinicaPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(ClinicaPeer::DATABASE_NAME);
        $criteria->add(ClinicaPeer::CLI_ID, $this->cli_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getCliId();
    }

    /**
     * Generic method to set the primary key (cli_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCliId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getCliId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Clinica (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCliNombre($this->getCliNombre());
        $copyObj->setCliNumeroMesaCentral($this->getCliNumeroMesaCentral());
        $copyObj->setCliNumeroRescate($this->getCliNumeroRescate());
        $copyObj->setCliDireccion($this->getCliDireccion());
        $copyObj->setCliEstado($this->getCliEstado());
        $copyObj->setCliEliminado($this->getCliEliminado());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getBlogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBlog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRecursos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRecurso($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsuarioAdministrativos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuarioAdministrativo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsuarioProfesionals() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuarioProfesional($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCliId(NULL); // this is a auto-increment column, so set to default value
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
     * @return Clinica Clone of current object.
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
     * @return ClinicaPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ClinicaPeer();
        }

        return self::$peer;
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
        if ('Blog' == $relationName) {
            $this->initBlogs();
        }
        if ('Recurso' == $relationName) {
            $this->initRecursos();
        }
        if ('UsuarioAdministrativo' == $relationName) {
            $this->initUsuarioAdministrativos();
        }
        if ('UsuarioProfesional' == $relationName) {
            $this->initUsuarioProfesionals();
        }
    }

    /**
     * Clears out the collBlogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Clinica The current object (for fluent API support)
     * @see        addBlogs()
     */
    public function clearBlogs()
    {
        $this->collBlogs = null; // important to set this to null since that means it is uninitialized
        $this->collBlogsPartial = null;

        return $this;
    }

    /**
     * reset is the collBlogs collection loaded partially
     *
     * @return void
     */
    public function resetPartialBlogs($v = true)
    {
        $this->collBlogsPartial = $v;
    }

    /**
     * Initializes the collBlogs collection.
     *
     * By default this just sets the collBlogs collection to an empty array (like clearcollBlogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBlogs($overrideExisting = true)
    {
        if (null !== $this->collBlogs && !$overrideExisting) {
            return;
        }
        $this->collBlogs = new PropelObjectCollection();
        $this->collBlogs->setModel('Blog');
    }

    /**
     * Gets an array of Blog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Clinica is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Blog[] List of Blog objects
     * @throws PropelException
     */
    public function getBlogs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBlogsPartial && !$this->isNew();
        if (null === $this->collBlogs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBlogs) {
                // return empty collection
                $this->initBlogs();
            } else {
                $collBlogs = BlogQuery::create(null, $criteria)
                    ->filterByClinica($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBlogsPartial && count($collBlogs)) {
                      $this->initBlogs(false);

                      foreach ($collBlogs as $obj) {
                        if (false == $this->collBlogs->contains($obj)) {
                          $this->collBlogs->append($obj);
                        }
                      }

                      $this->collBlogsPartial = true;
                    }

                    $collBlogs->getInternalIterator()->rewind();

                    return $collBlogs;
                }

                if ($partial && $this->collBlogs) {
                    foreach ($this->collBlogs as $obj) {
                        if ($obj->isNew()) {
                            $collBlogs[] = $obj;
                        }
                    }
                }

                $this->collBlogs = $collBlogs;
                $this->collBlogsPartial = false;
            }
        }

        return $this->collBlogs;
    }

    /**
     * Sets a collection of Blog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $blogs A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Clinica The current object (for fluent API support)
     */
    public function setBlogs(PropelCollection $blogs, PropelPDO $con = null)
    {
        $blogsToDelete = $this->getBlogs(new Criteria(), $con)->diff($blogs);


        $this->blogsScheduledForDeletion = $blogsToDelete;

        foreach ($blogsToDelete as $blogRemoved) {
            $blogRemoved->setClinica(null);
        }

        $this->collBlogs = null;
        foreach ($blogs as $blog) {
            $this->addBlog($blog);
        }

        $this->collBlogs = $blogs;
        $this->collBlogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Blog objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Blog objects.
     * @throws PropelException
     */
    public function countBlogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBlogsPartial && !$this->isNew();
        if (null === $this->collBlogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBlogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBlogs());
            }
            $query = BlogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByClinica($this)
                ->count($con);
        }

        return count($this->collBlogs);
    }

    /**
     * Method called to associate a Blog object to this object
     * through the Blog foreign key attribute.
     *
     * @param    Blog $l Blog
     * @return Clinica The current object (for fluent API support)
     */
    public function addBlog(Blog $l)
    {
        if ($this->collBlogs === null) {
            $this->initBlogs();
            $this->collBlogsPartial = true;
        }

        if (!in_array($l, $this->collBlogs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBlog($l);

            if ($this->blogsScheduledForDeletion and $this->blogsScheduledForDeletion->contains($l)) {
                $this->blogsScheduledForDeletion->remove($this->blogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Blog $blog The blog object to add.
     */
    protected function doAddBlog($blog)
    {
        $this->collBlogs[]= $blog;
        $blog->setClinica($this);
    }

    /**
     * @param	Blog $blog The blog object to remove.
     * @return Clinica The current object (for fluent API support)
     */
    public function removeBlog($blog)
    {
        if ($this->getBlogs()->contains($blog)) {
            $this->collBlogs->remove($this->collBlogs->search($blog));
            if (null === $this->blogsScheduledForDeletion) {
                $this->blogsScheduledForDeletion = clone $this->collBlogs;
                $this->blogsScheduledForDeletion->clear();
            }
            $this->blogsScheduledForDeletion[]= $blog;
            $blog->setClinica(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Clinica is new, it will return
     * an empty collection; or if this Clinica has previously
     * been saved, it will retrieve related Blogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Clinica.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Blog[] List of Blog objects
     */
    public function getBlogsJoinTipoPublicacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BlogQuery::create(null, $criteria);
        $query->joinWith('TipoPublicacion', $join_behavior);

        return $this->getBlogs($query, $con);
    }

    /**
     * Clears out the collRecursos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Clinica The current object (for fluent API support)
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
     * If this Clinica is new, it will return
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
                    ->filterByClinica($this)
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
     * @return Clinica The current object (for fluent API support)
     */
    public function setRecursos(PropelCollection $recursos, PropelPDO $con = null)
    {
        $recursosToDelete = $this->getRecursos(new Criteria(), $con)->diff($recursos);


        $this->recursosScheduledForDeletion = $recursosToDelete;

        foreach ($recursosToDelete as $recursoRemoved) {
            $recursoRemoved->setClinica(null);
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
                ->filterByClinica($this)
                ->count($con);
        }

        return count($this->collRecursos);
    }

    /**
     * Method called to associate a Recurso object to this object
     * through the Recurso foreign key attribute.
     *
     * @param    Recurso $l Recurso
     * @return Clinica The current object (for fluent API support)
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
        $recurso->setClinica($this);
    }

    /**
     * @param	Recurso $recurso The recurso object to remove.
     * @return Clinica The current object (for fluent API support)
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
            $recurso->setClinica(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Clinica is new, it will return
     * an empty collection; or if this Clinica has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Clinica.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     */
    public function getRecursosJoinBlog($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RecursoQuery::create(null, $criteria);
        $query->joinWith('Blog', $join_behavior);

        return $this->getRecursos($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Clinica is new, it will return
     * an empty collection; or if this Clinica has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Clinica.
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
     * Otherwise if this Clinica is new, it will return
     * an empty collection; or if this Clinica has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Clinica.
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
     * Otherwise if this Clinica is new, it will return
     * an empty collection; or if this Clinica has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Clinica.
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
     * Clears out the collUsuarioAdministrativos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Clinica The current object (for fluent API support)
     * @see        addUsuarioAdministrativos()
     */
    public function clearUsuarioAdministrativos()
    {
        $this->collUsuarioAdministrativos = null; // important to set this to null since that means it is uninitialized
        $this->collUsuarioAdministrativosPartial = null;

        return $this;
    }

    /**
     * reset is the collUsuarioAdministrativos collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsuarioAdministrativos($v = true)
    {
        $this->collUsuarioAdministrativosPartial = $v;
    }

    /**
     * Initializes the collUsuarioAdministrativos collection.
     *
     * By default this just sets the collUsuarioAdministrativos collection to an empty array (like clearcollUsuarioAdministrativos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsuarioAdministrativos($overrideExisting = true)
    {
        if (null !== $this->collUsuarioAdministrativos && !$overrideExisting) {
            return;
        }
        $this->collUsuarioAdministrativos = new PropelObjectCollection();
        $this->collUsuarioAdministrativos->setModel('UsuarioAdministrativo');
    }

    /**
     * Gets an array of UsuarioAdministrativo objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Clinica is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UsuarioAdministrativo[] List of UsuarioAdministrativo objects
     * @throws PropelException
     */
    public function getUsuarioAdministrativos($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsuarioAdministrativosPartial && !$this->isNew();
        if (null === $this->collUsuarioAdministrativos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsuarioAdministrativos) {
                // return empty collection
                $this->initUsuarioAdministrativos();
            } else {
                $collUsuarioAdministrativos = UsuarioAdministrativoQuery::create(null, $criteria)
                    ->filterByClinica($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsuarioAdministrativosPartial && count($collUsuarioAdministrativos)) {
                      $this->initUsuarioAdministrativos(false);

                      foreach ($collUsuarioAdministrativos as $obj) {
                        if (false == $this->collUsuarioAdministrativos->contains($obj)) {
                          $this->collUsuarioAdministrativos->append($obj);
                        }
                      }

                      $this->collUsuarioAdministrativosPartial = true;
                    }

                    $collUsuarioAdministrativos->getInternalIterator()->rewind();

                    return $collUsuarioAdministrativos;
                }

                if ($partial && $this->collUsuarioAdministrativos) {
                    foreach ($this->collUsuarioAdministrativos as $obj) {
                        if ($obj->isNew()) {
                            $collUsuarioAdministrativos[] = $obj;
                        }
                    }
                }

                $this->collUsuarioAdministrativos = $collUsuarioAdministrativos;
                $this->collUsuarioAdministrativosPartial = false;
            }
        }

        return $this->collUsuarioAdministrativos;
    }

    /**
     * Sets a collection of UsuarioAdministrativo objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usuarioAdministrativos A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Clinica The current object (for fluent API support)
     */
    public function setUsuarioAdministrativos(PropelCollection $usuarioAdministrativos, PropelPDO $con = null)
    {
        $usuarioAdministrativosToDelete = $this->getUsuarioAdministrativos(new Criteria(), $con)->diff($usuarioAdministrativos);


        $this->usuarioAdministrativosScheduledForDeletion = $usuarioAdministrativosToDelete;

        foreach ($usuarioAdministrativosToDelete as $usuarioAdministrativoRemoved) {
            $usuarioAdministrativoRemoved->setClinica(null);
        }

        $this->collUsuarioAdministrativos = null;
        foreach ($usuarioAdministrativos as $usuarioAdministrativo) {
            $this->addUsuarioAdministrativo($usuarioAdministrativo);
        }

        $this->collUsuarioAdministrativos = $usuarioAdministrativos;
        $this->collUsuarioAdministrativosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UsuarioAdministrativo objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UsuarioAdministrativo objects.
     * @throws PropelException
     */
    public function countUsuarioAdministrativos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsuarioAdministrativosPartial && !$this->isNew();
        if (null === $this->collUsuarioAdministrativos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuarioAdministrativos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsuarioAdministrativos());
            }
            $query = UsuarioAdministrativoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByClinica($this)
                ->count($con);
        }

        return count($this->collUsuarioAdministrativos);
    }

    /**
     * Method called to associate a UsuarioAdministrativo object to this object
     * through the UsuarioAdministrativo foreign key attribute.
     *
     * @param    UsuarioAdministrativo $l UsuarioAdministrativo
     * @return Clinica The current object (for fluent API support)
     */
    public function addUsuarioAdministrativo(UsuarioAdministrativo $l)
    {
        if ($this->collUsuarioAdministrativos === null) {
            $this->initUsuarioAdministrativos();
            $this->collUsuarioAdministrativosPartial = true;
        }

        if (!in_array($l, $this->collUsuarioAdministrativos->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUsuarioAdministrativo($l);

            if ($this->usuarioAdministrativosScheduledForDeletion and $this->usuarioAdministrativosScheduledForDeletion->contains($l)) {
                $this->usuarioAdministrativosScheduledForDeletion->remove($this->usuarioAdministrativosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	UsuarioAdministrativo $usuarioAdministrativo The usuarioAdministrativo object to add.
     */
    protected function doAddUsuarioAdministrativo($usuarioAdministrativo)
    {
        $this->collUsuarioAdministrativos[]= $usuarioAdministrativo;
        $usuarioAdministrativo->setClinica($this);
    }

    /**
     * @param	UsuarioAdministrativo $usuarioAdministrativo The usuarioAdministrativo object to remove.
     * @return Clinica The current object (for fluent API support)
     */
    public function removeUsuarioAdministrativo($usuarioAdministrativo)
    {
        if ($this->getUsuarioAdministrativos()->contains($usuarioAdministrativo)) {
            $this->collUsuarioAdministrativos->remove($this->collUsuarioAdministrativos->search($usuarioAdministrativo));
            if (null === $this->usuarioAdministrativosScheduledForDeletion) {
                $this->usuarioAdministrativosScheduledForDeletion = clone $this->collUsuarioAdministrativos;
                $this->usuarioAdministrativosScheduledForDeletion->clear();
            }
            $this->usuarioAdministrativosScheduledForDeletion[]= $usuarioAdministrativo;
            $usuarioAdministrativo->setClinica(null);
        }

        return $this;
    }

    /**
     * Clears out the collUsuarioProfesionals collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Clinica The current object (for fluent API support)
     * @see        addUsuarioProfesionals()
     */
    public function clearUsuarioProfesionals()
    {
        $this->collUsuarioProfesionals = null; // important to set this to null since that means it is uninitialized
        $this->collUsuarioProfesionalsPartial = null;

        return $this;
    }

    /**
     * reset is the collUsuarioProfesionals collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsuarioProfesionals($v = true)
    {
        $this->collUsuarioProfesionalsPartial = $v;
    }

    /**
     * Initializes the collUsuarioProfesionals collection.
     *
     * By default this just sets the collUsuarioProfesionals collection to an empty array (like clearcollUsuarioProfesionals());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsuarioProfesionals($overrideExisting = true)
    {
        if (null !== $this->collUsuarioProfesionals && !$overrideExisting) {
            return;
        }
        $this->collUsuarioProfesionals = new PropelObjectCollection();
        $this->collUsuarioProfesionals->setModel('UsuarioProfesional');
    }

    /**
     * Gets an array of UsuarioProfesional objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Clinica is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UsuarioProfesional[] List of UsuarioProfesional objects
     * @throws PropelException
     */
    public function getUsuarioProfesionals($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsuarioProfesionalsPartial && !$this->isNew();
        if (null === $this->collUsuarioProfesionals || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsuarioProfesionals) {
                // return empty collection
                $this->initUsuarioProfesionals();
            } else {
                $collUsuarioProfesionals = UsuarioProfesionalQuery::create(null, $criteria)
                    ->filterByClinica($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsuarioProfesionalsPartial && count($collUsuarioProfesionals)) {
                      $this->initUsuarioProfesionals(false);

                      foreach ($collUsuarioProfesionals as $obj) {
                        if (false == $this->collUsuarioProfesionals->contains($obj)) {
                          $this->collUsuarioProfesionals->append($obj);
                        }
                      }

                      $this->collUsuarioProfesionalsPartial = true;
                    }

                    $collUsuarioProfesionals->getInternalIterator()->rewind();

                    return $collUsuarioProfesionals;
                }

                if ($partial && $this->collUsuarioProfesionals) {
                    foreach ($this->collUsuarioProfesionals as $obj) {
                        if ($obj->isNew()) {
                            $collUsuarioProfesionals[] = $obj;
                        }
                    }
                }

                $this->collUsuarioProfesionals = $collUsuarioProfesionals;
                $this->collUsuarioProfesionalsPartial = false;
            }
        }

        return $this->collUsuarioProfesionals;
    }

    /**
     * Sets a collection of UsuarioProfesional objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usuarioProfesionals A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Clinica The current object (for fluent API support)
     */
    public function setUsuarioProfesionals(PropelCollection $usuarioProfesionals, PropelPDO $con = null)
    {
        $usuarioProfesionalsToDelete = $this->getUsuarioProfesionals(new Criteria(), $con)->diff($usuarioProfesionals);


        $this->usuarioProfesionalsScheduledForDeletion = $usuarioProfesionalsToDelete;

        foreach ($usuarioProfesionalsToDelete as $usuarioProfesionalRemoved) {
            $usuarioProfesionalRemoved->setClinica(null);
        }

        $this->collUsuarioProfesionals = null;
        foreach ($usuarioProfesionals as $usuarioProfesional) {
            $this->addUsuarioProfesional($usuarioProfesional);
        }

        $this->collUsuarioProfesionals = $usuarioProfesionals;
        $this->collUsuarioProfesionalsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UsuarioProfesional objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UsuarioProfesional objects.
     * @throws PropelException
     */
    public function countUsuarioProfesionals(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsuarioProfesionalsPartial && !$this->isNew();
        if (null === $this->collUsuarioProfesionals || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuarioProfesionals) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsuarioProfesionals());
            }
            $query = UsuarioProfesionalQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByClinica($this)
                ->count($con);
        }

        return count($this->collUsuarioProfesionals);
    }

    /**
     * Method called to associate a UsuarioProfesional object to this object
     * through the UsuarioProfesional foreign key attribute.
     *
     * @param    UsuarioProfesional $l UsuarioProfesional
     * @return Clinica The current object (for fluent API support)
     */
    public function addUsuarioProfesional(UsuarioProfesional $l)
    {
        if ($this->collUsuarioProfesionals === null) {
            $this->initUsuarioProfesionals();
            $this->collUsuarioProfesionalsPartial = true;
        }

        if (!in_array($l, $this->collUsuarioProfesionals->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUsuarioProfesional($l);

            if ($this->usuarioProfesionalsScheduledForDeletion and $this->usuarioProfesionalsScheduledForDeletion->contains($l)) {
                $this->usuarioProfesionalsScheduledForDeletion->remove($this->usuarioProfesionalsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	UsuarioProfesional $usuarioProfesional The usuarioProfesional object to add.
     */
    protected function doAddUsuarioProfesional($usuarioProfesional)
    {
        $this->collUsuarioProfesionals[]= $usuarioProfesional;
        $usuarioProfesional->setClinica($this);
    }

    /**
     * @param	UsuarioProfesional $usuarioProfesional The usuarioProfesional object to remove.
     * @return Clinica The current object (for fluent API support)
     */
    public function removeUsuarioProfesional($usuarioProfesional)
    {
        if ($this->getUsuarioProfesionals()->contains($usuarioProfesional)) {
            $this->collUsuarioProfesionals->remove($this->collUsuarioProfesionals->search($usuarioProfesional));
            if (null === $this->usuarioProfesionalsScheduledForDeletion) {
                $this->usuarioProfesionalsScheduledForDeletion = clone $this->collUsuarioProfesionals;
                $this->usuarioProfesionalsScheduledForDeletion->clear();
            }
            $this->usuarioProfesionalsScheduledForDeletion[]= $usuarioProfesional;
            $usuarioProfesional->setClinica(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->cli_id = null;
        $this->cli_nombre = null;
        $this->cli_numero_mesa_central = null;
        $this->cli_numero_rescate = null;
        $this->cli_direccion = null;
        $this->cli_estado = null;
        $this->cli_eliminado = null;
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
            if ($this->collBlogs) {
                foreach ($this->collBlogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRecursos) {
                foreach ($this->collRecursos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsuarioAdministrativos) {
                foreach ($this->collUsuarioAdministrativos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsuarioProfesionals) {
                foreach ($this->collUsuarioProfesionals as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collBlogs instanceof PropelCollection) {
            $this->collBlogs->clearIterator();
        }
        $this->collBlogs = null;
        if ($this->collRecursos instanceof PropelCollection) {
            $this->collRecursos->clearIterator();
        }
        $this->collRecursos = null;
        if ($this->collUsuarioAdministrativos instanceof PropelCollection) {
            $this->collUsuarioAdministrativos->clearIterator();
        }
        $this->collUsuarioAdministrativos = null;
        if ($this->collUsuarioProfesionals instanceof PropelCollection) {
            $this->collUsuarioProfesionals->clearIterator();
        }
        $this->collUsuarioProfesionals = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ClinicaPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Clinica The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = ClinicaPeer::UPDATED_AT;

        return $this;
    }

}
