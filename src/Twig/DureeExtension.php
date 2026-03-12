<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DureeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('duree', [$this, 'formatDuree']),
        ];
    }

    public function formatDuree(?int $minutes, string $mode = 'short', $arrondi = null, string $zeroValue = '_'): string
    {
        if ($minutes === null || $minutes === 0) {
            return $zeroValue;
        }

        $hours = intdiv($minutes, 60);
        $mins = $minutes % 60;

        if ($mode === 'short') {
            if ($hours > 0) {
                return $hours . 'H' . str_pad($mins, 2, '0', STR_PAD_LEFT);
            }
            return $mins . 'min';
        }

        return $minutes . 'min';
    }
}
