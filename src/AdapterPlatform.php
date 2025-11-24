<?php

declare(strict_types=1);

namespace PhpDb\Adapter\Sql92;

use PhpDb\Adapter\Platform\AbstractPlatform;
use PhpDb\Sql\Platform\PlatformDecoratorInterface;

use function addcslashes;
use function trigger_error;

class AdapterPlatform extends AbstractPlatform
{
    public const PLATFORM_NAME = 'SQL92';

    public function getSqlPlatformDecorator(): PlatformDecoratorInterface
    {
        return new SqlPlatform();
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return self::PLATFORM_NAME;
    }

    /**
     * {@inheritDoc}
     */
    public function quoteValue($value): string
    {
        trigger_error(
            'Attempting to quote a value without specific driver level support'
            . ' can introduce security vulnerabilities in a production environment.'
        );
        return '\'' . addcslashes($value ?? '', "\x00\n\r\\'\"\x1a") . '\'';
    }
}
