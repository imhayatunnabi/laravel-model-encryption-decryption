<?php

namespace Imhayatunnabi\LaravelHashes\Tests;

use Illuminate\Database\Eloquent\Model;
use Imhayatunnabi\LaravelHashes\Traits\HasEncryptedAttributes;

class TestModel extends Model
{
    use HasEncryptedAttributes;

    protected $table = 'test_models';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be encrypted.
     *
     * @var array
     */
    protected $encryptable = [
        'email',
        'phone',
    ];
} 