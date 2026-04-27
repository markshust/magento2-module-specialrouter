<?php

declare(strict_types=1);

namespace MarkShust\SpecialRouter\Router;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class SpecialRouter implements RouterInterface
{
    private const SYMBOL_TO_NAME_MAP = [
        [
            'symbol' => '-',
            'name' => 'dash',
        ],
        [
            'symbol' => '.',
            'name' => 'period',
        ],
        [
            'symbol' => '~',
            'name' => 'tilda',
        ],
        [
            'symbol' => '_',
            'name' => 'underscore',
        ],
    ];

    /**
     * Match a route to this router.
     *
     * If there is a match, replace the path with the new path.
     * Ex. /front-name/foo-bar/baz_qux -> /front-name/foodashbar/bazunderscorequx
     *
     * @param RequestInterface $request
     * @return void
     */
    public function match(
        RequestInterface $request,
    ): void {
        [$moduleName, $pathInfo, $args] = $this->splitPath($request->getPathInfo());

        if ($this->isMatch($pathInfo)) {
            $newPathInfo = sprintf('/%s/%s%s', $moduleName, $this->replacePath($pathInfo), $args);
            $request->setPathInfo($newPathInfo);
        }

        // Return void to allow the next router to match (void vs. null for PHP <=8.1 compatibility).
    }

    /**
     * Split a raw path into [frontName, actionPath/actionName, trailing args].
     *
     * @param string $rawPathInfo
     * @return array{0: string, 1: string, 2: string}
     */
    private function splitPath(
        string $rawPathInfo,
    ): array {
        $pathParts = explode('/', trim($rawPathInfo, '/'));

        $moduleName = array_shift($pathParts) ?? '';
        $actionPath = array_shift($pathParts) ?? '';
        $actionName = array_shift($pathParts) ?? '';
        $pathInfo = trim("$actionPath/$actionName", '/');
        $args = $pathParts ? '/' . implode('/', $pathParts) : '';

        return [$moduleName, $pathInfo, $args];
    }

    /**
     * Does the path contain a character in the symbol to name map?
     *
     * @param string $pathInfo
     * @return bool
     */
    private function isMatch(
        string $pathInfo,
    ): bool {
        foreach (self::SYMBOL_TO_NAME_MAP as $item) {
            if (str_contains($pathInfo, $item['symbol'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Replace special characters in the path with their names.
     *
     * @param string $pathInfo
     * @return string
     */
    private function replacePath(
        string $pathInfo,
    ): string {
        foreach (self::SYMBOL_TO_NAME_MAP as $item) {
            $pathInfo = str_replace($item['symbol'], $item['name'], $pathInfo);
        }

        return $pathInfo;
    }
}
