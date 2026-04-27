<?php

declare(strict_types=1);

namespace MarkShust\SpecialRouter\Router;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use MarkShust\SpecialRouter\Service\PathInfoRewriter;

class SpecialRouter implements RouterInterface
{
    public function __construct(
        private readonly PathInfoRewriter $pathInfoRewriter,
    ) {
    }

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
        $pathInfo = $request->getPathInfo();
        $rewrittenPathInfo = $this->pathInfoRewriter->rewrite($pathInfo);

        if ($rewrittenPathInfo !== $pathInfo) {
            $request->setPathInfo($rewrittenPathInfo);
        }

        // Return void to allow the next router to match (void vs. null for PHP <=8.1 compatibility).
    }
}
