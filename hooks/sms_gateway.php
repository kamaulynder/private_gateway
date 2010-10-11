<?php defined('SYSPATH') or die('No direct script access.');
/**
 * SMS GATEWAY Hook - Load All Events
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com>
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class sms_gateway {

	/**
	 * Registers the main event add method
	 */
	//public $from_number = "";
	
	public function __construct()
	{
		$this->db = Database::instance();
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}
	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
	{
		// Add a Sub-Nav Link
		Event::add('ushahidi_action.sub_nav_admin_settings_sms', array($this, '_sms_gateway'));

	//	Event::add('ushahidi_action.site_settings', array($this, '_sms_gateway'));
		//Add a 

		// Only add the events if we are on that controller
		if (Router::$controller == 'settings')
		{
		
			plugin::add_stylesheet('sms_gateway/views/css/main');
			//Add  
		}
	}
	
	public function _sms_gateway()
	{
                $this_sub_page = Event::$data;
                echo ($this_sub_page == "sms_gateway") ? "sms_gateway" : "<a href=\"".url::base()."admin/settings/sms_gateway\">Option 3: Use a Third Party SMS Gateway</a>";
	}

	
}
new sms_gateway;
