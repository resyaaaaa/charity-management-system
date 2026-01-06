<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        // Store dummy data in session if not exists
        if (!$request->session()->has('beneficiaries')) {
            $beneficiaries = [
                ['id'=>1,'name'=>'Ahmad Bin Ali','type'=>'Individual','category'=>'Food','status'=>'Pending','history'=>[]],
                ['id'=>2,'name'=>'Siti Binti Omar','type'=>'Individual','category'=>'Medical','status'=>'Pending','history'=>[]],
                ['id'=>3,'name'=>'Family Tan','type'=>'Family','category'=>'Education','status'=>'Verified','history'=>[]],
                ['id'=>4,'name'=>'Orphanage Al-Falah','type'=>'Organization','category'=>'Food','status'=>'Verified','history'=>[]],
            ];
            $request->session()->put('beneficiaries', $beneficiaries);
        }

        $beneficiaries = $request->session()->get('beneficiaries');
        return view('beneficiaries.index', compact('beneficiaries'));
    }

    // Verify dummy beneficiary
    public function verify(Request $request, $id)
    {
        $beneficiaries = $request->session()->get('beneficiaries');
        foreach ($beneficiaries as &$b) {
            if ($b['id'] == $id) $b['status'] = 'Verified';
        }
        $request->session()->put('beneficiaries', $beneficiaries);
        return redirect()->route('beneficiaries.index');
    }

    // Show distribute page
    public function distribute(Request $request, $id)
    {
        $beneficiaries = $request->session()->get('beneficiaries');
        $beneficiary = collect($beneficiaries)->firstWhere('id', $id);

        // Dummy donations
        $donations = [
            ['id'=>1,'donor'=>'Donor 1','amount'=>1000,'type'=>'Cash'],
            ['id'=>2,'donor'=>'Donor 2','amount'=>500,'type'=>'Goods'],
            ['id'=>3,'donor'=>'Donor 3','amount'=>750,'type'=>'Cash'],
        ];

        return view('beneficiaries.distribute', compact('beneficiary','donations'));
    }

    // Add dummy aid distribution
    public function addAid(Request $request)
    {
        $beneficiaries = $request->session()->get('beneficiaries');
        foreach ($beneficiaries as &$b) {
            if ($b['id'] == $request->beneficiary_id) {
                $b['history'][] = [
                    'date'=>date('Y-m-d'),
                    'donation_id'=>$request->donation_id,
                    'amount'=>$request->amount,
                    'aid_type'=>$request->aid_type,
                    'remarks'=>$request->remarks,
                ];
            }
        }
        $request->session()->put('beneficiaries', $beneficiaries);

        return redirect()->route('beneficiaries.distribute', $request->beneficiary_id);
    }
}
