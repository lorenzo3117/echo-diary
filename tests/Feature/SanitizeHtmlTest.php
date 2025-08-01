<?php

namespace Tests\Feature;

use Tests\TestCase;

class SanitizeHtmlTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_sanitize_html(): void
    {
        $html = <<<HTML
            <p>Hello</p><script>alert('XSS')</script><p>World</p>
        HTML;

        $expected = <<<HTML
            <p>Hello</p><p>World</p>
        HTML;

        $this->assertEquals($expected, sanitizeHtml($html));
    }
}
