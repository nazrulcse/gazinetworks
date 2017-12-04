<?php

namespace App;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Entrust;

class MyMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['role']) && !Entrust::hasRole($item['role'])) {
            return false;
        }

        return $item;
    }
}