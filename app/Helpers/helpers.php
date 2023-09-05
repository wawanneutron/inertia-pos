<?php

if (function_exists('formatPrice')) {
  // formatPrice
  function formatPrice($str) {
    return 'Rp. ' . number_format($str, '0', '', '.');
  }
}