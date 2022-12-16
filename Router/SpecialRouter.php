<?php declare(strict_types=1);

namespace MarkShust\SpecialRouter\Router;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Router\Base;

class SpecialRouter extends Base
{
    const specialMap = [
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

    protected function parseRequest(RequestInterface $request): array
    {
        $output = parent::parseRequest($request);

        foreach (self::specialMap as $item) {
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
