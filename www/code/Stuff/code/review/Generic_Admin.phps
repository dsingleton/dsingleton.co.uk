<?php

class Generic_Admin
{

//------------------------------------------------------------------------------
// Write
//------------------------------------------------------------------------------

	function add($table, $record, $fields, $required, $noun = 'Record')
	{
		$succes = false;
		
		$errors = Generic_Admin::validate_record($record, $required);
		
		if (!$errors) {
			$success = (bool) Generic_DB::insert($table, $record, $fields);
		}

		$verb = 'Added';
		$title = $noun . ($success ? ' was ' : ' could not be ') . $verb;
		
		$feedback = build_feedback($success, $success, $title, '', $errors);
		
		return $feedback;	
	}

//------------------------------------------------------------------------------

	function update($table, $match_field, $id, $record, $fields, $required, $noun = 'Record')
	{

		$succes = false;

		$errors = Generic_Admin::validate_record($record, $required);	

		if (!$errors) {
			$success = (bool) Generic_DB::update($table, $match_field, $id, $record, $fields);
		}
		
		$verb = 'Updated';
		$title = $noun . ($success ? ' was ' : ' could not be ') . $verb;
		
		$feedback = build_feedback($success, $success, $title, '', $errors);
		
		return $feedback;
	}

//------------------------------------------------------------------------------

	function delete($table, $match_field, $match_value, $noun = 'Record')
	{
		$success = (bool) Generic_DB::delete($table, $match_field, $match_value); 	
	
		$title = $noun . ' was deleted';
		$feedback = build_feedback($success, $success, $title);
		
		return $feedback;
	}
	
//------------------------------------------------------------------------------
// Helpers
//------------------------------------------------------------------------------

	function validate_record($record, $required)
	{
		$errors = array();
	
		foreach($required as $key) {
			if (!$record[$key]) {
				$errors[] = 'Please enter a value for ' . humanize_string($key);
			}
		}
		return $errors;
	}
	
//------------------------------------------------------------------------------

	function pagination($paging, $url = false, $range = 5)
	{
		pagination($paging, $url, $range);
	}
}

?>