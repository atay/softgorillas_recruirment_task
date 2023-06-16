<?php

namespace Tests\Application\Event\Converter;

use App\Domain\Event\Enum\EventType;
use App\Domain\Event\Enum\Status;
use PHPUnit\Framework\TestCase;
use App\Application\Event\Converter\FailureConverter;
use App\Domain\Event\Model\Failure;
use App\Domain\Event\Model\FailureType;
use App\Domain\Event\Model\FailureStatus;

class FailureConverterTest extends TestCase
{
    public function testConvert(): void
    {
        $failure = new Failure();
        $failure->setNumber(123);
        $failure->setPhoneNumber('1234567890');
        $failure->setDescription('Test failure');
        $failure->setDate(new \DateTime('2022-01-01 10:00:00'));
        $failure->setWeekOfYear(1);
        $failure->setStatus(Status::NEW );
        $failure->setRecommendation('Test recommendation');
        $failure->setCreatedAt(new \DateTime('2021-01-01 10:00:00'));

        $this->assertEquals("failure", $failure->getType()->value);

        $converter = new FailureConverter();
        $result = $converter->convert($failure);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('number', $result);
        $this->assertArrayHasKey('phone', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('date', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('weekOfYear', $result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('recommendation', $result);
        $this->assertArrayHasKey('createdAt', $result);

        $this->assertEquals($failure->getNumber(), $result['number']);
        $this->assertEquals($failure->getPhoneNumber(), $result['phone']);
        $this->assertEquals($failure->getDescription(), $result['description']);
        $this->assertEquals($failure->getDate()->format('Y-m-d H:i:s'), $result['date']);
        $this->assertEquals($failure->getType()->value, $result['type']);
        $this->assertEquals($failure->getWeekOfYear(), $result['weekOfYear']);
        $this->assertEquals($failure->getStatus()->value, $result['status']);
        $this->assertEquals($failure->getRecommendation(), $result['recommendation']);
        $this->assertEquals($failure->getCreatedAt()->format('Y-m-d H:i:s'), $result['createdAt']);
    }


}