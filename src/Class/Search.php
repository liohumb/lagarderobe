<?php

namespace App\Class;

use App\Entity\Category;
use App\Entity\Gender;

class Search
{
    /**
     * @var string
     */
    public string $string = '';

    /**
     * @var Category[]
     */
    public array $categories = [];

    /**
     * @var Gender[]
     */
    public array $genders = [];


    public function __toString()
    {
        return '';
    }

}