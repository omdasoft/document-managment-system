<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Encryptable
{
    /**
     * Encrypt the given data using AES-256-CBC.
     *
     * @param  string  $key  (Optional encryption key)
     */
    public function encryptData(string $data, ?string $key = null): string
    {
        $key = $key ?: config('document.encryption_key');
        $key = substr(hash('sha256', $key, true), 0, 32);

        $iv = Str::random(16); // Generate random IV (16 bytes)
        $cipherText = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);

        // Encode IV and CipherText to make it storable in a single string
        return base64_encode($iv.'::'.$cipherText);
    }

    /**
     * Decrypt the given encrypted data using AES-256-CBC.
     *
     * @param  string  $key  (Optional decryption key)
     */
    public function decryptData(string $encryptedData, ?string $key = null): string
    {
        $key = $key ?: config('document.encryption_key');
        $key = substr(hash('sha256', $key, true), 0, 32);

        $data = base64_decode($encryptedData);
        [$iv, $cipherText] = explode('::', $data, 2);

        return openssl_decrypt($cipherText, 'AES-256-CBC', $key, 0, $iv);
    }

    /**
     * Generate a checksum for the given data.
     */
    public function generateChecksum(string $data): string
    {
        return hash('sha256', $data);
    }

    /**
     * Validate the checksum for the given data.
     */
    public function validateChecksum(string $data, string $checksum): bool
    {
        return hash('sha256', $data) === $checksum;
    }

    /**
     * Generate and store a unique encryption key for the document.
     */
    public function generateEncryptionKey()
    {
        // Generate a random encryption key (32 bytes for AES-256)
        $key = random_bytes(32);

        return $this->encryptData($key);
    }
}
