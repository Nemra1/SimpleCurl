<?php
//Simple Curl
//Author: Silviu Bogdan Stroe
//Contact: silviu[at]silviu-s.com - www.silviu-s.com
class SimpleCurl
{
    public $timeout = 0;
    public $mycookies = null;
    public $headers = null;
    public $fields = null;
    public $followlocation = true;
    public $val = false;

    public function url($url)
    {
        $this->url = $url;
    }

    public function referer($ref)
    {
        $this->referer = $ref;
    }


    public function timeout($timeout)
    {
        $this->timeout = $timeout;
    }


    public function cookies($val)
    {
        $this->cookies = $val;
    }


    public function followredirect($followlocation)
    {
        $this->followlocation = $followlocation;
    }

    public function useragent($useragent)
    {
        $this->useragent = $useragent;
    }


    public function post($fields)
    {
        $this->fields = http_build_query($fields);
    }


    public function setcookies($mycookies)
    {
        $this->mycookies = $mycookies;
    }


    public function setheaders($headers)
    {
        $this->headers = $headers;
    }

    public function getdata()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_REFERER, $this->referer);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $this->followlocation);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);
        //check if you want the coookies enabled
        if ($this->cookies == true) {
            curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.txt");
            curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.txt");
        }
        //check if you want to post some data
        if ($this->fields != null) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->fields);
        }
        //check if you set some headers or cookies
        if ($this->headers != null)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        if ($this->mycookies != null)
            curl_setopt($ch, CURLOPT_COOKIE, $this->mycookies);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}

?>
