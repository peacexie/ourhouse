<?php
namespace imcat;
(!defined('RUN_INIT')) && die('No Init');

// 1. ����:db,stamp
// 2. ����:$rdo = pass/fail

$rdo = 'fail';

// code1: ex-dosth-1
// code2: ex-dosth-2
// code3: ...
basDebug::bugLogs('user_dosth','do-sth-N','detmp','db');

$rdo = 'pass';
