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
use AppBundle\Model\Comentario;
use AppBundle\Model\ComentarioPeer;
use AppBundle\Model\ComentarioQuery;
use AppBundle\Model\UsuarioPadre;
use AppBundle\Model\UsuarioPadreQuery;
use AppBundle\Model\UsuarioProfesional;
use AppBundle\Model\UsuarioProfesionalQuery;

abstract class BaseComentario extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\ComentarioPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ComentarioPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the com_id field.
     * @var        int
     */
    protected $com_id;

    /**
     * The value for the upr_id field.
     * @var        int
     */
    protected $upr_id;

    /**
     * The value for the upa_id field.
     * @var        int
     */
    protected $upa_id;

    /**
     * The value for the blo_id field.
     * @var        int
     */
    protected $blo_id;

    /**
     * The value for the com_mensaje field.
     * @var        string
     */
    protected $com_mensaje;

    /**
     * The value for the com_estado field.
     * @var        int
     */
    protected $com_estado;

    /**
     * The value for the com_eliminado field.
     * @var        int
     */
    protected $com_eliminado;

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
     * Get the [com_id] column value.
     *
     * @return int
     */
    public function getComId()
    {

        return $this->com_id;
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
     * Get the [upa_id] column value.
     *
     * @return int
     */
    public function getUpaId()
    {

        return $this->upa_id;
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
     * Get the [com_mensaje] column value.
     *
     * @return string
     */
    public function getComMensaje()
    {

        return $this->com_mensaje;
    }

    /**
     * Get the [com_estado] column value.
     *
     * @return int
     */
    public function getComEstado()
    {

        return $this->com_estado;
    }

    /**
     * Get the [com_eliminado] column value.
     *
     * @return int
     */
    public function getComEliminado()
    {

        return $this->com_eliminado;
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
     * Set the value of [com_id] column.
     *
     * @param  int $v new value
     * @return Comentario The current object (for fluent API support)
     */
    public function setComId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->com_id !== $v) {
            $this->com_id = $v;
            $this->modifiedColumns[] = ComentarioPeer::COM_ID;
        }


        return $this;
    } // setComId()

    /**
     * Set the value of [upr_id] column.
     *
     * @param  int $v new value
     * @return Comentario The current object (for fluent API support)
     */
    public function setUprId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upr_id !== $v) {
            $this->upr_id = $v;
            $this->modifiedColumns[] = ComentarioPeer::UPR_ID;
        }

        if ($this->aUsuarioProfesional !== null && $this->aUsuarioProfesional->getUprId() !== $v) {
            $this->aUsuarioProfesional = null;
        }


        return $this;
    } // setUprId()

    /**
     * Set the value of [upa_id] column.
     *
     * @param  int $v new value
     * @return Comentario The current object (for fluent API support)
     */
    public function setUpaId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upa_id !== $v) {
            $this->upa_id = $v;
            $this->modifiedColumns[] = ComentarioPeer::UPA_ID;
        }

        if ($this->aUsuarioPadre !== null && $this->aUsuarioPadre->getUpaId() !== $v) {
            $this->aUsuarioPadre = null;
        }


        return $this;
    } // setUpaId()

    /**
     * Set the value of [blo_id] column.
     *
     * @param  int $v new value
     * @return Comentario The current object (for fluent API support)
     */
    public function setBloId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->blo_id !== $v) {
            $this->blo_id = $v;
            $this->modifiedColumns[] = ComentarioPeer::BLO_ID;
        }

        if ($this->aBlog !== null && $this->aBlog->getBloId() !== $v) {
            $this->aBlog = null;
        }


        return $this;
    } // setBloId()

    /**
     * Set the value of [com_mensaje] column.
     *
     * @param  string $v new value
     * @return Comentario The current object (for fluent API support)
     */
    public function setComMensaje($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->com_mensaje !== $v) {
            $this->com_mensaje = $v;
            $this->modifiedColumns[] = ComentarioPeer::COM_MENSAJE;
        }


        return $this;
    } // setComMensaje()

    /**
     * Set the value of [com_estado] column.
     *
     * @param  int $v new value
     * @return Comentario The current object (for fluent API support)
     */
    public function setComEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->com_estado !== $v) {
            $this->com_estado = $v;
            $this->modifiedColumns[] = ComentarioPeer::COM_ESTADO;
        }


        return $this;
    } // setComEstado()

    /**
     * Set the value of [com_eliminado] column.
     *
     * @param  int $v new value
     * @return Comentario The current object (for fluent API support)
     */
    public function setComEliminado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->com_eliminado !== $v) {
            $this->com_eliminado = $v;
            $this->modifiedColumns[] = ComentarioPeer::COM_ELIMINADO;
        }


        return $this;
    } // setComEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Comentario The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = ComentarioPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Comentario The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = ComentarioPeer::UPDATED_AT;
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

            $this->com_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->upr_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->upa_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->blo_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->com_mensaje = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->com_estado = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->com_eliminado = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->created_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 9; // 9 = ComentarioPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Comentario object", $e);
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

        if ($this->aUsuarioProfesional !== null && $this->upr_id !== $this->aUsuarioProfesional->getUprId()) {
            $this->aUsuarioProfesional = null;
        }
        if ($this->aUsuarioPadre !== null && $this->upa_id !== $this->aUsuarioPadre->getUpaId()) {
            $this->aUsuarioPadre = null;
        }
        if ($this->aBlog !== null && $this->blo_id !== $this->aBlog->getBloId()) {
            $this->aBlog = null;
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
            $con = Propel::getConnection(ComentarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ComentarioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBlog = null;
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
            $con = Propel::getConnection(ComentarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ComentarioQuery::create()
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
            $con = Propel::getConnection(ComentarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(ComentarioPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(ComentarioPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(ComentarioPeer::UPDATED_AT)) {
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
                ComentarioPeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = ComentarioPeer::COM_ID;
        if (null !== $this->com_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ComentarioPeer::COM_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ComentarioPeer::COM_ID)) {
            $modifiedColumns[':p' . $index++]  = '`com_id`';
        }
        if ($this->isColumnModified(ComentarioPeer::UPR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`upr_id`';
        }
        if ($this->isColumnModified(ComentarioPeer::UPA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`upa_id`';
        }
        if ($this->isColumnModified(ComentarioPeer::BLO_ID)) {
            $modifiedColumns[':p' . $index++]  = '`blo_id`';
        }
        if ($this->isColumnModified(ComentarioPeer::COM_MENSAJE)) {
            $modifiedColumns[':p' . $index++]  = '`com_mensaje`';
        }
        if ($this->isColumnModified(ComentarioPeer::COM_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`com_estado`';
        }
        if ($this->isColumnModified(ComentarioPeer::COM_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`com_eliminado`';
        }
        if ($this->isColumnModified(ComentarioPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(ComentarioPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `comentario` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`com_id`':
                        $stmt->bindValue($identifier, $this->com_id, PDO::PARAM_INT);
                        break;
                    case '`upr_id`':
                        $stmt->bindValue($identifier, $this->upr_id, PDO::PARAM_INT);
                        break;
                    case '`upa_id`':
                        $stmt->bindValue($identifier, $this->upa_id, PDO::PARAM_INT);
                        break;
                    case '`blo_id`':
                        $stmt->bindValue($identifier, $this->blo_id, PDO::PARAM_INT);
                        break;
                    case '`com_mensaje`':
                        $stmt->bindValue($identifier, $this->com_mensaje, PDO::PARAM_STR);
                        break;
                    case '`com_estado`':
                        $stmt->bindValue($identifier, $this->com_estado, PDO::PARAM_INT);
                        break;
                    case '`com_eliminado`':
                        $stmt->bindValue($identifier, $this->com_eliminado, PDO::PARAM_INT);
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
        $this->setComId($pk);

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


            if (($retval = ComentarioPeer::doValidate($this, $columns)) !== true) {
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
        $pos = ComentarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getComId();
                break;
            case 1:
                return $this->getUprId();
                break;
            case 2:
                return $this->getUpaId();
                break;
            case 3:
                return $this->getBloId();
                break;
            case 4:
                return $this->getComMensaje();
                break;
            case 5:
                return $this->getComEstado();
                break;
            case 6:
                return $this->getComEliminado();
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
        if (isset($alreadyDumpedObjects['Comentario'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Comentario'][$this->getPrimaryKey()] = true;
        $keys = ComentarioPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getComId(),
            $keys[1] => $this->getUprId(),
            $keys[2] => $this->getUpaId(),
            $keys[3] => $this->getBloId(),
            $keys[4] => $this->getComMensaje(),
            $keys[5] => $this->getComEstado(),
            $keys[6] => $this->getComEliminado(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBlog) {
                $result['Blog'] = $this->aBlog->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = ComentarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setComId($value);
                break;
            case 1:
                $this->setUprId($value);
                break;
            case 2:
                $this->setUpaId($value);
                break;
            case 3:
                $this->setBloId($value);
                break;
            case 4:
                $this->setComMensaje($value);
                break;
            case 5:
                $this->setComEstado($value);
                break;
            case 6:
                $this->setComEliminado($value);
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
        $keys = ComentarioPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setComId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUprId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUpaId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setBloId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setComMensaje($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setComEstado($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setComEliminado($arr[$keys[6]]);
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
        $criteria = new Criteria(ComentarioPeer::DATABASE_NAME);

        if ($this->isColumnModified(ComentarioPeer::COM_ID)) $criteria->add(ComentarioPeer::COM_ID, $this->com_id);
        if ($this->isColumnModified(ComentarioPeer::UPR_ID)) $criteria->add(ComentarioPeer::UPR_ID, $this->upr_id);
        if ($this->isColumnModified(ComentarioPeer::UPA_ID)) $criteria->add(ComentarioPeer::UPA_ID, $this->upa_id);
        if ($this->isColumnModified(ComentarioPeer::BLO_ID)) $criteria->add(ComentarioPeer::BLO_ID, $this->blo_id);
        if ($this->isColumnModified(ComentarioPeer::COM_MENSAJE)) $criteria->add(ComentarioPeer::COM_MENSAJE, $this->com_mensaje);
        if ($this->isColumnModified(ComentarioPeer::COM_ESTADO)) $criteria->add(ComentarioPeer::COM_ESTADO, $this->com_estado);
        if ($this->isColumnModified(ComentarioPeer::COM_ELIMINADO)) $criteria->add(ComentarioPeer::COM_ELIMINADO, $this->com_eliminado);
        if ($this->isColumnModified(ComentarioPeer::CREATED_AT)) $criteria->add(ComentarioPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(ComentarioPeer::UPDATED_AT)) $criteria->add(ComentarioPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(ComentarioPeer::DATABASE_NAME);
        $criteria->add(ComentarioPeer::COM_ID, $this->com_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getComId();
    }

    /**
     * Generic method to set the primary key (com_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setComId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getComId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Comentario (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUprId($this->getUprId());
        $copyObj->setUpaId($this->getUpaId());
        $copyObj->setBloId($this->getBloId());
        $copyObj->setComMensaje($this->getComMensaje());
        $copyObj->setComEstado($this->getComEstado());
        $copyObj->setComEliminado($this->getComEliminado());
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
            $copyObj->setComId(NULL); // this is a auto-increment column, so set to default value
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
     * @return Comentario Clone of current object.
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
     * @return ComentarioPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ComentarioPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Blog object.
     *
     * @param                  Blog $v
     * @return Comentario The current object (for fluent API support)
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
            $v->addComentario($this);
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
                $this->aBlog->addComentarios($this);
             */
        }

        return $this->aBlog;
    }

    /**
     * Declares an association between this object and a UsuarioProfesional object.
     *
     * @param                  UsuarioProfesional $v
     * @return Comentario The current object (for fluent API support)
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
            $v->addComentario($this);
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
                $this->aUsuarioProfesional->addComentarios($this);
             */
        }

        return $this->aUsuarioProfesional;
    }

    /**
     * Declares an association between this object and a UsuarioPadre object.
     *
     * @param                  UsuarioPadre $v
     * @return Comentario The current object (for fluent API support)
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
            $v->addComentario($this);
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
                $this->aUsuarioPadre->addComentarios($this);
             */
        }

        return $this->aUsuarioPadre;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->com_id = null;
        $this->upr_id = null;
        $this->upa_id = null;
        $this->blo_id = null;
        $this->com_mensaje = null;
        $this->com_estado = null;
        $this->com_eliminado = null;
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
            if ($this->aUsuarioProfesional instanceof Persistent) {
              $this->aUsuarioProfesional->clearAllReferences($deep);
            }
            if ($this->aUsuarioPadre instanceof Persistent) {
              $this->aUsuarioPadre->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aBlog = null;
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
        return (string) $this->exportTo(ComentarioPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Comentario The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = ComentarioPeer::UPDATED_AT;

        return $this;
    }

}
