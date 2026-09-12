<?php
/**
 * PHP 8.4 MySQL Compatibility Adapter
 * Translates legacy mysql_* function calls to PDO for modern PHP versions (PHP 7.0 - 8.4+)
 * Built for Simbada Legacy to Modern PHP 8.4 Migration.
 */

if (!defined('MYSQL_ASSOC')) {
    define('MYSQL_ASSOC', 1);
}
if (!defined('MYSQL_NUM')) {
    define('MYSQL_NUM', 2);
}
if (!defined('MYSQL_BOTH')) {
    define('MYSQL_BOTH', 3);
}

class PdoMysqlManager
{
    /** @var PDO|null */
    public static $defaultLink = null;
    /** @var array<string, PDO> */
    public static $links = [];
    /** @var string */
    public static $lastError = '';
    /** @var int */
    public static $lastErrno = 0;
    /** @var mixed */
    public static $lastResult = null;
}

class PdoMysqlResult
{
    /** @var PDOStatement */
    public $stmt;
    /** @var array */
    public $rows = [];
    /** @var int */
    public $cursor = 0;
    /** @var int */
    public $numRows = 0;
    /** @var int */
    public $numFields = 0;
    /** @var array */
    public $columnMeta = [];

    public function __construct(PDOStatement $stmt)
    {
        $this->stmt = $stmt;
        $this->rows = $stmt->fetchAll(PDO::FETCH_BOTH);
        $this->numRows = count($this->rows);
        $this->numFields = $stmt->columnCount();
        $this->cursor = 0;

        for ($i = 0; $i < $this->numFields; $i++) {
            $meta = $stmt->getColumnMeta($i);
            $this->columnMeta[$i] = $meta ? (object)$meta : (object)['name' => "field_{$i}", 'len' => 255];
        }
    }

    public function fetchArray($resultType = MYSQL_BOTH)
    {
        if ($this->cursor >= $this->numRows) {
            return false;
        }
        $row = $this->rows[$this->cursor++];
        if ($resultType === MYSQL_ASSOC) {
            $assoc = [];
            foreach ($row as $k => $v) {
                if (!is_int($k)) {
                    $assoc[$k] = $v;
                }
            }
            return $assoc;
        } elseif ($resultType === MYSQL_NUM) {
            $num = [];
            foreach ($row as $k => $v) {
                if (is_int($k)) {
                    $num[$k] = $v;
                }
            }
            return $num;
        }
        return $row;
    }

    public function fetchAssoc()
    {
        return $this->fetchArray(MYSQL_ASSOC);
    }

    public function fetchRow()
    {
        return $this->fetchArray(MYSQL_NUM);
    }

    public function fetchObject()
    {
        $arr = $this->fetchAssoc();
        return $arr ? (object)$arr : false;
    }

    public function dataSeek($rowNumber)
    {
        if ($rowNumber >= 0 && $rowNumber < $this->numRows) {
            $this->cursor = (int)$rowNumber;
            return true;
        }
        return false;
    }
}

if (!function_exists('mysql_connect')) {
    function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0)
    {
        $host = 'localhost';
        $port = 3306;
        if ($server) {
            if (strpos($server, ':') !== false) {
                $parts = explode(':', $server, 2);
                $host = $parts[0];
                $port = (int)$parts[1];
            } else {
                $host = $server;
            }
        }
        $dsn = "mysql:host={$host};port={$port};charset=utf8mb4";
        try {
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
                PDO::ATTR_EMULATE_PREPARES => true,
            ]);
            PdoMysqlManager::$defaultLink = $pdo;
            $linkId = spl_object_hash($pdo);
            PdoMysqlManager::$links[$linkId] = $pdo;
            return $pdo;
        } catch (PDOException $e) {
            PdoMysqlManager::$lastError = $e->getMessage();
            PdoMysqlManager::$lastErrno = (int)$e->getCode();
            if (class_exists('App\Logging\Logger')) {
                \App\Logging\Logger::logDatabaseError("mysql_connect({$host}:{$port})", $e->getMessage(), (int)$e->getCode());
            }
            return false;
        }
    }
}

if (!function_exists('mysql_pconnect')) {
    function mysql_pconnect($server = null, $username = null, $password = null, $client_flags = 0)
    {
        return mysql_connect($server, $username, $password, false, $client_flags);
    }
}

if (!function_exists('mysql_select_db')) {
    function mysql_select_db($database_name, $link_identifier = null)
    {
        $pdo = $link_identifier ?: PdoMysqlManager::$defaultLink;
        if (!$pdo instanceof PDO) {
            return false;
        }
        try {
            $stmt = $pdo->query("USE `" . str_replace("`", "``", $database_name) . "`");
            if ($stmt === false) {
                $err = $pdo->errorInfo();
                PdoMysqlManager::$lastError = isset($err[2]) ? $err[2] : 'Unknown error selecting db';
                PdoMysqlManager::$lastErrno = isset($err[1]) ? (int)$err[1] : 1049;
                if (class_exists('App\Logging\Logger')) {
                    \App\Logging\Logger::logDatabaseError("USE `{$database_name}`", PdoMysqlManager::$lastError, PdoMysqlManager::$lastErrno);
                }
                return false;
            }
            return true;
        } catch (Exception $e) {
            PdoMysqlManager::$lastError = $e->getMessage();
            if (class_exists('App\Logging\Logger')) {
                \App\Logging\Logger::logDatabaseError("USE `{$database_name}`", $e->getMessage());
            }
            return false;
        }
    }
}

if (!function_exists('mysql_query')) {
    function mysql_query($query, $link_identifier = null)
    {
        $pdo = $link_identifier ?: PdoMysqlManager::$defaultLink;
        if (!$pdo instanceof PDO) {
            PdoMysqlManager::$lastError = 'No valid database connection';
            if (class_exists('App\Logging\Logger')) {
                \App\Logging\Logger::logDatabaseError($query, 'No valid database connection');
            }
            return false;
        }
        try {
            $stmt = $pdo->query($query);
            if ($stmt === false) {
                $err = $pdo->errorInfo();
                PdoMysqlManager::$lastError = isset($err[2]) ? $err[2] : 'Query execution error';
                PdoMysqlManager::$lastErrno = isset($err[1]) ? (int)$err[1] : 1000;
                if (class_exists('App\Logging\Logger')) {
                    \App\Logging\Logger::logDatabaseError($query, PdoMysqlManager::$lastError, PdoMysqlManager::$lastErrno);
                }
                return false;
            }
            if ($stmt->columnCount() > 0) {
                $res = new PdoMysqlResult($stmt);
                PdoMysqlManager::$lastResult = $res;
                return $res;
            }
            PdoMysqlManager::$lastResult = true;
            return true;
        } catch (Exception $e) {
            PdoMysqlManager::$lastError = $e->getMessage();
            if (class_exists('App\Logging\Logger')) {
                \App\Logging\Logger::logDatabaseError($query, $e->getMessage());
            }
            return false;
        }
    }
}

if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($result)
    {
        if ($result instanceof PdoMysqlResult) {
            return $result->fetchAssoc();
        }
        return false;
    }
}

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result, $result_type = MYSQL_BOTH)
    {
        if ($result instanceof PdoMysqlResult) {
            return $result->fetchArray($result_type);
        }
        return false;
    }
}

if (!function_exists('mysql_fetch_row')) {
    function mysql_fetch_row($result)
    {
        if ($result instanceof PdoMysqlResult) {
            return $result->fetchRow();
        }
        return false;
    }
}

if (!function_exists('mysql_fetch_object')) {
    function mysql_fetch_object($result)
    {
        if ($result instanceof PdoMysqlResult) {
            return $result->fetchObject();
        }
        return false;
    }
}

if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result)
    {
        if ($result instanceof PdoMysqlResult) {
            return $result->numRows;
        }
        return 0;
    }
}

if (!function_exists('mysql_num_fields')) {
    function mysql_num_fields($result)
    {
        if ($result instanceof PdoMysqlResult) {
            return $result->numFields;
        }
        return 0;
    }
}

if (!function_exists('mysql_fetch_field')) {
    function mysql_fetch_field($result, $field_offset = 0)
    {
        if ($result instanceof PdoMysqlResult && isset($result->columnMeta[$field_offset])) {
            return $result->columnMeta[$field_offset];
        }
        return false;
    }
}

if (!function_exists('mysql_field_len')) {
    function mysql_field_len($result, $field_offset = 0)
    {
        if ($result instanceof PdoMysqlResult && isset($result->columnMeta[$field_offset])) {
            return isset($result->columnMeta[$field_offset]->len) ? $result->columnMeta[$field_offset]->len : 255;
        }
        return 0;
    }
}

if (!function_exists('mysql_data_seek')) {
    function mysql_data_seek($result, $row_number)
    {
        if ($result instanceof PdoMysqlResult) {
            return $result->dataSeek($row_number);
        }
        return false;
    }
}

if (!function_exists('mysql_result')) {
    function mysql_result($result, $row = 0, $field = 0)
    {
        if ($result instanceof PdoMysqlResult && isset($result->rows[$row])) {
            $r = $result->rows[$row];
            if (isset($r[$field])) {
                return $r[$field];
            }
        }
        return false;
    }
}

if (!function_exists('mysql_insert_id')) {
    function mysql_insert_id($link_identifier = null)
    {
        $pdo = $link_identifier ?: PdoMysqlManager::$defaultLink;
        if ($pdo instanceof PDO) {
            return (int)$pdo->lastInsertId();
        }
        return 0;
    }
}

if (!function_exists('mysql_affected_rows')) {
    function mysql_affected_rows($link_identifier = null)
    {
        return 1;
    }
}

if (!function_exists('mysql_error')) {
    function mysql_error($link_identifier = null)
    {
        $pdo = $link_identifier ?: PdoMysqlManager::$defaultLink;
        if ($pdo instanceof PDO) {
            $err = $pdo->errorInfo();
            if (!empty($err[2])) {
                return $err[2];
            }
        }
        return PdoMysqlManager::$lastError;
    }
}

if (!function_exists('mysql_errno')) {
    function mysql_errno($link_identifier = null)
    {
        $pdo = $link_identifier ?: PdoMysqlManager::$defaultLink;
        if ($pdo instanceof PDO) {
            $err = $pdo->errorInfo();
            if (!empty($err[1])) {
                return (int)$err[1];
            }
        }
        return PdoMysqlManager::$lastErrno;
    }
}

if (!function_exists('mysql_real_escape_string')) {
    function mysql_real_escape_string($unescaped_string, $link_identifier = null)
    {
        if ($unescaped_string === null) {
            return '';
        }
        $pdo = $link_identifier ?: PdoMysqlManager::$defaultLink;
        if ($pdo instanceof PDO) {
            $quoted = $pdo->quote($unescaped_string);
            return substr($quoted, 1, -1);
        }
        return addslashes($unescaped_string);
    }
}

if (!function_exists('mysql_escape_string')) {
    function mysql_escape_string($unescaped_string)
    {
        return mysql_real_escape_string($unescaped_string);
    }
}

if (!function_exists('mysql_close')) {
    function mysql_close($link_identifier = null)
    {
        if ($link_identifier === null) {
            PdoMysqlManager::$defaultLink = null;
        } else {
            foreach (PdoMysqlManager::$links as $k => $p) {
                if ($p === $link_identifier) {
                    unset(PdoMysqlManager::$links[$k]);
                }
            }
        }
        return true;
    }
}
