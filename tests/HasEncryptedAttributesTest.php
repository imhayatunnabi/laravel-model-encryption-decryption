<?php

namespace Imhayatunnabi\LaravelHashes\Tests;

use Illuminate\Support\Facades\Crypt;

class HasEncryptedAttributesTest extends TestCase
{
    /** @test */
    public function it_encrypts_attributes_when_saving()
    {
        $model = TestModel::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890'
        ]);

        $this->assertNotEquals('john@example.com', $model->getAttributes()['email']);
        $this->assertNotEquals('1234567890', $model->getAttributes()['phone']);
    }

    /** @test */
    public function it_decrypts_attributes_when_retrieving()
    {
        $model = TestModel::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890'
        ]);

        $retrieved = TestModel::find($model->id);

        $this->assertEquals('john@example.com', $retrieved->email);
        $this->assertEquals('1234567890', $retrieved->phone);
    }

    /** @test */
    public function it_handles_null_values()
    {
        $model = TestModel::create([
            'name' => 'John Doe',
            'email' => null,
            'phone' => null
        ]);

        $retrieved = TestModel::find($model->id);

        $this->assertNull($retrieved->email);
        $this->assertNull($retrieved->phone);
    }

    /** @test */
    public function it_updates_encrypted_attributes()
    {
        $model = TestModel::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890'
        ]);

        $model->update([
            'email' => 'new@example.com',
            'phone' => '0987654321'
        ]);

        $retrieved = TestModel::find($model->id);

        $this->assertEquals('new@example.com', $retrieved->email);
        $this->assertEquals('0987654321', $retrieved->phone);
    }
} 