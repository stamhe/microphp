<?php
$r->map('', array('controller' => 'home'));  
$r->map('/login', array('controller' => 'auth', 'action' => 'login'));
$r->map('/logout', array('controller' => 'auth', 'action' => 'logout'));
$r->map('/signup', array('controller' => 'auth', 'action' => 'signup'));
$r->map('/profile/:action', array('controller' => 'profile')); 
$r->map(":controller/:id", array('action'=>'view'), array("id"=>"[0-9]+"));