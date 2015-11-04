<?php

namespace thamtechunit\uuid\validators;

use thamtech\uuid\validators\UuidValidator;
use thamtechunit\uuid\data\validators\models\FakedValidationModel;

class UuidValidatorTest extends \thamtechunit\uuid\TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();
    }

    public function testValidateValue()
    {
        $val = new UuidValidator();
        $this->assertTrue($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'));
        $this->assertTrue($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A'));

        $this->assertFalse($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7'));
        $this->assertFalse($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7'));
        $this->assertFalse($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a-EXTRACHARS'));
        $this->assertFalse($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A-EXTRACHARS'));
        $this->assertFalse($val->validate(''));
        $this->assertFalse($val->validate('25769c6cd34d4bfeba98e0ee856f3e7'));
        $this->assertFalse($val->validate(25769));

        $val->not = true;
        $this->assertFalse($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'));
        $this->assertFalse($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A'));

        $this->assertTrue($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7'));
        $this->assertTrue($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7'));
        $this->assertTrue($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a-EXTRACHARS'));
        $this->assertTrue($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A-EXTRACHARS'));
        $this->assertTrue($val->validate(''));
        $this->assertTrue($val->validate('25769c6cd34d4bfeba98e0ee856f3e7'));
        $this->assertTrue($val->validate(25769));
    }

    public function testValidateAttribute()
    {
        $val = new UuidValidator();
        $m = FakedValidationModel::createWithAttributes(['attr_uuid' => '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a']);
        $val->validateAttribute($m, 'attr_uuid');
        $this->assertFalse($m->hasErrors('attr_uuid'));

        $m->attr_uuid = 'non-uuid';
        $val->validateAttribute($m, 'attr_uuid');
        $this->assertTrue($m->hasErrors('attr_uuid'));
    }
}
