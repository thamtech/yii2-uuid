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

        // valid uuids
        // v1
        $this->assertTrue($val->validate('bd18d6ce-bbf2-11e8-a355-529269fb1459'));
        $this->assertTrue($val->validate('BD18D6CE-BBF2-11E8-A355-529269FB1459'));
        // v3
        $this->assertTrue($val->validate('c3a84ad9-4cac-33ad-913b-79f5993af18e'));
        $this->assertTrue($val->validate('C3A84AD9-4CAC-33AD-913B-79F5993AF18E'));
        // v4
        $this->assertTrue($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'));
        $this->assertTrue($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A'));
        // v5
        $this->assertTrue($val->validate('2d32a3f1-fac2-52a6-ac52-fe9e87e628ea'));
        $this->assertTrue($val->validate('2D32A3F1-FAC2-52A6-AC52-FE9E87E628EA'));

        // invalid uuids
        // v1
        $this->assertFalse($val->validate('bd18d6ce-bbf2-11e8-a355-529269fb145'));
        $this->assertFalse($val->validate('BD18D6CE-BBF2-11E8-A355-529269FB145'));
        $this->assertFalse($val->validate('bd18d6ce-bbf2-11e8-a355-529269fb1459-EXTRACHARS'));
        $this->assertFalse($val->validate('BD18D6CE-BBF2-11E8-A355-529269FB1459-EXTRACHARS'));
        $this->assertFalse($val->validate('bd18d6cebbf211e8a355529269fb145'));
        // v3
        $this->assertFalse($val->validate('c3a84ad9-4cac-33ad-913b-79f5993af18'));
        $this->assertFalse($val->validate('C3A84AD9-4CAC-33AD-913B-79F5993AF18'));
        $this->assertFalse($val->validate('c3a84ad9-4cac-33ad-913b-79f5993af18e-EXTRACHARS'));
        $this->assertFalse($val->validate('C3A84AD9-4CAC-33AD-913B-79F5993AF18E-EXTRACHARS'));
        $this->assertFalse($val->validate('c3a84ad94cac33ad913b79f5993af18'));
        // v4
        $this->assertFalse($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7'));
        $this->assertFalse($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7'));
        $this->assertFalse($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a-EXTRACHARS'));
        $this->assertFalse($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A-EXTRACHARS'));
        $this->assertFalse($val->validate('25769c6cd34d4bfeba98e0ee856f3e7'));
        // v5
        $this->assertFalse($val->validate('2d32a3f1-fac2-52a6-ac52-fe9e87e628e'));
        $this->assertFalse($val->validate('2D32A3F1-FAC2-52A6-AC52-FE9E87E628E'));
        $this->assertFalse($val->validate('2d32a3f1-fac2-52a6-ac52-fe9e87e628ea-EXTRACHARS'));
        $this->assertFalse($val->validate('2D32A3F1-FAC2-52A6-AC52-FE9E87E628EA-EXTRACHARS'));
        $this->assertFalse($val->validate('2d32a3f1fac252a6ac52fe9e87e628e'));
        // misc
        $this->assertFalse($val->validate(''));
        $this->assertFalse($val->validate(25769));

        $val->not = true;
        // valid uuids
        // v1
        $this->assertFalse($val->validate('bd18d6ce-bbf2-11e8-a355-529269fb1459'));
        $this->assertFalse($val->validate('BD18D6CE-BBF2-11E8-A355-529269FB1459'));
        // v3
        $this->assertFalse($val->validate('c3a84ad9-4cac-33ad-913b-79f5993af18e'));
        $this->assertFalse($val->validate('C3A84AD9-4CAC-33AD-913B-79F5993AF18E'));
        // v4
        $this->assertFalse($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a'));
        $this->assertFalse($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A'));
        // v5
        $this->assertFalse($val->validate('2d32a3f1-fac2-52a6-ac52-fe9e87e628ea'));
        $this->assertFalse($val->validate('2D32A3F1-FAC2-52A6-AC52-FE9E87E628EA'));

        // invalid uuids
        // v1
        $this->assertTrue($val->validate('bd18d6ce-bbf2-11e8-a355-529269fb145'));
        $this->assertTrue($val->validate('BD18D6CE-BBF2-11E8-A355-529269FB145'));
        $this->assertTrue($val->validate('bd18d6ce-bbf2-11e8-a355-529269fb1459-EXTRACHARS'));
        $this->assertTrue($val->validate('BD18D6CE-BBF2-11E8-A355-529269FB1459-EXTRACHARS'));
        $this->assertTrue($val->validate('bd18d6cebbf211e8a355529269fb145'));
        // v3
        $this->assertTrue($val->validate('c3a84ad9-4cac-33ad-913b-79f5993af18'));
        $this->assertTrue($val->validate('C3A84AD9-4CAC-33AD-913B-79F5993AF18'));
        $this->assertTrue($val->validate('c3a84ad9-4cac-33ad-913b-79f5993af18e-EXTRACHARS'));
        $this->assertTrue($val->validate('C3A84AD9-4CAC-33AD-913B-79F5993AF18E-EXTRACHARS'));
        $this->assertTrue($val->validate('c3a84ad94cac33ad913b79f5993af18'));
        // v4
        $this->assertTrue($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7'));
        $this->assertTrue($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7'));
        $this->assertTrue($val->validate('25769c6c-d34d-4bfe-ba98-e0ee856f3e7a-EXTRACHARS'));
        $this->assertTrue($val->validate('25769C6C-D34D-4BFE-BA98-E0EE856f3E7A-EXTRACHARS'));
        $this->assertTrue($val->validate('25769c6cd34d4bfeba98e0ee856f3e7'));
        // v5
        $this->assertTrue($val->validate('2d32a3f1-fac2-52a6-ac52-fe9e87e628e'));
        $this->assertTrue($val->validate('2D32A3F1-FAC2-52A6-AC52-FE9E87E628E'));
        $this->assertTrue($val->validate('2d32a3f1-fac2-52a6-ac52-fe9e87e628ea-EXTRACHARS'));
        $this->assertTrue($val->validate('2D32A3F1-FAC2-52A6-AC52-FE9E87E628EA-EXTRACHARS'));
        $this->assertTrue($val->validate('2d32a3f1fac252a6ac52fe9e87e628e'));
        // misc
        $this->assertTrue($val->validate(''));
        $this->assertTrue($val->validate(25769));
    }

    public function testValidateAttribute()
    {
        $val = new UuidValidator();
        $m = FakedValidationModel::createWithAttributes(['attr_uuid' => 'bd18d6ce-bbf2-11e8-a355-529269fb1459']);
        $val->validateAttribute($m, 'attr_uuid');
        $this->assertFalse($m->hasErrors('attr_uuid'));

        $m->attr_uuid = 'c3a84ad9-4cac-33ad-913b-79f5993af18e';
        $val->validateAttribute($m, 'attr_uuid');
        $this->assertFalse($m->hasErrors('attr_uuid'));

        $m->attr_uuid = '25769c6c-d34d-4bfe-ba98-e0ee856f3e7a';
        $val->validateAttribute($m, 'attr_uuid');
        $this->assertFalse($m->hasErrors('attr_uuid'));

        $m->attr_uuid = '2d32a3f1-fac2-52a6-ac52-fe9e87e628ea';
        $val->validateAttribute($m, 'attr_uuid');
        $this->assertFalse($m->hasErrors('attr_uuid'));

        $m->attr_uuid = 'non-uuid';
        $val->validateAttribute($m, 'attr_uuid');
        $this->assertTrue($m->hasErrors('attr_uuid'));
    }
}
