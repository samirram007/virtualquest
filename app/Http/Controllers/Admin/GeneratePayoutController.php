<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\InvestmentController;

class GeneratePayoutController extends Controller
{
   public function index()
   {
      InvestmentController::pps_distribution();
      PpsxInvestmentController::ppsx_distribution();
      InvestmentController::pps_distribution_log();
      PpsxInvestmentController::ppsx_distribution_log();
   }
}
