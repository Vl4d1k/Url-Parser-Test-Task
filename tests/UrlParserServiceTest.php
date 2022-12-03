<?php

declare(strict_types=1);

use Admin\UrlParser\Exception\NotImplementedException;
use Admin\UrlParser\UrlParserService;
use PHPUnit\Framework\TestCase;

final class UrlParserServiceTest extends TestCase
{
    private UrlParserService $urlParserService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->urlParserService = new UrlParserService();
    }

    /**
     * @return void
     * @throws NotImplementedException
     */
    public function testServiceWillReturnExceptionIfStrategyForHostNotImplemented(): void
    {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessage("Strategy was not found for host [rutube.ru]");

        $this->urlParserService->parse('https://rutube.ru/video/392ae32e92ef2a752117f126ff53fa42/');

    }

    /**
     * @param string $url
     * @param string $expectedVideoId
     * @param string $expectedVideoHostingName
     * @param string $expectedIframeCode
     *
     * @dataProvider provideCases
     *
     * @return void
     */
    public function testCorrectUrlParsing(
        string $url,
        string $expectedVideoId,
        string $expectedVideoHostingName,
        string $expectedIframeCode
    ): void {
        $dto = $this->urlParserService->parse($url);

        $this->assertSame($expectedVideoId, $dto->getVideoId());
        $this->assertSame($expectedVideoHostingName, $dto->getVideoHostingName());
        $this->assertSame($expectedIframeCode, $dto->getIframeCode());
    }

    /**
     * @return array
     */
    public function provideCases(): array
    {
        return [
            'Test youtube link parsing' => [
                'url' => 'https://www.youtube.com/watch?v=G1IbRujko-A',
                'expectedVideoId' => 'G1IbRujko-A',
                'expectedVideoHostingName' => 'YouTube',
                'expectedIframeCode' => '<iframe src="https://www.youtube.com/watch?v=G1IbRujko-A"></iframe>'
            ],
            'Test vimeo link parsing ' => [
                'url' => 'https://youtu.be/homqyBxHwis',
                'expectedVideoId' => 'homqyBxHwis',
                'expectedVideoHostingName' => 'YouTube',
                'expectedIframeCode' => '<iframe src="https://youtu.be/homqyBxHwis"></iframe>'
            ],
            'Test shortened youtube link parsing ' => [
                'url' => 'https://vimeo.com/225408543',
                'expectedVideoId' => '225408543',
                'expectedVideoHostingName' => 'Vimeo',
                'expectedIframeCode' => '<iframe src="https://vimeo.com/225408543"></iframe>'
            ],
        ];
    }
}
