<?php declare(strict_types = 1);

namespace jbtcd\Fitbit\Logger;

class DebugStack
{
    public array $calls = [];
    private bool $enabled = true;
    private ?float $start = null;
    private int $currentCall = 0;

    public function startCall(string $url): void
    {
        if (! $this->enabled) {
            return;
        }

        $this->start = microtime(true);

        $this->calls[++$this->currentCall] = [
            'url' => $url,
            'executionMS' => 0,
        ];
    }

    public function endCall(): void
    {
        if (! $this->enabled) {
            return;
        }

        $this->calls[$this->currentCall]['executionMS'] = microtime(true) - $this->start;
    }
}
