<?php
require_once __DIR__ . '/BaseAdminController.php';
class AdminController extends BaseAdminController
{
    public function dashboard()
    {
        require_once './views/admin/dashboard.php';
    }
}
