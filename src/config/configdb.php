<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'portal');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE)
		or die ('Could not connect to the database server' . mysqli_connect_error());
	mysqli_set_charset( $db, 'utf8' );

/*
https://www.w3schools.com/php/php_ref_mysqli.asp
PHP 5 MySQLi Functions
Function 	Description
mysqli_affected_rows() 	Returns the number of affected rows in the previous MySQL operation
mysqli_autocommit() 	Turns on or off auto-committing database modifications
mysqli_change_user() 	Changes the user of the specified database connection
mysqli_character_set_name() 	Returns the default character set for the database connection
mysqli_close() 	Closes a previously opened database connection
mysqli_commit() 	Commits the current transaction
mysqli_connect_errno() 	Returns the error code from the last connection error
mysqli_connect_error() 	Returns the error description from the last connection error
mysqli_connect() 	Opens a new connection to the MySQL server
mysqli_data_seek() 	Adjusts the result pointer to an arbitrary row in the result-set
mysqli_debug() 	Performs debugging operations
mysqli_dump_debug_info() 	Dumps debugging info into the log
mysqli_errno() 	Returns the last error code for the most recent function call
mysqli_error_list() 	Returns a list of errors for the most recent function call
mysqli_error() 	Returns the last error description for the most recent function call
mysqli_fetch_all() 	Fetches all result rows as an associative array, a numeric array, or both
mysqli_fetch_array() 	Fetches a result row as an associative, a numeric array, or both
mysqli_fetch_assoc() 	Fetches a result row as an associative array
mysqli_fetch_field_direct() 	Returns meta-data for a single field in the result set, as an object
mysqli_fetch_field() 	Returns the next field in the result set, as an object
mysqli_fetch_fields() 	Returns an array of objects that represent the fields in a result set
mysqli_fetch_lengths() 	Returns the lengths of the columns of the current row in the result set
mysqli_fetch_object() 	Returns the current row of a result set, as an object
mysqli_fetch_row() 	Fetches one row from a result-set and returns it as an enumerated array
mysqli_field_count() 	Returns the number of columns for the most recent query
mysqli_field_seek() 	Sets the field cursor to the given field offset
mysqli_field_tell() 	Returns the position of the field cursor
mysqli_free_result() 	Frees the memory associated with a result
mysqli_get_charset() 	Returns a character set object
mysqli_get_client_info() 	Returns the MySQL client library version
mysqli_get_client_stats() 	Returns statistics about client per-process
mysqli_get_client_version() 	Returns the MySQL client library version as an integer
mysqli_get_connection_stats() 	Returns statistics about the client connection
mysqli_get_host_info() 	Returns the MySQL server hostname and the connection type
mysqli_get_proto_info() 	Returns the MySQL protocol version
mysqli_get_server_info() 	Returns the MySQL server version
mysqli_get_server_version() 	Returns the MySQL server version as an integer
mysqli_info() 	Returns information about the most recently executed query
mysqli_init() 	Initializes MySQLi and returns a resource for use with mysqli_real_connect()
mysqli_insert_id() 	Returns the auto-generated id used in the last query
mysqli_kill() 	Asks the server to kill a MySQL thread
mysqli_more_results() 	Checks if there are more results from a multi query
mysqli_multi_query() 	Performs one or more queries on the database
mysqli_next_result() 	Prepares the next result set from mysqli_multi_query()
mysqli_num_fields() 	Returns the number of fields in a result set
mysqli_num_rows() 	Returns the number of rows in a result set
mysqli_options() 	Sets extra connect options and affect behavior for a connection
mysqli_ping() 	Pings a server connection, or tries to reconnect if the connection has gone down
mysqli_prepare() 	Prepares an SQL statement for execution
mysqli_query() 	Performs a query against the database
mysqli_real_connect() 	Opens a new connection to the MySQL server
mysqli_real_escape_string() 	Escapes special characters in a string for use in an SQL statement
mysqli_real_query() 	Executes an SQL query
mysqli_reap_async_query() 	Returns the result from async query
mysqli_refresh() 	Refreshes tables or caches, or resets the replication server information
mysqli_rollback() 	Rolls back the current transaction for the database
mysqli_select_db() 	Changes the default database for the connection
mysqli_set_charset() 	Sets the default client character set
mysqli_set_local_infile_default() 	Unsets user defined handler for load local infile command
mysqli_set_local_infile_handler() 	Set callback function for LOAD DATA LOCAL INFILE command
mysqli_sqlstate() 	Returns the SQLSTATE error code for the last MySQL operation
mysqli_ssl_set() 	Used to establish secure connections using SSL
mysqli_stat() 	Returns the current system status
mysqli_stmt_init() 	Initializes a statement and returns an object for use with mysqli_stmt_prepare()
mysqli_store_result() 	Transfers a result set from the last query
mysqli_thread_id() 	Returns the thread ID for the current connection
mysqli_thread_safe() 	Returns whether the client library is compiled as thread-safe
mysqli_use_result() 	Initiates the retrieval of a result set from the last query executed using the mysqli_real_query()
mysqli_warning_count() 	Returns the number of warnings from the last query in the connection

*/
?>
