<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class form_input extends Component
{
    public function __construct(
        public string $type = 'text',
        public string $name = '',
        public string $value = '',
        public string $placeholder = ''
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
