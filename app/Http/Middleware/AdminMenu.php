<?php

namespace App\Http\Middleware;

use Closure;

class AdminMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         \Menu::make('Admin', function ($menu) {
            $dashboard = $menu->add('Dashboard', [
                'route'  => 'admin.dashboard',
                'class' => 'nav-item',
                'data-toggle' => 'tooltip',
                'data-placement' => 'right',
                'title' => 'Dashboard',
            ])
            ->prepend('<i class="fa fa-fw fa-dashboard"></i> <span class="nav-link-text">')
            ->append('</span>');
            $dashboard->link->attr([
                'class' => 'nav-link'
            ]);
            $users = $menu->add('Users', [
                'route'  => 'admin.users.index',
                'class' => 'nav-item',
                'data-toggle' => 'tooltip',
                'data-placement' => 'right',
                'title' => 'Users',
            ])
            ->prepend('<i class="fa fa-fw fa-users"></i> <span class="nav-link-text">')
            ->append('</span>');
            $users->link->attr([
                'class' => 'nav-link'
            ]);
        });
        
        return $next($request);
    }
}
