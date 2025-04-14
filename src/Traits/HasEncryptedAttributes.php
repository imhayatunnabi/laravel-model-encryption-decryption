<?php

namespace Imhayatunnabi\LaravelHashes\Traits;

use Illuminate\Support\Facades\Crypt;

trait HasEncryptedAttributes
{
    /**
     * Get the attributes that should be encrypted.
     *
     * @return array
     */
    protected function getEncryptableAttributes()
    {
        return $this->encryptable ?? [];
    }

    /**
     * Boot the trait.
     *
     * @return void
     */
    protected static function bootHasEncryptedAttributes()
    {
        static::saving(function ($model) {
            $model->encryptAttributes();
        });

        static::retrieved(function ($model) {
            $model->decryptAttributes();
        });
    }

    /**
     * Encrypt the encryptable attributes.
     *
     * @return void
     */
    protected function encryptAttributes()
    {
        foreach ($this->getEncryptableAttributes() as $attribute) {
            if (isset($this->attributes[$attribute])) {
                $this->attributes[$attribute] = Crypt::encryptString($this->attributes[$attribute]);
            }
        }
    }

    /**
     * Decrypt the encryptable attributes.
     *
     * @return void
     */
    protected function decryptAttributes()
    {
        foreach ($this->getEncryptableAttributes() as $attribute) {
            if (isset($this->attributes[$attribute])) {
                $this->attributes[$attribute] = Crypt::decryptString($this->attributes[$attribute]);
            }
        }
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->getEncryptableAttributes()) && !is_null($value)) {
            return Crypt::decryptString($value);
        }

        return $value;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->getEncryptableAttributes()) && !is_null($value)) {
            $value = Crypt::encryptString($value);
        }

        return parent::setAttribute($key, $value);
    }
} 