<?php

require __DIR__ . '/../index.php';

$technologiesArray = ['TailwindCSS', 'AlpineJS','Livewire', 'Laravel'];
$courseArray = [
    'name' => 'TALL Stack Course',
    'price' => 14.99,
    'published' => true,
    'author' => null,
    'technologies' => $technologiesArray
];

class Course
{
    public $name = 'TALL Stack Course';
    public $price = 14.99;
    public $published = true;
    public $technologies = ['TailwindCSS', 'AlpineJS', 'Livewire', 'Laravel'];
}

$courseObject = new Course();

dump($courseArray);
dump($courseObject);

dd("Thanks for all!");