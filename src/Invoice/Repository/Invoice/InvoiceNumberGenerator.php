<?php

declare(strict_types=1);

namespace App\Invoice\Repository\Invoice;

use Doctrine\ORM\NoResultException;

readonly class InvoiceNumberGenerator
{
    public function __construct(private Repository $repository)
    {
    }

    public function getNextInvoiceNumber(): string
    {
        try {
            $lastInvoiceNumber = $this->repository
                ->createQueryBuilder('invoice')
                ->select('invoice.invoiceNumber')
                ->andWhere('YEAR(invoice.createdAt) = :year')
                ->orderBy('invoice.invoiceNumber', 'DESC')
                ->setParameter('year', date('Y'))
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException $e) {
            $lastInvoiceNumber = null;
        }
        /** @var ?string $lastInvoiceNumber */
        if ($lastInvoiceNumber === null) {
            return $this->formatInvoiceNumber(1);
        }

        return $this->formatInvoiceNumber($this->extractRowFromInvoiceNumber($lastInvoiceNumber) + 1);
    }

    protected function extractRowFromInvoiceNumber(string $invoiceNumber): int
    {
        if (preg_match('{^(\d{4})(\d{4,})}', $invoiceNumber, $matches) !== 1) {
            throw new \InvalidArgumentException('Invalid invoice number format');
        }
        return (int)$matches[2];
    }

    protected function formatInvoiceNumber(int $invoiceNumber): string
    {
        return sprintf('%s%s', date('Y'), str_pad((string)$invoiceNumber, 4, '0', STR_PAD_LEFT));
    }
}
