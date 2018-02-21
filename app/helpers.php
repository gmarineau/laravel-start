<?php

function active_if($route_names)
{
  $route_names = (array) $route_names;


  foreach ($route_names as $route_name) {;
    if (Route::is($route_name)) {
        return 'active';
    }
  }

  return '';
}