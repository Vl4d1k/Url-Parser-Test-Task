<?php

declare(strict_types=1);

namespace Admin\UrlParser\Strategies;

use Admin\UrlParser\DTO\ParsedUrlDTO;

class VimeoUrlParserStrategy implements UrlParserStrategyInterface
{
    private const VIDEO_HOSTING_NAME = 'Vimeo';

    /**
     * @param string $url
     *
     * @return ParsedUrlDTO
     */
    public function parse(string $url): ParsedUrlDTO
    {
        $parsedUrl = parse_url($url);

        $path = $parsedUrl['path'] ?? null;
        if (!$path) {
            throw new \RuntimeException("Can`t parse url: [$url]");
        }

        $videoId = ltrim($path, '/');

        return new ParsedUrlDTO(
            $videoId,
            self::VIDEO_HOSTING_NAME,
            $url
        );
    }
}
