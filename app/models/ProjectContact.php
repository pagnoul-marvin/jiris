<?php

namespace App\Models;

use Core\Database;

class ProjectContact extends Database
{
    protected string $table = 'projects_contacts';

    public function __construct()
    {
        parent::__construct(base_path('.env.local.ini'));
    }

}