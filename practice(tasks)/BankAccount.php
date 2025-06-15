<?php

namespace Classes;

use ErrorException;

class BankAccount {
    private string $accountNumber;
    private float $balance;

    public function __construct(){
        $this->accountNumber = $this->generateUniqueNumber();
        $this->balance = 0;
    }
    function generateUniqueNumber(): string {
    return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function deposit(float $cash){
        $this->balance += $cash;
    }

    public function withdraw(float $cash){
        if(($this->balance - $cash) >= 0){
            $this->balance -= $cash;
            echo "Balance sheet: " . $this->balance;
        } else {
            throw new ErrorException("insufficient means");
        }
    }

	public function getBalance(): float {
		return $this->balance;
	}
}