<?php
class Level extends AppModel
{
   	var $name="Level";		
		
	public function getLevelThreshold()
	{
		$LevelThreshold = $this->find("all");
		return $LevelThreshold[0]['Level']['LevelThreshold'];
	}
}
?>