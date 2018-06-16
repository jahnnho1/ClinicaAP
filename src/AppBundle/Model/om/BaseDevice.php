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
use AppBundle\Model\Device;
use AppBundle\Model\DevicePeer;
use AppBundle\Model\DeviceQuery;
use AppBundle\Model\UsuarioPadre;
use AppBundle\Model\UsuarioPadreQuery;
use AppBundle\Model\UsuarioProfesional;
use AppBundle\Model\UsuarioProfesionalQuery;

abstract class BaseDevice extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\DevicePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DevicePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the dev_id field.
     * @var        int
     */
    protected $dev_id;

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
     * The value for the dev_app_version field.
     * @var        string
     */
    protected $dev_app_version;

    /**
     * The value for the dev_cordova field.
     * @var        string
     */
    protected $dev_cordova;

    /**
     * The value for the dev_model field.
     * @var        string
     */
    protected $dev_model;

    /**
     * The value for the dev_platform field.
     * @var        string
     */
    protected $dev_platform;

    /**
     * The value for the dev_uuid field.
     * @var        string
     */
    protected $dev_uuid;

    /**
     * The value for the dev_version field.
     * @var        string
     */
    protected $dev_version;

    /**
     * The value for the dev_manufacturer field.
     * @var        string
     */
    protected $dev_manufacturer;

    /**
     * The value for the dev_isvirtual field.
     * @var        string
     */
    protected $dev_isvirtual;

    /**
     * The value for the dev_serial field.
     * @var        string
     */
    protected $dev_serial;

    /**
     * The value for the dev_token_apn field.
     * @var        string
     */
    protected $dev_token_apn;

    /**
     * The value for the dev_ver_app_name field.
     * @var        string
     */
    protected $dev_ver_app_name;

    /**
     * The value for the dev_ver_package_name field.
     * @var        string
     */
    protected $dev_ver_package_name;

    /**
     * The value for the dev_ver_code field.
     * @var        string
     */
    protected $dev_ver_code;

    /**
     * The value for the dev_ver_number field.
     * @var        string
     */
    protected $dev_ver_number;

    /**
     * The value for the dev_estado field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $dev_estado;

    /**
     * The value for the dev_eliminado field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $dev_eliminado;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->dev_estado = 1;
        $this->dev_eliminado = false;
    }

    /**
     * Initializes internal state of BaseDevice object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [dev_id] column value.
     *
     * @return int
     */
    public function getDevId()
    {

        return $this->dev_id;
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
     * Get the [dev_app_version] column value.
     *
     * @return string
     */
    public function getDevAppVersion()
    {

        return $this->dev_app_version;
    }

    /**
     * Get the [dev_cordova] column value.
     *
     * @return string
     */
    public function getDevCordova()
    {

        return $this->dev_cordova;
    }

    /**
     * Get the [dev_model] column value.
     *
     * @return string
     */
    public function getDevModel()
    {

        return $this->dev_model;
    }

    /**
     * Get the [dev_platform] column value.
     *
     * @return string
     */
    public function getDevPlatform()
    {

        return $this->dev_platform;
    }

    /**
     * Get the [dev_uuid] column value.
     *
     * @return string
     */
    public function getDevUuid()
    {

        return $this->dev_uuid;
    }

    /**
     * Get the [dev_version] column value.
     *
     * @return string
     */
    public function getDevVersion()
    {

        return $this->dev_version;
    }

    /**
     * Get the [dev_manufacturer] column value.
     *
     * @return string
     */
    public function getDevManufacturer()
    {

        return $this->dev_manufacturer;
    }

    /**
     * Get the [dev_isvirtual] column value.
     *
     * @return string
     */
    public function getDevIsvirtual()
    {

        return $this->dev_isvirtual;
    }

    /**
     * Get the [dev_serial] column value.
     *
     * @return string
     */
    public function getDevSerial()
    {

        return $this->dev_serial;
    }

    /**
     * Get the [dev_token_apn] column value.
     *
     * @return string
     */
    public function getDevTokenApn()
    {

        return $this->dev_token_apn;
    }

    /**
     * Get the [dev_ver_app_name] column value.
     *
     * @return string
     */
    public function getDevVerAppName()
    {

        return $this->dev_ver_app_name;
    }

    /**
     * Get the [dev_ver_package_name] column value.
     *
     * @return string
     */
    public function getDevVerPackageName()
    {

        return $this->dev_ver_package_name;
    }

    /**
     * Get the [dev_ver_code] column value.
     *
     * @return string
     */
    public function getDevVerCode()
    {

        return $this->dev_ver_code;
    }

    /**
     * Get the [dev_ver_number] column value.
     *
     * @return string
     */
    public function getDevVerNumber()
    {

        return $this->dev_ver_number;
    }

    /**
     * Get the [dev_estado] column value.
     *
     * @return int
     */
    public function getDevEstado()
    {

        return $this->dev_estado;
    }

    /**
     * Get the [dev_eliminado] column value.
     *
     * @return boolean
     */
    public function getDevEliminado()
    {

        return $this->dev_eliminado;
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
     * Set the value of [dev_id] column.
     *
     * @param  int $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->dev_id !== $v) {
            $this->dev_id = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_ID;
        }


        return $this;
    } // setDevId()

    /**
     * Set the value of [upr_id] column.
     *
     * @param  int $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setUprId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upr_id !== $v) {
            $this->upr_id = $v;
            $this->modifiedColumns[] = DevicePeer::UPR_ID;
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
     * @return Device The current object (for fluent API support)
     */
    public function setUpaId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->upa_id !== $v) {
            $this->upa_id = $v;
            $this->modifiedColumns[] = DevicePeer::UPA_ID;
        }

        if ($this->aUsuarioPadre !== null && $this->aUsuarioPadre->getUpaId() !== $v) {
            $this->aUsuarioPadre = null;
        }


        return $this;
    } // setUpaId()

    /**
     * Set the value of [dev_app_version] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevAppVersion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_app_version !== $v) {
            $this->dev_app_version = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_APP_VERSION;
        }


        return $this;
    } // setDevAppVersion()

    /**
     * Set the value of [dev_cordova] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevCordova($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_cordova !== $v) {
            $this->dev_cordova = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_CORDOVA;
        }


        return $this;
    } // setDevCordova()

    /**
     * Set the value of [dev_model] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevModel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_model !== $v) {
            $this->dev_model = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_MODEL;
        }


        return $this;
    } // setDevModel()

    /**
     * Set the value of [dev_platform] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevPlatform($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_platform !== $v) {
            $this->dev_platform = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_PLATFORM;
        }


        return $this;
    } // setDevPlatform()

    /**
     * Set the value of [dev_uuid] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevUuid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_uuid !== $v) {
            $this->dev_uuid = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_UUID;
        }


        return $this;
    } // setDevUuid()

    /**
     * Set the value of [dev_version] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevVersion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_version !== $v) {
            $this->dev_version = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_VERSION;
        }


        return $this;
    } // setDevVersion()

    /**
     * Set the value of [dev_manufacturer] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevManufacturer($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_manufacturer !== $v) {
            $this->dev_manufacturer = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_MANUFACTURER;
        }


        return $this;
    } // setDevManufacturer()

    /**
     * Set the value of [dev_isvirtual] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevIsvirtual($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_isvirtual !== $v) {
            $this->dev_isvirtual = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_ISVIRTUAL;
        }


        return $this;
    } // setDevIsvirtual()

    /**
     * Set the value of [dev_serial] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevSerial($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_serial !== $v) {
            $this->dev_serial = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_SERIAL;
        }


        return $this;
    } // setDevSerial()

    /**
     * Set the value of [dev_token_apn] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevTokenApn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_token_apn !== $v) {
            $this->dev_token_apn = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_TOKEN_APN;
        }


        return $this;
    } // setDevTokenApn()

    /**
     * Set the value of [dev_ver_app_name] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevVerAppName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_ver_app_name !== $v) {
            $this->dev_ver_app_name = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_VER_APP_NAME;
        }


        return $this;
    } // setDevVerAppName()

    /**
     * Set the value of [dev_ver_package_name] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevVerPackageName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_ver_package_name !== $v) {
            $this->dev_ver_package_name = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_VER_PACKAGE_NAME;
        }


        return $this;
    } // setDevVerPackageName()

    /**
     * Set the value of [dev_ver_code] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevVerCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_ver_code !== $v) {
            $this->dev_ver_code = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_VER_CODE;
        }


        return $this;
    } // setDevVerCode()

    /**
     * Set the value of [dev_ver_number] column.
     *
     * @param  string $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevVerNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dev_ver_number !== $v) {
            $this->dev_ver_number = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_VER_NUMBER;
        }


        return $this;
    } // setDevVerNumber()

    /**
     * Set the value of [dev_estado] column.
     *
     * @param  int $v new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->dev_estado !== $v) {
            $this->dev_estado = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_ESTADO;
        }


        return $this;
    } // setDevEstado()

    /**
     * Sets the value of the [dev_eliminado] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Device The current object (for fluent API support)
     */
    public function setDevEliminado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->dev_eliminado !== $v) {
            $this->dev_eliminado = $v;
            $this->modifiedColumns[] = DevicePeer::DEV_ELIMINADO;
        }


        return $this;
    } // setDevEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Device The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = DevicePeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Device The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = DevicePeer::UPDATED_AT;
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
            if ($this->dev_estado !== 1) {
                return false;
            }

            if ($this->dev_eliminado !== false) {
                return false;
            }

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

            $this->dev_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->upr_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->upa_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->dev_app_version = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->dev_cordova = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->dev_model = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->dev_platform = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->dev_uuid = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->dev_version = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->dev_manufacturer = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->dev_isvirtual = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->dev_serial = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->dev_token_apn = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->dev_ver_app_name = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->dev_ver_package_name = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->dev_ver_code = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->dev_ver_number = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->dev_estado = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
            $this->dev_eliminado = ($row[$startcol + 18] !== null) ? (boolean) $row[$startcol + 18] : null;
            $this->created_at = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->updated_at = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 21; // 21 = DevicePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Device object", $e);
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
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DevicePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

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
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DeviceQuery::create()
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
            $con = Propel::getConnection(DevicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(DevicePeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(DevicePeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(DevicePeer::UPDATED_AT)) {
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
                DevicePeer::addInstanceToPool($this);
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

        $this->modifiedColumns[] = DevicePeer::DEV_ID;
        if (null !== $this->dev_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DevicePeer::DEV_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DevicePeer::DEV_ID)) {
            $modifiedColumns[':p' . $index++]  = '`dev_id`';
        }
        if ($this->isColumnModified(DevicePeer::UPR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`upr_id`';
        }
        if ($this->isColumnModified(DevicePeer::UPA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`upa_id`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_APP_VERSION)) {
            $modifiedColumns[':p' . $index++]  = '`dev_app_version`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_CORDOVA)) {
            $modifiedColumns[':p' . $index++]  = '`dev_cordova`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_MODEL)) {
            $modifiedColumns[':p' . $index++]  = '`dev_model`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_PLATFORM)) {
            $modifiedColumns[':p' . $index++]  = '`dev_platform`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`dev_uuid`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_VERSION)) {
            $modifiedColumns[':p' . $index++]  = '`dev_version`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_MANUFACTURER)) {
            $modifiedColumns[':p' . $index++]  = '`dev_manufacturer`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_ISVIRTUAL)) {
            $modifiedColumns[':p' . $index++]  = '`dev_isvirtual`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_SERIAL)) {
            $modifiedColumns[':p' . $index++]  = '`dev_serial`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_TOKEN_APN)) {
            $modifiedColumns[':p' . $index++]  = '`dev_token_apn`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_VER_APP_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`dev_ver_app_name`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_VER_PACKAGE_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`dev_ver_package_name`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_VER_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`dev_ver_code`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_VER_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`dev_ver_number`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`dev_estado`';
        }
        if ($this->isColumnModified(DevicePeer::DEV_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`dev_eliminado`';
        }
        if ($this->isColumnModified(DevicePeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(DevicePeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `device` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`dev_id`':
                        $stmt->bindValue($identifier, $this->dev_id, PDO::PARAM_INT);
                        break;
                    case '`upr_id`':
                        $stmt->bindValue($identifier, $this->upr_id, PDO::PARAM_INT);
                        break;
                    case '`upa_id`':
                        $stmt->bindValue($identifier, $this->upa_id, PDO::PARAM_INT);
                        break;
                    case '`dev_app_version`':
                        $stmt->bindValue($identifier, $this->dev_app_version, PDO::PARAM_STR);
                        break;
                    case '`dev_cordova`':
                        $stmt->bindValue($identifier, $this->dev_cordova, PDO::PARAM_STR);
                        break;
                    case '`dev_model`':
                        $stmt->bindValue($identifier, $this->dev_model, PDO::PARAM_STR);
                        break;
                    case '`dev_platform`':
                        $stmt->bindValue($identifier, $this->dev_platform, PDO::PARAM_STR);
                        break;
                    case '`dev_uuid`':
                        $stmt->bindValue($identifier, $this->dev_uuid, PDO::PARAM_STR);
                        break;
                    case '`dev_version`':
                        $stmt->bindValue($identifier, $this->dev_version, PDO::PARAM_STR);
                        break;
                    case '`dev_manufacturer`':
                        $stmt->bindValue($identifier, $this->dev_manufacturer, PDO::PARAM_STR);
                        break;
                    case '`dev_isvirtual`':
                        $stmt->bindValue($identifier, $this->dev_isvirtual, PDO::PARAM_STR);
                        break;
                    case '`dev_serial`':
                        $stmt->bindValue($identifier, $this->dev_serial, PDO::PARAM_STR);
                        break;
                    case '`dev_token_apn`':
                        $stmt->bindValue($identifier, $this->dev_token_apn, PDO::PARAM_STR);
                        break;
                    case '`dev_ver_app_name`':
                        $stmt->bindValue($identifier, $this->dev_ver_app_name, PDO::PARAM_STR);
                        break;
                    case '`dev_ver_package_name`':
                        $stmt->bindValue($identifier, $this->dev_ver_package_name, PDO::PARAM_STR);
                        break;
                    case '`dev_ver_code`':
                        $stmt->bindValue($identifier, $this->dev_ver_code, PDO::PARAM_STR);
                        break;
                    case '`dev_ver_number`':
                        $stmt->bindValue($identifier, $this->dev_ver_number, PDO::PARAM_STR);
                        break;
                    case '`dev_estado`':
                        $stmt->bindValue($identifier, $this->dev_estado, PDO::PARAM_INT);
                        break;
                    case '`dev_eliminado`':
                        $stmt->bindValue($identifier, (int) $this->dev_eliminado, PDO::PARAM_INT);
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
        $this->setDevId($pk);

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


            if (($retval = DevicePeer::doValidate($this, $columns)) !== true) {
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
        $pos = DevicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDevId();
                break;
            case 1:
                return $this->getUprId();
                break;
            case 2:
                return $this->getUpaId();
                break;
            case 3:
                return $this->getDevAppVersion();
                break;
            case 4:
                return $this->getDevCordova();
                break;
            case 5:
                return $this->getDevModel();
                break;
            case 6:
                return $this->getDevPlatform();
                break;
            case 7:
                return $this->getDevUuid();
                break;
            case 8:
                return $this->getDevVersion();
                break;
            case 9:
                return $this->getDevManufacturer();
                break;
            case 10:
                return $this->getDevIsvirtual();
                break;
            case 11:
                return $this->getDevSerial();
                break;
            case 12:
                return $this->getDevTokenApn();
                break;
            case 13:
                return $this->getDevVerAppName();
                break;
            case 14:
                return $this->getDevVerPackageName();
                break;
            case 15:
                return $this->getDevVerCode();
                break;
            case 16:
                return $this->getDevVerNumber();
                break;
            case 17:
                return $this->getDevEstado();
                break;
            case 18:
                return $this->getDevEliminado();
                break;
            case 19:
                return $this->getCreatedAt();
                break;
            case 20:
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
        if (isset($alreadyDumpedObjects['Device'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Device'][$this->getPrimaryKey()] = true;
        $keys = DevicePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getDevId(),
            $keys[1] => $this->getUprId(),
            $keys[2] => $this->getUpaId(),
            $keys[3] => $this->getDevAppVersion(),
            $keys[4] => $this->getDevCordova(),
            $keys[5] => $this->getDevModel(),
            $keys[6] => $this->getDevPlatform(),
            $keys[7] => $this->getDevUuid(),
            $keys[8] => $this->getDevVersion(),
            $keys[9] => $this->getDevManufacturer(),
            $keys[10] => $this->getDevIsvirtual(),
            $keys[11] => $this->getDevSerial(),
            $keys[12] => $this->getDevTokenApn(),
            $keys[13] => $this->getDevVerAppName(),
            $keys[14] => $this->getDevVerPackageName(),
            $keys[15] => $this->getDevVerCode(),
            $keys[16] => $this->getDevVerNumber(),
            $keys[17] => $this->getDevEstado(),
            $keys[18] => $this->getDevEliminado(),
            $keys[19] => $this->getCreatedAt(),
            $keys[20] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
        $pos = DevicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDevId($value);
                break;
            case 1:
                $this->setUprId($value);
                break;
            case 2:
                $this->setUpaId($value);
                break;
            case 3:
                $this->setDevAppVersion($value);
                break;
            case 4:
                $this->setDevCordova($value);
                break;
            case 5:
                $this->setDevModel($value);
                break;
            case 6:
                $this->setDevPlatform($value);
                break;
            case 7:
                $this->setDevUuid($value);
                break;
            case 8:
                $this->setDevVersion($value);
                break;
            case 9:
                $this->setDevManufacturer($value);
                break;
            case 10:
                $this->setDevIsvirtual($value);
                break;
            case 11:
                $this->setDevSerial($value);
                break;
            case 12:
                $this->setDevTokenApn($value);
                break;
            case 13:
                $this->setDevVerAppName($value);
                break;
            case 14:
                $this->setDevVerPackageName($value);
                break;
            case 15:
                $this->setDevVerCode($value);
                break;
            case 16:
                $this->setDevVerNumber($value);
                break;
            case 17:
                $this->setDevEstado($value);
                break;
            case 18:
                $this->setDevEliminado($value);
                break;
            case 19:
                $this->setCreatedAt($value);
                break;
            case 20:
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
        $keys = DevicePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setDevId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUprId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUpaId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDevAppVersion($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setDevCordova($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDevModel($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setDevPlatform($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setDevUuid($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setDevVersion($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setDevManufacturer($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setDevIsvirtual($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setDevSerial($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setDevTokenApn($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setDevVerAppName($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setDevVerPackageName($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setDevVerCode($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setDevVerNumber($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setDevEstado($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setDevEliminado($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setCreatedAt($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setUpdatedAt($arr[$keys[20]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DevicePeer::DATABASE_NAME);

        if ($this->isColumnModified(DevicePeer::DEV_ID)) $criteria->add(DevicePeer::DEV_ID, $this->dev_id);
        if ($this->isColumnModified(DevicePeer::UPR_ID)) $criteria->add(DevicePeer::UPR_ID, $this->upr_id);
        if ($this->isColumnModified(DevicePeer::UPA_ID)) $criteria->add(DevicePeer::UPA_ID, $this->upa_id);
        if ($this->isColumnModified(DevicePeer::DEV_APP_VERSION)) $criteria->add(DevicePeer::DEV_APP_VERSION, $this->dev_app_version);
        if ($this->isColumnModified(DevicePeer::DEV_CORDOVA)) $criteria->add(DevicePeer::DEV_CORDOVA, $this->dev_cordova);
        if ($this->isColumnModified(DevicePeer::DEV_MODEL)) $criteria->add(DevicePeer::DEV_MODEL, $this->dev_model);
        if ($this->isColumnModified(DevicePeer::DEV_PLATFORM)) $criteria->add(DevicePeer::DEV_PLATFORM, $this->dev_platform);
        if ($this->isColumnModified(DevicePeer::DEV_UUID)) $criteria->add(DevicePeer::DEV_UUID, $this->dev_uuid);
        if ($this->isColumnModified(DevicePeer::DEV_VERSION)) $criteria->add(DevicePeer::DEV_VERSION, $this->dev_version);
        if ($this->isColumnModified(DevicePeer::DEV_MANUFACTURER)) $criteria->add(DevicePeer::DEV_MANUFACTURER, $this->dev_manufacturer);
        if ($this->isColumnModified(DevicePeer::DEV_ISVIRTUAL)) $criteria->add(DevicePeer::DEV_ISVIRTUAL, $this->dev_isvirtual);
        if ($this->isColumnModified(DevicePeer::DEV_SERIAL)) $criteria->add(DevicePeer::DEV_SERIAL, $this->dev_serial);
        if ($this->isColumnModified(DevicePeer::DEV_TOKEN_APN)) $criteria->add(DevicePeer::DEV_TOKEN_APN, $this->dev_token_apn);
        if ($this->isColumnModified(DevicePeer::DEV_VER_APP_NAME)) $criteria->add(DevicePeer::DEV_VER_APP_NAME, $this->dev_ver_app_name);
        if ($this->isColumnModified(DevicePeer::DEV_VER_PACKAGE_NAME)) $criteria->add(DevicePeer::DEV_VER_PACKAGE_NAME, $this->dev_ver_package_name);
        if ($this->isColumnModified(DevicePeer::DEV_VER_CODE)) $criteria->add(DevicePeer::DEV_VER_CODE, $this->dev_ver_code);
        if ($this->isColumnModified(DevicePeer::DEV_VER_NUMBER)) $criteria->add(DevicePeer::DEV_VER_NUMBER, $this->dev_ver_number);
        if ($this->isColumnModified(DevicePeer::DEV_ESTADO)) $criteria->add(DevicePeer::DEV_ESTADO, $this->dev_estado);
        if ($this->isColumnModified(DevicePeer::DEV_ELIMINADO)) $criteria->add(DevicePeer::DEV_ELIMINADO, $this->dev_eliminado);
        if ($this->isColumnModified(DevicePeer::CREATED_AT)) $criteria->add(DevicePeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(DevicePeer::UPDATED_AT)) $criteria->add(DevicePeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(DevicePeer::DATABASE_NAME);
        $criteria->add(DevicePeer::DEV_ID, $this->dev_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getDevId();
    }

    /**
     * Generic method to set the primary key (dev_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setDevId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getDevId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Device (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUprId($this->getUprId());
        $copyObj->setUpaId($this->getUpaId());
        $copyObj->setDevAppVersion($this->getDevAppVersion());
        $copyObj->setDevCordova($this->getDevCordova());
        $copyObj->setDevModel($this->getDevModel());
        $copyObj->setDevPlatform($this->getDevPlatform());
        $copyObj->setDevUuid($this->getDevUuid());
        $copyObj->setDevVersion($this->getDevVersion());
        $copyObj->setDevManufacturer($this->getDevManufacturer());
        $copyObj->setDevIsvirtual($this->getDevIsvirtual());
        $copyObj->setDevSerial($this->getDevSerial());
        $copyObj->setDevTokenApn($this->getDevTokenApn());
        $copyObj->setDevVerAppName($this->getDevVerAppName());
        $copyObj->setDevVerPackageName($this->getDevVerPackageName());
        $copyObj->setDevVerCode($this->getDevVerCode());
        $copyObj->setDevVerNumber($this->getDevVerNumber());
        $copyObj->setDevEstado($this->getDevEstado());
        $copyObj->setDevEliminado($this->getDevEliminado());
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
            $copyObj->setDevId(NULL); // this is a auto-increment column, so set to default value
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
     * @return Device Clone of current object.
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
     * @return DevicePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DevicePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a UsuarioProfesional object.
     *
     * @param                  UsuarioProfesional $v
     * @return Device The current object (for fluent API support)
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
            $v->addDevice($this);
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
                $this->aUsuarioProfesional->addDevices($this);
             */
        }

        return $this->aUsuarioProfesional;
    }

    /**
     * Declares an association between this object and a UsuarioPadre object.
     *
     * @param                  UsuarioPadre $v
     * @return Device The current object (for fluent API support)
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
            $v->addDevice($this);
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
                $this->aUsuarioPadre->addDevices($this);
             */
        }

        return $this->aUsuarioPadre;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->dev_id = null;
        $this->upr_id = null;
        $this->upa_id = null;
        $this->dev_app_version = null;
        $this->dev_cordova = null;
        $this->dev_model = null;
        $this->dev_platform = null;
        $this->dev_uuid = null;
        $this->dev_version = null;
        $this->dev_manufacturer = null;
        $this->dev_isvirtual = null;
        $this->dev_serial = null;
        $this->dev_token_apn = null;
        $this->dev_ver_app_name = null;
        $this->dev_ver_package_name = null;
        $this->dev_ver_code = null;
        $this->dev_ver_number = null;
        $this->dev_estado = null;
        $this->dev_eliminado = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->aUsuarioProfesional instanceof Persistent) {
              $this->aUsuarioProfesional->clearAllReferences($deep);
            }
            if ($this->aUsuarioPadre instanceof Persistent) {
              $this->aUsuarioPadre->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

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
        return (string) $this->exportTo(DevicePeer::DEFAULT_STRING_FORMAT);
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
     * @return     Device The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = DevicePeer::UPDATED_AT;

        return $this;
    }

}
