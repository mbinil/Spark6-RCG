<?php
class Alert extends AppModel
{
	var $name = 'Alert';
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Enter Alert Name.'
			),
			
		)
	);
	
    /* Get all Alerts  */
	public function GetAlerts()
	{
		
		$alertresult = $this->find('all',array('order' => 'Alert.id ASC')); 
		return $alertresult;
	}
	
}
?>