<?php

namespace App\Libs;
use \PDO;

class Database {
	/** @var null|PDO $db */
	private $db = null;
	/** @var string $exception */
	private $exception = '';

	/** Database constructor. */
	public function __construct($dbname = null, $host = null, $user = null, $pass = null) {
		try {
			if($dbname === null || $host === null || $user === null || $pass === null) {
				$this->db = new PDO(
					'mysql:dbname='.DBNAME.';host='.HOST,
					USER,
					PASS,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
				);
			} else {
				$this->db = new PDO(
					'mysql:dbname='.$dbname.';host='.$host,
					$user,
					$pass,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
				);
			}
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e) {
			$this->exception = $e->getMessage();
		}
	}
	
	/**
	 * SELECT method that returns an array of objects for a given class name.
	 * @param $class - class name.
	 * @param $query - sql query without parameters.
	 * @param $params - array of parameters for binding.
	 * @return $class[] - array of objects.
	 */
	public function select($class, $query, $params = []) {
		$result = $this->db->prepare($query);
		
		foreach($params as $key => &$val)
			$result->bindParam($key, $val);
		$result->execute();

		Factory::autoload($class);
		$result->setFetchMode(PDO::FETCH_CLASS, $class);
		$arr = [];
		while($object = $result->fetch())
			array_push($arr, $object);
		return $arr;
	}

	/**
	 * SELECT method that returns the first row.
	 * @param $query - sql query without parameters.
	 * @param $params - array of parameters for binding.
	 * @return mixed
	 */
	public function selectQuery($query, $params = []) {
		$result = $this->db->prepare($query);
	
		foreach($params as $key => &$val)
			$result->bindParam($key, $val);

		$result->execute();
		$result = $result->fetch();
		return $result;
	}

	/**
	 * INSERT method that executes if there's no data in the database with the
	 * same data.
	 * @param $class - class name
	 * @param $query_insert
	 * @param $query_select
	 * @param $params_insert - array of parameters for binding the insert query
	 * @param $params_select - array of parameters for binding the select query
	 * @return bool
	 */
	public function insert($class, $query_insert, $params_insert = [], $query_select = '', $params_select = []) {
		if(strlen($query_select) > 0) {
			if(count(self::select($class, $query_select, $params_select)) > 0)
				return false;
		}
		$result = $this->db->prepare($query_insert);

		foreach($params_insert as $key => &$val)
			$result->bindParam($key, $val);
		
		return $result->execute();
	}

    /**
     * UPDATE method updates data in the database if it can find such data.
     * @param $class
     * @param $query_update
     * @param $params_update
     * @param string $query_select
     * @param array $params_select
     * @return mixed|null
     */
	public function update($class, $query_update, $params_update, $query_select = '', $params_select = []) {
		$this->result = $this->db->prepare($query_update);
		
		foreach($params_update as $key => &$val)
			$this->result->bindParam($key, $val);
		$this->result->execute();
		$arr = [];
		if(strlen($query_select) > 0) {
			$arr = self::select($class, $query_select, $params_select);
			if(count($arr) === 0)
				return null;
		}
		foreach($arr as $a)
			return $a;
		return null;
	}
	/**
	 * DELETE method deletes data from the database.
	 * @param $table
	 * @param $query
	 * @param $params_delete
	 * @return bool
	 */
	public function delete($query, $params_delete = []) {
		$result = $this->db->prepare($query);

		foreach($params_delete as $key => &$val)
			$result->bindParam($key, $val);
		$result->execute();
		return true;
	}

	/**
	 * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
	 * Initiates a transaction.
	 * @link http://php.net/manual/en/pdo.begintransaction.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function beginTransaction() {
		return $this->db->beginTransaction();
	}

	/**
	 * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
	 * Commits a transaction.
	 * @link http://php.net/manual/en/pdo.commit.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function commit() {
		return $this->db->commit();
	}

	/**
	 * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
	 * Rolls back a transaction.
	 * @link http://php.net/manual/en/pdo.rollback.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function rollBack() {
		return $this->db->rollBack();
	}

	/**
	 * (PHP 5 &gt;= 5.1.0, PECL pdo &gt;= 0.1.0)<br/>
	 * Returns the ID of the last inserted row or sequence value
	 * @link http://php.net/manual/en/pdo.lastinsertid.php
	 * @param string $name [optional] <p>
	 * Name of the sequence object from which the ID should be returned.
	 * </p>
	 * @return string If a sequence name was not specified for the <i>name</i>
	 * parameter, <b>PDO::lastInsertId</b> returns a
	 * string representing the row ID of the last row that was inserted into
	 * the database.
	 * </p>
	 * <p>
	 * If a sequence name was specified for the <i>name</i>
	 * parameter, <b>PDO::lastInsertId</b> returns a
	 * string representing the last value retrieved from the specified sequence
	 * object.
	 * </p>
	 * <p>
	 * If the PDO driver does not support this capability,
	 * <b>PDO::lastInsertId</b> triggers an
	 * IM001 SQLSTATE.
	 */
	public function lastInsertId($name = null) {
		if($name === null)
			return $this->db->lastInsertId();
		else
			return $this->db->lastInsertId($name);
	}
}