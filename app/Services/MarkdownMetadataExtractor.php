<?php

namespace App\Services;

use DateTime;

class MarkdownMetadataExtractor
{
    /**
     * @const
     */
    const CONTENT_DELIMITER = '==============================';

    /**
     * @const
     */
    const METADATA_DELIMITER = '-';

    /**
     * @const
     */
    const TITLE_DELIMITER = '#';

    /**
     * @param $content
     * @return array
     */
    public function extract($content) : array
    {
        $parts = explode(self::CONTENT_DELIMITER, $content);

        $content = array_pop($parts);

        $parts = array_map(function ($part) {
            return trim($part);
        }, explode(self::METADATA_DELIMITER, $parts[0]));

        return [
            'title'       => str_replace(self::TITLE_DELIMITER, '', $parts[0]),
            'author'      => $parts[1],
            'publishedAt' => new DateTime($parts[2]),
            'content'     => $content
        ];
    }
}