<?php

//------------------------------------------------------------------------------
//  Read
//------------------------------------------------------------------------------

function get_admin_user($id)
{
	$table = 'admin_users';
	$match_field = 'admin_user_id';
	return Generic_DB::get_row($table, $match_field, $id);
}

function get_admin_users()
{

}

function search_admin_users($page, $per_page = 2)
{
	$table = 'admin_users';
	$order_by = 'first_name ASC, last_name ASC';
	
	return Generic_DB::search($table, $page, $per_page, $order_by);
}

//------------------------------------------------------------------------------
//  Write
//------------------------------------------------------------------------------

function add_admin_user($user, &$feedback)
{
	$table = 'admin_users';
	$fields = array('title', 'first_name',  'last_name', 'telephone', 'email', 'username', 'password');
	$required = array('title', 'first_name',  'last_name', 'email', 'username', 'password');
	$noun = 'Admin User';
	
	$feedback = Generic_Admin::add($table, $user, $fields, $required, $noun);
	
	return $feedback['success'];
}

function update_admin_user($id, $user, &$feedback)
{
	$table = 'admin_users';
	$match_field = 'admin_user_id';
	$fields = array('title', 'first_name',  'last_name', 'telephone', 'email', 'username', 'password');
	$required = array('title', 'first_name',  'last_name', 'email', 'username', 'password');
	$noun = 'Admin User';
	
	$feedback = Generic_Admin::update($table, $match_field, $id, $user, $fields, $required, $noun);
	
	return $feedback['success'];	
}

function delete_admin_user($id, &$feedback)
{
	$table = 'admin_users';
	$match_field = 'admin_user_id';
	$noun = 'Admin User';
	
	$feedback = Generic_Admin::delete($table, $match_field, $id, $noun);
	
	return $feedback['success'];	
}

//------------------------------------------------------------------------------
//  Support
//------------------------------------------------------------------------------

?>