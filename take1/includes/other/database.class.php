<?PHP
require_once("DB.php");
require_once("/home/onsale/include/master_functions.php");

define("FDB_CONFIG", "db.config.php");

define("FDB_TYPE_ONE", "One");
define("FDB_TYPE_ROW", "Row");
define("FDB_TYPE_COLUMN", "Col");
define("FDB_TYPE_ALL", "All");

define("FDB_MAX_QUERY", "select max(!) from ! !");
define("FDB_LAST_ID", "SELECT LAST_INSERT_ID()");
define("FDB_VALUE_QUERY", "select ! from ! !");
define("FDB_ROW_QUERY", "select * from ! !");
define("FDB_COLUMN_QUERY", FDB_VALUE_QUERY);
define("FDB_SHOW_INDEX_QUERY", "show index from !");
define("FDB_SET_VARIABLE", "set @! = ?");

/**
 * Sets up the database for the scripts.
 *
 * This is our own instantiation of the database class. It is a re-write of previous classes,
 * but this one inherits from PEAR, so it is fully abstracted.
 *
 * @copyright 2006 OrbSix LLC
 */
class database {
	public $result;
	public $pear_db;
    public $object = "";
    public $row_count;
    public $last_id=0;
    public $last_error;

	/**
	 * Constructor for the class.
	 *
	 * The connection info can be in one of two forms. Either a string that specifies the
	 * connection values in the form of "mysql://user:password@localhost/database" or an
	 * associate array that has all the key=>value pairs: 
	 * 
	 * <title></title><code> 
	 * $dsn = "mysql://user:password@localhost/database"; 
	 * // or 
	 * $dsn = array( 		
	 * 		'phptype'	 => 'mysql', 
	 * 		'username'   => 'my_db_user', 		
	 * 		'password'	 => 'password12', 
	 * 		'hostspec'	 => 'localhost', 
	 * 		'database'	 => 'super_db' );
	 *
	 * $db = new database($dsn);
	 * </code>
	 * <br>
	 * 
	 * These values can either be passed in through the constructor, or you can specify
	 * a config file that holds the $dsn connection variable. If you pass nothing into
	 * the constructor, the class will look for "db.config.php" in the DOCUMENT_ROOT and
	 * then DOCUMENT_ROOT/include of the current script.
	 * 
	 * <code>
	 * // this will automatically include the file "db.config.php" which should contain
	 * // the $dsn variable.
	 * $db = new database();
	 * </code>
	 * 
	 * @link http://pear.php.net/manual/en/package.database.db.intro-dsn.php DB::DSN
	 * @link http://pear.php.net/manual/en/package.database.db.intro-connect.php DB::Connect
	 *
	 * @param mixed [$dsn]				Connection info.
	 */
	function __construct($dsn = "") {
		global $_mp_document_root, $_mp_custom_path;
		$dsn_passed_in = false;
        $new_db = false;
        
		if (!isset($GLOBALS["_master_pear_db"]) or !empty($dsn)) {
			$new_db = true;
		}
		
		if (!empty($dsn)) {
			$dsn_passed_in = true;
		}
		
        if (!$dsn_passed_in and $new_db) {
			$config = FDB_CONFIG;
            if(file_exists($_mp_document_root."/".$config)) {
                include($_mp_document_root."/".$config);
            } elseif(file_exists($_mp_document_root."/include/".$config)) {
                include($_mp_document_root."/include/".$config);
            } elseif(file_exists($_mp_custom_path."/include/".$config)) {
                include($_mp_custom_path."/include/".$config);
			} elseif(file_exists($_mp_document_root."/../include/".$config)) {
                include($_mp_document_root."/../include/".$config);
			}
        } elseif ($dsn_passed_in and !is_array($dsn)) {
            if(file_exists($_mp_document_root."/".$dsn)) {
                include($_mp_document_root."/".$dsn);
			} else {
				@include($dsn);
            }
		}
		
		if ($new_db) {
			if(isset($dsn["crypt_passkey"])) {
				$crypt_passkey = $dsn["crypt_passkey"];
			} else {
				$crypt_passkey = "p2a4s6s8k0e1y3";
			}
			
			$options = array(
				'debug'	=> @$_SESSION["_DEBUG"],
				'portability' => DB_PORTABILITY_ALL
			);

			if (!$dsn_passed_in) {
				$GLOBALS["_master_pear_db"] =& DB::connect($dsn, $options);
				$this->pear_db =& $GLOBALS["_master_pear_db"];
			} else {
				$this->pear_db =& DB::connect($dsn, $options);
			}
			
			if (PEAR::isError($this->pear_db)) {
				$this->error($this->pear_db);
			}
			
			$this->query("SET NAMES 'utf8'");
			$this->set_crypt_passkey($crypt_passkey);
			
			if(@$db_values) {
				foreach($db_values as $key=>$value) {
					$this->set_sql_variable($key, $value);
					define("DATABASE_" . strtoupper($key), $value);
				}
			}
		} else {
			$this->pear_db =& $GLOBALS["_master_pear_db"];
		}
		
		unset($dsn);		
	}
	//--------------------------------------------------------------------------------
	
    /**
     * Sets the object that the queries will return.
     *
     * @param string $object_name 		The name of the class to return from the query.
     */
    function set_object($object_name) {
		$this->object = $object_name;
	}
    //--------------------------------------------------------------------------------
    
    /**
     * Passes a select statement to the database and retrieves the results.
     *
     * @param string $query 			String that holds the incoming query.
	 * @param mixed [$arguments] 		Either an array with the arguments, or individual values.
     *
     * @return mixed 					The resultset that came back from the query.
     */
    function &query($query) {
        $arguments = "";
        if (func_num_args() > 1) {
            $arguments = func_get_args();
            array_shift($arguments); // pull the query off the top
            if(is_array($arguments[0])) {
                $arguments = $arguments[0];
            }
        }
        
        if(empty($this->object)) {
            if(empty($arguments)) {
                $this->array_query($query);
            } else {
                $this->array_query($query, $arguments);
            }
        } else {
            if(empty($arguments)) {
                $this->object_query($this->object, $query);
            } else {
                $this->object_query($this->object, $query, $arguments);
            }
        }            

		unset($arguments);

        return $this->result;
    }
    //--------------------------------------------------------------------------------
    
	/**
     * Passes a select statement to the database and retrieve the results.
	 *
	 * @param string $query 			String that holds the incoming query.
	 * @param mixed [$arguments]  		Either an array with the arguments, or individual values.
	 *
	 * @return array 					The resultset that came from the query with each row being 
	 *									an array.
	 */
	function &array_query($query) {
		$_start = microtime(true);
		
		$this->pear_db->setFetchMode(DB_FETCHMODE_ASSOC);

		$this->clean_query($query);
		if (func_num_args() > 1) {
			$arguments = func_get_args();
			array_shift($arguments); // pull the query off the top
			if(is_array($arguments[0])) {
				$arguments = $arguments[0];
			}

        	$this->parse_query($query, $arguments);
			$this->result =& $this->pear_db->query($query, $arguments);
			/*if(substr(strtolower(trim($query)), 0, 6) == "insert") {
				$this->last_id = $this->query_field(FDB_LAST_ID);
			}*/

			unset($arguments);
		} else {
			$this->result =& $this->pear_db->query($query);
		}

		if(PEAR::isError($this->result)) {
			$this->error($this->result);
		}
		
		if(is_object($this->result)) {
			$this->row_count = $this->result->numRows();
		}

		//debug_track("_mp_queries", array("q"=>str_replace("\n", "", $query), "t"=>microtime(true)-$_start, "f"=>"base"));

		return $this->result;
	}
	//--------------------------------------------------------------------------------

	/**
	 * Passes a select statement to the database and retrieve the results.
	 *
	 * @param string $object_name   	Name of the class to return as the object. can be 
	 *									const DB_row.
	 * @param string $query   			String that holds the incoming query.
	 * @param mixed [$arguments]  		Either an array with the arguments, or individual values.
	 *
	 * @return object  					Result object that holds the results of the query.
	 */
	function &object_query($object_name, $query) {
		$_start = microtime(true);
		
		$this->pear_db->setFetchMode(DB_FETCHMODE_OBJECT, $object_name);

		$this->clean_query($query);
		if (func_num_args() > 2) {
			$arguments = func_get_args();
			array_shift($arguments); // pull the object off the top
			array_shift($arguments); // pull the query off the top
			if(is_array($arguments[0])) {
				$arguments = $arguments[0];
			}

        	$this->parse_query($query, $arguments);
			$this->result =& $this->pear_db->query($query, $arguments);
			
			/*if(substr(strtolower(trim($query)), 0, 6) == "insert") {
				$this->last_id = $this->query_field(FDB_LAST_ID);
			}*/
		} else {
			$this->result =& $this->pear_db->query($query);
		}

		if(PEAR::isError($this->result)) {
			$this->error($this->result);
		}

		if(is_object($this->result)) {
			$this->row_count = $this->result->numRows();
		}

		//debug_track("_mp_queries", array("q"=>str_replace("\n", "", $query), "t"=>microtime(true)-$_start, "f"=>"base"));

		return $this->result;
	}
	//--------------------------------------------------------------------------------

	/**
 	 * Fetches a row from the current result-set, based on the current fetchMode.
	 *
	 * @return mixed  					An array or object containing the row's data, NULL at end. 
	 */
	function &fetch_row() {
		$row =& $this->result->fetchRow();
		
		if(PEAR::isError($row)) {
			$this->error($row);
		}

		return $row;
	}
	//--------------------------------------------------------------------------------

	/**
 	 * Fetches first field from the current result set.
	 *
	 * @return mixed 					The value from a single field. 
	 */
	function fetch_field() {
		$row =& $this->result->fetchRow();
		
		if(PEAR::isError($row)) {
			$this->error($row);
		}
		
		if(!empty($row)) {
			$field = array_shift($row);
		} else {
			$field = null;
		}
		
		return $field;
	}
	//--------------------------------------------------------------------------------

	/**
	 * Closes an open recordset.
	 *
	 */
	function free_result() {
	    if(isset($this->result)) {
	    	if(get_class($this->result) == "db_result") {
				$this->result->free();
	    	}
			unset($this->result);
		}
	}
	//--------------------------------------------------------------------------------

	/**
	 * Returns the first returned value from the first field, that comes back from a query.
	 *
	 * @param string $query 			The query to run on the database.
	 * @param mixed [$arguments] 		Either an array with the arguments, or individual values.
	 *
	 * @return mixed 					The result from the query.
	 */
	function query_field($query) {
        $arguments = func_get_args();
 		$value =& $this->query_base("", $arguments, FDB_TYPE_ONE);
	    
		return $value;
	}
	//--------------------------------------------------------------------------------

	/**
	 * Returns the first row from a table, based on the query, with optional arguments.
	 *
	 * @param string $query     		The query to run on the database.
	 * @param mixed [$arguments]     	Either an array with the arguments, or individual values.
	 *
	 * @return mixed 					The result from the query.
	 */
	function &query_row($query) {
        $arguments = func_get_args();
		$row =& $this->query_base("", $arguments, FDB_TYPE_ROW);
	    
		return $row;
	}
	//--------------------------------------------------------------------------------
    
	/**
	 * Returns the first row from a table, based on the query, with optional arguments.
	 *
	 * @param string $query     		The query to run on the database.
	 * @param mixed [$arguments]  		Either an array with the arguments, or individual values.
	 *
	 * @return mixed 					The result from the query.
	 */
    function &query_all($query) {
        $arguments = func_get_args();
		$all =& $this->query_base("", $arguments, FDB_TYPE_ALL);
	    
		return $all;    	
    }
	//--------------------------------------------------------------------------------
    
    /**
	 * Short Description.
	 *
	 * Long Description. (optional)
	 *
	 * @param type $name  description
	 *
	 * @return type description
	 */
	function &limit_query_all($query, $start, $rows) {
		$arguments = func_get_args();
		array_shift($arguments); // query off the top
		array_shift($arguments); // start off the top
		array_shift($arguments); // rows off the top
		if(is_array($arguments[0])) {
			$arguments = $arguments[0];
		}
		
		$this->query($query, $arguments);

		if(!isset($start)) {
			$start = 0;
		}
		
		if(!isset($rows)) {
			$rows = 25;
		}
		
		$query = trim($query, "; \n\r\t\0") . " limit $start, $rows";
		$arguments = array_merge(array($query), $arguments);
		
		$all =& $this->query_base("", $arguments, FDB_TYPE_ALL);
		return $all;
	}
	//--------------------------------------------------------------------------------
	
	/**
	 * Returns the first column from a table, based on the query, with optional arguments.
	 *
	 * @param string $query  			The query to run on the database.
	 * @param mixed [$arguments]  		Either an array with the arguments, or individual values.
	 *
	 * @return mixed 					The result from the query.
	 */
	function &query_column($query) {
        $arguments = func_get_args();
		$column =& $this->query_base("", $arguments, FDB_TYPE_COLUMN);
	    
		return $column;
	}
	//--------------------------------------------------------------------------------

    /**
     * Returns the first row from a table as an object, based on the query, with 
     * optional arguments.
     *
     * @param string $object_name  		The name of the class to return.
     * @param string $query        		The query to run on the database.
     * @param mixed [$arguments]   		Either an array with the arguments, or individual values.
     *
     * @return mixed 					The result from the query.
     */
    function &object_query_row($object_name, $query) {
        $arguments = func_get_args();
        array_shift($arguments); // pull the object off the top
        $row =& $this->query_base($object_name, $arguments, FDB_TYPE_ROW);
        
        return $row;
    }
    //--------------------------------------------------------------------------------
    
    /**
     * Returns the first row from a table as an object, based on the query, with 
     * optional arguments
     *
     * @param string $object_name  		The name of the class to return.
     * @param string $query        		The query to run on the database.
     * @param mixed [$arguments]   		Either an array with the arguments, or individual values.
     *
     * @return mixed 					The result from the query.
     */
    function &array_query_row($object_name, $query) {
        $arguments = func_get_args();
        $row =& $this->query_base("", $arguments, FDB_TYPE_ROW, DB_FETCHMODE_ASSOC);
        
        return $row;
    }
    //--------------------------------------------------------------------------------

	/**
	 * Internal function used by query_value(), query_column(), query_row().
	 *
	 * @param array $arguments  		An array that includes the query and the args.
	 * @param string $type 				The type of query:  FDB_TYPE_ONE | FDB_TYPE_ROW | FDB_TYPE_COLUMN.
     * @param mixed $arguments  		Either an array with the arguments, or individual values.
	 * @param sting [$mode]				The fetch mode; DB_FETCHMODE_ASSOC | DB_FETCHMODE_OBJECT.
	 *
	 * @return mixed 					The result from the query.
	 */
	function &query_base($object_name, $arguments, $type, $mode = "") {
 		$_start = microtime(true);

		if($mode == DB_FETCHMODE_ASSOC) {
			$this->pear_db->setFetchMode(DB_FETCHMODE_ASSOC);
		} elseif(empty($this->object) and empty($object_name) and empty($mode)) {
            $this->pear_db->setFetchMode(DB_FETCHMODE_ASSOC);
        } else {
			if(empty($object_name) and empty($this->object)) {
			    $object_name = "DB_row";
			} elseif (empty($object_name)) {
				$object_name = $this->object;
			}
			$this->pear_db->setFetchMode(DB_FETCHMODE_OBJECT, $object_name);
        }
            
		$query = array_shift($arguments); // pull the query of the top

		$function = "get" . $type;

		$this->clean_query($query);
		if (count($arguments)) {
			if(is_array(@$arguments[0])) {
				$arguments = $arguments[0];
			}

        	$this->parse_query($query, $arguments);
			if($type == FDB_TYPE_COLUMN) {
				$value =& $this->pear_db->$function($query, 0, $arguments);
			} else {
				$value =& $this->pear_db->$function($query, $arguments);
			}
		} else {
			$value =& $this->pear_db->$function($query);
		}

		if(PEAR::isError($value)) {
			$this->error($value);
		}

		//debug_track("_mp_queries", array("q"=>str_replace("\n", "", $query), "t"=>microtime(true)-$_start, "f"=>"base"));

	    return $value;
	}
	//--------------------------------------------------------------------------------
	
	/**
	 * Returns the primary key for the table that belongs to this object.
	 *
	 * @return string 					The name of the primary key.
	 */
	function get_primary_key($table_name) {
		$primary_key = "";

		$this->query(FDB_SHOW_INDEX_QUERY, $table_name);
		while(($row =& $this->fetch_row()) and $primary_key == "") {
			if($row["key_name"] == 'PRIMARY') {
				$primary_key = $row["column_name"];
			}
		}

		$this->free_result();
		return($primary_key);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Returns the last ID in the database. 
	 *
	 * This function gets the Last ID created in the database for this object type. This can be used
	 * to learn the ID of a new object, or to learn what the next ID should be.
	 *
	 * @return mixed 					The last ID in the database.
	 */
	function get_last_id($table_name = "") {
		if(!$this->last_id) {
			if (trim($table_name)=="") {
				$this->last_id = $this->query_field(FDB_LAST_ID);
			} else {
				$this->last_id = $this->query_field(FDB_MAX_QUERY, $this->get_primary_key($table_name),
											  $table_name, ""); // the final "" gets rid of the where clause
			}
		}
		return $this->last_id;
	} 
	//--------------------------------------------------------------------------------

	/**
	 * Shows the last query that was run. Handy when trying to debug a problem
	 * with a query.
	 * 
	 * @return string					The last query that was run.
	 */
	function show_query() {
		echo($this->pear_db->last_query);
	}
	//--------------------------------------------------------------------------------	

	/**
	 * Set the AES Encryption and Description passkey.
	 *
	 * Once the passkey is set, you can call AES_ENCRYPT without passing the passkey over
	 * the wire. You can then call it like this AES_ENCRYPT('my text', @aes_passkey).
	 *
	 * @param string $crypt_passkey 	The passkey to set as a SQL variable.
	 */
	function set_crypt_passkey($crypt_passkey) {
		$this->set_sql_variable("crypt_passkey", $crypt_passkey);
	}
	//--------------------------------------------------------------------------------
	
	/**
	 * Sets a sql variable for future use. The variable will live for the life of the
	 * connection.
	 *
	 * @param string $name 				The name for the sql variable.
	 * @param string $value 			The value to give to the sql variable.
	 */
	function set_sql_variable($name, $value) {
		$this->query(FDB_SET_VARIABLE, $name, $value);
		$this->free_result();
	}
	//--------------------------------------------------------------------------------
	
	/**
	 * Spits all the entire call stack and shows the error.
	 *
	 * @param string $error 		    Error to display.  
	 */
	function error($error) {
		global $__sql_error;
		$__sql_error = $error->userinfo;

		if(@$_SESSION["_DEBUG"] or @$_SERVER["SHELL"]) {
			$error_string = str_replace("{", "&#123;", str_replace("}", "&#125;", $error->userinfo));
			throw new exception("SQL ERROR: <pre>" . $error_string . "</pre>");
		} elseif($_GET["rest_debug"]) {
			throw new exception("SQL ERROR: \n<![CDATA[\n" . $error->userinfo . "\n]]>\n");
		} else {
			throw new exception("SQL ERROR. A notice has been sent to the admin.");
		}
		
		$this->last_error = $error;
	}
	//--------------------------------------------------------------------------------
	
	/**
	 * Parses the query.
	 */
	function parse_query(&$query, &$parameters) {
		$reworked = array();

		if(is_associative_array($parameters)) {
			$done = false;
			$start = 0;
			while(!$done) {
				$start_pos = strpos($query, "{", $start);
				$end_pos = strpos($query, "}", $start_pos);
				
				if($start_pos and $end_pos) {
					$bit = "?";
					$name = substr($query, $start_pos+1, ($end_pos-$start_pos)-1);
					if(substr($name, 0, 1) == "!") {
						$name = substr($name, 1);
						$bit = "!";
					}

					if(isset($parameters[$name])) {
						$reworked[] = @$parameters[$name];

						if(substr($query, $start_pos-1, 1) == "'" and substr($query, $end_pos+1, 1) == "'") {
							$start_pos--;
							$end_pos++;
						}

						$query = substr($query, 0, $start_pos) . $bit . substr($query, $end_pos+1);
					} else {
						$start = $start_pos+1;
					}
				} else {
					$done = true;
				}
			}

			$parameters = $reworked;
		}
	}
	
	/**
	 * Short Description.
	 *
	 * Long Description. (optional)
	 *
	 * @param type $name  description
	 *
	 * @return type description
	 */
	public function clean_query(&$query) {
		if($this->pear_db->dbsyntax == "mysql" or $this->pear_db->dbsyntax == "mysqli") {
			/*$query = str_replace("[", "`", $query);
			$query = str_replace("]", "`", $query);*/
		} elseif($this->pear_db->dbsyntax == "oci8") { // oracle
			/*$query = str_replace("[", "'", $query);
			$query = str_replace("]", "'", $query);*/
			$query = str_replace("`", "'", $query);
		}
	}
	//--------------------------------------------------------------------------------

	/**
	 * Returns the select field names.
	 *
	 * @return array the field names from the query
	 */
	function get_table_info() {
		$info = $this->pear_db->tableInfo($this->result);
		
		return $info;
	}
	//--------------------------------------------------------------------------------

}
?>
