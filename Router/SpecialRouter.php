<?php

declare(strict_types=1);

namespace MarkShust\SpecialRouter\Router;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class SpecialRouter implements RouterInterface
{
    private const array SYMBOL_TO_NAME_MAP = [
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
     * Ex. /my-module/foo-bar/baz_qux -> /my-module/foodashbar/bazunderscorequx
     *
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(
        RequestInterface $request,
    ): ActionInterface|null {
        $identifier = trim($request->getPathInfo(), '/');
        $pathParts = explode('/', $identifier);
        $moduleName = array_shift($pathParts);
        $pathInfo = implode('/', $pathParts);

        if ($this->isMatch($pathInfo)) {
            $newPathInfo = $this->replacePath($pathInfo);
            $newPathInfo = "/$moduleName/$newPathInfo";
            $request->setPathInfo($newPathInfo);
        }

        // Now that path has been updated, return null to allow the next router to match.
        return null;
    }

    /**
     * Does the path contain a character in the symbol to name map?
     *
     * @param string $pathInfo
     * @return bool
     */
    public function isMatch(string $pathInfo): bool
    {
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
    public function replacePath(string $pathInfo): string
    {
        foreach (self::SYMBOL_TO_NAME_MAP as $item) {
            $pathInfo = str_replace($item['symbol'], $item['name'], $pathInfo);
        }

        return $pathInfo;
    }
}
