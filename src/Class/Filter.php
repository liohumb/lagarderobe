<?php

namespace App\Class;

use App\Entity\Category;
use App\Entity\Gender;

class Filter
{
    /**
     * @var Category[]
     */
    public array $categories = [];

    /**
     * @var Gender[]
     */
    public array $gender = [];
}