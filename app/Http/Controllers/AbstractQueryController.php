<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Purify;
use Auth;
use Illuminate\Database\QueryException as QE;
abstract class AbstractQueryController extends Controller{

/**
 * main showing function
 * @return View with Array Data
 */
  abstract public function index();
  /**
   * Store into DB
   * Trying to store data (request) into DB
   * @param  Request $request 
   * @return Redirect with message
   */
  abstract public function store(Request $request);
  /**
   * search data in DB
   * @param  Request $request 
   * @return View with Array or simple View with default data
   */
  abstract public function search(Request $request);
/**
 * delete (remove) some data from DB using ID
 * @param  Request $request 
 * @return Array Message
 */
  abstract public function delete(Request $request);
/**
 * rename brand (manufactirer) name
 * @param  Request $request 
 * @return Array message if ok - renamed esle error           
 */
  abstract public function update(Request $request);

}