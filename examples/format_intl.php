<?php

declare(strict_types=1);

/**
 * Example: ICU-based number, currency, and date formatting with Twig intl-extra extension.
 *
 * Run from the intl-extra project root:
 *   php examples/format_intl.php
 */

require __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Extra\Intl\IntlExtension;

$loader = new ArrayLoader([
    'report.html.twig' => <<<'TWIG'
Price:    {{ 1234567.89 | format_currency('USD', locale='en') }}
Price DE: {{ 1234567.89 | format_currency('EUR', locale='de') }}
Number:   {{ 1234567.89 | format_number(locale='en') }}
Percent:  {{ 0.753 | format_number(style='percent', locale='en') }}
Date:     {{ date | format_date(locale='en') }}
Time:     {{ date | format_time(pattern='HH:mm', locale='en') }}
Country:  {{ 'US' | country_name('en') }}
Currency: {{ 'EUR' | currency_name('de') }}
Language: {{ 'fr' | language_name('en') }}
TWIG,
]);

$twig = new Environment($loader);
$twig->addExtension(new IntlExtension());

$output = $twig->render('report.html.twig', [
    'date' => new \DateTimeImmutable('2026-03-20 14:30:00', new \DateTimeZone('UTC')),
]);

echo $output;
