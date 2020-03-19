<?php
namespace Ittc;

interface Routes 
{
    public function getRoutes(): array;
    public function getAuthentication(): \Ittc\Authentication;
}