<?php

namespace App\Services;

interface Markdown
{
    /**
     * @param string $markdown
     * @return string
     */
    public function toHtml(string $markdown) : string;
}