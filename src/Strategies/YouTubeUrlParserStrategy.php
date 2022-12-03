<?php

declare(strict_types=1);

namespace Admin\UrlParser\Strategies;

use Admin\UrlParser\DTO\ParsedUrlDTO;

class YouTubeUrlParserStrategy implements UrlParserStrategyInterface
{
    private const VIDEO_HOSTING_NAME = 'YouTube';

    /**
     * @param string $url
     *
     * @return ParsedUrlDTO
     */
    public function parse(string $url): ParsedUrlDTO
    {
        $parsedUrl = parse_url($url);

        parse_str($parsedUrl["query"] ?? '', $queryParams);

        $videoId = $queryParams['v'] ?? null;
        if (!$videoId) {
            throw new \RuntimeException("Can`t parse url: [$url]");
        }

        return new ParsedUrlDTO(
            $queryParams['v'],
            self::VIDEO_HOSTING_NAME,
            $url
        );
    }
}
