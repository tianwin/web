<?php

declare(strict_types=1);

namespace Mautic\CoreBundle\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Event\ConsoleErrorEvent;

/**
 * Class ConsoleErrorListener.
 */
class ConsoleErrorListener
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onConsoleError(ConsoleErrorEvent $event)
    {
        $command   = $event->getCommand();
        $exception = $event->getError();

        // Log error with trace
        $trace = (MAUTIC_ENV == 'dev') ? "\n[stack trace]\n".$exception->getTraceAsString() : '';

        $message = sprintf(
            '%s: %s (uncaught exception) at %s line %s while running console command `%s`%s',
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            empty($command) ? 'UNKNOWN' : $command->getName(),
            $trace
        );

        // Use notice so it makes it to the log all "perttified" (using error spits it out to console and not the log)
        $this->logger->notice($message);
    }
}
