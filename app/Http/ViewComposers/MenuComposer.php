<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Menu;

class MenuComposer
{
    
    public function compose(View $view)
    {
        $menu = Menu::where('estado','1')->orderBy('nivel', 'asc')->get();
        $view->with('menu',$menu);
    }

   
}
