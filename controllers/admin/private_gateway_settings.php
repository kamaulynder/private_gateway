<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Private SMS Gateway Settings Controller
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   Generic SMS Gateway Settings Controller	
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
* 
*/

class Private_Gateway_Settings_Controller extends Admin_Controller
{
	public function index()
	{
		$this->template->this_page = 'addons';
		
		// Standard Settings View
		$this->template->content = new View("admin/plugins_settings");
		$this->template->content->title = "Private SMS Gateway Settings";
		
		// Settings Form View
		$this->template->content->settings_form = new View("private_gateway/admin/private_gateway_settings");
		
		// setup and initialize form field names
        $form = array
        (
            'phonenumber_variable' => '',
            'message_variable' => ''
        );
        //  Copy the form as errors, so the errors will be stored with keys
        //  corresponding to the form field names
        $errors = $form;
        $form_error = FALSE;
        $form_saved = FALSE;

        // check, has the form been submitted, if so, setup validation
        if ($_POST)
        {
            // Instantiate Validation, use $post, so we don't overwrite $_POST
            // fields with our own things
            $post = new Validation($_POST);

            // Add some filters
            $post->pre_filter('trim', TRUE);

            // Add some rules, the input field, followed by a list of checks, carried out in order

            $post->add_rules('phonenumber_variable','required', 'length[4,20]');
            $post->add_rules('message_variable', 'required', 'length[3,50]');

            // Test to see if things passed the rule checks
            if ($post->validate())
            {
                // Yes! everything is valid
                $private_gateway = new Private_Gateway_Model(1);
                $private_gateway->phonenumber_variable = $post->phonenumber_variable;
                $private_gateway->message_variable = $post->message_variable;
                $private_gateway->save();

                // Everything is A-Okay!
                $form_saved = TRUE;

                // repopulate the form fields
                $form = arr::overwrite($form, $post->as_array());

            }

            // No! We have validation errors, we need to show the form again,
            // with the errors
            else
            {
                // repopulate the form fields
                $form = arr::overwrite($form, $post->as_array());

                // populate the error fields, if any
                $errors = arr::overwrite($errors, $post->errors('settings'));
                $form_error = TRUE;
            }
        }
        else
        {
            // Retrieve Current Settings
            $private_gateway = ORM::factory('private_gateway', 1);

            $form = array
            (
                'phonenumber_variable' => $private_gateway->phonenumber_variable,
                'message_variable' => $private_gateway->message_variable
            );
        }
		
		// Pass the $form on to the settings_form variable in the view
		$this->template->content->settings_form->form = $form;
		
		
		// Do we have a Sync Key? If not create and save one on the fly
        $private_gateway = ORM::factory('private_gateway', 1);
		
		if ($private_gateway->loaded AND $private_gateway->private_gateway_key)
		{
			$private_gateway_key = $private_gateway->private_gateway_key;
		}
		else
		{
			$private_gateway_key = strtoupper(text::random('alnum',8));
            $private_gateway->private_gateway_key = $private_gateway_key;
            $private_gateway->save();
		}

		$this->template->content->settings_form->private_gateway = $private_gateway;
		$this->template->content->settings_form->private_gateway_key = $private_gateway_key;
		$this->template->content->settings_form->private_gateway_link = url::site()."private_gateway/?key=".$private_gateway_key."&".$private_gateway->phonenumber_variable."=\${sender_number}&".$private_gateway->message_variable."=\${message_content}";
		
		// Other variables
	    $this->template->content->errors = $errors;
		$this->template->content->form_error = $form_error;
		$this->template->content->form_saved = $form_saved;
	}
}
