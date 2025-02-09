<?php

namespace common\helpers;

use Yii;
use yii\helpers\Url;

class URLHelper extends \yii\helpers\BaseUrl
{

    /**
     * @param $route mixed
     * @return bool
     */
    public static function isRoute($route)
    {
        return Yii::$app->request->getUrl() == Url::toRoute($route);
    }

    /**
     * Add a trailing slash to an url if there is no trailing slash at the end of the url.
     *
     * @param string $url The url which a trailing slash should be appended
     * @param string $slash If you want to trail a file on a windows system it gives you the ability to add forward slashes.
     * @return string The url with added trailing slash, if requred.
     */
    public static function trailing($url, $slash = '/')
    {
        return rtrim($url, $slash) . $slash;
    }

    /**
     * This helper method will not concern any context informations
     *
     * @param array $routeParams Example array to route `['/module/controller/action']`.
     * @param boolean $scheme Whether to return the absolute url or not
     * @return string The created url.
     */
    public static function toInternal(array $routeParams, $scheme = false)
    {
        if ($scheme) {
            return Yii::$app->getUrlManager()->internalCreateAbsoluteUrl($routeParams);
        }

        return Yii::$app->getUrlManager()->internalCreateUrl($routeParams);
    }

    /**
     * Create a link to use when point to an ajax script.
     *
     * @param string $route  The base routing path defined in yii. module/controller/action
     * @param array $params Optional array containing get parameters with key value pairing
     * @return string The ajax url link.
     */
    public static function toAjax($route, array $params = [])
    {
        $routeParams = ['/'.$route];
        foreach ($params as $key => $value) {
            $routeParams[$key] = $value;
        }

        return static::toInternal($routeParams, true);
    }

    /**
     * Apply the http protcol to an url to make sure valid clickable links. Commonly used when provide link where user could have added urls
     * in an administration area. For Example:
     *
     * ```php
     * Url::ensureHttp('luya.io'); // return http://luya.io
     * Url::ensureHttp('www.luya.io'); // return https://luya.io
     * Url::ensureHttp('luya.io', true); // return https://luya.io
     * ```
     *
     * @param string $url The url where the http protcol should be applied to if missing
     * @param boolean $https Whether the ensured url should be returned as https or not.
     * @return string
     */
    public static function ensureHttp($url, $https = false)
    {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = ($https ? "https://" : "http://") . $url;
        }

        return $url;
    }

    /**
     * @param $domain
     * @return bool
     */
    public static function contaisDomainInAbsolute($domain) {
        $absoluteHost = parse_url(Yii::$app->request->getAbsoluteUrl(), PHP_URL_HOST);
        $domainHost = parse_url($domain, PHP_URL_HOST);
        return strpos($absoluteHost, $domainHost) !== false;
    }

    /**
     * Remove scheme from URL
     *
     * @param $url
     * @return string
     */
    public static function removeScheme($url)
    {
        $parsed_url = parse_url($url);
        $scheme = '//';
        $host = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass = isset($parsed_url['pass']) ? ':' . $parsed_url['pass'] : '';
        $pass = ($user || $pass) ? "$pass@" : '';
        $path = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $query = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }

}