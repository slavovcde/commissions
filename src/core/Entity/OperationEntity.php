<?php

declare(strict_types=1);

namespace Funds\Commissions\Core\Entity;

define('DEPOSIT_FEE', 0.003);
define('WITHDRAW_FEE', 0.03);
define('OPERATION_DEPOSIT', 'deposit');
define('OPERATION_WITHDRAW', 'withdraw');
define('OPERATION_RULE_PRIVATE', 'private');
define('OPERATION_RULE_BUSINESS', 'business');
define('OPERATIONS', [OPERATION_DEPOSIT, OPERATION_WITHDRAW]);
define('OPERATION_RULES', [OPERATION_RULE_PRIVATE, OPERATION_RULE_BUSINESS]);
// lets pretend we're getting this from nowhere and here is list of all currencies
define('CURRENCIES', ['EUR', 'USD', 'JPY']);

class OperationEntity {
    private $user = false;
    private $chargeRate = DEPOSIT_FEE;
    private $operation = false;
    private $operationRule = false;
    private $currency = false;
    private $amount = 0.00;
    private $date = '';

    // for big data will be better to use interface
    public function __construct(array $params = []) {
        if(isset($params['operation']) && array_search($params['operation'], OPERATIONS) >= 0 &&
           isset($params['operationRule']) && array_search($params['operationRule'], OPERATION_RULES) >= 0 &&
           isset($params['currency']) && array_search($params['currency'], CURRENCIES) >= 0 &&
           isset($params['user']) && $params['user'] >= 1) 
        {
            $this->setOperation($params['operation']);
            $this->setOperationRule($params['operationRule']);
            $this->setCurrency($params['currency']);
            $this->setDate($params['date']);
            $this->setAmount(floatval($params['amount']));
            $this->setUser((int) $params['user']);

            if($this->getOperation() === OPERATION_WITHDRAW) {
                $this->setChargeRate(WITHDRAW_FEE);
            }
        }

    }

    public function isValidDate($date, $format = 'Y-m-d') {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function getChargeRate(): float {
        return $this->chargeRate;
    }
    public function setChargeRate(float $rate) {
        $this->chargeRate = $rate;
    }

    public function getOperation(): string | bool {
        return $this->operation;
    }
    public function setOperation(string $operation) {
        $this->operation = $operation;
    }

    public function getOperationRule(): string | bool {
        return $this->operationRule;
    }
    public function setOperationRule(string $operationRule) {
        $this->operationRule = $operationRule;
    }

    public function getCurrency(): string | bool {
        return $this->currency;
    }
    public function setCurrency(string $currency) {
        $this->currency = $currency;
    }

    public function getDate(): string {
        return $this->date;
    }
    public function setDate(string $date) {
        if($this->isValidDate($date)) {
            $this->date = $date;
        }
    }

    public function getUser(): int | bool {
        return $this->user;
    }
    public function setUser(int $user) {
        $this->user = $user;
    }

    public function getAmount(): float {
        return $this->amount;
    }
    public function setAmount(float $amount) {
        $this->amount = $amount;
    }
}