## Instalation

```bash
    composer global require mpietrucha/zed-laravel-pint
```

## Usage

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
