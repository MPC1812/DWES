<?php
require_once 'logger.php';

print str_replace('[[SERVICEPATH]]',dirname($_SERVER['REQUEST_URI']),file_get_contents('tarea05_generic.wsdl'));
_l("archivo wsdl consultado");

