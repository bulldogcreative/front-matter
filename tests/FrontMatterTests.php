<?php

use Bulldog\FrontMatter;
use PHPUnit\Framework\TestCase;

class FrontMatterTests extends TestCase
{
    public function testConfig()
    {
        $fm = FrontMatter::load('file.yaml');
        $this->assertEquals($fm->config()['title'], "Hello World");
        $this->assertEquals($fm->html(), '<h1>Hello World</h1><p>It is i, levi.</p><p><a href="https://google.com">test</a></p>');
    }
}
