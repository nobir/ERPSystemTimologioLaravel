<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

require_once(dirname(__FILE__) . "/nobirApiRoute.php");
require_once(dirname(__FILE__) . "/sajjadApiRoute.php");
// require_once(dirname(__FILE__) . "/jannatulApiRoute.php");
// require_once(dirname(__FILE__) . "/tareqApiRoute.php");
