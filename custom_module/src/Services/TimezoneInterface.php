<?php

namespace Drupal\custom_module\Services;

/**
 * Provides an interface defining a timezone format.
 */
interface TimezoneInterface {

  /**
   * Formats a date, using a custom date format string.
   *
   * @return string
   *   A date string in the requested format.
   */
  public function getTimeByTimezone();

}