<?php

if (!function_exists('badge_color')) {
    /**
     * Get badge color based on status
     */
    function badge_color($status)
    {
        $colors = [
            'active' => 'success',
            'inactive' => 'secondary',
            'pending' => 'warning',
            'completed' => 'success',
            'failed' => 'danger',
            'processing' => 'info',
        ];

        return $colors[strtolower($status)] ?? 'secondary';
    }
}

if (!function_exists('format_currency')) {
    /**
     * Format number as currency
     */
    function format_currency($amount, $currency = '₹')
    {
        return $currency . number_format($amount, 2);
    }
}

if (!function_exists('format_date')) {
    /**
     * Format date for display
     */
    function format_date($date, $format = 'd M Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('user_initials')) {
    /**
     * Get user initials from name
     */
    function user_initials($name)
    {
        $parts = explode(' ', $name);
        return strtoupper(
            substr($parts[0] ?? '', 0, 1) .
            substr($parts[1] ?? '', 0, 1)
        );
    }
}

if (!function_exists('truncate_text')) {
    /**
     * Truncate text to specified length
     */
    function truncate_text($text, $length = 50, $suffix = '...')
    {
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . $suffix;
    }
}
