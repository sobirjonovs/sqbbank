<?php

/**
 * @property SimpleXMLElement|string xml
 */
class CbrXmlParser
{
    private $xml;

    public const TODAY = 'today';
    public const THIRTY_DAYS = 'thirtyDays';
    public const FORMAT_DMY = 'd/m/Y';
    public const FORMAT_YMD = 'Y/m/d';

    private $dailies = [];

    public function set(string $url, $params = [])
    {
        $this->xml = simplexml_load_file($url);
        if (!empty($params)) {
            $this->xml = simplexml_load_file($url . '?' . http_build_query($params));
        }
    }

    public function get(string $index = null)
    {
        return $index ? $this->xml->{$index} : $this->xml;
    }

    public function times(string $format, string $time)
    {
        return [
            'today' => date($format, time()),
            'thirtyDays' => date($format, time() + 2592000)
        ][$time];
    }
}