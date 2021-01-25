<?php 
/**
 * Adasi Express
 * Utilities package used in Adasi Software's CodeIgniter 4 projects
 * 
 * Authenticator controller
 * 
 * @author Adasi Software <ricardo@adasi.com.br>
 * @link https://www.adasi.com.br
 */

namespace Adasi\Express\Controllers;

use CodeIgniter\Controller;
use Adasi\Express\Libraries\Twig;
use Adasi\Express\Libraries\Authenticator;

class AuthController extends Controller
{
    /**
     * @var \Adasi\Libraries\Twig
     */
	protected $twig;    

    /**
     * @var \Adasi\Libraries\Authenticator
     */
    protected $authentication;
    
    public function __construct()
	{
		// start session
        $this->twig = new Twig();
        $this->authentication = new Authenticator();
	}
    
    /**
     * Carrega a página de login
     *
     * @return void
     */
	public function index()
	{
		return $this->twig->render('auth/login.html.twig',[
		]);
    }
    
    /**
     * Efetua a tentativa de login no sistema
     *
     * @return void
     */
    public function attemptLogin()
    {
        $form = $this->request->getPost();

        $attemptLogin = $this->authentication->login($form);

        if (isset($attemptLogin['success']) && !$attemptLogin['success'])
            return redirect()->to('/')->withInput()->with('error', $attemptLogin['message']);

        if (isset($attemptLogin['success']) && $attemptLogin['success'])
            return redirect()->to('dashboard');
        
        return redirect()->to('/')->withInput()->with('error', 'Ocorreu um erro inesperado!');
    }

    /**
     * Efetua o logout do sistema
     *
     * @return void
     */
    public function logout()
    {
        $this->authentication->logout();
        
        return redirect()->to('/');
    }
}
