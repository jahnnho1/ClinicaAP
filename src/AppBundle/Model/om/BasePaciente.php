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
use AppBundle\Model\Paciente;
use AppBundle\Model\PacienteFichamedica;
use AppBundle\Model\PacienteFichamedicaQuery;
use AppBundle\Model\PacientePeer;
use AppBundle\Model\PacienteQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoQuery;
use AppBundle\Model\UsuariopadrePaciente;
use AppBundle\Model\UsuariopadrePacienteQuery;

abstract class BasePaciente extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\PacientePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PacientePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the pac_id field.
     * @var        int
     */
    protected $pac_id;

    /**
     * The value for the pac_nombres field.
     * @var        string
     */
    protected $pac_nombres;

    /**
     * The value for the pac_apellidos field.
     * @var        string
     */
    protected $pac_apellidos;

    /**
     * The value for the pac_fecha_nacimiento field.
     * @var        string
     */
    protected $pac_fecha_nacimiento;

    /**
     * The value for the pac_sexo field.
     * @var        int
     */
    protected $pac_sexo;

    /**
     * The value for the pac_rut field.
     * @var        string
     */
    protected $pac_rut;

    /**
     * The value for the pac_documento field.
     * @var        string
     */
    protected $pac_documento;

    /**
     * The value for the pac_estado field.
     * @var        int
     */
    protected $pac_estado;

    /**
     * The value for the pac_eliminado field.
     * @var        int
     */
    protected $pac_eliminado;

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
     * @var        PropelObjectCollection|PacienteFichamedica[] Collection to store aggregation of PacienteFichamedica objects.
     */
    protected $collPacienteFichamedicas;
    protected $collPacienteFichamedicasPartial;

    /**
     * @var        PropelObjectCollection|Recurso[] Collection to store aggregation of Recurso objects.
     */
    protected $collRecursos;
    protected $collRecursosPartial;

    /**
     * @var        PropelObjectCollection|UsuariopadrePaciente[] Collection to store aggregation of UsuariopadrePaciente objects.
     */
    protected $collUsuariopadrePacientes;
    protected $collUsuariopadrePacientesPartial;

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
    protected $pacienteFichamedicasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $recursosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usuariopadrePacientesScheduledForDeletion = null;

    /**
     * Get the [pac_id] column value.
     *
     * @return int
     */
    public function getPacId()
    {

        return $this->pac_id;
    }

    /**
     * Get the [pac_nombres] column value.
     *
     * @return string
     */
    public function getPacNombres()
    {

        return $this->pac_nombres;
    }

    /**
     * Get the [pac_apellidos] column value.
     *
     * @return string
     */
    public function getPacApellidos()
    {

        return $this->pac_apellidos;
    }

    /**
     * Get the [optionally formatted] temporal [pac_fecha_nacimiento] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPacFechaNacimiento($format = null)
    {
        if ($this->pac_fecha_nacimiento === null) {
            return null;
        }

        if ($this->pac_fecha_nacimiento === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->pac_fecha_nacimiento);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->pac_fecha_nacimiento, true), $x);
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
     * Get the [pac_sexo] column value.
     *
     * @return int
     */
    public function getPacSexo()
    {

        return $this->pac_sexo;
    }

    /**
     * Get the [pac_rut] column value.
     *
     * @return string
     */
    public function getPacRut()
    {

        return $this->pac_rut;
    }

    /**
     * Get the [pac_documento] column value.
     *
     * @return string
     */
    public function getPacDocumento()
    {

        return $this->pac_documento;
    }

    /**
     * Get the [pac_estado] column value.
     *
     * @return int
     */
    public function getPacEstado()
    {

        return $this->pac_estado;
    }

    /**
     * Get the [pac_eliminado] column value.
     *
     * @return int
     */
    public function getPacEliminado()
    {

        return $this->pac_eliminado;
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
     * Set the value of [pac_id] column.
     *
     * @param  int $v new value
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pac_id !== $v) {
            $this->pac_id = $v;
            $this->modifiedColumns[] = PacientePeer::PAC_ID;
        }


        return $this;
    } // setPacId()

    /**
     * Set the value of [pac_nombres] column.
     *
     * @param  string $v new value
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacNombres($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pac_nombres !== $v) {
            $this->pac_nombres = $v;
            $this->modifiedColumns[] = PacientePeer::PAC_NOMBRES;
        }


        return $this;
    } // setPacNombres()

    /**
     * Set the value of [pac_apellidos] column.
     *
     * @param  string $v new value
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacApellidos($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pac_apellidos !== $v) {
            $this->pac_apellidos = $v;
            $this->modifiedColumns[] = PacientePeer::PAC_APELLIDOS;
        }


        return $this;
    } // setPacApellidos()

    /**
     * Sets the value of [pac_fecha_nacimiento] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacFechaNacimiento($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->pac_fecha_nacimiento !== null || $dt !== null) {
            $currentDateAsString = ($this->pac_fecha_nacimiento !== null && $tmpDt = new DateTime($this->pac_fecha_nacimiento)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->pac_fecha_nacimiento = $newDateAsString;
                $this->modifiedColumns[] = PacientePeer::PAC_FECHA_NACIMIENTO;
            }
        } // if either are not null


        return $this;
    } // setPacFechaNacimiento()

    /**
     * Set the value of [pac_sexo] column.
     *
     * @param  int $v new value
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacSexo($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pac_sexo !== $v) {
            $this->pac_sexo = $v;
            $this->modifiedColumns[] = PacientePeer::PAC_SEXO;
        }


        return $this;
    } // setPacSexo()

    /**
     * Set the value of [pac_rut] column.
     *
     * @param  string $v new value
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacRut($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pac_rut !== $v) {
            $this->pac_rut = $v;
            $this->modifiedColumns[] = PacientePeer::PAC_RUT;
        }


        return $this;
    } // setPacRut()

    /**
     * Set the value of [pac_documento] column.
     *
     * @param  string $v new value
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacDocumento($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pac_documento !== $v) {
            $this->pac_documento = $v;
            $this->modifiedColumns[] = PacientePeer::PAC_DOCUMENTO;
        }


        return $this;
    } // setPacDocumento()

    /**
     * Set the value of [pac_estado] column.
     *
     * @param  int $v new value
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pac_estado !== $v) {
            $this->pac_estado = $v;
            $this->modifiedColumns[] = PacientePeer::PAC_ESTADO;
        }


        return $this;
    } // setPacEstado()

    /**
     * Set the value of [pac_eliminado] column.
     *
     * @param  int $v new value
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacEliminado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pac_eliminado !== $v) {
            $this->pac_eliminado = $v;
            $this->modifiedColumns[] = PacientePeer::PAC_ELIMINADO;
        }


        return $this;
    } // setPacEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Paciente The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = PacientePeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Paciente The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = PacientePeer::UPDATED_AT;
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

            $this->pac_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->pac_nombres = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->pac_apellidos = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->pac_fecha_nacimiento = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->pac_sexo = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->pac_rut = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->pac_documento = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->pac_estado = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->pac_eliminado = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->created_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->updated_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 11; // 11 = PacientePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Paciente object", $e);
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
            $con = Propel::getConnection(PacientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PacientePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPacienteFichamedicas = null;

            $this->collRecursos = null;

            $this->collUsuariopadrePacientes = null;

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
            $con = Propel::getConnection(PacientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PacienteQuery::create()
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
            $con = Propel::getConnection(PacientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(PacientePeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PacientePeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PacientePeer::UPDATED_AT)) {
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
                PacientePeer::addInstanceToPool($this);
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

            if ($this->pacienteFichamedicasScheduledForDeletion !== null) {
                if (!$this->pacienteFichamedicasScheduledForDeletion->isEmpty()) {
                    PacienteFichamedicaQuery::create()
                        ->filterByPrimaryKeys($this->pacienteFichamedicasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pacienteFichamedicasScheduledForDeletion = null;
                }
            }

            if ($this->collPacienteFichamedicas !== null) {
                foreach ($this->collPacienteFichamedicas as $referrerFK) {
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

            if ($this->usuariopadrePacientesScheduledForDeletion !== null) {
                if (!$this->usuariopadrePacientesScheduledForDeletion->isEmpty()) {
                    UsuariopadrePacienteQuery::create()
                        ->filterByPrimaryKeys($this->usuariopadrePacientesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->usuariopadrePacientesScheduledForDeletion = null;
                }
            }

            if ($this->collUsuariopadrePacientes !== null) {
                foreach ($this->collUsuariopadrePacientes as $referrerFK) {
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

        $this->modifiedColumns[] = PacientePeer::PAC_ID;
        if (null !== $this->pac_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PacientePeer::PAC_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PacientePeer::PAC_ID)) {
            $modifiedColumns[':p' . $index++]  = '`pac_id`';
        }
        if ($this->isColumnModified(PacientePeer::PAC_NOMBRES)) {
            $modifiedColumns[':p' . $index++]  = '`pac_nombres`';
        }
        if ($this->isColumnModified(PacientePeer::PAC_APELLIDOS)) {
            $modifiedColumns[':p' . $index++]  = '`pac_apellidos`';
        }
        if ($this->isColumnModified(PacientePeer::PAC_FECHA_NACIMIENTO)) {
            $modifiedColumns[':p' . $index++]  = '`pac_fecha_nacimiento`';
        }
        if ($this->isColumnModified(PacientePeer::PAC_SEXO)) {
            $modifiedColumns[':p' . $index++]  = '`pac_sexo`';
        }
        if ($this->isColumnModified(PacientePeer::PAC_RUT)) {
            $modifiedColumns[':p' . $index++]  = '`pac_rut`';
        }
        if ($this->isColumnModified(PacientePeer::PAC_DOCUMENTO)) {
            $modifiedColumns[':p' . $index++]  = '`pac_documento`';
        }
        if ($this->isColumnModified(PacientePeer::PAC_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`pac_estado`';
        }
        if ($this->isColumnModified(PacientePeer::PAC_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`pac_eliminado`';
        }
        if ($this->isColumnModified(PacientePeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(PacientePeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `paciente` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`pac_id`':
                        $stmt->bindValue($identifier, $this->pac_id, PDO::PARAM_INT);
                        break;
                    case '`pac_nombres`':
                        $stmt->bindValue($identifier, $this->pac_nombres, PDO::PARAM_STR);
                        break;
                    case '`pac_apellidos`':
                        $stmt->bindValue($identifier, $this->pac_apellidos, PDO::PARAM_STR);
                        break;
                    case '`pac_fecha_nacimiento`':
                        $stmt->bindValue($identifier, $this->pac_fecha_nacimiento, PDO::PARAM_STR);
                        break;
                    case '`pac_sexo`':
                        $stmt->bindValue($identifier, $this->pac_sexo, PDO::PARAM_INT);
                        break;
                    case '`pac_rut`':
                        $stmt->bindValue($identifier, $this->pac_rut, PDO::PARAM_STR);
                        break;
                    case '`pac_documento`':
                        $stmt->bindValue($identifier, $this->pac_documento, PDO::PARAM_STR);
                        break;
                    case '`pac_estado`':
                        $stmt->bindValue($identifier, $this->pac_estado, PDO::PARAM_INT);
                        break;
                    case '`pac_eliminado`':
                        $stmt->bindValue($identifier, $this->pac_eliminado, PDO::PARAM_INT);
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
        $this->setPacId($pk);

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


            if (($retval = PacientePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPacienteFichamedicas !== null) {
                    foreach ($this->collPacienteFichamedicas as $referrerFK) {
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

                if ($this->collUsuariopadrePacientes !== null) {
                    foreach ($this->collUsuariopadrePacientes as $referrerFK) {
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
        $pos = PacientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getPacId();
                break;
            case 1:
                return $this->getPacNombres();
                break;
            case 2:
                return $this->getPacApellidos();
                break;
            case 3:
                return $this->getPacFechaNacimiento();
                break;
            case 4:
                return $this->getPacSexo();
                break;
            case 5:
                return $this->getPacRut();
                break;
            case 6:
                return $this->getPacDocumento();
                break;
            case 7:
                return $this->getPacEstado();
                break;
            case 8:
                return $this->getPacEliminado();
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
        if (isset($alreadyDumpedObjects['Paciente'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Paciente'][$this->getPrimaryKey()] = true;
        $keys = PacientePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPacId(),
            $keys[1] => $this->getPacNombres(),
            $keys[2] => $this->getPacApellidos(),
            $keys[3] => $this->getPacFechaNacimiento(),
            $keys[4] => $this->getPacSexo(),
            $keys[5] => $this->getPacRut(),
            $keys[6] => $this->getPacDocumento(),
            $keys[7] => $this->getPacEstado(),
            $keys[8] => $this->getPacEliminado(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPacienteFichamedicas) {
                $result['PacienteFichamedicas'] = $this->collPacienteFichamedicas->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRecursos) {
                $result['Recursos'] = $this->collRecursos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsuariopadrePacientes) {
                $result['UsuariopadrePacientes'] = $this->collUsuariopadrePacientes->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PacientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setPacId($value);
                break;
            case 1:
                $this->setPacNombres($value);
                break;
            case 2:
                $this->setPacApellidos($value);
                break;
            case 3:
                $this->setPacFechaNacimiento($value);
                break;
            case 4:
                $this->setPacSexo($value);
                break;
            case 5:
                $this->setPacRut($value);
                break;
            case 6:
                $this->setPacDocumento($value);
                break;
            case 7:
                $this->setPacEstado($value);
                break;
            case 8:
                $this->setPacEliminado($value);
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
        $keys = PacientePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setPacId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPacNombres($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPacApellidos($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPacFechaNacimiento($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPacSexo($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPacRut($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setPacDocumento($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setPacEstado($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setPacEliminado($arr[$keys[8]]);
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
        $criteria = new Criteria(PacientePeer::DATABASE_NAME);

        if ($this->isColumnModified(PacientePeer::PAC_ID)) $criteria->add(PacientePeer::PAC_ID, $this->pac_id);
        if ($this->isColumnModified(PacientePeer::PAC_NOMBRES)) $criteria->add(PacientePeer::PAC_NOMBRES, $this->pac_nombres);
        if ($this->isColumnModified(PacientePeer::PAC_APELLIDOS)) $criteria->add(PacientePeer::PAC_APELLIDOS, $this->pac_apellidos);
        if ($this->isColumnModified(PacientePeer::PAC_FECHA_NACIMIENTO)) $criteria->add(PacientePeer::PAC_FECHA_NACIMIENTO, $this->pac_fecha_nacimiento);
        if ($this->isColumnModified(PacientePeer::PAC_SEXO)) $criteria->add(PacientePeer::PAC_SEXO, $this->pac_sexo);
        if ($this->isColumnModified(PacientePeer::PAC_RUT)) $criteria->add(PacientePeer::PAC_RUT, $this->pac_rut);
        if ($this->isColumnModified(PacientePeer::PAC_DOCUMENTO)) $criteria->add(PacientePeer::PAC_DOCUMENTO, $this->pac_documento);
        if ($this->isColumnModified(PacientePeer::PAC_ESTADO)) $criteria->add(PacientePeer::PAC_ESTADO, $this->pac_estado);
        if ($this->isColumnModified(PacientePeer::PAC_ELIMINADO)) $criteria->add(PacientePeer::PAC_ELIMINADO, $this->pac_eliminado);
        if ($this->isColumnModified(PacientePeer::CREATED_AT)) $criteria->add(PacientePeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(PacientePeer::UPDATED_AT)) $criteria->add(PacientePeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(PacientePeer::DATABASE_NAME);
        $criteria->add(PacientePeer::PAC_ID, $this->pac_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getPacId();
    }

    /**
     * Generic method to set the primary key (pac_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPacId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getPacId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Paciente (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPacNombres($this->getPacNombres());
        $copyObj->setPacApellidos($this->getPacApellidos());
        $copyObj->setPacFechaNacimiento($this->getPacFechaNacimiento());
        $copyObj->setPacSexo($this->getPacSexo());
        $copyObj->setPacRut($this->getPacRut());
        $copyObj->setPacDocumento($this->getPacDocumento());
        $copyObj->setPacEstado($this->getPacEstado());
        $copyObj->setPacEliminado($this->getPacEliminado());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPacienteFichamedicas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPacienteFichamedica($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRecursos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRecurso($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsuariopadrePacientes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuariopadrePaciente($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPacId(NULL); // this is a auto-increment column, so set to default value
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
     * @return Paciente Clone of current object.
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
     * @return PacientePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PacientePeer();
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
        if ('PacienteFichamedica' == $relationName) {
            $this->initPacienteFichamedicas();
        }
        if ('Recurso' == $relationName) {
            $this->initRecursos();
        }
        if ('UsuariopadrePaciente' == $relationName) {
            $this->initUsuariopadrePacientes();
        }
    }

    /**
     * Clears out the collPacienteFichamedicas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Paciente The current object (for fluent API support)
     * @see        addPacienteFichamedicas()
     */
    public function clearPacienteFichamedicas()
    {
        $this->collPacienteFichamedicas = null; // important to set this to null since that means it is uninitialized
        $this->collPacienteFichamedicasPartial = null;

        return $this;
    }

    /**
     * reset is the collPacienteFichamedicas collection loaded partially
     *
     * @return void
     */
    public function resetPartialPacienteFichamedicas($v = true)
    {
        $this->collPacienteFichamedicasPartial = $v;
    }

    /**
     * Initializes the collPacienteFichamedicas collection.
     *
     * By default this just sets the collPacienteFichamedicas collection to an empty array (like clearcollPacienteFichamedicas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPacienteFichamedicas($overrideExisting = true)
    {
        if (null !== $this->collPacienteFichamedicas && !$overrideExisting) {
            return;
        }
        $this->collPacienteFichamedicas = new PropelObjectCollection();
        $this->collPacienteFichamedicas->setModel('PacienteFichamedica');
    }

    /**
     * Gets an array of PacienteFichamedica objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Paciente is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PacienteFichamedica[] List of PacienteFichamedica objects
     * @throws PropelException
     */
    public function getPacienteFichamedicas($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPacienteFichamedicasPartial && !$this->isNew();
        if (null === $this->collPacienteFichamedicas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPacienteFichamedicas) {
                // return empty collection
                $this->initPacienteFichamedicas();
            } else {
                $collPacienteFichamedicas = PacienteFichamedicaQuery::create(null, $criteria)
                    ->filterByPaciente($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPacienteFichamedicasPartial && count($collPacienteFichamedicas)) {
                      $this->initPacienteFichamedicas(false);

                      foreach ($collPacienteFichamedicas as $obj) {
                        if (false == $this->collPacienteFichamedicas->contains($obj)) {
                          $this->collPacienteFichamedicas->append($obj);
                        }
                      }

                      $this->collPacienteFichamedicasPartial = true;
                    }

                    $collPacienteFichamedicas->getInternalIterator()->rewind();

                    return $collPacienteFichamedicas;
                }

                if ($partial && $this->collPacienteFichamedicas) {
                    foreach ($this->collPacienteFichamedicas as $obj) {
                        if ($obj->isNew()) {
                            $collPacienteFichamedicas[] = $obj;
                        }
                    }
                }

                $this->collPacienteFichamedicas = $collPacienteFichamedicas;
                $this->collPacienteFichamedicasPartial = false;
            }
        }

        return $this->collPacienteFichamedicas;
    }

    /**
     * Sets a collection of PacienteFichamedica objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $pacienteFichamedicas A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Paciente The current object (for fluent API support)
     */
    public function setPacienteFichamedicas(PropelCollection $pacienteFichamedicas, PropelPDO $con = null)
    {
        $pacienteFichamedicasToDelete = $this->getPacienteFichamedicas(new Criteria(), $con)->diff($pacienteFichamedicas);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->pacienteFichamedicasScheduledForDeletion = clone $pacienteFichamedicasToDelete;

        foreach ($pacienteFichamedicasToDelete as $pacienteFichamedicaRemoved) {
            $pacienteFichamedicaRemoved->setPaciente(null);
        }

        $this->collPacienteFichamedicas = null;
        foreach ($pacienteFichamedicas as $pacienteFichamedica) {
            $this->addPacienteFichamedica($pacienteFichamedica);
        }

        $this->collPacienteFichamedicas = $pacienteFichamedicas;
        $this->collPacienteFichamedicasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PacienteFichamedica objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PacienteFichamedica objects.
     * @throws PropelException
     */
    public function countPacienteFichamedicas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPacienteFichamedicasPartial && !$this->isNew();
        if (null === $this->collPacienteFichamedicas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPacienteFichamedicas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPacienteFichamedicas());
            }
            $query = PacienteFichamedicaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPaciente($this)
                ->count($con);
        }

        return count($this->collPacienteFichamedicas);
    }

    /**
     * Method called to associate a PacienteFichamedica object to this object
     * through the PacienteFichamedica foreign key attribute.
     *
     * @param    PacienteFichamedica $l PacienteFichamedica
     * @return Paciente The current object (for fluent API support)
     */
    public function addPacienteFichamedica(PacienteFichamedica $l)
    {
        if ($this->collPacienteFichamedicas === null) {
            $this->initPacienteFichamedicas();
            $this->collPacienteFichamedicasPartial = true;
        }

        if (!in_array($l, $this->collPacienteFichamedicas->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPacienteFichamedica($l);

            if ($this->pacienteFichamedicasScheduledForDeletion and $this->pacienteFichamedicasScheduledForDeletion->contains($l)) {
                $this->pacienteFichamedicasScheduledForDeletion->remove($this->pacienteFichamedicasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PacienteFichamedica $pacienteFichamedica The pacienteFichamedica object to add.
     */
    protected function doAddPacienteFichamedica($pacienteFichamedica)
    {
        $this->collPacienteFichamedicas[]= $pacienteFichamedica;
        $pacienteFichamedica->setPaciente($this);
    }

    /**
     * @param	PacienteFichamedica $pacienteFichamedica The pacienteFichamedica object to remove.
     * @return Paciente The current object (for fluent API support)
     */
    public function removePacienteFichamedica($pacienteFichamedica)
    {
        if ($this->getPacienteFichamedicas()->contains($pacienteFichamedica)) {
            $this->collPacienteFichamedicas->remove($this->collPacienteFichamedicas->search($pacienteFichamedica));
            if (null === $this->pacienteFichamedicasScheduledForDeletion) {
                $this->pacienteFichamedicasScheduledForDeletion = clone $this->collPacienteFichamedicas;
                $this->pacienteFichamedicasScheduledForDeletion->clear();
            }
            $this->pacienteFichamedicasScheduledForDeletion[]= clone $pacienteFichamedica;
            $pacienteFichamedica->setPaciente(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Paciente is new, it will return
     * an empty collection; or if this Paciente has previously
     * been saved, it will retrieve related PacienteFichamedicas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Paciente.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PacienteFichamedica[] List of PacienteFichamedica objects
     */
    public function getPacienteFichamedicasJoinFichaMedica($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PacienteFichamedicaQuery::create(null, $criteria);
        $query->joinWith('FichaMedica', $join_behavior);

        return $this->getPacienteFichamedicas($query, $con);
    }

    /**
     * Clears out the collRecursos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Paciente The current object (for fluent API support)
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
     * If this Paciente is new, it will return
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
                    ->filterByPaciente($this)
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
     * @return Paciente The current object (for fluent API support)
     */
    public function setRecursos(PropelCollection $recursos, PropelPDO $con = null)
    {
        $recursosToDelete = $this->getRecursos(new Criteria(), $con)->diff($recursos);


        $this->recursosScheduledForDeletion = $recursosToDelete;

        foreach ($recursosToDelete as $recursoRemoved) {
            $recursoRemoved->setPaciente(null);
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
                ->filterByPaciente($this)
                ->count($con);
        }

        return count($this->collRecursos);
    }

    /**
     * Method called to associate a Recurso object to this object
     * through the Recurso foreign key attribute.
     *
     * @param    Recurso $l Recurso
     * @return Paciente The current object (for fluent API support)
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
        $recurso->setPaciente($this);
    }

    /**
     * @param	Recurso $recurso The recurso object to remove.
     * @return Paciente The current object (for fluent API support)
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
            $recurso->setPaciente(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Paciente is new, it will return
     * an empty collection; or if this Paciente has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Paciente.
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
     * Otherwise if this Paciente is new, it will return
     * an empty collection; or if this Paciente has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Paciente.
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
     * Otherwise if this Paciente is new, it will return
     * an empty collection; or if this Paciente has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Paciente.
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
     * Otherwise if this Paciente is new, it will return
     * an empty collection; or if this Paciente has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Paciente.
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
     * Clears out the collUsuariopadrePacientes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Paciente The current object (for fluent API support)
     * @see        addUsuariopadrePacientes()
     */
    public function clearUsuariopadrePacientes()
    {
        $this->collUsuariopadrePacientes = null; // important to set this to null since that means it is uninitialized
        $this->collUsuariopadrePacientesPartial = null;

        return $this;
    }

    /**
     * reset is the collUsuariopadrePacientes collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsuariopadrePacientes($v = true)
    {
        $this->collUsuariopadrePacientesPartial = $v;
    }

    /**
     * Initializes the collUsuariopadrePacientes collection.
     *
     * By default this just sets the collUsuariopadrePacientes collection to an empty array (like clearcollUsuariopadrePacientes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsuariopadrePacientes($overrideExisting = true)
    {
        if (null !== $this->collUsuariopadrePacientes && !$overrideExisting) {
            return;
        }
        $this->collUsuariopadrePacientes = new PropelObjectCollection();
        $this->collUsuariopadrePacientes->setModel('UsuariopadrePaciente');
    }

    /**
     * Gets an array of UsuariopadrePaciente objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Paciente is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UsuariopadrePaciente[] List of UsuariopadrePaciente objects
     * @throws PropelException
     */
    public function getUsuariopadrePacientes($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsuariopadrePacientesPartial && !$this->isNew();
        if (null === $this->collUsuariopadrePacientes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsuariopadrePacientes) {
                // return empty collection
                $this->initUsuariopadrePacientes();
            } else {
                $collUsuariopadrePacientes = UsuariopadrePacienteQuery::create(null, $criteria)
                    ->filterByPaciente($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsuariopadrePacientesPartial && count($collUsuariopadrePacientes)) {
                      $this->initUsuariopadrePacientes(false);

                      foreach ($collUsuariopadrePacientes as $obj) {
                        if (false == $this->collUsuariopadrePacientes->contains($obj)) {
                          $this->collUsuariopadrePacientes->append($obj);
                        }
                      }

                      $this->collUsuariopadrePacientesPartial = true;
                    }

                    $collUsuariopadrePacientes->getInternalIterator()->rewind();

                    return $collUsuariopadrePacientes;
                }

                if ($partial && $this->collUsuariopadrePacientes) {
                    foreach ($this->collUsuariopadrePacientes as $obj) {
                        if ($obj->isNew()) {
                            $collUsuariopadrePacientes[] = $obj;
                        }
                    }
                }

                $this->collUsuariopadrePacientes = $collUsuariopadrePacientes;
                $this->collUsuariopadrePacientesPartial = false;
            }
        }

        return $this->collUsuariopadrePacientes;
    }

    /**
     * Sets a collection of UsuariopadrePaciente objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usuariopadrePacientes A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Paciente The current object (for fluent API support)
     */
    public function setUsuariopadrePacientes(PropelCollection $usuariopadrePacientes, PropelPDO $con = null)
    {
        $usuariopadrePacientesToDelete = $this->getUsuariopadrePacientes(new Criteria(), $con)->diff($usuariopadrePacientes);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->usuariopadrePacientesScheduledForDeletion = clone $usuariopadrePacientesToDelete;

        foreach ($usuariopadrePacientesToDelete as $usuariopadrePacienteRemoved) {
            $usuariopadrePacienteRemoved->setPaciente(null);
        }

        $this->collUsuariopadrePacientes = null;
        foreach ($usuariopadrePacientes as $usuariopadrePaciente) {
            $this->addUsuariopadrePaciente($usuariopadrePaciente);
        }

        $this->collUsuariopadrePacientes = $usuariopadrePacientes;
        $this->collUsuariopadrePacientesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UsuariopadrePaciente objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UsuariopadrePaciente objects.
     * @throws PropelException
     */
    public function countUsuariopadrePacientes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsuariopadrePacientesPartial && !$this->isNew();
        if (null === $this->collUsuariopadrePacientes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuariopadrePacientes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsuariopadrePacientes());
            }
            $query = UsuariopadrePacienteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPaciente($this)
                ->count($con);
        }

        return count($this->collUsuariopadrePacientes);
    }

    /**
     * Method called to associate a UsuariopadrePaciente object to this object
     * through the UsuariopadrePaciente foreign key attribute.
     *
     * @param    UsuariopadrePaciente $l UsuariopadrePaciente
     * @return Paciente The current object (for fluent API support)
     */
    public function addUsuariopadrePaciente(UsuariopadrePaciente $l)
    {
        if ($this->collUsuariopadrePacientes === null) {
            $this->initUsuariopadrePacientes();
            $this->collUsuariopadrePacientesPartial = true;
        }

        if (!in_array($l, $this->collUsuariopadrePacientes->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUsuariopadrePaciente($l);

            if ($this->usuariopadrePacientesScheduledForDeletion and $this->usuariopadrePacientesScheduledForDeletion->contains($l)) {
                $this->usuariopadrePacientesScheduledForDeletion->remove($this->usuariopadrePacientesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	UsuariopadrePaciente $usuariopadrePaciente The usuariopadrePaciente object to add.
     */
    protected function doAddUsuariopadrePaciente($usuariopadrePaciente)
    {
        $this->collUsuariopadrePacientes[]= $usuariopadrePaciente;
        $usuariopadrePaciente->setPaciente($this);
    }

    /**
     * @param	UsuariopadrePaciente $usuariopadrePaciente The usuariopadrePaciente object to remove.
     * @return Paciente The current object (for fluent API support)
     */
    public function removeUsuariopadrePaciente($usuariopadrePaciente)
    {
        if ($this->getUsuariopadrePacientes()->contains($usuariopadrePaciente)) {
            $this->collUsuariopadrePacientes->remove($this->collUsuariopadrePacientes->search($usuariopadrePaciente));
            if (null === $this->usuariopadrePacientesScheduledForDeletion) {
                $this->usuariopadrePacientesScheduledForDeletion = clone $this->collUsuariopadrePacientes;
                $this->usuariopadrePacientesScheduledForDeletion->clear();
            }
            $this->usuariopadrePacientesScheduledForDeletion[]= clone $usuariopadrePaciente;
            $usuariopadrePaciente->setPaciente(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Paciente is new, it will return
     * an empty collection; or if this Paciente has previously
     * been saved, it will retrieve related UsuariopadrePacientes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Paciente.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UsuariopadrePaciente[] List of UsuariopadrePaciente objects
     */
    public function getUsuariopadrePacientesJoinUsuarioPadre($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UsuariopadrePacienteQuery::create(null, $criteria);
        $query->joinWith('UsuarioPadre', $join_behavior);

        return $this->getUsuariopadrePacientes($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Paciente is new, it will return
     * an empty collection; or if this Paciente has previously
     * been saved, it will retrieve related UsuariopadrePacientes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Paciente.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UsuariopadrePaciente[] List of UsuariopadrePaciente objects
     */
    public function getUsuariopadrePacientesJoinUsuarioProfesional($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UsuariopadrePacienteQuery::create(null, $criteria);
        $query->joinWith('UsuarioProfesional', $join_behavior);

        return $this->getUsuariopadrePacientes($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->pac_id = null;
        $this->pac_nombres = null;
        $this->pac_apellidos = null;
        $this->pac_fecha_nacimiento = null;
        $this->pac_sexo = null;
        $this->pac_rut = null;
        $this->pac_documento = null;
        $this->pac_estado = null;
        $this->pac_eliminado = null;
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
            if ($this->collPacienteFichamedicas) {
                foreach ($this->collPacienteFichamedicas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRecursos) {
                foreach ($this->collRecursos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsuariopadrePacientes) {
                foreach ($this->collUsuariopadrePacientes as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collPacienteFichamedicas instanceof PropelCollection) {
            $this->collPacienteFichamedicas->clearIterator();
        }
        $this->collPacienteFichamedicas = null;
        if ($this->collRecursos instanceof PropelCollection) {
            $this->collRecursos->clearIterator();
        }
        $this->collRecursos = null;
        if ($this->collUsuariopadrePacientes instanceof PropelCollection) {
            $this->collUsuariopadrePacientes->clearIterator();
        }
        $this->collUsuariopadrePacientes = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PacientePeer::DEFAULT_STRING_FORMAT);
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
     * @return     Paciente The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = PacientePeer::UPDATED_AT;

        return $this;
    }

}
