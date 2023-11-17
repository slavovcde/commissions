<?php

declare(strict_types=1);

namespace Funds\Commissions\Core\Controller;

use Funds\Commissions\Core\Entity;

define('LIMIT_PER_WEEK', 1000.00);

class ServiceController {
    public $historyOperations = [];

    public function __construct() {
    }

    public function calcOperation(array $operationRow = []): float | int
    {
        $operation = new Entity\OperationEntity([
            'date' => $operationRow[0],
            'operation' => $operationRow[3],
            'operationRule' => $operationRow[2],
            'currency' => $operationRow[5],
            'amount' => $operationRow[4],
            'user' => $operationRow[1]
        ]);

        if($operation->getOperation() === 'withdraw') {

        }

        // for reference of date format - https://www.php.net/manual/en/datetime.format.php
        // if [userId][year][week] exist, then update
        if (isset($this->historyOperations[$operation->getUser()][date('o', strtotime($operation->getDate()))][date('W', strtotime($operation->getDate()))])) {

        } else {
            // otherwise create new one
        }

        return 0;
    }
}
