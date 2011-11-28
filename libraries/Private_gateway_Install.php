<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Performs install/uninstall methods for the Private SMS Gateway Plugin
 *
 * @package    Ushahidi
 * @author     Ushahidi Team
 * @copyright  (c) 2008 Ushahidi Team
 * @license    http://www.ushahidi.com/license.html
 */
class Private_Gateway_Install {
	
	/**
	 * Constructor to load the shared database library
	 */
	public function __construct()
	{
		$this->db =  new Database();
	}

	/**
	 * Creates the required columns for the Private_Gateway Plugin
	 */
	public function run_install()
	{
		
		// ****************************************
		// DATABASE STUFF
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `".Kohana::config('database.default.table_prefix')."private_gateway`
			(
				id int(11) unsigned NOT NULL AUTO_INCREMENT,
				phonenumber_variable varchar(100) DEFAULT NULL,
				message_variable varchar(100) DEFAULT NULL,
				private_gateway_key varchar(100) DEFAULT NULL,
				PRIMARY KEY (`id`)
			);
		");
		// ****************************************
	}

	/**
	 * Drops the Private Gateway Tables
	 */
	public function uninstall()
	{
		$this->db->query("
			DROP TABLE ".Kohana::config('database.default.table_prefix')."private_gateway;
			");
	}
}
