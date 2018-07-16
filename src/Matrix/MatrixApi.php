<?php

/**
 * @file
 * Matrix Api.
 */

/**
 * Matrix Api.
 *
 * Open Source PHP client for Matrix API.
 *
 * @todo: release as public package on Packagist.com and include as a dependency if time allows.
 */
class MatrixApi {

  /**
   * Host.
   *
   * @var string
   */
  private $host;

  /**
   * Api Key.
   *
   * @var string
   */
  private $apiKey;

  /**
   * Api version.
   *
   * @var string
   */
  private $apiVersion;

  /**
   * Use SSL.
   *
   * @var bool
   */
  private $useSsl;

  /**
   * Debug.
   *
   * @var bool
   */
  private $debug;

  /**
   * Port.
   *
   * @var int
   */
  private $port;

  /**
   * Set Host.
   *
   * @param string $host
   *   Host.
   */
  public function setHost($host) {
    $this->host = $host;
  }

  /**
   * Get Host.
   */
  public function getHost() {
    return $this->host;
  }

  /**
   * Set API Key.
   *
   * @var string $apiKey
   *   API Key.
   */
  public function setApiKey($apiKey) {
    $this->apiKey = $apiKey;
  }

  /**
   * Get API Key.
   *
   * @return string
   *   API Key.
   */
  public function getApiKey() {
    return $this->apiKey;
  }

  /**
   * Set API Version.
   *
   * @param string $apiVersion
   *   API Version.
   */
  public function setApiVersion($apiVersion) {
    $this->apiVersion = $apiVersion;
  }

  /**
   * Get API Version.
   *
   * @return string
   *   API Version.
   */
  public function getApiVersion() {
    return $this->apiVersion;
  }

  /**
   * Set Use SSL.
   *
   * @param string $useSsl
   *   Api Version.
   */
  public function setUseSsl($useSsl) {
    $this->useSsl = $useSsl;
  }

  /**
   * Get Use SSL.
   *
   * @return bool
   *   Use SSL.
   */
  public function isUseSsl() {
    return $this->useSsl;
  }

  /**
   * Set Debug.
   *
   * @param string $debug
   *   Debug.
   */
  public function setDebug($debug) {
    $this->debug = $debug;
  }

  /**
   * Get Debug.
   *
   * @return bool
   *   Debug.
   */
  public function isDebug() {
    return $this->debug;
  }

  /**
   * Set Port.
   *
   * @param string $port
   *   Port.
   */
  public function setPort($port) {
    $this->port = $port;
  }

  /**
   * Get Port.
   *
   * @return int
   *   Port.
   */
  public function getPort() {
    return $this->port;
  }

  /**
   * API constructor.
   *
   * @param array $attributes
   *   API attributes.
   */
  public function __construct(array $attributes) {
    $this->host = $attributes['host'];
    $this->apiKey = $attributes['api_key'];
    $this->apiVersion = $attributes['api_version'];
    $this->useSsl = $attributes['use_ssl'];
    $this->debug = isset($attributes['debug']) ? $attributes['debug'] : FALSE;

    if (isset($attributes['port'])) {
      $this->port = $attributes['port'];
    }
    else {
      $this->port = $this->useSsl ? 443 : 80;
    }
  }

  /**
   * Get the version number of the API.
   *
   * @return int
   *   API Version.
   */
  public function getVersion() {
    return $this->get('get_version');
  }

  /**
   * Invoke Method via GET.
   *
   * @param string $method
   *   Method to invoke.
   * @param array $args
   *   Arguments.
   *
   * @return mixed
   *   Response.
   */
  protected function get($method, array $args = []) {
    if (strlen($this->apiKey)) {
      $args['api_key'] = $this->apiKey;
    }

    if (strlen($this->apiVersion)) {
      $args['api_version'] = $this->apiVersion;
    }

    if (strlen($this->debug)) {
      $args['debug'] = $this->debug;
    }

    $parts = [];

    foreach ($args as $key => $value) {
      if (is_array($value)) {
        foreach ($value as $part) {
          $parts[] = urlencode($key) . '[]=' . urlencode($part);
        }
      }
      else {
        $parts[] = urlencode($key) . '=' . urlencode($value);
      }
    }

    $path = ($this->useSsl ? 'https://' : 'http://') . $this->host . '/api/' . $method . '?' . implode('&', $parts);
    $result = file_get_contents($path);
    return json_decode($result);
  }

  /**
   * Ensure parameter is returned as an array.
   *
   * @param string $ids
   *   Values.
   *
   * @return array
   *   Values formatted as an array.
   */
  public function toArray($ids) {
    if (is_array($ids)) {
      return $ids;
    }
    else {
      return explode(',', $ids);
    }
  }

}
