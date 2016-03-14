<?php

namespace App\Services;

use League\CommonMark\CommonMarkConverter;

class CommonMark implements Markdown
{
    /**
     * @var CommonMarkConverter
     */
    private $converter;

    /**
     * @param CommonMarkConverter $converter
     */
    public function __construct(CommonMarkConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @param string $markdown
     * @return string
     */
    public function toHtml(string $markdown) : string
    {
        return $this->converter->convertToHtml($markdown);
    }
}