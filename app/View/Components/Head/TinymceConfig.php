<?php

namespace App\View\Components\Head;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TinymceConfig extends Component
{
    public string $selector;
    public string $uploadUrl;

    /**
     * Create a new component instance.
     */
    public function __construct(string $selector = '#content', string $uploadUrl = null)
    {
        $this->selector = $selector;
        $this->uploadUrl = $uploadUrl ?? route('admin.upload-image');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.head.tinymce-config');
    }
}
