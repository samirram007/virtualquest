<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpsLevelCommission;
use App\Models\ReferralCommission;
use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SchemeController extends Controller
{
    protected $status = ['active', 'inactive'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Scheme::all();
        $status = $this->status;
        return view('admin.scheme.index', compact('collections', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.scheme.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'interest' => 'required',
            'duration' => 'required',
            'minimum_amount' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $collection = new Scheme();
        $collection->name = $request->name;
        $collection->description = $request->description;
        $collection->duration = $request->duration;
        $collection->interest = $request->interest;
        $collection->minimum_amount = $request->minimum_amount;
        $collection->distribution_level = $request->distribution_level;

        $collection->status = $request->status;
        $collection->save();

        return redirect()->route('admin.scheme_index')->with('success', 'Scheme created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_collection = Scheme::find($id);
        $status = $this->status;
        return view('admin.scheme.edit', compact('edit_collection', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'interest' => 'required',
            'minimum_amount' => 'required',
            'distribution_level' => 'required',
            'status' => 'required',
        ]);

        $collection = Scheme::find($id);
        $collection->name = $request->name;
        $collection->description = $request->description;
        $collection->duration = $request->duration;
        $collection->interest = $request->interest;
        $collection->minimum_amount = $request->minimum_amount;
        $collection->distribution_level = $request->distribution_level;
        $collection->status = $request->status;
        $collection->save();

        return redirect()->route('admin.scheme_index')->with('success', 'Scheme updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Scheme::find($id);
        $collection->delete();

        return redirect()->route('admin.scheme_index')->with('success', 'Scheme deleted successfully.');
    }
    public function scheme_referral_commission($id)
    {
        $commissions = ReferralCommission::where('scheme_id', $id)->get();
        $collection = Scheme::find($id);

        return view('admin.scheme.referral_commission', compact('commissions', 'collection'));
    }
    public function scheme_pps_level_commission($id)
    {
        $commissions = PpsLevelCommission::where('scheme_id', $id)->get();
        $collection = Scheme::find($id);

        return view('admin.scheme.pps_level_commission', compact('commissions', 'collection'));
    }
    public function referral_commision_store(Request $request, $scheme)
    {
        //  dd($request->all());
        //save multi level commission array into PpsLevelCommission table
        $collection = Scheme::find($scheme);

        DB::transaction(function ( ) use ($request, $scheme) {

            $scheme_id = $scheme;
            $level = $request->level;
            $commission = $request->commission;
            $count = count($level);

            for ($i = 0; $i < $count; $i++) {
                $data = [
                    'scheme_id' => $scheme_id,
                    'level' => $level[$i],
                    'commission' => $commission[$i],
                ];
               $exists = ReferralCommission::where('scheme_id', $scheme_id)->where('level', $level[$i])->first();
                if($exists){
                    $exists->update($data);
                }else{
                    ReferralCommission::create($data);
                }

            }
        });
        return redirect()->route('admin.scheme_referral_commission', $scheme)->with('success', 'Referral Commission created successfully.');
    }
    public function pps_level_commision_store(Request $request, $scheme)
    {
        //  dd($request->all());
        //save multi level commission array into PpsLevelCommission table
        $collection = Scheme::find($scheme);

        DB::transaction(function ( ) use ($request, $scheme) {

            $scheme_id = $scheme;
            $level = $request->level;
            $commission = $request->commission;
            $count = count($level);

            for ($i = 0; $i < $count; $i++) {
                $data = [
                    'scheme_id' => $scheme_id,
                    'level' => $level[$i],
                    'commission' => $commission[$i],
                ];
               $exists = PpsLevelCommission::where('scheme_id', $scheme_id)->where('level', $level[$i])->first();
                if($exists){
                    $exists->update($data);
                }else{
                    PpsLevelCommission::create($data);
                }

            }
        });
        return redirect()->route('admin.scheme_pps_level_commission', $scheme)->with('success', 'PPS Level Commission created successfully.');
    }
}
