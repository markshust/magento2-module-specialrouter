<?php

declare(strict_types=1);

namespace MarkShust\SpecialRouter\Service;

use MarkShust\SpecialRouter\Model\SpecialRouterSymbol;

class PathInfoRewriter
{
    /**
     * Rewrite only actionPath and actionName path parts.
     *
     * @param string $pathInfo
     * @return string
     */
    public function rewrite(
        string $pathInfo,
    ): string {
        $trimmedPathInfo = trim($pathInfo, '/');

        if ($trimmedPathInfo === '') {
            return $pathInfo;
        }

        $pathParts = explode('/', $trimmedPathInfo);
        [$pathParts, $didReplaceActionPath] = $this->rewriteActionPath($pathParts);
        [$pathParts, $didReplaceActionName] = $this->rewriteActionName($pathParts);
        $didReplace = $didReplaceActionPath || $didReplaceActionName;

        if (!$didReplace) {
            return $pathInfo;
        }

        return '/' . implode('/', $pathParts);
    }

    /**
     * @param array<int, string> $pathParts
     * @return array{0: array<int, string>, 1: bool}
     */
    private function rewriteActionPath(
        array $pathParts,
    ): array {
        return $this->rewriteSegment($pathParts, 1);
    }

    /**
     * @param array<int, string> $pathParts
     * @return array{0: array<int, string>, 1: bool}
     */
    private function rewriteActionName(
        array $pathParts,
    ): array {
        return $this->rewriteSegment($pathParts, 2);
    }

    /**
     * @param array<int, string> $pathParts
     * @param int $segmentIndex
     * @return array{0: array<int, string>, 1: bool}
     */
    private function rewriteSegment(
        array $pathParts,
        int $segmentIndex,
    ): array {
        if (!isset($pathParts[$segmentIndex])) {
            return [$pathParts, false];
        }

        $rewrittenPathPart = $this->replaceSymbols($pathParts[$segmentIndex]);
        if ($rewrittenPathPart === $pathParts[$segmentIndex]) {
            return [$pathParts, false];
        }

        $pathParts[$segmentIndex] = $rewrittenPathPart;
        return [$pathParts, true];
    }

    private function replaceSymbols(
        string $pathPart,
    ): string {
        foreach (SpecialRouterSymbol::cases() as $routerSymbol) {
            $pathPart = str_replace(
                $routerSymbol->value,
                $routerSymbol->key(),
                $pathPart
            );
        }

        return $pathPart;
    }
}
