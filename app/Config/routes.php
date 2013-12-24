<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	/*Home pages*/
	Router::connect('/', array('controller' => 'home', 'action' => 'display', 'home'));
	
	/*Challenge discover (search result) pages*/
	Router::connect('/discover', array('controller' => 'challenges', 'action' => 'discover'));
	
        /*Challenge hosting steps*/
	Router::connect('/host_challenge_step1/:slug', array('controller' => 'challenges', 'action' => 'host_challenge_step1'),array('pass' => array('slug')));
        Router::connect('/host_challenge_step2', array('controller' => 'challenges', 'action' => 'host_challenge_step2'));
        Router::connect('/ajax_host_challenge_step1', array('controller' => 'challenges', 'action' => 'ajax_host_challenge_step1'));
        Router::connect('/ajax_host_challenge_add', array('controller' => 'challenges', 'action' => 'ajax_host_challenge_add'));
        
	/*Challenge details pages*/
	Router::connect('/discover/:slug', array('controller' => 'challenges', 'action' => 'challenge_details'), array('pass' => array('slug')));
	/*My challenges pages*/
	Router::connect('/my_challenges', array('controller' => 'challenges', 'action' => 'my_challenges'));
	Router::connect('/get_challenge', array('controller' => 'challenges', 'action' => 'get_challenge'));
	Router::connect('/ajax_pick_a_host', array('controller' => 'challenges', 'action' => 'ajax_pick_a_host'));
	Router::connect('/ajax_challenge_checking', array('controller' => 'challenges', 'action' => 'ajax_challenge_checking'));
	
	/*Registration pages*/
	Router::connect('/registration_step1', array('controller' => 'users', 'action' => 'registration_step1'));
	Router::connect('/registration_step2', array('controller' => 'users', 'action' => 'registration_step2'));
	Router::connect('/registration_step3', array('controller' => 'users', 'action' => 'registration_step3'));
	Router::connect('/adminuser_uploads', array('controller' => 'users', 'action' => 'adminuser_uploads'));
	
	/*Login checking ajax page*/
	Router::connect('/ajax_loginchecking', array('controller' => 'users', 'action' => 'ajax_loginchecking'));
	
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	
	/*Manage account pages*/
	Router::connect('/manage_account_step1', array('controller' => 'users', 'action' => 'manage_account_step1'));
	Router::connect('/manage_account_step2', array('controller' => 'users', 'action' => 'manage_account_step2'));
	Router::connect('/manage_account_step3', array('controller' => 'users', 'action' => 'manage_account_step3'));
	
	/*My profile page*/
	Router::connect('/view_profile', array('controller' => 'users', 'action' => 'view_profile'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
