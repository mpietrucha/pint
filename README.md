## Installation

> **Requires [PHP 8.2+](https://php.net/releases/) and [Composer 2.8+](https://getcomposer.org)**

Require extension using [Composer](https://getcomposer.org):

```bash
composer mpietrucha/zed-laravel-pint
```

## Usage

This example assumes that `vendor/bin` is [globally available](https://www.uptimia.com/questions/how-to-add-composervendorbin-to-your-path) in your `PATH`.

```json
"languages": {
    "PHP": {
        "formatter": {
            "external": {
                "command": "zed-pint",
                "arguments": ["{buffer_path"]
            }
        }
    }
},
```
