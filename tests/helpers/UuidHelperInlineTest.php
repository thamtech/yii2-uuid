<?php

namespace thamtechunit\uuid\helpers;

/**
 * Test UuidHelper without the 'use' line at the top of the file.
 */
class UuidHelperInlineTest extends \thamtechunit\uuid\TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
    }

    public function testUuid()
    {
        $val = new \thamtech\uuid\validators\UuidValidator();

        $uuid = \thamtech\uuid\helpers\UuidHelper::uuid();
        $this->assertTrue($val->validate($uuid));

        $uuid2 = \thamtech\uuid\helpers\UuidHelper::uuid();
        $this->assertTrue($val->validate($uuid2));
    }

    public function testUuidBin()
    {
        $uuid = '25769C6C-D34D-4BFE-BA98-E0EE856f3E7A';
        $uuidBin = \thamtech\uuid\helpers\UuidHelper::uuid2bin($uuid);

        $this->assertEquals(16, strlen($uuidBin));

        $uuid2 = \thamtech\uuid\helpers\UuidHelper::bin2uuid($uuidBin);
        $this->assertEquals(strtolower($uuid), $uuid2);
    }
}
