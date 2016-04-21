<?php

/**
 * This script runs the ODT encrypt macro
 *
 * @package    Html52pdf
 * @subpackage Macros
 * @copyright  Copyright (c) 2014 No-nonsense Labs (http://www.nononsenselabs.com)
 * @license    http://www.html52pdf.com/licenses
 * @link       http://www.html52pdf.com
 * @version    1.0
 * @since      1.0
 */

require_once dirname(__FILE__) . '/../classes/Core/Crypt.inc';

Use Html52pdf\Core as core;

//create an instance of the Render class
$crypt = new core\Crypt();
$longArgs = $crypt->cliArgs();
\array_unshift($longArgs, 'soffice:');
\array_unshift($longArgs, 'os:');
var_dump($longArgs);
$args = getopt('', $longArgs);
var_dump('_______________________________________________');
var_dump($args);
var_dump($crypt->options($args));
var_dump('_______________________________________________');
$macroOptions = $crypt->options($args);

$path = $args['soffice'];
$pathArray = explode(DIRECTORY_SEPARATOR, $path);
$dirs = count($pathArray);

if ($args['os'] == "WINDOWS") {
    //let start to build the command
    $cli = 'cd\\ & ';
    for ($j = 1; $j < $dirs - 1; $j++) {
        $cli .= 'cd "' . $pathArray[$j] . '" ';
        $cli .= '& ';
    }
    $cli .= $pathArray[$dirs-1];
    $cli .= ' "macro:///Standard.macrotest.Encrypt(' . $macroOptions . ')"';
} else {
    //let start to build the command
    $cli = 'cd ';
    for ($j = 1; $j < $dirs - 1; $j++) {
        $cli .= DIRECTORY_SEPARATOR . $pathArray[$j];
    }
    $cli .= ' && ' . $pathArray[$dirs-1];
    $cli .= ' "macro:///Standard.macrotest.Encrypt(' . $macroOptions . ')"';
    var_dump($cli);
}
passthru($cli);