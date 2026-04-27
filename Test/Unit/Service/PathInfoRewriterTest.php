<?php

declare(strict_types=1);

namespace MarkShust\SpecialRouter\Test\Unit\Service;

require_once dirname(__DIR__, 3) . '/Model/SpecialRouterSymbol.php';
require_once dirname(__DIR__, 3) . '/Service/PathInfoRewriter.php';

use MarkShust\SpecialRouter\Service\PathInfoRewriter;
use PHPUnit\Framework\TestCase;

class PathInfoRewriterTest extends TestCase
{
    /**
     * @dataProvider rewriteDataProvider
     */
    public function testRewrite(
        string $pathInfo,
        string $expectedPathInfo,
    ): void {
        $pathInfoRewriter = new PathInfoRewriter();

        self::assertSame($expectedPathInfo, $pathInfoRewriter->rewrite($pathInfo));
    }

    /**
     * @return array<string, array{0: string, 1: string}>
     */
    public static function rewriteDataProvider(): array
    {
        return [
            'rewrite controller and action for dash and period' => [
                '/foo/alpha-beta/charlie.delta',
                '/foo/alphadashbeta/charlieperioddelta',
            ],
            'do not rewrite front name' => [
                '/test-test/index/index',
                '/test-test/index/index',
            ],
            'do not rewrite store switcher params' => [
                '/stores/store/redirect/___store/bg_bg/___from_store/us_en/uenc/aHR0cHM6Ly9wcm9tb2NlbGwudGVzdC9iZ19iZy8~',
                '/stores/store/redirect/___store/bg_bg/___from_store/us_en/uenc/aHR0cHM6Ly9wcm9tb2NlbGwudGVzdC9iZ19iZy8~',
            ],
            'rewrite only controller with two segments after front name' => [
                '/foo/alpha-beta',
                '/foo/alphadashbeta',
            ],
            'do not rewrite underscores in action name' => [
                '/foo/bar/baz_qux',
                '/foo/bar/baz_qux',
            ],
            'no rewrite for empty path' => [
                '/',
                '/',
            ],
        ];
    }
}
