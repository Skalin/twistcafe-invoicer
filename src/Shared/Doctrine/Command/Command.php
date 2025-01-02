<?php

namespace App\Shared\Doctrine\Command;

interface Command
{
    public function execute(): void;
}
