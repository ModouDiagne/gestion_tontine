<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserAvatar extends Component
{
    public $user;
    public $class;

    public function __construct($user, $class = '')
    {
        $this->user = $user;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.user-avatar');
    }
}
