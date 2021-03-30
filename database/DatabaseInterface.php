<?php

namespace Database;

interface DatabaseInterface
{
    public function __construct(string $credentials);

    public function createTable(array $columns);

    public function create(array $parameters);
}