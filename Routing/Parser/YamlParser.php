<?php

namespace Gear\Routing\Parser;

use Symfony\Component\Yaml\Yaml;

class YamlParser implements ParserInterface
{
    public function parse($file)
    {
        return Yaml::parse($file);
    }
}
