<?php

declare(strict_types=1);

namespace App\Invoice\Command;

use App\Invoice\DTO\Invoice\CreateInvoiceDTO;
use App\Invoice\Entity\Invoice;
use App\Invoice\Service\Invoice\EntityManager;
use App\Shared\Doctrine\Command\Command;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\SharedLockInterface;
use Symfony\Component\Lock\Store\SemaphoreStore;

class CreateInvoiceCommand implements Command
{
    private CreateInvoiceDTO $model;

    private Invoice $invoice;

    public function __construct(private readonly EntityManager $manager)
    {
    }

    public function setModel(CreateInvoiceDTO $model): void
    {
        $this->model = $model;
    }

    public function execute(): void
    {

        $lock = $this->createLock(name: __CLASS__, ttl: 30);
        if (!$lock->acquire(blocking: true)) {
            throw new \RuntimeException(message: 'Cannot acquire the lock');
        }
        try {
            $this->invoice = $this->manager->create(createInvoiceDTO: $this->model);
        } finally {
            $lock->release();
        }
    }

    private function createLock(string $name, ?int $ttl = null): SharedLockInterface
    {

        $store = new SemaphoreStore();
        $factory = new LockFactory($store);

        return $factory->createLock(resource: $name, ttl: $ttl);
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }
}
