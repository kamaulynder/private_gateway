<?php defined('SYSPATH') or die('No direct script access.');
/**
* Private Gateway HTTP Post Controller
* Gets HTTP Post data from a Private SMS Gateway 
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @module	   Private Gateway Controller	
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
*/

class Private_Gateway_Controller extends Controller
{
	function index()
	{
		$variables = ORM::factory('private_gateway')->find_all();
		foreach($variables as $variable)
		{
			$phonenumber = $variable->phonenumber_variable;
			$message = $variable->message_variable;
		}
		if (isset($_GET['key']))
		{
			$private_gateway_key = $_GET['key'];
		}
		
		if (isset($_GET[$phonenumber]))
		{
			$message_from = $_GET[$phonenumber];
			// Remove non-numeric characters from string
			$message_from = preg_replace("#[^0-9]#", "", $message_from);
		}
		
		if (isset($_GET[$message]))
		{
			$message_description = $_GET[$message];
		}
		
		if ( ! empty($private_gateway_key) AND ! empty($message_from) AND ! empty($message_description))
		{
			// Is this a valid sync Key?
			$keycheck = ORM::factory('private_gateway')
				->where('private_gateway_key', $private_gateway_key)
				->find(1);

			if ($keycheck->loaded == TRUE)
			{
					sms::add($message_from, $message_description);
			}
		}
	}
}
