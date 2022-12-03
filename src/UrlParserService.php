<?php

declare(strict_types=1);

namespace Admin\UrlParser;

use Admin\UrlParser\DTO\ParsedUrlDTO;

use Admin\UrlParser\Exception\NotImplementedException;
use Admin\UrlParser\Strategies\ShortenedYouTubeUrlParserStrategy;
use Admin\UrlParser\Strategies\VimeoUrlParserStrategy;
use Admin\UrlParser\Strategies\YouTubeUrlParserStrategy;

class UrlParserService
{
    /**
     * @param string $url
     *
     * @return ParsedUrlDTO
     *
     * @throws NotImplementedException
     * @throws \RuntimeException
     */
    public function parse(string $url): ParsedUrlDTO
    {
        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'];

        $strategy = match ($host) {
            'www.youtube.com' => new YouTubeUrlParserStrategy(),
            'youtu.be' => new ShortenedYouTubeUrlParserStrategy(),
            'vimeo.com' => new VimeoUrlParserStrategy(),
            default => throw new NotImplementedException("Strategy was not found for host [$host]")
        };

        return $strategy->parse($url);
    }
}
