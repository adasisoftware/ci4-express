<?php
/**
 * Adasi Express
 * Utilities package used in Adasi Software's CodeIgniter 4 projects
 * 
 * Authenticator library
 * 
 * @author Adasi Software <ricardo@adasi.com.br>
 * @link https://www.adasi.com.br
 */

namespace Adasi\Express\Libraries;

use Adasi\Express\Models\UserModel;

class Authenticator
{

    /**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
    protected $session;

    public function __construct()
	{
		// start session
        $this->session = \Config\Services::session();
	}

    public function login($data = [])
    {

        $userModel = new UserModel();

        $user = $userModel->findByUsername($data['username']);

        if (!$user || !password_verify($data['password'], $user->{getenv('adasiexpress.auth.passwordfield')}))
            return [
                'success' => false, 
                'message' => getenv('adasiexpress.auth.failmessage'),
            ];

        if (!$user->ativo)
            return [
                'success' => false, 
                'message' => getenv('adasiexpress.auth.inactiveusermessage'),
            ];

        $this->persist($user);

        return [
            'success' => true,
        ];
    }

    public function persist($user)
    {
        $this->session->set('isLogged',true);
        $this->session->set('user',$user);    
    }

    public function logout()
    {     
        $this->session->destroy();
    }

    public function isLogged()
    {
        return $this->session->isLogged;
    }
}