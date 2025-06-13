<?php

namespace Mpietrucha\Zed\Pint;

use Illuminate\Support\Arr;
use Mpietrucha\Zed\Pint\Contracts\ConfigInterface;
use Mpietrucha\Zed\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Zed\Pint\Filesystem\File;

class Config implements ConfigInterface
{
    /**
        @var string[]
     */
    protected array $content = [];

    protected ?string $file = null;

    public function __construct(string $cwd, ?string $name = null)
    {
        $file = File::find($name ?? 'pint.json', $cwd);

        if ($file === null) {
            return;
        }

        $this->file = $file;

        $this->content = File::json($file) ?? [];
    }

    public static function build(EnvironmentInterface $environment, ?string $name = null): self
    {
        $cwd = $environment->cwd();

        return new self($cwd, $name);
    }

    public function file(): ?string
    {
        return $this->file;
    }

    /**
        @return string[]
     */
    public function excluded(): array
    {
        $excluded = Arr::only($this->content(), ['exclude', 'notPath', 'notName']);

        return Arr::flatten($excluded);
    }

    /**
        @return string[]
     */
    protected function content(): array
    {
        return $this->content;
    }
}
