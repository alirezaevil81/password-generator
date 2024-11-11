<?php

use PHPUnit\Framework\TestCase;
use Src\PasswordGenerator;

class PasswordGeneratorTest extends TestCase
{
    protected $generator;

    protected function setUp(): void
    {
        $this->generator = new PasswordGenerator();
    }

    public function testDefaultPasswordLength()
    {
        $password = $this->generator->build();
        $this->assertEquals(12, strlen($password), "Password length should be 12 by default.");
    }

    public function testPasswordContainsUppercase()
    {
        $password = $this->generator->build(12, true, false, false);
        $this->assertMatchesRegularExpression('/[A-Z]/', $password, "Password should contain uppercase letters.");
    }

    public function testPasswordContainsNumbers()
    {
        $password = $this->generator->build(12, false, true, false);
        $this->assertMatchesRegularExpression('/[0-9]/', $password, "Password should contain numbers.");
    }

    public function testPasswordContainsSymbols()
    {
        $password = $this->generator->build(12, false, false, true);
        $this->assertMatchesRegularExpression('/[!@#$%^&*()_\-+=<>?]/', $password, "Password should contain symbols.");
    }

    public function testPasswordWithCustomNumbers()
    {
        $customNumbers = '12345';
        $password = $this->generator->changeNumbers($customNumbers)->build(12, false, true, false);
        $this->assertMatchesRegularExpression('/[1-5]/', $password, "Password should contain only custom numbers.");
    }

    public function testPasswordWithCustomSymbols()
    {
        $customSymbols = '*+-/';
        $password = $this->generator->changeSymbols($customSymbols)->build(12, false, false, true);
        $this->assertMatchesRegularExpression('/[\*\+\-\/]/', $password, "Password should contain only custom symbols.");
    }

    public function testPasswordWithCustomCases()
    {
        $customLowercase = 'xyz';
        $this->generator->changeCases($customLowercase);
        $password = $this->generator->build(12, true, false, false);
        
        $this->assertMatchesRegularExpression('/[x-z]/', $password, "Password should contain only custom lowercase letters.");
        $this->assertMatchesRegularExpression('/[X-Z]/', $password, "Password should contain only custom uppercase letters.");
    }

    public function testPasswordLength()
    {
        $password = $this->generator->build(16);
        $this->assertEquals(16, strlen($password), "Password length should be 16.");
    }
}
