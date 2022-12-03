<?php

declare(strict_types=1);

namespace Admin\UrlParser\Strategies;

use Admin\UrlParser\DTO\ParsedUrlDTO;

interface UrlParserStrategyInterface
{
    /**
     * @param string $url
     *
     * @return ParsedUrlDTO
     */
    public function parse(string $url): ParsedUrlDTO;
}
