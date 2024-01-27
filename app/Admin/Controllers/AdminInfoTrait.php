<?php

namespace App\Admin\Controllers;

trait AdminInfoTrait
{
    public function getAdminId() {
        return auth('admin')->id();
    }
}
