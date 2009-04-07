<?php
//------------------------------------------------------------------------------
// Backup
//------------------------------------------------------------------------------
// A simple system to backup the contents File Strcture and Database of a site.
//
// It makes use of two shell commands ('tar' and 'mysqldump') so the ability to 
// execute shell commands is required, as is the availability of these two 
// commands.
//
// While a Windows server will have mysqldump (if mysql is installed), it's 
// unlikely that 'tar' is available, so these scripts won't work.
//
// tar man page: http://unixhelp.ed.ac.uk/CGI/man-cgi?tar
// mysqldump man page: http://unixhelp.ed.ac.uk/CGI/man-cgi?mysqldump
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
// Website Backup
//------------------------------------------------------------------------------
// This will take a backup of the folder struture from the site root (not the
// document root), so will include functions and ny other top level folders.
//
// You can exclude certain directories by adding them to the $exclude_dirs 
// array. The style of these must match the tar commands --exclude option
//------------------------------------------------------------------------------

function get_site_backup()
{
	global $site;
	
	// The filename it will be downloaded as
	$dest_filename = 'Website_Backup.tar.gz';
	
	// The path it will be stored at.
	$dest_filepath = $site['dir']['backups'] . $dest_filename;
	
	// The directory to back up from
	$source_filepath = $site['dir']['root'];
	
	// These folders (and thier contents) will be ignored in the backup
	$exclude_dirs = array(
		'backup',
		'code',
		'sake',
		'drop-ins',
	);
	
	// Create the backup file
	backup_site($source_filepath, $dest_filepath, $exclude_dirs);
	
	// Send the backup file to the browser as a download
	http_force_download($dest_filepath, $dest_filename);
}

function backup_site($source_filepath, $dest_filepath, $excludes = false)
{
	// Remove the existing file (supressing erros as it may not exist)
	@unlink($dest_filepath);
	
	// If there are any exlcusions, build up a string of them
	$exclude_str = '';
	
	if ($excludes === false || !is_array($excludes)) {
		$excludes = array();
	}

	foreach($excludes as $path) {
		$exclude_str .= '--exclude="' . $path . '" ';
	}

	// Build a command to tar/gzip the directory, adding the list of 
	// exclusions on the end.
	$backup_pattern = 'tar -cvzf %s -C %s . %s';
	$backup_cmd = sprintf($backup_pattern, $dest_filepath, $source_filepath, $exclude_str);

	exec($backup_cmd);
	
	// If a new file exists we assume the backup was successful.
	return is_file($dest_filepath);
}

//------------------------------------------------------------------------------
// Database Backup
//------------------------------------------------------------------------------
// Back up the database specificed in the config file, all tables.
// This uses mysqldump and requires lock permissions to make the backup
//------------------------------------------------------------------------------

function get_db_backup()
{
	global $site;
	
	// The filename to be downloaded as
	$filename = 'Database_Backup.tar.gz';
	
	// Where the backup is stored on the server.
	$filepath = $site['dir']['backups'] . $filename;
	
	// Create the backup file
	backup_mysql_db($filepath, DB_USER, DB_PASS, DB_NAME);
	
	// Force the backup file as a download
	http_force_download($filepath, $filename);
}

function backup_mysql_db($dest_filepath, $db_user, $db_pass, $db_name)
{
	// Delete the file (supress errors as it may not exist)
	@unlink($dest_filepath);

	// We need to create a temp file, which is in gzipped
	// This gets placed in the same directory as the destination file
	$dest_dir = dirname($dest_filepath);
	
	$tmp_filename = $db_name . '.sql';
	$tmp_filepath = $dest_dir . '/' . $tmp_filename;
	
	// Make a mysqldump providing the username, password, db name and output file
	$dump_pattern = 'mysqldump -u %s -p%s %s -r %s';
	$dump_cmd = sprintf($dump_pattern, $db_user, $db_pass, $db_name, $tmp_filepath);
	
	exec($dump_cmd);
	
	// Take the local file and make a .tar.gz file remove the original temp file
	$compress_pattern = "cd $dest_dir; tar -cvzf %s --remove-files %s";
	$compress_cmd = sprintf($compress_pattern, $dest_filepath, $tmp_filename);
	
	exec($compress_cmd);
	
	// If a file now exists we assume the backup was successful.
	return is_file($dest_filepath);
}

?>
