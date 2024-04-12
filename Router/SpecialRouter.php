<?php

declare(strict_types=1);

namespace MarkShust\SpecialRouter\Router;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Router\Base;

class SpecialRouter extends Base
{
    private const array SPECIAL_MAP = [
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
     * Translate special characters in the path to names.
     *
     * @param RequestInterface $request
     * @return array
     */
    protected function parseRequest(RequestInterface $request): array
    {
        $output = parent::parseRequest($request);

        foreach (self::SPECIAL_MAP as $item) {
            // These two lines convert the symbol to its related name (For example, - to dash).
            // This makes it so that "Dash" can be used within a controller class name to respond to these requests.
            $output['actionPath'] = isset($output['actionPath'])
                ? str_replace($item['symbol'], $item['name'], $output['actionPath'])
                : null;
            $output['actionName'] = isset($output['actionName'])
                ? str_replace($item['symbol'], $item['name'], $output['actionName'])
                : null;
        }

        return $output;
    }
}
