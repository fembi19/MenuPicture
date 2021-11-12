<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_auth extends Model
{

	protected $table = 'users';
	protected $allowedFields = ['username', 'password'];
}
