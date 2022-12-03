<?php

declare(strict_types=1);

namespace Admin\UrlParser\DTO;

class ParsedUrlDTO {
    /**
     * @param string $videoId
     * @param string $videoHostingName
     * @param string $rawUrl
     */
    public function __construct(
        private string $videoId,
        private string $videoHostingName,
        private string $rawUrl
    ) {
    }

    /**
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->videoId;
    }

    /**
     * @return string
     */
    public function getVideoHostingName(): string
    {
        return $this->videoHostingName;
    }

    /**
     * @return string
     */
    public function getRawUrl(): string
    {
        return $this->rawUrl;
    }

    /**
     * @return string
     */
    public function getIframeCode(): string
    {
        return "<iframe src=\"$this->rawUrl\"></iframe>";
    }
}
