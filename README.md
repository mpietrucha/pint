## Installation

> **Requires [PHP 8.5+](https://php.net/releases/) and [Composer 2.8+](https://getcomposer.org)**

Require extension using [Composer](https://getcomposer.org):

```bash
composer require mpietrucha/pint
```

## Usage

This example assumes that `vendor/bin` is [globally available](https://getcomposer.org/doc/00-intro.md#globally) in your `PATH`.

```json
"languages": {
    "PHP": {
        "formatter": {
            "external": {
                "command": "pint",
                "arguments": ["{buffer_path"]
            }
        }
    }
},
```
