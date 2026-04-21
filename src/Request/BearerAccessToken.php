<?php

declare(strict_types=1);

namespace Fusio\Engine\Request;

/**
 * Extracts the raw access token from an Authorization: Bearer header for user-center style APIs
 * that expect the JWT in X-User-Access-Token without a Bearer prefix.
 */
final class BearerAccessToken
{
    /**
     * @return string|null the raw token; null if the header is missing, empty, or not a Bearer scheme; empty string if Bearer was sent with an empty token
     */
    public static function rawFromAuthorizationHeader(?string $authorization): ?string
    {
        if ($authorization === null) {
            return null;
        }

        $authorization = trim($authorization);
        if ($authorization === '') {
            return null;
        }

        if (!preg_match('/^Bearer(?:\s+(.*))?$/is', $authorization, $matches)) {
            return null;
        }

        return isset($matches[1]) ? trim($matches[1]) : '';
    }
}
