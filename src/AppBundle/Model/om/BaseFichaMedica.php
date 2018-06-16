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
use AppBundle\Model\FichaMedica;
use AppBundle\Model\FichaMedicaPeer;
use AppBundle\Model\FichaMedicaQuery;
use AppBundle\Model\PacienteFichamedica;
use AppBundle\Model\PacienteFichamedicaQuery;

abstract class BaseFichaMedica extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\FichaMedicaPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        FichaMedicaPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the fme_id field.
     * @var        int
     */
    protected $fme_id;

    /**
     * The value for the fme_descripcion field.
     * @var        string
     */
    protected $fme_descripcion;

    /**
     * The value for the fme_nombre field.
     * @var        string
     */
    protected $fme_nombre;

    /**
     * The value for the fme_numero_ficha field.
     * @var        int
     */
    protected $fme_numero_ficha;

    /**
     * The value for the fme_estado field.
     * @var        int
     */
    protected $fme_estado;

    /**
     * The value for the fme_eliminado field.
     * @var        int
     */
    protected $fme_eliminado;

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
     * Get the [fme_id] column value.
     *
     * @return int
     */
    public function getFmeId()
    {

        return $this->fme_id;
    }

    /**
     * Get the [fme_descripcion] column value.
     *
     * @return string
     */
    public function getFmeDescripcion()
    {

        return $this->fme_descripcion;
    }

    /**
     * Get the [fme_nombre] column value.
     *
     * @return string
     */
    public function getFmeNombre()
    {

        return $this->fme_nombre;
    }

    /**
     * Get the [fme_numero_ficha] column value.
     *
     * @return int
     */
    public function getFmeNumeroFicha()
    {

        return $this->fme_numero_ficha;
    }

    /**
     * Get the [fme_estado] column value.
     *
     * @return int
     */
    public function getFmeEstado()
    {

        return $this->fme_estado;
    }

    /**
     * Get the [fme_eliminado] column value.
     *
     * @return int
     */
    public function getFmeEliminado()
    {

        return $this->fme_eliminado;
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
     * Set the value of [fme_id] column.
     *
     * @param  int $v new value
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setFmeId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->fme_id !== $v) {
            $this->fme_id = $v;
            $this->modifiedColumns[] = FichaMedicaPeer::FME_ID;
        }


        return $this;
    } // setFmeId()

    /**
     * Set the value of [fme_descripcion] column.
     *
     * @param  string $v new value
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setFmeDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fme_descripcion !== $v) {
            $this->fme_descripcion = $v;
            $this->modifiedColumns[] = FichaMedicaPeer::FME_DESCRIPCION;
        }


        return $this;
    } // setFmeDescripcion()

    /**
     * Set the value of [fme_nombre] column.
     *
     * @param  string $v new value
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setFmeNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fme_nombre !== $v) {
            $this->fme_nombre = $v;
            $this->modifiedColumns[] = FichaMedicaPeer::FME_NOMBRE;
        }


        return $this;
    } // setFmeNombre()

    /**
     * Set the value of [fme_numero_ficha] column.
     *
     * @param  int $v new value
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setFmeNumeroFicha($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->fme_numero_ficha !== $v) {
            $this->fme_numero_ficha = $v;
            $this->modifiedColumns[] = FichaMedicaPeer::FME_NUMERO_FICHA;
        }


        return $this;
    } // setFmeNumeroFicha()

    /**
     * Set the value of [fme_estado] column.
     *
     * @param  int $v new value
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setFmeEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->fme_estado !== $v) {
            $this->fme_estado = $v;
            $this->modifiedColumns[] = FichaMedicaPeer::FME_ESTADO;
        }


        return $this;
    } // setFmeEstado()

    /**
     * Set the value of [fme_eliminado] column.
     *
     * @param  int $v new value
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setFmeEliminado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->fme_eliminado !== $v) {
            $this->fme_eliminado = $v;
            $this->modifiedColumns[] = FichaMedicaPeer::FME_ELIMINADO;
        }


        return $this;
    } // setFmeEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = FichaMedicaPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = FichaMedicaPeer::UPDATED_AT;
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

            $this->fme_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fme_descripcion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->fme_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->fme_numero_ficha = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->fme_estado = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->fme_eliminado = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->created_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->updated_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 8; // 8 = FichaMedicaPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating FichaMedica object", $e);
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
            $con = Propel::getConnection(FichaMedicaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = FichaMedicaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPacienteFichamedicas = null;

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
            $con = Propel::getConnection(FichaMedicaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = FichaMedicaQuery::create()
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
            $con = Propel::getConnection(FichaMedicaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(FichaMedicaPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(FichaMedicaPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(FichaMedicaPeer::UPDATED_AT)) {
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
                FichaMedicaPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = FichaMedicaPeer::FME_ID;
        if (null !== $this->fme_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FichaMedicaPeer::FME_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FichaMedicaPeer::FME_ID)) {
            $modifiedColumns[':p' . $index++]  = '`fme_id`';
        }
        if ($this->isColumnModified(FichaMedicaPeer::FME_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = '`fme_descripcion`';
        }
        if ($this->isColumnModified(FichaMedicaPeer::FME_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = '`fme_nombre`';
        }
        if ($this->isColumnModified(FichaMedicaPeer::FME_NUMERO_FICHA)) {
            $modifiedColumns[':p' . $index++]  = '`fme_numero_ficha`';
        }
        if ($this->isColumnModified(FichaMedicaPeer::FME_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`fme_estado`';
        }
        if ($this->isColumnModified(FichaMedicaPeer::FME_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`fme_eliminado`';
        }
        if ($this->isColumnModified(FichaMedicaPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(FichaMedicaPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `ficha_medica` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`fme_id`':
                        $stmt->bindValue($identifier, $this->fme_id, PDO::PARAM_INT);
                        break;
                    case '`fme_descripcion`':
                        $stmt->bindValue($identifier, $this->fme_descripcion, PDO::PARAM_STR);
                        break;
                    case '`fme_nombre`':
                        $stmt->bindValue($identifier, $this->fme_nombre, PDO::PARAM_STR);
                        break;
                    case '`fme_numero_ficha`':
                        $stmt->bindValue($identifier, $this->fme_numero_ficha, PDO::PARAM_INT);
                        break;
                    case '`fme_estado`':
                        $stmt->bindValue($identifier, $this->fme_estado, PDO::PARAM_INT);
                        break;
                    case '`fme_eliminado`':
                        $stmt->bindValue($identifier, $this->fme_eliminado, PDO::PARAM_INT);
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
        $this->setFmeId($pk);

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


            if (($retval = FichaMedicaPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPacienteFichamedicas !== null) {
                    foreach ($this->collPacienteFichamedicas as $referrerFK) {
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
        $pos = FichaMedicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFmeId();
                break;
            case 1:
                return $this->getFmeDescripcion();
                break;
            case 2:
                return $this->getFmeNombre();
                break;
            case 3:
                return $this->getFmeNumeroFicha();
                break;
            case 4:
                return $this->getFmeEstado();
                break;
            case 5:
                return $this->getFmeEliminado();
                break;
            case 6:
                return $this->getCreatedAt();
                break;
            case 7:
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
        if (isset($alreadyDumpedObjects['FichaMedica'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['FichaMedica'][$this->getPrimaryKey()] = true;
        $keys = FichaMedicaPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getFmeId(),
            $keys[1] => $this->getFmeDescripcion(),
            $keys[2] => $this->getFmeNombre(),
            $keys[3] => $this->getFmeNumeroFicha(),
            $keys[4] => $this->getFmeEstado(),
            $keys[5] => $this->getFmeEliminado(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPacienteFichamedicas) {
                $result['PacienteFichamedicas'] = $this->collPacienteFichamedicas->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = FichaMedicaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFmeId($value);
                break;
            case 1:
                $this->setFmeDescripcion($value);
                break;
            case 2:
                $this->setFmeNombre($value);
                break;
            case 3:
                $this->setFmeNumeroFicha($value);
                break;
            case 4:
                $this->setFmeEstado($value);
                break;
            case 5:
                $this->setFmeEliminado($value);
                break;
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
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
        $keys = FichaMedicaPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setFmeId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFmeDescripcion($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFmeNombre($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setFmeNumeroFicha($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFmeEstado($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setFmeEliminado($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(FichaMedicaPeer::DATABASE_NAME);

        if ($this->isColumnModified(FichaMedicaPeer::FME_ID)) $criteria->add(FichaMedicaPeer::FME_ID, $this->fme_id);
        if ($this->isColumnModified(FichaMedicaPeer::FME_DESCRIPCION)) $criteria->add(FichaMedicaPeer::FME_DESCRIPCION, $this->fme_descripcion);
        if ($this->isColumnModified(FichaMedicaPeer::FME_NOMBRE)) $criteria->add(FichaMedicaPeer::FME_NOMBRE, $this->fme_nombre);
        if ($this->isColumnModified(FichaMedicaPeer::FME_NUMERO_FICHA)) $criteria->add(FichaMedicaPeer::FME_NUMERO_FICHA, $this->fme_numero_ficha);
        if ($this->isColumnModified(FichaMedicaPeer::FME_ESTADO)) $criteria->add(FichaMedicaPeer::FME_ESTADO, $this->fme_estado);
        if ($this->isColumnModified(FichaMedicaPeer::FME_ELIMINADO)) $criteria->add(FichaMedicaPeer::FME_ELIMINADO, $this->fme_eliminado);
        if ($this->isColumnModified(FichaMedicaPeer::CREATED_AT)) $criteria->add(FichaMedicaPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(FichaMedicaPeer::UPDATED_AT)) $criteria->add(FichaMedicaPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(FichaMedicaPeer::DATABASE_NAME);
        $criteria->add(FichaMedicaPeer::FME_ID, $this->fme_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getFmeId();
    }

    /**
     * Generic method to set the primary key (fme_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setFmeId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getFmeId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of FichaMedica (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFmeDescripcion($this->getFmeDescripcion());
        $copyObj->setFmeNombre($this->getFmeNombre());
        $copyObj->setFmeNumeroFicha($this->getFmeNumeroFicha());
        $copyObj->setFmeEstado($this->getFmeEstado());
        $copyObj->setFmeEliminado($this->getFmeEliminado());
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

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFmeId(NULL); // this is a auto-increment column, so set to default value
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
     * @return FichaMedica Clone of current object.
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
     * @return FichaMedicaPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new FichaMedicaPeer();
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
    }

    /**
     * Clears out the collPacienteFichamedicas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return FichaMedica The current object (for fluent API support)
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
     * If this FichaMedica is new, it will return
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
                    ->filterByFichaMedica($this)
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
     * @return FichaMedica The current object (for fluent API support)
     */
    public function setPacienteFichamedicas(PropelCollection $pacienteFichamedicas, PropelPDO $con = null)
    {
        $pacienteFichamedicasToDelete = $this->getPacienteFichamedicas(new Criteria(), $con)->diff($pacienteFichamedicas);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->pacienteFichamedicasScheduledForDeletion = clone $pacienteFichamedicasToDelete;

        foreach ($pacienteFichamedicasToDelete as $pacienteFichamedicaRemoved) {
            $pacienteFichamedicaRemoved->setFichaMedica(null);
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
                ->filterByFichaMedica($this)
                ->count($con);
        }

        return count($this->collPacienteFichamedicas);
    }

    /**
     * Method called to associate a PacienteFichamedica object to this object
     * through the PacienteFichamedica foreign key attribute.
     *
     * @param    PacienteFichamedica $l PacienteFichamedica
     * @return FichaMedica The current object (for fluent API support)
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
        $pacienteFichamedica->setFichaMedica($this);
    }

    /**
     * @param	PacienteFichamedica $pacienteFichamedica The pacienteFichamedica object to remove.
     * @return FichaMedica The current object (for fluent API support)
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
            $pacienteFichamedica->setFichaMedica(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FichaMedica is new, it will return
     * an empty collection; or if this FichaMedica has previously
     * been saved, it will retrieve related PacienteFichamedicas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FichaMedica.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PacienteFichamedica[] List of PacienteFichamedica objects
     */
    public function getPacienteFichamedicasJoinPaciente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PacienteFichamedicaQuery::create(null, $criteria);
        $query->joinWith('Paciente', $join_behavior);

        return $this->getPacienteFichamedicas($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->fme_id = null;
        $this->fme_descripcion = null;
        $this->fme_nombre = null;
        $this->fme_numero_ficha = null;
        $this->fme_estado = null;
        $this->fme_eliminado = null;
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

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collPacienteFichamedicas instanceof PropelCollection) {
            $this->collPacienteFichamedicas->clearIterator();
        }
        $this->collPacienteFichamedicas = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FichaMedicaPeer::DEFAULT_STRING_FORMAT);
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
     * @return     FichaMedica The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = FichaMedicaPeer::UPDATED_AT;

        return $this;
    }

}
