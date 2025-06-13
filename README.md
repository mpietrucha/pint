## Installation

> **Requires [PHP 8.4+](https://php.net/releases/) and [Composer 2.8+](https://getcomposer.org)**

Require extension using [Composer](https://getcomposer.org):

```bash
composer mpietrucha/zed-laravel-pint
```

## Usage

Configure the editor settings as in the example below:

```json
"languages": {
    "PHP": {
        "formatter": {
            "external": {
                "command": "bash",
                "arguments": ["-c", "$(composer global config bin-dir --absolute --quiet)/zed-pint", "{buffer_path"]
            }
        }
    }
},
```
