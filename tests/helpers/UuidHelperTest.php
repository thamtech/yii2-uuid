<?php

namespace thamtechunit\uuid\helpers;

use thamtech\uuid\validators\UuidValidator;
use thamtech\uuid\helpers\UuidHelper;

class UuidHelperTest extends \thamtechunit\uuid\TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
    }

    public function testUuid()
    {
        $val = new UuidValidator();

        $uuid = UuidHelper::uuid();
        $this->assertTrue($val->validate($uuid));

        $uuid2 = UuidHelper::uuid();
        $this->assertTrue($val->validate($uuid2));
    }

    public function testIsValid()
    {
        $this->assertTrue(UuidHelper::isValid('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'));
        $this->assertTrue(UuidHelper::isValid('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A'));

        $this->assertFalse(UuidHelper::isValid('25769c6c-d34d-4bfe-ba98-e0ee856f3e7'));
        $this->assertFalse(UuidHelper::isValid('25769C6C-D34D-4BFE-BA98-E0EE856f3E7'));
        $this->assertFalse(UuidHelper::isValid('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a-EXTRACHARS'));
        $this->assertFalse(UuidHelper::isValid('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A-EXTRACHARS'));
        $this->assertFalse(UuidHelper::isValid(''));
        $this->assertFalse(UuidHelper::isValid('25769c6cd34d4bfeba98e0ee856f3e7'));
        $this->assertFalse(UuidHelper::isValid(25769));
    }

    public function testUuidBin()
    {
        $uuid = '25769C6C-D34D-4BFE-BA98-E0EE856f3E7A';
        $uuidBin = UuidHelper::uuid2bin($uuid);

        $this->assertEquals(16, strlen($uuidBin));

        $uuid2 = UuidHelper::bin2uuid($uuidBin);
        $this->assertEquals(strtolower($uuid), $uuid2);
    }
}
