<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This controller is used for third party sms gateway 
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Admin Users Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Sms_Gateway_Controller extends Settings_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->template->this_page = 'sms_gateway';

	}

	function index()
	{
		$this->template->content = new View('sms_gateway/sms_gateway');

	}


}
