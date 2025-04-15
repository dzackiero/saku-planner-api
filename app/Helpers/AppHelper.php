<?php

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use Spatie\LaravelData\Data;

/**
 * Get all values of a backed Enum class (string/int).
 *
 * @param class-string<UnitEnum> $enumClass
 * @return array
 */

if (!function_exists('enum_values')) {
  /**
   * Get all values of a backed Enum class (string/int).
   *
   * @param class-string<UnitEnum> $enumClass
   * @return array
   */
  function enum_values(string $enumClass): array
  {
    return array_map(fn($case) => $case->value, $enumClass::cases());
  }
}

if (!function_exists('getDeviceName')) {
  /**
   * Get the device name from the request's User-Agent header.
   * @return string
   */
  function getDeviceName()
  {
    $request = request();
    AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

    $userAgent = $request->header('User-Agent');
    $dd = new DeviceDetector($userAgent);
    $dd->parse();

    if ($dd->isBot()) {
      $botInfo = $dd->getBot();
      return $botInfo['name'] ?? 'Unknown Bot';
    }

    $device = $dd->getDeviceName();
    $brand = $dd->getBrandName();
    $model = $dd->getModel();
    $os = $dd->getOs();
    $client = $dd->getClient();

    $parts = [];

    if ($model) {
      $parts[] = $model;
    } elseif ($brand) {
      $parts[] = $brand;
    }

    if (!empty($os['name'])) {
      $parts[] = $os['name'];
    }

    if (!empty($client['name'])) {
      $parts[] = $client['name'];
    }

    return implode(' - ', $parts) ?: 'Unknown Device';
  }
}
