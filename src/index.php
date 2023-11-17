<?php

declare(strict_types=1);

namespace Funds\Commissions;

require_once('core/Controller/ServiceController.php');
require_once('core/Entity/OperationEntity.php');

$regex = '/.+(\.csv)$/';

if(isset($argv[1]) && preg_match($regex, $argv[1]) === 1) {
    $lines = file($argv[1], FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

    $service = new Core\Controller\ServiceController();

    foreach($lines as $line) {
        $line = trim($line);

        $values = explode(',', $line);

        $service->calcOperation($values);
    }
}