<?php

use App\Domain\Exceptions\InvalidEventException;
use PHPUnit\Framework\TestCase;
use App\Application\Event\EventFactory;
use App\Domain\Events\Event;

class EventFactoryTest extends TestCase
{
    public function testCreateEventHappyPath()
    {
        $eventSource = [
            'number' => '123',
            'description' => 'Test event',
            'dueDate' => '2022-01-01',
            'phone' => '1234567890'
        ];

        $eventFactory = new EventFactory();
        $event = $eventFactory->createEvent($eventSource);

        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals('123', $event->getNumber());
        $this->assertEquals('Test event', $event->getDescription());
        $this->assertEquals('2022-01-01', $event->getDueDate());
        $this->assertEquals('1234567890', $event->getPhone());
    }

    public function testCreateEventWithNullDueDate()
    {
        $eventSource = [
            'number' => '123',
            'description' => 'Test event',
            'dueDate' => null,
            'phone' => '1234567890'
        ];

        $eventFactory = new EventFactory();
        $event = $eventFactory->createEvent($eventSource);

        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals(null, $event->getDueDate());
    }

    public function testCreateEventWithNullPhone()
    {
        $eventSource = [
            'number' => '123',
            'description' => 'Test event',
            'dueDate' => '2022-01-01',
            'phone' => null
        ];

        $eventFactory = new EventFactory();
        $event = $eventFactory->createEvent($eventSource);

        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals(null, $event->getPhone());
    }

    public function testCreateEventWithMissingNumber()
    {
        $eventSource = [
            'description' => 'Test event',
            'dueDate' => '2022-01-01',
            'phone' => '1234567890'
        ];

        $this->expectException(InvalidEventException::class);

        $eventFactory = new EventFactory();
        $eventFactory->createEvent($eventSource);
    }

    public function testCreateEventWithMissingDescription()
    {
        $eventSource = [
            'number' => '123',
            'dueDate' => '2022-01-01',
            'phone' => '1234567890'
        ];

        $this->expectException(InvalidEventException::class);

        $eventFactory = new EventFactory();
        $eventFactory->createEvent($eventSource);
    }
}