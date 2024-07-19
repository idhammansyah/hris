<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
  /**
   * Instance of the main Request object.
   *
   * @var CLIRequest|IncomingRequest
   */
  protected $request;
  protected $sessions;
	
	protected $users; 
  protected $log_activity; 
  protected $token; 
  protected $session; 
  protected $validation;
  protected $menu; 
  protected $sub_menu;
  protected $role;
  protected $calendar_events; 
  protected $materials;
  protected $company; 
  protected $department;
  protected $level; 
  protected $location;
  protected $position;
  protected $contract;
  protected $jobs; 
  protected $views;
  protected $menu_category;

  /**
   * An array of helpers to be loaded automatically upon
   * class instantiation. These helpers will be available
   * to all other controllers that extend BaseController.
   *
   * @var array
   */
  protected $helpers = ['auth', 'routes'];

  /**
   * Be sure to declare properties for any property fetch you initialized.
   * The creation of dynamic property is deprecated in PHP 8.2.
   */

  /**
   * @return void
   */
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    // Do Not Edit This Line
    parent::initController($request, $response, $logger);

    // Preload any models, libraries, etc, here.
  }

  public function __construct()
  {
    $this->checkLogin();
  }

  protected function CheckSession()
  {
    $sessions = session();
    if(is_null($sessions->get('user_data')))
    {
      if (!$sessions->get('alert_shown')) {
        // Jika belum, tampilkan alert dan atur session flag
        echo "<script>alert('Your session is time out. Please login again!'); document.location='".route_to('/')."'</script>";
        $sessions->set('alert_shown', true);
        return redirect()->to('/')->with('message', 'You already sign out.');
      }
    }
  }

  protected function checkLogin()
  {
    if (empty(session()->get('user_data'))) {
      return redirect()->route('/')->with('error', 'You must login first!');
    }
  }
}