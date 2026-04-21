<?php

declare(strict_types=1);

namespace Fusio\Engine\Tests;

use Fusio\Engine\Request\BearerAccessToken;
use PHPUnit\Framework\TestCase;

class BearerAccessTokenTest extends TestCase
{
    public function testRawFromAuthorizationHeader(): void
    {
        $jwt = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIn0.sig';
        $this->assertSame($jwt, BearerAccessToken::rawFromAuthorizationHeader('Bearer ' . $jwt));
        $this->assertSame($jwt, BearerAccessToken::rawFromAuthorizationHeader('bearer ' . $jwt));
        $this->assertSame($jwt, BearerAccessToken::rawFromAuthorizationHeader('Bearer  ' . $jwt));
    }

    public function testReturnsNullForNonBearer(): void
    {
        $this->assertNull(BearerAccessToken::rawFromAuthorizationHeader(null));
        $this->assertNull(BearerAccessToken::rawFromAuthorizationHeader(''));
        $this->assertNull(BearerAccessToken::rawFromAuthorizationHeader('Basic Zm9v'));
    }

    public function testReturnsEmptyStringWhenBearerTokenMissing(): void
    {
        $this->assertSame('', BearerAccessToken::rawFromAuthorizationHeader('Bearer'));
        $this->assertSame('', BearerAccessToken::rawFromAuthorizationHeader('Bearer '));
    }
}
