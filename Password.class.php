<?php

class Password
{
    private $length = 12;

    private $charRanges = [
        'upper' => 'ABCDEFGHJKLMNPQRSTUVWXYZ',
        'lower' => 'abcdefghijkmnpqrstuvwxyz',
        'digits' => '123456789',
        'special' => '!@#$%^&*_+-=,./?;:`"~\'\\',
        'brackets' => '(){}[]<>',
        'high' => '¡¢£¤¥¦§©ª«¬®¯°±²³´µ¶¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþ',
        'ambiguous' => 'O0oIl'
    ];

    private $ranges = [];


    public function __construct()
    {

    }

    public function setLength($length)
    {
        $this->length = $length;
    }


    public function setOptionUpper($state)
    {
        $this->setOption('upper', $state);
    }


    public function setOptionLower($state)
    {
        $this->setOption('lower', $state);
    }

    public function setOptionDigits($state)
    {
        $this->setOption('digits', $state);
    }

    public function setOptionSpecial($state)
    {
        $this->setOption('special', $state);
    }

    public function setOptionBrackets($state)
    {
        $this->setOption('brackets', $state);
    }

    public function setOptionHigh($state)
    {
        $this->setOption('high', $state);
    }

    public function setOptionAmbiguous($state)
    {
        $this->setOption('ambiguous', $state);
    }

    public function setOption($option, $state)
    {
        if ($state) {
            $this->ranges[$option] = $option;
        } else {
            unset($this->ranges[$option]);
        }
    }

    public function generate()
    {
        $password = [];
        for ($i = 0; $i < $this->length; $i++) {
            $range = $this->ranges[array_rand($this->ranges)];
            $char = mb_substr($this->charRanges[$range], rand(0, mb_strlen($this->charRanges[$range]) - 1), 1);
            $password[] = $char;
        }
        return implode('', $password);
    }

}