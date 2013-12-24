<?php
//21days RCG constants
####################################################
//Challenge Status
//0=waiting for date ,1=playing, 2=challenge completed, 3=challenge failed, 4= challenge initiated, 5=request open, 6=request accepted, 7=request rejected, 8=outdated(invalid), 9 = unjoined after joining, 10 = request open for guest logins
###########################################################
$config = array('eBayBusinessUnit'=> array("0"=>"Select an option","1"=>"eBay, Inc","2"=>"eBay Marketpalces","3"=>"PayPal","4"=>"eBay Enterprise"),
				'eBayBusinessUnitLoc'=> array("0"=>"Select an option","1"=>"San Jose, CA","2"=>"Sacremento, CA"),
				'HostEditStatus' => array(0,4),
				'HostAddStatus' => array(2,3,5,7,8,9),				
				'HostInviteFriends' => array(0,6),
				'ActiveParticipantStatus' => array(1),
				'WaitingParticipantStatus' => array(0,6),
				'WaitingHostStatus' => array(0,4),
				'WaitingStatus' => array(0,4,5,6), 
				'HostTimeInterval' =>     array("05:00"=>"05:00 AM","05:30"=>"05:30 AM","06:00"=>"06:00 AM","06:30"=>"06:30 AM","07:00"=>"07:00 AM","07:30"=>"07:30 AM","08:00"=>"08:00 AM","08:30"=>"08:30 AM","09:00"=>"09:00 AM","09:30"=>"09:30 AM","10:00"=>"10:00 AM","10:30"=>"10:30 AM","11:00"=>"11:00 AM","11:30"=>"11:30 AM","12:00"=>"12:00 PM","12:30"=>"12:30 PM","13:00"=>"01:00 PM","13:30" => "01:30 PM","14:00"=>"02:00 PM","14:30"=>"02:30 PM","15:00"=>"03:00 PM","15:30"=>"03:30 PM","16:00"=>"04:00 PM","16:30"=>"04:30 PM","17:00"=>"05:00 PM","17:30"=>"05:30 PM"),
				'TimeInterval' => array("06:00 AM","06:30 AM","07:00 AM","07:30 AM","08:00 AM","8:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 PM","12:30 PM","01:00 PM","01:30 PM","02:00 PM","02:30 PM","03:00 PM","03:30 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM"),				
				'MemoryLimit' => '999M',
				'UploadMaxFileSize' => '50M',
				'MaxExecutionTime' => '300000');
?>