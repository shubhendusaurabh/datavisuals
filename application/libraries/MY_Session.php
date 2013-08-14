<?php 

/**
* 
*/
class MY_Session extends CI_Session
{
	
	
	function sess_update()
		{
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XmlHttpRequest') {
				parent::sess_update();
			}
		}
	
}