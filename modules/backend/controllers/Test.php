<?php namespace Backend\Controllers;

use App;
use Log;
use Mail;
use Flash;
use System;
use Config;
use Backend;
use Request;
use Validator;
use BackendAuth;
use Backend\Models\AccessLog;
use Backend\Classes\Controller;
use Backend\Models\User as UserModel;
use System\Classes\UpdateManager;
use ApplicationException;
use ValidationException;
use NotFoundException;
use Exception;

/**
 * Test Controller
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 *
 */
class Test extends Controller
{
    public function index()
    {

    }
}