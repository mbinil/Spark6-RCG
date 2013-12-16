<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
    /**
     * Get the last visited day 
     * @param string $date date in string format
     * @return string $difftext how many days from today will return.
     */
    public function GetLastVisitDay($date)
    {
        $difftext   =   "";
        $createdday =   strtotime($date);
        
        if($createdday){
            $today      =   time(); 
            $datediff   =   abs($today - $createdday);  

            $years      =   floor($datediff / (365*60*60*24));  
            $months     =   floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
            $days       =   floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
            $hours      =   floor($datediff/3600);  
            $minutes    =   floor($datediff/60);  
            $seconds    =   floor($datediff);  
            //year checker  
            if($difftext=="")  
            {  
              if($years>1)  
                   $difftext    =   $years." years ago";  
              elseif($years==1)  
                   $difftext    =   $years." year ago";  
            }  
            //month checker  
            if($difftext=="")  
            {  
                if($months>1)  
                    $difftext   =   $months." months ago";  
                elseif($months==1)  
                    $difftext   =   $months." month ago";  
            }  
            //month checker  
            if($difftext=="")  
            {  
                if($days>1)  
                    $difftext   =   $days." days ago";  
                elseif($days==1)  
                    $difftext   =   "Yesterday";  
            }  
            //hour checker  
            if($difftext=="")  
            {  
                if($hours>1)  
                    $difftext   =   $hours." hours ago";  
                elseif($hours==1)  
                    $difftext   =   $hours." hour ago";  
            }  
            //minutes checker  
            if($difftext=="")  
            {  
                if($minutes>1)  
                    $difftext   =   $minutes." minutes ago";  
                elseif($minutes==1)  
                    $difftext   =   $minutes." minute ago";  
            }  
            //seconds checker  
            if($difftext=="")  
            {  
                if($seconds>1)  
                    $difftext    =   $seconds." seconds ago";  
                elseif($seconds==1)  
                    $difftext    =   $seconds." second ago";  
            } 
        }
        
        return $difftext;
    }
}
