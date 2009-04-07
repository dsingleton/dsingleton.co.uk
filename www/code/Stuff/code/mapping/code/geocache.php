<?php

<?php

class ActiveRecord
{
	// Fields
	
	var $table = null;
	var $pri_key = null;
	var $fields = null;
	var $record = array();
	
	// Constructor
	
	function ActiveRecord()
	{
		
	}
	
	// Load and Save
	
	function load($record_id)
	{
		$record = Generic_DB::get_row($this->table, $this->pri_key, $record_id);
		
		$record_exists = (bool) $record;
		
		if ($record_exists) {
			
			$this->id = $record[$pri_key];
			
			foreach($this->fields as $key) {
				
				if (isset($record[$key])) {
					$this->setAttr($key, $record[$key]);
				}
			}
		}
		
		return $record_exists;
	}
	
	function save()
	{
		if ($this->exists()) {
			// Update
			$this->update();
		}
		else {
			$this->create();
		}
	}
	
	function create()
	{
		$insert_id = Generic_DB::update(
			$this->table,
			$this->record,
			$this->fields);
		
		$inserted = (bool) $insert_id;
		
		if ($inserted) {
			$this->id = $insert_id;
		}
		
		return $inserted;
	}
	
	function update()
	{
		$table = $this->table;
		$id_field = $this->pri_key;
		$id = $this->getID();
		
		$fields = $this->fields;
		$record = $this->record;
		
		return Generic_DB::update(
			$table,
			$id_field,
			$id, 
			$record,
			$fields);
	}
	
	
	// Manipulation and Access
		
	function getAttr($attr)
	{
		return $this->record[$attr];
	}
	
	function getID()
	{
		return $this->id;
	}
	
	function setAttr($attr, $value)
	{
		$this->record[$attr] = $value;
	}


	// Booleans
	
	function exists()
	{
		return $this->id > 0;
	}
}



class 

function save_venue()

function get_upcoming_venue()
{
	
	
}

