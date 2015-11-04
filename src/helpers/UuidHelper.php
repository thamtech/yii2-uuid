<?php
/*
 * Copyright (C) 2015 Thamtech, LLC
 *
 * This software is copyrighted. No part of this work may be
 * reproduced in whole or in part in any manner without the
 * permission of the Copyright owner, unless specifically authorized
 * by a license obtained from the Copyright owner.
**/

namespace thamtech\uuid\helpers;

use Ramsey\Uuid\Uuid;

/**
 * UuidHelper provides UUID functions that you can use in your application.
 *
 * @author Tyler Ham <tyler@thamtech.com>
 */
class UuidHelper
{
    /**
     * Generate a UUID string (version 4 by default).
     *
     * @return string canonical format UUID, i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
     */
    public static function uuid()
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * Checks if the given string looks like a UUID in the canonical format,
     * i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a. This check is case
     * insensitive.
     *
     * @param  string  $uuid UUID String to check
     *
     * @return bool       whether or not it matches the pattern.
     */
    public static function isValid($uuid)
    {
        $validator = new \thamtech\uuid\validators\UuidValidator();

        return $validator->validate($uuid, $error);
    }

    /**
     * Converts a UUID string into a compact binary string.
     *
     * @param  string $uuid UUID in canonical format, i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
     *
     * @return string compact 16-byte binary representation of the UUID.
     */
    public static function uuid2bin($uuid)
    {
        // normalize to uppercase, remove hyphens
        $hex = str_replace('-', '', strtoupper($uuid));

        // H for big-endian to behave similarly to MySQL's
        // HEX() and UNHEX() functions.
        $bin = pack('H*', $hex);

        return $bin;
    }

    /**
     * Converts a compact 16-byte binary representation of the UUID into
     * a string in canonical format, i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a.
     *
     * @param  string $uuidBin compact 16-byte binary representation of the UUID.
     *
     * @return string UUID in canonical format, i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
     */
    public static function bin2uuid($uuidBin)
    {
        // H for big-endian to behave similarly to MySQL's
        // HEX() and UNHEX() functions.
        $hexArray = unpack('H*', $uuidBin);

        $hex = strtolower(array_shift($hexArray));

        // break into components
        $components = [
          substr($hex, 0, 8),
          substr($hex, 8, 4),
          substr($hex, 12, 4),
          substr($hex, 16, 4),
          substr($hex, 20, 12),
        ];

        return implode('-', $components);
    }
}
