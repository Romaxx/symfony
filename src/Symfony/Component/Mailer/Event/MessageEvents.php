<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mailer\Event;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class MessageEvents
{
    private $events = [];
    private $transports = [];

    public function add(MessageEvent $event): void
    {
        $this->events[] = $event;
        $this->transports[$event->getTransportName()] = true;
    }

    public function getTransports(): array
    {
        return array_keys($this->transports);
    }

    /**
     * @return MessageEvent[]
     */
    public function getEvents(string $name = null): array
    {
        if (null === $name) {
            return $this->events;
        }

        $events = [];
        foreach ($this->events as $event) {
            if ($name === $event->getTransportName()) {
                $events[] = $event;
            }
        }

        return $events;
    }
}
