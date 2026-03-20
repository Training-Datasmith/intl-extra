# Architecture: intl-extra

## Purpose
A Twig extension providing internationalisation filters powered by PHP's `intl` extension. Offers filters for number formatting, currency formatting, language/country name display, time zone handling, and locale-aware date/time formatting.

## Directory Structure
```
IntlExtension.php       # All Twig filters/functions — single file extension
Tests/
  IntlExtensionTest.php # Unit tests for individual filters
  IntegrationTest.php   # Twig integration tests
```

## Key Design Decisions
- **Single-class extension** — all filters live in `IntlExtension.php` to keep the API surface small and self-contained.
- **PHP intl dependency** — requires the `ext-intl` extension; filters delegate directly to ICU-based classes (`NumberFormatter`, `IntlDateFormatter`, `Locale`, etc.).
- **No caching** — formatter instances are created on demand. For high-throughput rendering, callers should cache the compiled Twig template.

## Extension Points
- Register the `IntlExtension` with any Twig `Environment` instance.
- Subclass to override specific filters without replacing the whole extension.

## Dependency Flow
```
Twig Environment
  └─ IntlExtension
       ├─ format_currency → NumberFormatter (ICU)
       ├─ format_number  → NumberFormatter (ICU)
       ├─ country_name   → Locale / IntlChar (ICU)
       ├─ language_name  → Locale (ICU)
       └─ format_date / format_datetime → IntlDateFormatter (ICU)
```
