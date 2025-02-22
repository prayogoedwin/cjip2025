<?php

namespace App\Filament\Widgets;

use App\Models\Features;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\ComponentContainer;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class WidgetFeatures extends Widget
{
    use HasWidgetShield;
    protected int | string | array $columnSpan = 'full';

    public array $grid = [];
    // protected static string $view = 'filament.widgets.widget-features';

    public function getColumnsConfig(): array
    {
        if ($this instanceof ComponentContainer && $this->getParentComponent()) {
            return $this->getParentComponent()->getColumnsConfig();
        }

        return $this->columns ?? [
            'default' => 1,
            'sm' => 2,
            'md' => 2,
            'lg' => 3,
            'xl' => 3,
            '2xl' => null,
        ];
    }

    public function mount(): void
    {

        if (empty($this->grid)) {
            $this->grid = $this->getColumnsConfig();
        }
    }
    public function render(): View
    {
        $feature = Features::all();

        return view('filament.widgets.widget-features', compact('feature'));
    }
}
