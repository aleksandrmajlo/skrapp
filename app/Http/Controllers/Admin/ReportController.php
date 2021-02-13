<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $paginate = 50;

    public function index()
    {
        $reports = Report::orderBy('created_at', 'desc')->paginate($this->paginate);
        $banks = Bank::orderBy('sort')->get();
        $operators = User::activeoperator()->orderBy('created_at')->get();
        $status = config('reports');
        return view('reports.index', [
            'reports' => $reports,
            'banks' => $banks,
            'operators' => $operators,
            'status' => $status
        ]);
    }

    public function filter(Request $request)
    {
        $query = Report::orderBy('created_at', 'desc');
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->has('bank_id')) {
            $query->where('bank_id', $request->bank_id);
        }
        if (($request->has('date_start') && !empty($request->date_start)) && ($request->has('date_end') && !empty($request->date_end))) {
            $query->whereBetween('created_at', [$request->date_start, $request->date_end]);
        }
        if (($request->has('date_start') && !empty($request->date_start)) && empty($request->date_end)) {
            $query->where('created_at', '>=', $request->date_start . ' 00:00:00');
        }
        if (($request->has('date_end') && !empty($request->date_end)) && empty($request->date_start)) {
            $query->where('created_at', '<', $request->date_end . ' 23:59:59');
        }
        $reports = $query->paginate($this->paginate);
        $banks = Bank::orderBy('sort')->get();
        $operators = User::activeoperator()->orderBy('created_at')->get();
        $status = config('reports');
        return view('reports.index', [
            'reports' => $reports,
            'banks' => $banks,
            'operators' => $operators,
            'status' => $status
        ]);

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
