<?php

namespace Skeleton\SkeletonPhpApplication\Core;

class Hash
{
    /**
     * Hash de uma string usando bcrypt.
     *
     * @param string $value
     * @return string
     */
    public static function make($value)
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    /**
     * Verifica se o hash corresponde ao valor fornecido.
     *
     * @param string $value
     * @param string $hashedValue
     * @return bool
     */
    public static function check($value, $hashedValue)
    {
        return password_verify($value, $hashedValue);
    }

    /**
     * Verifica se o hash precisa ser atualizado.
     *
     * @param string $hashedValue
     * @return bool
     */
    public static function needsRehash($hashedValue)
    {
        return password_needs_rehash($hashedValue, PASSWORD_BCRYPT);
    }
}