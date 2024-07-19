<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Controllers;

class CheckSession implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if(! session()->get('user_data')) {
      // return redirect()->route('/')->with('error', 'You must login first!');
    }
    
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    
  }
}