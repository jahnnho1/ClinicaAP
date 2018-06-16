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
use AppBundle\Model\Clinica;
use AppBundle\Model\ClinicaQuery;
use AppBundle\Model\Comentario;
use AppBundle\Model\ComentarioQuery;
use AppBundle\Model\Device;
use AppBundle\Model\DeviceQuery;
use AppBundle\Model\Especialidad;
use AppBundle\Model\EspecialidadQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoQuery;
use AppBundle\Model\UsuarioProfesional;
use AppBundle\Model\UsuarioProfesionalPeer;
use AppBundle\Model\UsuarioProfesionalQuery;
use AppBundle\Model\UsuariopadrePaciente;
use AppBundle\Model\UsuariopadrePacienteQuery;

abstract class BaseUsuarioProfesional extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\UsuarioProfesionalPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UsuarioProfesionalPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the upr_id field.
     * @var        int
     */
    protected $upr_id;

    /**
     * The value for the cli_id field.
     * @var        int
     */
    protected $cli_id;

    /**
     * The value for the upr_nombres field.
     * @var        string
     */
    protected $upr_nombres;

    /**
     * The value for the upr_apellidos field.
     * @var        string
     */
    protected $upr_apellidos;

    /**
     * The value for the upr_email field.
     * @var        string
     */
    protected $upr_email;

    /**
     * The value for the upr_clave field.
     * @var        string
     */
    protected $upr_clave;

    /**
     * The value for the upr_rut field.
     * @var        string
     */
    protected $upr_rut;

    /**
     * The value for the upr_documento field.
     * @var        string
     */
    protected $upr_documento;

    /**
     * The value for the upr_estado field.
     * @var        int
     */
    protected $upr_estado;

    /**
     * The value for the upr_eliminado field.
     * @var        int
     */
    protected $upr_eliminado;

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
     * @var        PropelObjectCollection|Comentario[] Collection to store aggregation of Comentario objects.
     */
    protected $collComentarios;
    protected $collComentariosPartial;

    /**
     * @var        PropelObjectCollection|Device[] Collection to store aggregation of Device objects.
     */
    protected $collDevices;
    protected $collDevicesPartial;

    /**
     * @var        PropelObjectCollection|Especialidad[] Collection to store aggregation of Especialidad objects.
     */
    protected $collEspecialidads;
    protected $collEspecialidadsPartial;

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
    protected $comentariosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $devicesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $especialidadsScheduledForDeletion = null;

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
     * Get the [upr_id] column value.
     *
     * @return int
     */
    public function getUprId()
    {

        return $this->upr_id;
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
     * Get the [upr_nombres] column value.
     *
     * @return string
     */
    public function getUprNombres()
    {

        return $this->upr_nombres;
    }

    /**
     * Get the [upr_apellidos] column value.
     *
     * @return string
     */
    public function getUprApellidos()
    {

        return $this->upr_apellidos;
    }

    /**
     * Get the [upr_email] column value.
     *
     * @return string
     */
    public function getUprEmail()
    {

        return $this->upr_email;
    }

    /**
     * Get the [upr_clave] column value.
     *
     * @return string
     */
    public function getUprClave()
    {

        return $this->upr_clave;
    }

    /**
     * Get the [upr_rut] column value.
     *
     * @return string
     */
    public function getUprRut()
    {

        return $this->upr_rut;
    }

    /**
     * Get the [upr_documento] column value.
     *
     * @return string
     */
    public function getUprDocumento()
    {

        return $this->upr_documento;
    }

    /**
     * Get the [upr_estado] column value.
     *
     * @return int
     */
    public function getUprEstado()
    {

        return $this->upr_estado;
    }

    /**
     * Get the [upr_eliminado] column value.
     *
     * @return int
     */
    public function getUprEliminado()
    {

        return $this->upr_eliminado;
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
     * Set the value of [upr_id] column.
     *
     * @param  int $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upr_id !== $v) {
            $this->upr_id = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_ID;
        }


        return $this;
    } // setUprId()

    /**
     * Set the value of [cli_id] column.
     *
     * @param  int $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setCliId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->cli_id !== $v) {
            $this->cli_id = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::CLI_ID;
        }

        if ($this->aClinica !== null && $this->aClinica->getCliId() !== $v) {
            $this->aClinica = null;
        }


        return $this;
    } // setCliId()

    /**
     * Set the value of [upr_nombres] column.
     *
     * @param  string $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprNombres($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->upr_nombres !== $v) {
            $this->upr_nombres = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_NOMBRES;
        }


        return $this;
    } // setUprNombres()

    /**
     * Set the value of [upr_apellidos] column.
     *
     * @param  string $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprApellidos($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->upr_apellidos !== $v) {
            $this->upr_apellidos = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_APELLIDOS;
        }


        return $this;
    } // setUprApellidos()

    /**
     * Set the value of [upr_email] column.
     *
     * @param  string $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->upr_email !== $v) {
            $this->upr_email = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_EMAIL;
        }


        return $this;
    } // setUprEmail()

    /**
     * Set the value of [upr_clave] column.
     *
     * @param  string $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprClave($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->upr_clave !== $v) {
            $this->upr_clave = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_CLAVE;
        }


        return $this;
    } // setUprClave()

    /**
     * Set the value of [upr_rut] column.
     *
     * @param  string $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprRut($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->upr_rut !== $v) {
            $this->upr_rut = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_RUT;
        }


        return $this;
    } // setUprRut()

    /**
     * Set the value of [upr_documento] column.
     *
     * @param  string $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprDocumento($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->upr_documento !== $v) {
            $this->upr_documento = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_DOCUMENTO;
        }


        return $this;
    } // setUprDocumento()

    /**
     * Set the value of [upr_estado] column.
     *
     * @param  int $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upr_estado !== $v) {
            $this->upr_estado = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_ESTADO;
        }


        return $this;
    } // setUprEstado()

    /**
     * Set the value of [upr_eliminado] column.
     *
     * @param  int $v new value
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUprEliminado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upr_eliminado !== $v) {
            $this->upr_eliminado = $v;
            $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_ELIMINADO;
        }


        return $this;
    } // setUprEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = UsuarioProfesionalPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = UsuarioProfesionalPeer::UPDATED_AT;
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

            $this->upr_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->cli_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->upr_nombres = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->upr_apellidos = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->upr_email = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->upr_clave = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->upr_rut = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->upr_documento = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->upr_estado = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->upr_eliminado = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->created_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->updated_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 12; // 12 = UsuarioProfesionalPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating UsuarioProfesional object", $e);
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
            $con = Propel::getConnection(UsuarioProfesionalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UsuarioProfesionalPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aClinica = null;
            $this->collComentarios = null;

            $this->collDevices = null;

            $this->collEspecialidads = null;

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
            $con = Propel::getConnection(UsuarioProfesionalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UsuarioProfesionalQuery::create()
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
            $con = Propel::getConnection(UsuarioProfesionalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(UsuarioProfesionalPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(UsuarioProfesionalPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(UsuarioProfesionalPeer::UPDATED_AT)) {
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
                UsuarioProfesionalPeer::addInstanceToPool($this);
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

            if ($this->devicesScheduledForDeletion !== null) {
                if (!$this->devicesScheduledForDeletion->isEmpty()) {
                    foreach ($this->devicesScheduledForDeletion as $device) {
                        // need to save related object because we set the relation to null
                        $device->save($con);
                    }
                    $this->devicesScheduledForDeletion = null;
                }
            }

            if ($this->collDevices !== null) {
                foreach ($this->collDevices as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->especialidadsScheduledForDeletion !== null) {
                if (!$this->especialidadsScheduledForDeletion->isEmpty()) {
                    EspecialidadQuery::create()
                        ->filterByPrimaryKeys($this->especialidadsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->especialidadsScheduledForDeletion = null;
                }
            }

            if ($this->collEspecialidads !== null) {
                foreach ($this->collEspecialidads as $referrerFK) {
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

        $this->modifiedColumns[] = UsuarioProfesionalPeer::UPR_ID;
        if (null !== $this->upr_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsuarioProfesionalPeer::UPR_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`upr_id`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::CLI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`cli_id`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_NOMBRES)) {
            $modifiedColumns[':p' . $index++]  = '`upr_nombres`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_APELLIDOS)) {
            $modifiedColumns[':p' . $index++]  = '`upr_apellidos`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`upr_email`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_CLAVE)) {
            $modifiedColumns[':p' . $index++]  = '`upr_clave`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_RUT)) {
            $modifiedColumns[':p' . $index++]  = '`upr_rut`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_DOCUMENTO)) {
            $modifiedColumns[':p' . $index++]  = '`upr_documento`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`upr_estado`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`upr_eliminado`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `usuario_profesional` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`upr_id`':
                        $stmt->bindValue($identifier, $this->upr_id, PDO::PARAM_INT);
                        break;
                    case '`cli_id`':
                        $stmt->bindValue($identifier, $this->cli_id, PDO::PARAM_INT);
                        break;
                    case '`upr_nombres`':
                        $stmt->bindValue($identifier, $this->upr_nombres, PDO::PARAM_STR);
                        break;
                    case '`upr_apellidos`':
                        $stmt->bindValue($identifier, $this->upr_apellidos, PDO::PARAM_STR);
                        break;
                    case '`upr_email`':
                        $stmt->bindValue($identifier, $this->upr_email, PDO::PARAM_STR);
                        break;
                    case '`upr_clave`':
                        $stmt->bindValue($identifier, $this->upr_clave, PDO::PARAM_STR);
                        break;
                    case '`upr_rut`':
                        $stmt->bindValue($identifier, $this->upr_rut, PDO::PARAM_STR);
                        break;
                    case '`upr_documento`':
                        $stmt->bindValue($identifier, $this->upr_documento, PDO::PARAM_STR);
                        break;
                    case '`upr_estado`':
                        $stmt->bindValue($identifier, $this->upr_estado, PDO::PARAM_INT);
                        break;
                    case '`upr_eliminado`':
                        $stmt->bindValue($identifier, $this->upr_eliminado, PDO::PARAM_INT);
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
        $this->setUprId($pk);

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


            if (($retval = UsuarioProfesionalPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collComentarios !== null) {
                    foreach ($this->collComentarios as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collDevices !== null) {
                    foreach ($this->collDevices as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collEspecialidads !== null) {
                    foreach ($this->collEspecialidads as $referrerFK) {
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
        $pos = UsuarioProfesionalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getUprId();
                break;
            case 1:
                return $this->getCliId();
                break;
            case 2:
                return $this->getUprNombres();
                break;
            case 3:
                return $this->getUprApellidos();
                break;
            case 4:
                return $this->getUprEmail();
                break;
            case 5:
                return $this->getUprClave();
                break;
            case 6:
                return $this->getUprRut();
                break;
            case 7:
                return $this->getUprDocumento();
                break;
            case 8:
                return $this->getUprEstado();
                break;
            case 9:
                return $this->getUprEliminado();
                break;
            case 10:
                return $this->getCreatedAt();
                break;
            case 11:
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
        if (isset($alreadyDumpedObjects['UsuarioProfesional'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['UsuarioProfesional'][$this->getPrimaryKey()] = true;
        $keys = UsuarioProfesionalPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUprId(),
            $keys[1] => $this->getCliId(),
            $keys[2] => $this->getUprNombres(),
            $keys[3] => $this->getUprApellidos(),
            $keys[4] => $this->getUprEmail(),
            $keys[5] => $this->getUprClave(),
            $keys[6] => $this->getUprRut(),
            $keys[7] => $this->getUprDocumento(),
            $keys[8] => $this->getUprEstado(),
            $keys[9] => $this->getUprEliminado(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aClinica) {
                $result['Clinica'] = $this->aClinica->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collComentarios) {
                $result['Comentarios'] = $this->collComentarios->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDevices) {
                $result['Devices'] = $this->collDevices->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEspecialidads) {
                $result['Especialidads'] = $this->collEspecialidads->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UsuarioProfesionalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setUprId($value);
                break;
            case 1:
                $this->setCliId($value);
                break;
            case 2:
                $this->setUprNombres($value);
                break;
            case 3:
                $this->setUprApellidos($value);
                break;
            case 4:
                $this->setUprEmail($value);
                break;
            case 5:
                $this->setUprClave($value);
                break;
            case 6:
                $this->setUprRut($value);
                break;
            case 7:
                $this->setUprDocumento($value);
                break;
            case 8:
                $this->setUprEstado($value);
                break;
            case 9:
                $this->setUprEliminado($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
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
        $keys = UsuarioProfesionalPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setUprId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCliId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUprNombres($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUprApellidos($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setUprEmail($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUprClave($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUprRut($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setUprDocumento($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUprEstado($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setUprEliminado($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UsuarioProfesionalPeer::DATABASE_NAME);

        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_ID)) $criteria->add(UsuarioProfesionalPeer::UPR_ID, $this->upr_id);
        if ($this->isColumnModified(UsuarioProfesionalPeer::CLI_ID)) $criteria->add(UsuarioProfesionalPeer::CLI_ID, $this->cli_id);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_NOMBRES)) $criteria->add(UsuarioProfesionalPeer::UPR_NOMBRES, $this->upr_nombres);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_APELLIDOS)) $criteria->add(UsuarioProfesionalPeer::UPR_APELLIDOS, $this->upr_apellidos);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_EMAIL)) $criteria->add(UsuarioProfesionalPeer::UPR_EMAIL, $this->upr_email);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_CLAVE)) $criteria->add(UsuarioProfesionalPeer::UPR_CLAVE, $this->upr_clave);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_RUT)) $criteria->add(UsuarioProfesionalPeer::UPR_RUT, $this->upr_rut);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_DOCUMENTO)) $criteria->add(UsuarioProfesionalPeer::UPR_DOCUMENTO, $this->upr_documento);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_ESTADO)) $criteria->add(UsuarioProfesionalPeer::UPR_ESTADO, $this->upr_estado);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPR_ELIMINADO)) $criteria->add(UsuarioProfesionalPeer::UPR_ELIMINADO, $this->upr_eliminado);
        if ($this->isColumnModified(UsuarioProfesionalPeer::CREATED_AT)) $criteria->add(UsuarioProfesionalPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(UsuarioProfesionalPeer::UPDATED_AT)) $criteria->add(UsuarioProfesionalPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(UsuarioProfesionalPeer::DATABASE_NAME);
        $criteria->add(UsuarioProfesionalPeer::UPR_ID, $this->upr_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getUprId();
    }

    /**
     * Generic method to set the primary key (upr_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUprId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getUprId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of UsuarioProfesional (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCliId($this->getCliId());
        $copyObj->setUprNombres($this->getUprNombres());
        $copyObj->setUprApellidos($this->getUprApellidos());
        $copyObj->setUprEmail($this->getUprEmail());
        $copyObj->setUprClave($this->getUprClave());
        $copyObj->setUprRut($this->getUprRut());
        $copyObj->setUprDocumento($this->getUprDocumento());
        $copyObj->setUprEstado($this->getUprEstado());
        $copyObj->setUprEliminado($this->getUprEliminado());
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

            foreach ($this->getDevices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDevice($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEspecialidads() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEspecialidad($relObj->copy($deepCopy));
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
            $copyObj->setUprId(NULL); // this is a auto-increment column, so set to default value
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
     * @return UsuarioProfesional Clone of current object.
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
     * @return UsuarioProfesionalPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UsuarioProfesionalPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Clinica object.
     *
     * @param                  Clinica $v
     * @return UsuarioProfesional The current object (for fluent API support)
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
            $v->addUsuarioProfesional($this);
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
                $this->aClinica->addUsuarioProfesionals($this);
             */
        }

        return $this->aClinica;
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
        if ('Device' == $relationName) {
            $this->initDevices();
        }
        if ('Especialidad' == $relationName) {
            $this->initEspecialidads();
        }
        if ('Recurso' == $relationName) {
            $this->initRecursos();
        }
        if ('UsuariopadrePaciente' == $relationName) {
            $this->initUsuariopadrePacientes();
        }
    }

    /**
     * Clears out the collComentarios collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return UsuarioProfesional The current object (for fluent API support)
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
     * If this UsuarioProfesional is new, it will return
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
                    ->filterByUsuarioProfesional($this)
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
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setComentarios(PropelCollection $comentarios, PropelPDO $con = null)
    {
        $comentariosToDelete = $this->getComentarios(new Criteria(), $con)->diff($comentarios);


        $this->comentariosScheduledForDeletion = $comentariosToDelete;

        foreach ($comentariosToDelete as $comentarioRemoved) {
            $comentarioRemoved->setUsuarioProfesional(null);
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
                ->filterByUsuarioProfesional($this)
                ->count($con);
        }

        return count($this->collComentarios);
    }

    /**
     * Method called to associate a Comentario object to this object
     * through the Comentario foreign key attribute.
     *
     * @param    Comentario $l Comentario
     * @return UsuarioProfesional The current object (for fluent API support)
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
        $comentario->setUsuarioProfesional($this);
    }

    /**
     * @param	Comentario $comentario The comentario object to remove.
     * @return UsuarioProfesional The current object (for fluent API support)
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
            $comentario->setUsuarioProfesional(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related Comentarios from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Comentario[] List of Comentario objects
     */
    public function getComentariosJoinBlog($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ComentarioQuery::create(null, $criteria);
        $query->joinWith('Blog', $join_behavior);

        return $this->getComentarios($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related Comentarios from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
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
     * Clears out the collDevices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return UsuarioProfesional The current object (for fluent API support)
     * @see        addDevices()
     */
    public function clearDevices()
    {
        $this->collDevices = null; // important to set this to null since that means it is uninitialized
        $this->collDevicesPartial = null;

        return $this;
    }

    /**
     * reset is the collDevices collection loaded partially
     *
     * @return void
     */
    public function resetPartialDevices($v = true)
    {
        $this->collDevicesPartial = $v;
    }

    /**
     * Initializes the collDevices collection.
     *
     * By default this just sets the collDevices collection to an empty array (like clearcollDevices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDevices($overrideExisting = true)
    {
        if (null !== $this->collDevices && !$overrideExisting) {
            return;
        }
        $this->collDevices = new PropelObjectCollection();
        $this->collDevices->setModel('Device');
    }

    /**
     * Gets an array of Device objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this UsuarioProfesional is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Device[] List of Device objects
     * @throws PropelException
     */
    public function getDevices($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDevicesPartial && !$this->isNew();
        if (null === $this->collDevices || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDevices) {
                // return empty collection
                $this->initDevices();
            } else {
                $collDevices = DeviceQuery::create(null, $criteria)
                    ->filterByUsuarioProfesional($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDevicesPartial && count($collDevices)) {
                      $this->initDevices(false);

                      foreach ($collDevices as $obj) {
                        if (false == $this->collDevices->contains($obj)) {
                          $this->collDevices->append($obj);
                        }
                      }

                      $this->collDevicesPartial = true;
                    }

                    $collDevices->getInternalIterator()->rewind();

                    return $collDevices;
                }

                if ($partial && $this->collDevices) {
                    foreach ($this->collDevices as $obj) {
                        if ($obj->isNew()) {
                            $collDevices[] = $obj;
                        }
                    }
                }

                $this->collDevices = $collDevices;
                $this->collDevicesPartial = false;
            }
        }

        return $this->collDevices;
    }

    /**
     * Sets a collection of Device objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $devices A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setDevices(PropelCollection $devices, PropelPDO $con = null)
    {
        $devicesToDelete = $this->getDevices(new Criteria(), $con)->diff($devices);


        $this->devicesScheduledForDeletion = $devicesToDelete;

        foreach ($devicesToDelete as $deviceRemoved) {
            $deviceRemoved->setUsuarioProfesional(null);
        }

        $this->collDevices = null;
        foreach ($devices as $device) {
            $this->addDevice($device);
        }

        $this->collDevices = $devices;
        $this->collDevicesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Device objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Device objects.
     * @throws PropelException
     */
    public function countDevices(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDevicesPartial && !$this->isNew();
        if (null === $this->collDevices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDevices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDevices());
            }
            $query = DeviceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuarioProfesional($this)
                ->count($con);
        }

        return count($this->collDevices);
    }

    /**
     * Method called to associate a Device object to this object
     * through the Device foreign key attribute.
     *
     * @param    Device $l Device
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function addDevice(Device $l)
    {
        if ($this->collDevices === null) {
            $this->initDevices();
            $this->collDevicesPartial = true;
        }

        if (!in_array($l, $this->collDevices->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDevice($l);

            if ($this->devicesScheduledForDeletion and $this->devicesScheduledForDeletion->contains($l)) {
                $this->devicesScheduledForDeletion->remove($this->devicesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Device $device The device object to add.
     */
    protected function doAddDevice($device)
    {
        $this->collDevices[]= $device;
        $device->setUsuarioProfesional($this);
    }

    /**
     * @param	Device $device The device object to remove.
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function removeDevice($device)
    {
        if ($this->getDevices()->contains($device)) {
            $this->collDevices->remove($this->collDevices->search($device));
            if (null === $this->devicesScheduledForDeletion) {
                $this->devicesScheduledForDeletion = clone $this->collDevices;
                $this->devicesScheduledForDeletion->clear();
            }
            $this->devicesScheduledForDeletion[]= $device;
            $device->setUsuarioProfesional(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related Devices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Device[] List of Device objects
     */
    public function getDevicesJoinUsuarioPadre($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = DeviceQuery::create(null, $criteria);
        $query->joinWith('UsuarioPadre', $join_behavior);

        return $this->getDevices($query, $con);
    }

    /**
     * Clears out the collEspecialidads collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return UsuarioProfesional The current object (for fluent API support)
     * @see        addEspecialidads()
     */
    public function clearEspecialidads()
    {
        $this->collEspecialidads = null; // important to set this to null since that means it is uninitialized
        $this->collEspecialidadsPartial = null;

        return $this;
    }

    /**
     * reset is the collEspecialidads collection loaded partially
     *
     * @return void
     */
    public function resetPartialEspecialidads($v = true)
    {
        $this->collEspecialidadsPartial = $v;
    }

    /**
     * Initializes the collEspecialidads collection.
     *
     * By default this just sets the collEspecialidads collection to an empty array (like clearcollEspecialidads());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEspecialidads($overrideExisting = true)
    {
        if (null !== $this->collEspecialidads && !$overrideExisting) {
            return;
        }
        $this->collEspecialidads = new PropelObjectCollection();
        $this->collEspecialidads->setModel('Especialidad');
    }

    /**
     * Gets an array of Especialidad objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this UsuarioProfesional is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Especialidad[] List of Especialidad objects
     * @throws PropelException
     */
    public function getEspecialidads($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collEspecialidadsPartial && !$this->isNew();
        if (null === $this->collEspecialidads || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEspecialidads) {
                // return empty collection
                $this->initEspecialidads();
            } else {
                $collEspecialidads = EspecialidadQuery::create(null, $criteria)
                    ->filterByUsuarioProfesional($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collEspecialidadsPartial && count($collEspecialidads)) {
                      $this->initEspecialidads(false);

                      foreach ($collEspecialidads as $obj) {
                        if (false == $this->collEspecialidads->contains($obj)) {
                          $this->collEspecialidads->append($obj);
                        }
                      }

                      $this->collEspecialidadsPartial = true;
                    }

                    $collEspecialidads->getInternalIterator()->rewind();

                    return $collEspecialidads;
                }

                if ($partial && $this->collEspecialidads) {
                    foreach ($this->collEspecialidads as $obj) {
                        if ($obj->isNew()) {
                            $collEspecialidads[] = $obj;
                        }
                    }
                }

                $this->collEspecialidads = $collEspecialidads;
                $this->collEspecialidadsPartial = false;
            }
        }

        return $this->collEspecialidads;
    }

    /**
     * Sets a collection of Especialidad objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $especialidads A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setEspecialidads(PropelCollection $especialidads, PropelPDO $con = null)
    {
        $especialidadsToDelete = $this->getEspecialidads(new Criteria(), $con)->diff($especialidads);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->especialidadsScheduledForDeletion = clone $especialidadsToDelete;

        foreach ($especialidadsToDelete as $especialidadRemoved) {
            $especialidadRemoved->setUsuarioProfesional(null);
        }

        $this->collEspecialidads = null;
        foreach ($especialidads as $especialidad) {
            $this->addEspecialidad($especialidad);
        }

        $this->collEspecialidads = $especialidads;
        $this->collEspecialidadsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Especialidad objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Especialidad objects.
     * @throws PropelException
     */
    public function countEspecialidads(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collEspecialidadsPartial && !$this->isNew();
        if (null === $this->collEspecialidads || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEspecialidads) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEspecialidads());
            }
            $query = EspecialidadQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuarioProfesional($this)
                ->count($con);
        }

        return count($this->collEspecialidads);
    }

    /**
     * Method called to associate a Especialidad object to this object
     * through the Especialidad foreign key attribute.
     *
     * @param    Especialidad $l Especialidad
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function addEspecialidad(Especialidad $l)
    {
        if ($this->collEspecialidads === null) {
            $this->initEspecialidads();
            $this->collEspecialidadsPartial = true;
        }

        if (!in_array($l, $this->collEspecialidads->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddEspecialidad($l);

            if ($this->especialidadsScheduledForDeletion and $this->especialidadsScheduledForDeletion->contains($l)) {
                $this->especialidadsScheduledForDeletion->remove($this->especialidadsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Especialidad $especialidad The especialidad object to add.
     */
    protected function doAddEspecialidad($especialidad)
    {
        $this->collEspecialidads[]= $especialidad;
        $especialidad->setUsuarioProfesional($this);
    }

    /**
     * @param	Especialidad $especialidad The especialidad object to remove.
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function removeEspecialidad($especialidad)
    {
        if ($this->getEspecialidads()->contains($especialidad)) {
            $this->collEspecialidads->remove($this->collEspecialidads->search($especialidad));
            if (null === $this->especialidadsScheduledForDeletion) {
                $this->especialidadsScheduledForDeletion = clone $this->collEspecialidads;
                $this->especialidadsScheduledForDeletion->clear();
            }
            $this->especialidadsScheduledForDeletion[]= clone $especialidad;
            $especialidad->setUsuarioProfesional(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related Especialidads from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Especialidad[] List of Especialidad objects
     */
    public function getEspecialidadsJoinTipoEspecialidad($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = EspecialidadQuery::create(null, $criteria);
        $query->joinWith('TipoEspecialidad', $join_behavior);

        return $this->getEspecialidads($query, $con);
    }

    /**
     * Clears out the collRecursos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return UsuarioProfesional The current object (for fluent API support)
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
     * If this UsuarioProfesional is new, it will return
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
                    ->filterByUsuarioProfesional($this)
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
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setRecursos(PropelCollection $recursos, PropelPDO $con = null)
    {
        $recursosToDelete = $this->getRecursos(new Criteria(), $con)->diff($recursos);


        $this->recursosScheduledForDeletion = $recursosToDelete;

        foreach ($recursosToDelete as $recursoRemoved) {
            $recursoRemoved->setUsuarioProfesional(null);
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
                ->filterByUsuarioProfesional($this)
                ->count($con);
        }

        return count($this->collRecursos);
    }

    /**
     * Method called to associate a Recurso object to this object
     * through the Recurso foreign key attribute.
     *
     * @param    Recurso $l Recurso
     * @return UsuarioProfesional The current object (for fluent API support)
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
        $recurso->setUsuarioProfesional($this);
    }

    /**
     * @param	Recurso $recurso The recurso object to remove.
     * @return UsuarioProfesional The current object (for fluent API support)
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
            $recurso->setUsuarioProfesional(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
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
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
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
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
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
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
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
     * @return UsuarioProfesional The current object (for fluent API support)
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
     * If this UsuarioProfesional is new, it will return
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
                    ->filterByUsuarioProfesional($this)
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
     * @return UsuarioProfesional The current object (for fluent API support)
     */
    public function setUsuariopadrePacientes(PropelCollection $usuariopadrePacientes, PropelPDO $con = null)
    {
        $usuariopadrePacientesToDelete = $this->getUsuariopadrePacientes(new Criteria(), $con)->diff($usuariopadrePacientes);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->usuariopadrePacientesScheduledForDeletion = clone $usuariopadrePacientesToDelete;

        foreach ($usuariopadrePacientesToDelete as $usuariopadrePacienteRemoved) {
            $usuariopadrePacienteRemoved->setUsuarioProfesional(null);
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
                ->filterByUsuarioProfesional($this)
                ->count($con);
        }

        return count($this->collUsuariopadrePacientes);
    }

    /**
     * Method called to associate a UsuariopadrePaciente object to this object
     * through the UsuariopadrePaciente foreign key attribute.
     *
     * @param    UsuariopadrePaciente $l UsuariopadrePaciente
     * @return UsuarioProfesional The current object (for fluent API support)
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
        $usuariopadrePaciente->setUsuarioProfesional($this);
    }

    /**
     * @param	UsuariopadrePaciente $usuariopadrePaciente The usuariopadrePaciente object to remove.
     * @return UsuarioProfesional The current object (for fluent API support)
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
            $usuariopadrePaciente->setUsuarioProfesional(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related UsuariopadrePacientes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UsuariopadrePaciente[] List of UsuariopadrePaciente objects
     */
    public function getUsuariopadrePacientesJoinPaciente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UsuariopadrePacienteQuery::create(null, $criteria);
        $query->joinWith('Paciente', $join_behavior);

        return $this->getUsuariopadrePacientes($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this UsuarioProfesional is new, it will return
     * an empty collection; or if this UsuarioProfesional has previously
     * been saved, it will retrieve related UsuariopadrePacientes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in UsuarioProfesional.
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
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->upr_id = null;
        $this->cli_id = null;
        $this->upr_nombres = null;
        $this->upr_apellidos = null;
        $this->upr_email = null;
        $this->upr_clave = null;
        $this->upr_rut = null;
        $this->upr_documento = null;
        $this->upr_estado = null;
        $this->upr_eliminado = null;
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
            if ($this->collDevices) {
                foreach ($this->collDevices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEspecialidads) {
                foreach ($this->collEspecialidads as $o) {
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
            if ($this->aClinica instanceof Persistent) {
              $this->aClinica->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collComentarios instanceof PropelCollection) {
            $this->collComentarios->clearIterator();
        }
        $this->collComentarios = null;
        if ($this->collDevices instanceof PropelCollection) {
            $this->collDevices->clearIterator();
        }
        $this->collDevices = null;
        if ($this->collEspecialidads instanceof PropelCollection) {
            $this->collEspecialidads->clearIterator();
        }
        $this->collEspecialidads = null;
        if ($this->collRecursos instanceof PropelCollection) {
            $this->collRecursos->clearIterator();
        }
        $this->collRecursos = null;
        if ($this->collUsuariopadrePacientes instanceof PropelCollection) {
            $this->collUsuariopadrePacientes->clearIterator();
        }
        $this->collUsuariopadrePacientes = null;
        $this->aClinica = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsuarioProfesionalPeer::DEFAULT_STRING_FORMAT);
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
     * @return     UsuarioProfesional The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = UsuarioProfesionalPeer::UPDATED_AT;

        return $this;
    }

}
