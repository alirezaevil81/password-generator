<?php


namespace Src;

require_once 'vendor/autoload.php';

class PasswordGenerator
{
    protected $lowercase;
    protected $uppercase;
    protected $numbers;
    protected $symbols;
    protected $characters;

    public function __construct()
    {
        $this->lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $this->uppercase = strtoupper($this->lowercase);
        $this->numbers = implode('', range(0, 9));
        $this->symbols = '!@#$%^&*()_-+=<>?';
        $this->characters = $this->lowercase;
    }

    public function changeNumbers($numbers) {
        $this->numbers = $numbers;
        return $this;
    }
    public function changeSymbols($symbols) {
        $this->symbols = $symbols;
        return $this;
    }
    public function changeCases($lowercase) {
        $this->lowercase = $lowercase;
        $this->uppercase = strtoupper($lowercase);
        return $this;
    }

    public function build(int $length = 12,bool $includeUppercase = true, bool $includeNumbers = true, bool $includeSymbols = true)
    {
        if ($includeUppercase) {
            $this->characters .= $this->uppercase;
        }
        if ($includeNumbers) {
            $this->characters .= $this->numbers;
        }
        if ($includeSymbols) {
            $this->characters .= $this->symbols;
        }
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($this->characters) - 1);
            $password .= $this->characters[$index];
        }

        return $password;
    }
}
