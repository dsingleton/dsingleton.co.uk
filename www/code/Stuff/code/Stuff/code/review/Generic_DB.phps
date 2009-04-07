<?php
//------------------------------------------------------------------------------
// Generic DB Functions
//------------------------------------------------------------------------------
// A collection of generic database manipulation functions, to make standard
// actions (such as getting all records in a table, or getting a record by ID)
// substantially quicker and easier.
//
// A lot of standard actions against a Database table 
//------------------------------------------------------------------------------

class Generic_DB
{
//------------------------------------------------------------------------------
// Read 
//------------------------------------------------------------------------------

	// Get the value of a single field from a single row in the table. 
	// The row is based on the match value matching the match field, ie. 
	// the match field would be 'user_id' and the value '2'

	function get_one($table, $match_field, $match_value, $field)
	{
		$record = Genric_DB::get_row($table, $match_field, $match_value, $field);
		return $record[$field];
	}


	// Get a single row from a table, seleced on match field and match 
	// value, as above. 
	
	// Fields needs to be explained somewhere else, as its used in various places.
	
	// You can optionally specify which fields are to be 
	// returned, by default it's ALL fields, to specificy a single field 
	// use a string of the field name, for multiple fields pass an array
	// of field names
	
	function get_row($table, $match_field, $match_value, $fields = false)
	{	
		$match_value = mysql_real_escape_string($match_value);
		$fields = Generic_DB::build_field_list($fields);
		
		$SQL = <<<SQL

SELECT $fields
FROM $table
WHERE $match_field = '$match_value'
LIMIT 1

SQL;
		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		return mysql_fetch_assoc($result);	
	}

	
	
	
	function get_all($table, $order_by = '', $extra_sql = '', $fields = false)
	{
		$fields = Generic_DB::build_field_list($fields);
		
		$SQL = <<<SQL

SELECT $fields
FROM $table
$extra_sql

SQL;
		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		while ($rows[] = mysql_fetch_assoc($result));
		array_pop($rows);

		return $rows;
	}

//------------------------------------------------------------------------------

	function search($table, $page, $per_page, $order_by, $extra_sql = '', $fields = false)
	{
		// Get the total number of records in this table (using the optional extra sql)
		$total_records = Generic_DB::total_records($table, $extra_sql);
		$total_pages = ceil($total_records / $per_page);
		
		// Get the current page and ensure it's valid
		if(intval($page) < 1)	{
			$page = 1;
		}
		elseif($page > $total_pages) {
			$page = $total_pages;
		}
		
		// Start record used in LIMIT
		$start_record = ($page - 1) * $per_page;
		$finish_record = $page * $per_page;
		if($finish_record > $count)   {
			$finish_record = $count;
		}
	
		// Fields - If there's a primary key for this table, we'll assume that it's
		// going to the unique id, and we can grab it by a more generic name
		$fields = Generic_DB::build_field_list($fields);
		if($pri_key = Generic_DB::get_primary_key($table)) {
			$fields .= ", $pri_key AS `id`";
		}
		
		$SQL = <<<SQL
		
SELECT $fields
FROM $table
$extra_sql
ORDER BY $order_by	
LIMIT $start_record, $per_page
		
SQL;
	
		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		
		while ($results[] = mysql_fetch_assoc($result));
		array_pop($results);
	
		$paging = compact('page', 'total_records', 'total_pages', 'per_page');
		$search_results = compact('results', 'paging');
	
		return $search_results;
	}
	
//------------------------------------------------------------------------------
// Write 
//------------------------------------------------------------------------------
	
	function insert($table, $record, $fields, $required = false)
	{
	
		foreach($fields as $field) {
		
			$values[] = mysql_real_escape_string($record[$field]);
		}
		
		$fields_sql = "`" . implode("`, `", $fields) . "`";
		$values_sql = "'" . implode("', '", $values) . "'";
	
		$SQL = <<<SQL
		
INSERT INTO $table
($fields_sql)
VALUES ($values_sql)

SQL;
	
		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		return mysql_insert_id();
	}

//------------------------------------------------------------------------------

	function update($table, $match_field, $id, $record, $fields)
	{
		foreach ($fields as $field) 
		{
			$escaped_value = mysql_real_escape_string($record[$field]);
			$pairs[] = "$field = '$escaped_value'";
		}
		
		$update_sql = implode(', ', $pairs);
		
		$SQL = <<<SQL

	UPDATE `$table` 
	SET $update_sql
	WHERE `$match_field` = '$id'
	LIMIT 1
SQL;

		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		return mysql_affected_rows();
	}
	
	
	function update_one($table, $match, $id, $field, $value)
	{
		$fields = array($field);
		$data = array($field => $value);
		
		return update_generic($table, $fields, $data, $match, $id);
	}
	
//------------------------------------------------------------------------------	
	
	function delete($table, $match_field, $match_value)
	{
		$match_value = mysql_real_escape_string($match_value);
	
		$SQL = <<<SQL
		
		DELETE
		FROM $table
		WHERE $match_field = '$match_value'
SQL;

		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		return mysql_affected_rows();
	}
	
//------------------------------------------------------------------------------
//  Helper / Support Functions
//------------------------------------------------------------------------------

	function get_primary_key($table)
	{
		$SQL = "SHOW COLUMNS FROM `$table`";
		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		
		while ($column = mysql_fetch_assoc($result)) {
			if ($column['Key'] == 'PRI') {
				return $column['Field'];
			}
		}
	}

//------------------------------------------------------------------------------

	function build_field_list($fields, $default = '*')
	{
		if (is_array($fields)) {
		
			// Join the array into a string of fields
			$fields = "\n `" . implode("`,\n `", $fields) . "`";
		}
		elseif (trim($fields)) {
		
			// If its a string, treat it as a single field
			$fields = "`$fields`";
		}
		else {
		
			// Default
			$fields = $default;
		}
		
		return $fields;
	}

//------------------------------------------------------------------------------

	function total_records($table, $extra_sql = '')
	{
		$SQL = <<<SQL
		
		SELECT COUNT(*) AS `count` 
		FROM $table
		$extra_sql
		
SQL;
		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		$total_records = (int) @mysql_result($result, 0, 0);
		
		return $total_records;
	}
	
	function select_to_array($SQL)
	{
		$result = mysql_query($SQL) or trigger_error(mysql_error(), E_USER_ERROR);
		
		while ($rows[] = mysql_fetch_assoc($result));
		array_pop($rows);
		
		return $rows;
	}
	
}

?>