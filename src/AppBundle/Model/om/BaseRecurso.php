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
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use AppBundle\Model\Blog;
use AppBundle\Model\BlogQuery;
use AppBundle\Model\Clinica;
use AppBundle\Model\ClinicaQuery;
use AppBundle\Model\Paciente;
use AppBundle\Model\PacienteQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoPeer;
use AppBundle\Model\RecursoQuery;
use AppBundle\Model\UsuarioPadre;
use AppBundle\Model\UsuarioPadreQuery;
use AppBundle\Model\UsuarioProfesional;
use AppBundle\Model\UsuarioProfesionalQuery;

abstract class BaseRecurso extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\RecursoPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        RecursoPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the rec_id field.
     * @var        int
     */
    protected $rec_id;

    /**
     * The value for the pac_id field.
     * @var        int
     */
    protected $pac_id;

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
     * The value for the blo_id field.
     * @var        int
     */
    protected $blo_id;

    /**
     * The value for the upa_id field.
     * @var        int
     */
    protected $upa_id;

    /**
     * The value for the rec_tipo field.
     * @var        int
     */
    protected $rec_tipo;

    /**
     * The value for the rec_es_principal field.
     * @var        int
     */
    protected $rec_es_principal;

    /**
     * The value for the rec_src field.
     * @var        string
     */
    protected $rec_src;

    /**
     * The value for the rec_url field.
     * @var        string
     */
    protected $rec_url;

    /**
     * The value for the rec_orden field.
     * @var        int
     */
    protected $rec_orden;

    /**
     * The value for the rec_estado field.
     * @var        int
     */
    protected $rec_estado;

    /**
     * The value for the rec_eliminado field.
     * @var        int
     */
    protected $rec_eliminado;

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
     * @var        Blog
     */
    protected $aBlog;

    /**
     * @var        Clinica
     */
    protected $aClinica;

    /**
     * @var        Paciente
     */
    protected $aPaciente;

    /**
     * @var        UsuarioProfesional
     */
    protected $aUsuarioProfesional;

    /**
     * @var        UsuarioPadre
     */
    protected $aUsuarioPadre;

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
     * Get the [rec_id] column value.
     *
     * @return int
     */
    public function getRecId()
    {

        return $this->rec_id;
    }

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
     * Get the [blo_id] column value.
     *
     * @return int
     */
    public function getBloId()
    {

        return $this->blo_id;
    }

    /**
     * Get the [upa_id] column value.
     *
     * @return int
     */
    public function getUpaId()
    {

        return $this->upa_id;
    }

    /**
     * Get the [rec_tipo] column value.
     *
     * @return int
     */
    public function getRecTipo()
    {

        return $this->rec_tipo;
    }

    /**
     * Get the [rec_es_principal] column value.
     *
     * @return int
     */
    public function getRecEsPrincipal()
    {

        return $this->rec_es_principal;
    }

    /**
     * Get the [rec_src] column value.
     *
     * @return string
     */
    public function getRecSrc()
    {

        return $this->rec_src;
    }

    /**
     * Get the [rec_url] column value.
     *
     * @return string
     */
    public function getRecUrl()
    {

        return $this->rec_url;
    }

    /**
     * Get the [rec_orden] column value.
     *
     * @return int
     */
    public function getRecOrden()
    {

        return $this->rec_orden;
    }

    /**
     * Get the [rec_estado] column value.
     *
     * @return int
     */
    public function getRecEstado()
    {

        return $this->rec_estado;
    }

    /**
     * Get the [rec_eliminado] column value.
     *
     * @return int
     */
    public function getRecEliminado()
    {

        return $this->rec_eliminado;
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
     * Set the value of [rec_id] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setRecId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->rec_id !== $v) {
            $this->rec_id = $v;
            $this->modifiedColumns[] = RecursoPeer::REC_ID;
        }


        return $this;
    } // setRecId()

    /**
     * Set the value of [pac_id] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setPacId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pac_id !== $v) {
            $this->pac_id = $v;
            $this->modifiedColumns[] = RecursoPeer::PAC_ID;
        }

        if ($this->aPaciente !== null && $this->aPaciente->getPacId() !== $v) {
            $this->aPaciente = null;
        }


        return $this;
    } // setPacId()

    /**
     * Set the value of [upr_id] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setUprId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upr_id !== $v) {
            $this->upr_id = $v;
            $this->modifiedColumns[] = RecursoPeer::UPR_ID;
        }

        if ($this->aUsuarioProfesional !== null && $this->aUsuarioProfesional->getUprId() !== $v) {
            $this->aUsuarioProfesional = null;
        }


        return $this;
    } // setUprId()

    /**
     * Set the value of [cli_id] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setCliId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->cli_id !== $v) {
            $this->cli_id = $v;
            $this->modifiedColumns[] = RecursoPeer::CLI_ID;
        }

        if ($this->aClinica !== null && $this->aClinica->getCliId() !== $v) {
            $this->aClinica = null;
        }


        return $this;
    } // setCliId()

    /**
     * Set the value of [blo_id] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setBloId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->blo_id !== $v) {
            $this->blo_id = $v;
            $this->modifiedColumns[] = RecursoPeer::BLO_ID;
        }

        if ($this->aBlog !== null && $this->aBlog->getBloId() !== $v) {
            $this->aBlog = null;
        }


        return $this;
    } // setBloId()

    /**
     * Set the value of [upa_id] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setUpaId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upa_id !== $v) {
            $this->upa_id = $v;
            $this->modifiedColumns[] = RecursoPeer::UPA_ID;
        }

        if ($this->aUsuarioPadre !== null && $this->aUsuarioPadre->getUpaId() !== $v) {
            $this->aUsuarioPadre = null;
        }


        return $this;
    } // setUpaId()

    /**
     * Set the value of [rec_tipo] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setRecTipo($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->rec_tipo !== $v) {
            $this->rec_tipo = $v;
            $this->modifiedColumns[] = RecursoPeer::REC_TIPO;
        }


        return $this;
    } // setRecTipo()

    /**
     * Set the value of [rec_es_principal] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setRecEsPrincipal($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->rec_es_principal !== $v) {
            $this->rec_es_principal = $v;
            $this->modifiedColumns[] = RecursoPeer::REC_ES_PRINCIPAL;
        }


        return $this;
    } // setRecEsPrincipal()

    /**
     * Set the value of [rec_src] column.
     *
     * @param  string $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setRecSrc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rec_src !== $v) {
            $this->rec_src = $v;
            $this->modifiedColumns[] = RecursoPeer::REC_SRC;
        }


        return $this;
    } // setRecSrc()

    /**
     * Set the value of [rec_url] column.
     *
     * @param  string $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setRecUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rec_url !== $v) {
            $this->rec_url = $v;
            $this->modifiedColumns[] = RecursoPeer::REC_URL;
        }


        return $this;
    } // setRecUrl()

    /**
     * Set the value of [rec_orden] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setRecOrden($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->rec_orden !== $v) {
            $this->rec_orden = $v;
            $this->modifiedColumns[] = RecursoPeer::REC_ORDEN;
        }


        return $this;
    } // setRecOrden()

    /**
     * Set the value of [rec_estado] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setRecEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->rec_estado !== $v) {
            $this->rec_estado = $v;
            $this->modifiedColumns[] = RecursoPeer::REC_ESTADO;
        }


        return $this;
    } // setRecEstado()

    /**
     * Set the value of [rec_eliminado] column.
     *
     * @param  int $v new value
     * @return Recurso The current object (for fluent API support)
     */
    public function setRecEliminado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->rec_eliminado !== $v) {
            $this->rec_eliminado = $v;
            $this->modifiedColumns[] = RecursoPeer::REC_ELIMINADO;
        }


        return $this;
    } // setRecEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Recurso The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = RecursoPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Recurso The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = RecursoPeer::UPDATED_AT;
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

            $this->rec_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->pac_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->upr_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->cli_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->blo_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->upa_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->rec_tipo = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->rec_es_principal = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->rec_src = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->rec_url = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->rec_orden = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->rec_estado = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->rec_eliminado = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->created_at = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->updated_at = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 15; // 15 = RecursoPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Recurso object", $e);
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

        if ($this->aPaciente !== null && $this->pac_id !== $this->aPaciente->getPacId()) {
            $this->aPaciente = null;
        }
        if ($this->aUsuarioProfesional !== null && $this->upr_id !== $this->aUsuarioProfesional->getUprId()) {
            $this->aUsuarioProfesional = null;
        }
        if ($this->aClinica !== null && $this->cli_id !== $this->aClinica->getCliId()) {
            $this->aClinica = null;
        }
        if ($this->aBlog !== null && $this->blo_id !== $this->aBlog->getBloId()) {
            $this->aBlog = null;
        }
        if ($this->aUsuarioPadre !== null && $this->upa_id !== $this->aUsuarioPadre->getUpaId()) {
            $this->aUsuarioPadre = null;
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
            $con = Propel::getConnection(RecursoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = RecursoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBlog = null;
            $this->aClinica = null;
            $this->aPaciente = null;
            $this->aUsuarioProfesional = null;
            $this->aUsuarioPadre = null;
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
            $con = Propel::getConnection(RecursoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = RecursoQuery::create()
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
            $con = Propel::getConnection(RecursoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(RecursoPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(RecursoPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(RecursoPeer::UPDATED_AT)) {
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
                RecursoPeer::addInstanceToPool($this);
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

            if ($this->aBlog !== null) {
                if ($this->aBlog->isModified() || $this->aBlog->isNew()) {
                    $affectedRows += $this->aBlog->save($con);
                }
                $this->setBlog($this->aBlog);
            }

            if ($this->aClinica !== null) {
                if ($this->aClinica->isModified() || $this->aClinica->isNew()) {
                    $affectedRows += $this->aClinica->save($con);
                }
                $this->setClinica($this->aClinica);
            }

            if ($this->aPaciente !== null) {
                if ($this->aPaciente->isModified() || $this->aPaciente->isNew()) {
                    $affectedRows += $this->aPaciente->save($con);
                }
                $this->setPaciente($this->aPaciente);
            }

            if ($this->aUsuarioProfesional !== null) {
                if ($this->aUsuarioProfesional->isModified() || $this->aUsuarioProfesional->isNew()) {
                    $affectedRows += $this->aUsuarioProfesional->save($con);
                }
                $this->setUsuarioProfesional($this->aUsuarioProfesional);
            }

            if ($this->aUsuarioPadre !== null) {
                if ($this->aUsuarioPadre->isModified() || $this->aUsuarioPadre->isNew()) {
                    $affectedRows += $this->aUsuarioPadre->save($con);
                }
                $this->setUsuarioPadre($this->aUsuarioPadre);
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

        $this->modifiedColumns[] = RecursoPeer::REC_ID;
        if (null !== $this->rec_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RecursoPeer::REC_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RecursoPeer::REC_ID)) {
            $modifiedColumns[':p' . $index++]  = '`rec_id`';
        }
        if ($this->isColumnModified(RecursoPeer::PAC_ID)) {
            $modifiedColumns[':p' . $index++]  = '`pac_id`';
        }
        if ($this->isColumnModified(RecursoPeer::UPR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`upr_id`';
        }
        if ($this->isColumnModified(RecursoPeer::CLI_ID)) {
            $modifiedColumns[':p' . $index++]  = '`cli_id`';
        }
        if ($this->isColumnModified(RecursoPeer::BLO_ID)) {
            $modifiedColumns[':p' . $index++]  = '`blo_id`';
        }
        if ($this->isColumnModified(RecursoPeer::UPA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`upa_id`';
        }
        if ($this->isColumnModified(RecursoPeer::REC_TIPO)) {
            $modifiedColumns[':p' . $index++]  = '`rec_tipo`';
        }
        if ($this->isColumnModified(RecursoPeer::REC_ES_PRINCIPAL)) {
            $modifiedColumns[':p' . $index++]  = '`rec_es_principal`';
        }
        if ($this->isColumnModified(RecursoPeer::REC_SRC)) {
            $modifiedColumns[':p' . $index++]  = '`rec_src`';
        }
        if ($this->isColumnModified(RecursoPeer::REC_URL)) {
            $modifiedColumns[':p' . $index++]  = '`rec_url`';
        }
        if ($this->isColumnModified(RecursoPeer::REC_ORDEN)) {
            $modifiedColumns[':p' . $index++]  = '`rec_orden`';
        }
        if ($this->isColumnModified(RecursoPeer::REC_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`rec_estado`';
        }
        if ($this->isColumnModified(RecursoPeer::REC_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`rec_eliminado`';
        }
        if ($this->isColumnModified(RecursoPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(RecursoPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `recurso` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`rec_id`':
                        $stmt->bindValue($identifier, $this->rec_id, PDO::PARAM_INT);
                        break;
                    case '`pac_id`':
                        $stmt->bindValue($identifier, $this->pac_id, PDO::PARAM_INT);
                        break;
                    case '`upr_id`':
                        $stmt->bindValue($identifier, $this->upr_id, PDO::PARAM_INT);
                        break;
                    case '`cli_id`':
                        $stmt->bindValue($identifier, $this->cli_id, PDO::PARAM_INT);
                        break;
                    case '`blo_id`':
                        $stmt->bindValue($identifier, $this->blo_id, PDO::PARAM_INT);
                        break;
                    case '`upa_id`':
                        $stmt->bindValue($identifier, $this->upa_id, PDO::PARAM_INT);
                        break;
                    case '`rec_tipo`':
                        $stmt->bindValue($identifier, $this->rec_tipo, PDO::PARAM_INT);
                        break;
                    case '`rec_es_principal`':
                        $stmt->bindValue($identifier, $this->rec_es_principal, PDO::PARAM_INT);
                        break;
                    case '`rec_src`':
                        $stmt->bindValue($identifier, $this->rec_src, PDO::PARAM_STR);
                        break;
                    case '`rec_url`':
                        $stmt->bindValue($identifier, $this->rec_url, PDO::PARAM_STR);
                        break;
                    case '`rec_orden`':
                        $stmt->bindValue($identifier, $this->rec_orden, PDO::PARAM_INT);
                        break;
                    case '`rec_estado`':
                        $stmt->bindValue($identifier, $this->rec_estado, PDO::PARAM_INT);
                        break;
                    case '`rec_eliminado`':
                        $stmt->bindValue($identifier, $this->rec_eliminado, PDO::PARAM_INT);
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
        $this->setRecId($pk);

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

            if ($this->aBlog !== null) {
                if (!$this->aBlog->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBlog->getValidationFailures());
                }
            }

            if ($this->aClinica !== null) {
                if (!$this->aClinica->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aClinica->getValidationFailures());
                }
            }

            if ($this->aPaciente !== null) {
                if (!$this->aPaciente->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aPaciente->getValidationFailures());
                }
            }

            if ($this->aUsuarioProfesional !== null) {
                if (!$this->aUsuarioProfesional->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUsuarioProfesional->getValidationFailures());
                }
            }

            if ($this->aUsuarioPadre !== null) {
                if (!$this->aUsuarioPadre->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUsuarioPadre->getValidationFailures());
                }
            }


            if (($retval = RecursoPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = RecursoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getRecId();
                break;
            case 1:
                return $this->getPacId();
                break;
            case 2:
                return $this->getUprId();
                break;
            case 3:
                return $this->getCliId();
                break;
            case 4:
                return $this->getBloId();
                break;
            case 5:
                return $this->getUpaId();
                break;
            case 6:
                return $this->getRecTipo();
                break;
            case 7:
                return $this->getRecEsPrincipal();
                break;
            case 8:
                return $this->getRecSrc();
                break;
            case 9:
                return $this->getRecUrl();
                break;
            case 10:
                return $this->getRecOrden();
                break;
            case 11:
                return $this->getRecEstado();
                break;
            case 12:
                return $this->getRecEliminado();
                break;
            case 13:
                return $this->getCreatedAt();
                break;
            case 14:
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
        if (isset($alreadyDumpedObjects['Recurso'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Recurso'][$this->getPrimaryKey()] = true;
        $keys = RecursoPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getRecId(),
            $keys[1] => $this->getPacId(),
            $keys[2] => $this->getUprId(),
            $keys[3] => $this->getCliId(),
            $keys[4] => $this->getBloId(),
            $keys[5] => $this->getUpaId(),
            $keys[6] => $this->getRecTipo(),
            $keys[7] => $this->getRecEsPrincipal(),
            $keys[8] => $this->getRecSrc(),
            $keys[9] => $this->getRecUrl(),
            $keys[10] => $this->getRecOrden(),
            $keys[11] => $this->getRecEstado(),
            $keys[12] => $this->getRecEliminado(),
            $keys[13] => $this->getCreatedAt(),
            $keys[14] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBlog) {
                $result['Blog'] = $this->aBlog->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aClinica) {
                $result['Clinica'] = $this->aClinica->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPaciente) {
                $result['Paciente'] = $this->aPaciente->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsuarioProfesional) {
                $result['UsuarioProfesional'] = $this->aUsuarioProfesional->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsuarioPadre) {
                $result['UsuarioPadre'] = $this->aUsuarioPadre->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = RecursoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setRecId($value);
                break;
            case 1:
                $this->setPacId($value);
                break;
            case 2:
                $this->setUprId($value);
                break;
            case 3:
                $this->setCliId($value);
                break;
            case 4:
                $this->setBloId($value);
                break;
            case 5:
                $this->setUpaId($value);
                break;
            case 6:
                $this->setRecTipo($value);
                break;
            case 7:
                $this->setRecEsPrincipal($value);
                break;
            case 8:
                $this->setRecSrc($value);
                break;
            case 9:
                $this->setRecUrl($value);
                break;
            case 10:
                $this->setRecOrden($value);
                break;
            case 11:
                $this->setRecEstado($value);
                break;
            case 12:
                $this->setRecEliminado($value);
                break;
            case 13:
                $this->setCreatedAt($value);
                break;
            case 14:
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
        $keys = RecursoPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setRecId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPacId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUprId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCliId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setBloId($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUpaId($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setRecTipo($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setRecEsPrincipal($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setRecSrc($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setRecUrl($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setRecOrden($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setRecEstado($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setRecEliminado($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(RecursoPeer::DATABASE_NAME);

        if ($this->isColumnModified(RecursoPeer::REC_ID)) $criteria->add(RecursoPeer::REC_ID, $this->rec_id);
        if ($this->isColumnModified(RecursoPeer::PAC_ID)) $criteria->add(RecursoPeer::PAC_ID, $this->pac_id);
        if ($this->isColumnModified(RecursoPeer::UPR_ID)) $criteria->add(RecursoPeer::UPR_ID, $this->upr_id);
        if ($this->isColumnModified(RecursoPeer::CLI_ID)) $criteria->add(RecursoPeer::CLI_ID, $this->cli_id);
        if ($this->isColumnModified(RecursoPeer::BLO_ID)) $criteria->add(RecursoPeer::BLO_ID, $this->blo_id);
        if ($this->isColumnModified(RecursoPeer::UPA_ID)) $criteria->add(RecursoPeer::UPA_ID, $this->upa_id);
        if ($this->isColumnModified(RecursoPeer::REC_TIPO)) $criteria->add(RecursoPeer::REC_TIPO, $this->rec_tipo);
        if ($this->isColumnModified(RecursoPeer::REC_ES_PRINCIPAL)) $criteria->add(RecursoPeer::REC_ES_PRINCIPAL, $this->rec_es_principal);
        if ($this->isColumnModified(RecursoPeer::REC_SRC)) $criteria->add(RecursoPeer::REC_SRC, $this->rec_src);
        if ($this->isColumnModified(RecursoPeer::REC_URL)) $criteria->add(RecursoPeer::REC_URL, $this->rec_url);
        if ($this->isColumnModified(RecursoPeer::REC_ORDEN)) $criteria->add(RecursoPeer::REC_ORDEN, $this->rec_orden);
        if ($this->isColumnModified(RecursoPeer::REC_ESTADO)) $criteria->add(RecursoPeer::REC_ESTADO, $this->rec_estado);
        if ($this->isColumnModified(RecursoPeer::REC_ELIMINADO)) $criteria->add(RecursoPeer::REC_ELIMINADO, $this->rec_eliminado);
        if ($this->isColumnModified(RecursoPeer::CREATED_AT)) $criteria->add(RecursoPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(RecursoPeer::UPDATED_AT)) $criteria->add(RecursoPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(RecursoPeer::DATABASE_NAME);
        $criteria->add(RecursoPeer::REC_ID, $this->rec_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getRecId();
    }

    /**
     * Generic method to set the primary key (rec_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setRecId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getRecId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Recurso (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPacId($this->getPacId());
        $copyObj->setUprId($this->getUprId());
        $copyObj->setCliId($this->getCliId());
        $copyObj->setBloId($this->getBloId());
        $copyObj->setUpaId($this->getUpaId());
        $copyObj->setRecTipo($this->getRecTipo());
        $copyObj->setRecEsPrincipal($this->getRecEsPrincipal());
        $copyObj->setRecSrc($this->getRecSrc());
        $copyObj->setRecUrl($this->getRecUrl());
        $copyObj->setRecOrden($this->getRecOrden());
        $copyObj->setRecEstado($this->getRecEstado());
        $copyObj->setRecEliminado($this->getRecEliminado());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setRecId(NULL); // this is a auto-increment column, so set to default value
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
     * @return Recurso Clone of current object.
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
     * @return RecursoPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new RecursoPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Blog object.
     *
     * @param                  Blog $v
     * @return Recurso The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBlog(Blog $v = null)
    {
        if ($v === null) {
            $this->setBloId(NULL);
        } else {
            $this->setBloId($v->getBloId());
        }

        $this->aBlog = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Blog object, it will not be re-added.
        if ($v !== null) {
            $v->addRecurso($this);
        }


        return $this;
    }


    /**
     * Get the associated Blog object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Blog The associated Blog object.
     * @throws PropelException
     */
    public function getBlog(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBlog === null && ($this->blo_id !== null) && $doQuery) {
            $this->aBlog = BlogQuery::create()->findPk($this->blo_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBlog->addRecursos($this);
             */
        }

        return $this->aBlog;
    }

    /**
     * Declares an association between this object and a Clinica object.
     *
     * @param                  Clinica $v
     * @return Recurso The current object (for fluent API support)
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
            $v->addRecurso($this);
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
                $this->aClinica->addRecursos($this);
             */
        }

        return $this->aClinica;
    }

    /**
     * Declares an association between this object and a Paciente object.
     *
     * @param                  Paciente $v
     * @return Recurso The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPaciente(Paciente $v = null)
    {
        if ($v === null) {
            $this->setPacId(NULL);
        } else {
            $this->setPacId($v->getPacId());
        }

        $this->aPaciente = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Paciente object, it will not be re-added.
        if ($v !== null) {
            $v->addRecurso($this);
        }


        return $this;
    }


    /**
     * Get the associated Paciente object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Paciente The associated Paciente object.
     * @throws PropelException
     */
    public function getPaciente(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aPaciente === null && ($this->pac_id !== null) && $doQuery) {
            $this->aPaciente = PacienteQuery::create()->findPk($this->pac_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPaciente->addRecursos($this);
             */
        }

        return $this->aPaciente;
    }

    /**
     * Declares an association between this object and a UsuarioProfesional object.
     *
     * @param                  UsuarioProfesional $v
     * @return Recurso The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsuarioProfesional(UsuarioProfesional $v = null)
    {
        if ($v === null) {
            $this->setUprId(NULL);
        } else {
            $this->setUprId($v->getUprId());
        }

        $this->aUsuarioProfesional = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the UsuarioProfesional object, it will not be re-added.
        if ($v !== null) {
            $v->addRecurso($this);
        }


        return $this;
    }


    /**
     * Get the associated UsuarioProfesional object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return UsuarioProfesional The associated UsuarioProfesional object.
     * @throws PropelException
     */
    public function getUsuarioProfesional(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUsuarioProfesional === null && ($this->upr_id !== null) && $doQuery) {
            $this->aUsuarioProfesional = UsuarioProfesionalQuery::create()->findPk($this->upr_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsuarioProfesional->addRecursos($this);
             */
        }

        return $this->aUsuarioProfesional;
    }

    /**
     * Declares an association between this object and a UsuarioPadre object.
     *
     * @param                  UsuarioPadre $v
     * @return Recurso The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsuarioPadre(UsuarioPadre $v = null)
    {
        if ($v === null) {
            $this->setUpaId(NULL);
        } else {
            $this->setUpaId($v->getUpaId());
        }

        $this->aUsuarioPadre = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the UsuarioPadre object, it will not be re-added.
        if ($v !== null) {
            $v->addRecurso($this);
        }


        return $this;
    }


    /**
     * Get the associated UsuarioPadre object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return UsuarioPadre The associated UsuarioPadre object.
     * @throws PropelException
     */
    public function getUsuarioPadre(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUsuarioPadre === null && ($this->upa_id !== null) && $doQuery) {
            $this->aUsuarioPadre = UsuarioPadreQuery::create()->findPk($this->upa_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsuarioPadre->addRecursos($this);
             */
        }

        return $this->aUsuarioPadre;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->rec_id = null;
        $this->pac_id = null;
        $this->upr_id = null;
        $this->cli_id = null;
        $this->blo_id = null;
        $this->upa_id = null;
        $this->rec_tipo = null;
        $this->rec_es_principal = null;
        $this->rec_src = null;
        $this->rec_url = null;
        $this->rec_orden = null;
        $this->rec_estado = null;
        $this->rec_eliminado = null;
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
            if ($this->aBlog instanceof Persistent) {
              $this->aBlog->clearAllReferences($deep);
            }
            if ($this->aClinica instanceof Persistent) {
              $this->aClinica->clearAllReferences($deep);
            }
            if ($this->aPaciente instanceof Persistent) {
              $this->aPaciente->clearAllReferences($deep);
            }
            if ($this->aUsuarioProfesional instanceof Persistent) {
              $this->aUsuarioProfesional->clearAllReferences($deep);
            }
            if ($this->aUsuarioPadre instanceof Persistent) {
              $this->aUsuarioPadre->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aBlog = null;
        $this->aClinica = null;
        $this->aPaciente = null;
        $this->aUsuarioProfesional = null;
        $this->aUsuarioPadre = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RecursoPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Recurso The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = RecursoPeer::UPDATED_AT;

        return $this;
    }

}
