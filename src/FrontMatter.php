<?php

namespace Bulldog;

use Symfony\Component\Yaml\Yaml;

class FrontMatter
{
    private $parsedown;
    private $config;

    private function __construct($file)
    {
        $this->parsedown = new \Parsedown;

        $fileContent = file_get_contents($file);

        $stuff = preg_match("/---\s(.*?)\s---/", $fileContent, $matches);

        if(!isset($matches[1])) {
            throw new \Exception('Invalid File Format');
        }

        $this->config = Yaml::parse($matches[1]);

        $markdownBegins = $this->getWhereMarkdownBegins($fileContent);
        $this->html = $this->getMarkdown($fileContent, $markdownBegins);
    }

    public static function load($file)
    {
        return new FrontMatter($file);
    }

    public function config()
    {
        return $this->config;
    }

    public function html()
    {
        return $this->html;
    }

    private function getMarkdown($content, $begins)
    {
        $data = "";
        $arrayContent = explode("\n", $content);
        for($i=$begins;$i<count($arrayContent);$i++) {
            $data .= $this->parsedown->text($arrayContent[$i]);
        }
        return $data;
    }

    private function getWhereMarkdownBegins($content)
    {
        $i = 0;
        $x = 0;
        $lines = explode("\n", $content);
        foreach($lines as $line) {
            if(strcmp($line, "---")) {
                $x++;
            }
            if($x == 2) {
                return $i + 1;
            }
            $i++;
        }
    }

}
