<?php

namespace Tests\Application\Event\Converter;

use App\Domain\Event\Enum\EventType;
use App\Domain\Event\Enum\Status;
use PHPUnit\Framework\TestCase;
use App\Domain\Event\Model\Inspection;
use App\Application\Event\Converter\InspectionConverter;

class InspectionConverterTest extends TestCase
{
    public function testConvertReturnsCorrectArray()
    {
        $inspection = new Inspection();
        $inspection->setNumber('123');
        $inspection->setDescription('Test Inspection');
        $inspection->setDateOfVisit(new \DateTime('2022-01-01 10:00:00'));
        $inspection->setClientPhoneNumber('1234567890');
        $inspection->setStatus(Status::NEW );
        $inspection->setCreatedAt(new \DateTime('2021-01-01 10:00:00'));

        $this->assertEquals("inspection", $inspection->getType()->value);

        $converter = new InspectionConverter();
        $result = $converter->convert($inspection);

        $expectedResult = [
            'number' => '123',
            'description' => 'Test Inspection',
            'dueDate' => '2022-01-01 10:00:00',
            'clientPhoneNumber' => '1234567890',
            'type' => 'inspection',
            'status' => 'new',
            'createdAt' => '2021-01-01 10:00:00',
        ];

        $this->assertEquals($expectedResult, $result);
    }

}