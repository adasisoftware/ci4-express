<?php

namespace Adasi\Express\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $primaryKey = 'id';

    protected $returnType = 'object';

    public function __construct()
    {
        parent::__construct();
        
        $this->table = getenv('adasiexpress.auth.table');
    }

    public function findByUsername($username)
    {
        return $this->table($this->table)
            ->where(getenv('adasiexpress.auth.usernamefield'),$username)->first();
    }
}