<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TinymceEditor extends Component
{
    public string $name;
    public string $id;
    public ?string $value;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name = 'content', string $id = 'content', ?string $value = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.tinymce-editor');
    }
}
