<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Http\Resources\Report\GetAccountsCusCollection;

class ReportController extends ApiController
{
    private $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    } 

    public function totalQuotation(Request $request)
    {
        $invoices = DB::table('invoices AS i')
            ->select('i.type as comprobante', 'i.number as nro', 'q.cite', DB::raw('DATE_FORMAT(i.date,"%d/%m/%Y") as fecha'), 'c.business_name as cliente', 'u.name as vendedor', DB::raw('FORMAT(i.total, 2) as monto'), DB::raw('FORMAT(COALESCE(SUM(p.amount), 0), 2) AS cancelado'), DB::raw('FORMAT(i.total - COALESCE(SUM(p.amount), 0), 2) AS saldo'))
            ->leftjoin('payments AS p', function($join) {
                $join->on('p.paymentable_id', 'i.id')
                  ->where('p.paymentable_type', 'App\Invoice');
            })
            ->join('customers AS c', 'c.id', '=', 'i.customer_id')
            ->join('quotations AS q', 'q.id', '=', 'i.quotation_id')
            ->join('users AS u', 'u.id', '=', 'q.user_id')
            ->join('licenses AS l', 'l.id', '=', 'i.license_id')
            ->join('offices AS o', 'o.id', '=', 'l.office_id')
            ->where('o.id', $request->office)
            ->when($request->customer, function($query) use ($request) {
                $query->where('i.customer_id', $request->customer);
            })
            ->when($request->user, function($query) use ($request) {
                $query->where('q.user_id', $request->user);
            })
            ->where(function($query) use ($request) {
                $query->whereDate('i.date', '>=', $request->initial_date)
                  ->whereDate('i.date', '<=', $request->final_date)
                  ->where('i.state_id', 1);
            })
            ->groupBy('i.id')
            ->get();

        $notes = DB::table('notes AS n')
            ->select('n.type as comprobante', 'n.number as nro', 'q.cite', DB::raw('DATE_FORMAT(n.date,"%d/%m/%Y") as fecha'), 'c.business_name as cliente', 'u.name as vendedor', DB::raw('FORMAT(n.total, 2) as monto'), DB::raw('FORMAT(COALESCE(SUM(p.amount), 0), 2) AS cancelado'), DB::raw('FORMAT(n.total - COALESCE(SUM(p.amount), 0), 2) AS saldo'))
            ->leftjoin('payments AS p', function($join) {
                $join->on('p.paymentable_id', 'n.id')
                  ->where('p.paymentable_type', 'App\Note');
            })
            ->join('customers AS c', 'c.id', '=', 'n.customer_id')
            ->join('quotations AS q', 'q.id', '=', 'n.quotation_id')
            ->join('users AS u', 'u.id', '=', 'q.user_id')
            ->join('vouchers AS v', 'v.id', '=', 'n.voucher_id')
            ->join('offices AS o', 'o.id', '=', 'v.office_id')
            ->where('o.id', $request->office)
            ->when($request->customer, function($query) use ($request) {
                $query->where('n.customer_id', $request->customer);
            })
            ->when($request->user, function($query) use ($request) {
                $query->where('q.user_id', $request->user);
            })
            ->where(function($query) use ($request) {
                $query->whereDate('n.date', '>=', $request->initial_date)
                  ->whereDate('n.date', '<=', $request->final_date)
                  ->whereNull('n.deleted_at');
            })
            ->groupBy('n.id')
            ->get();  

        $data = collect($invoices)->merge($notes);

        return $this->respond($data);
    }

    public function invoiceReport(Request $request)
    {
        //cambiar vendedor tabla cotizacion
        $quotations = DB::table('invoices AS i')
            ->select(DB::raw('UPPER(c.business_name) as cliente'), DB::raw('IFNULL(UPPER(i.nit_name), UPPER(c.business_name)) as "razón social"'), 'i.number AS número', DB::raw('(CASE i.state_id WHEN 1 THEN "VÁLIDA" ELSE "ANULADA" END) as estado'), DB::raw('DATE_FORMAT(i.date,"%d/%m/%Y") as fecha'), 'i.summary as detalle', 'u.name as vendedor', DB::raw('FORMAT(i.total, 2) as monto'))
            ->join('customers AS c', 'c.id', '=', 'i.customer_id')
            ->join('quotations AS q', 'q.id', '=', 'i.quotation_id')
            ->join('users AS u', 'u.id', '=', 'q.user_id')
            ->join('licenses AS l', 'l.id', '=', 'i.license_id')
            ->join('offices AS o', 'o.id', '=', 'l.office_id')
            ->where('o.id', $request->office)
            ->when($request->customer, function($query) use ($request) {
                $query->where('i.customer_id', $request->customer);
            })
            ->when($request->user, function($query) use ($request) {
                $query->where('i.user_id', $request->user);
            })
            ->where(function($query) use ($request) {
                $query->whereDate('i.date', '>=', $request->initial_date)
                  ->whereDate('i.date', '<=', $request->final_date);
                //   ->where('i.state_id', 1);
            })
            ->groupBy('i.id')
            ->get();

        $data = collect($quotations);

        return $this->respond($data);
    }

    public function getAccounts(Request $request)
    {
        $invoices = DB::table('invoices AS i')
            ->select('i.id', 'i.date', 'i.type', 'i.number', 'i.summary', 'i.total')
            ->join('customers AS c', 'c.id', '=', 'i.customer_id')
            ->join('quotations AS q', 'q.id', '=', 'i.quotation_id')
            ->join('users AS u', 'u.id', '=', 'q.user_id')
            ->join('licenses AS l', 'l.id', '=', 'i.license_id')
            ->join('offices AS o', 'o.id', '=', 'l.office_id')
            ->where('o.id', $request->office)
            ->when($request->customer, function($query) use ($request) {
                $query->where('i.customer_id', $request->customer);
            })
            ->when($request->user, function($query) use ($request) {
                $query->where('q.user_id', $request->customer);
            })
            ->where(function($query) use ($request) {
                $query->whereDate('i.date', '>=', $request->initial_date)
                  ->whereDate('i.date', '<=', $request->final_date)
                  ->where('i.state_id', 1);
            })
            ->groupBy('i.id')
            ->get();

        $data = collect(\App\Invoice::hydrate($invoices->toArray()));
        
        return new GetAccountsCusCollection($data);
    }

    public function listQuotationGeneral(Request $request)
    {   
        $quotations = DB::table('quotations AS q')
            ->select('q.cite', DB::raw('DATE_FORMAT(q.date,"%d/%m/%Y") as fecha'), 's.title as estado', 'c.business_name as cliente', 'u.name as vendedor', DB::raw('FORMAT(q.amount - q.discount, 2) as monto'))
            ->join('customers AS c', 'c.id', '=', 'q.customer_id')
            ->join('users AS u', 'u.id', '=', 'q.user_id')
            ->join('states AS s', 's.id', '=', 'q.state_id')
            ->join('offices AS o', 'o.id', '=', 'q.office_id')
            ->where('o.id', $request->office)
            ->when($request->customer, function($query) use ($request) {
                $query->where('q.customer_id', $request->customer);
            })
            ->when($request->user, function($query) use ($request) {
                $query->where('q.user_id', $request->user);
            })
            ->where(function($query) use ($request) {
                $query->whereDate('q.date', '>=', $request->initial_date)
                  ->whereDate('q.date', '<=', $request->final_date)
                  ->whereNull('q.deleted_at');
            })
            ->groupBy('q.id')
            ->get();

        $data = collect($quotations);

        return $this->respond($data);
    }

    public function listQuotationPending(Request $request)
    {   
        $quotations = DB::table('quotations AS q')
            ->select('q.cite', DB::raw('DATE_FORMAT(q.date,"%d/%m/%Y") as fecha'), 's.title as estado', 'c.business_name as cliente', 'u.name as vendedor', DB::raw('FORMAT(q.amount - q.discount, 2) as monto'))
            ->join('customers AS c', 'c.id', '=', 'q.customer_id')
            ->join('users AS u', 'u.id', '=', 'q.user_id')
            ->join('states AS s', 's.id', '=', 'q.state_id')
            ->join('offices AS o', 'o.id', '=', 'q.office_id')
            ->where('q.state_id', 1)
            ->where('o.id', $request->office)
            ->when($request->customer, function($query) use ($request) {
                $query->where('q.customer_id', $request->customer);
            })
            ->when($request->user, function($query) use ($request) {
                $query->where('q.user_id', $request->user);
            })
            ->where(function($query) use ($request) {
                $query->whereDate('q.date', '>=', $request->initial_date)
                  ->whereDate('q.date', '<=', $request->final_date)
                  ->whereNull('q.deleted_at');
            })
            ->groupBy('q.id')
            ->get();

        $data = collect($quotations);

        return $this->respond($data);
    }

    public function listQuotationApproved(Request $request)
    {   
        $quotations = DB::table('quotations AS q')
            ->select('q.cite', DB::raw('DATE_FORMAT(q.date,"%d/%m/%Y") as fecha'), 's.title as estado', 'c.business_name as cliente', 'u.name as vendedor', DB::raw('FORMAT(q.amount - q.discount, 2) as monto'))
            ->join('customers AS c', 'c.id', '=', 'q.customer_id')
            ->join('users AS u', 'u.id', '=', 'q.user_id')
            ->join('states AS s', 's.id', '=', 'q.state_id')
            ->join('offices AS o', 'o.id', '=', 'q.office_id')
            ->where('q.state_id', 2)
            ->where('o.id', $request->office)
            ->when($request->customer, function($query) use ($request) {
                $query->where('q.customer_id', $request->customer);
            })
            ->when($request->user, function($query) use ($request) {
                $query->where('q.user_id', $request->user);
            })
            ->where(function($query) use ($request) {
                $query->whereDate('q.date', '>=', $request->initial_date)
                  ->whereDate('q.date', '<=', $request->final_date)
                  ->whereNull('q.deleted_at');
            })
            ->groupBy('q.id')
            ->get();

        $data = collect($quotations);

        return $this->respond($data);
    }

    public function listQuotationExecuted(Request $request)
    {   
        $quotations = DB::table('quotations AS q')
            ->select('q.cite', DB::raw('DATE_FORMAT(q.date,"%d/%m/%Y") as fecha'), 's.title as estado', 'c.business_name as cliente', 'u.name as vendedor', DB::raw('FORMAT(q.amount - q.discount, 2) as monto'))
            ->join('customers AS c', 'c.id', '=', 'q.customer_id')
            ->join('users AS u', 'u.id', '=', 'q.user_id')
            ->join('states AS s', 's.id', '=', 'q.state_id')
            ->join('offices AS o', 'o.id', '=', 'q.office_id')
            ->where('q.state_id', 3)
            ->where('o.id', $request->office)
            ->when($request->customer, function($query) use ($request) {
                $query->where('q.customer_id', $request->customer);
            })
            ->when($request->user, function($query) use ($request) {
                $query->where('q.user_id', $request->user);
            })
            ->where(function($query) use ($request) {
                $query->whereDate('q.date', '>=', $request->initial_date)
                  ->whereDate('q.date', '<=', $request->final_date)
                  ->whereNull('q.deleted_at');
            })
            ->groupBy('q.id')
            ->get();

        $data = collect($quotations);

        return $this->respond($data);
    }

    public function pdfDownload(Request $request)
    {
        return $this->service->manyPdfDownload($request);
    }

    public function excelDownload(Request $request) 
    {
        return $this->service->manyExcelDownload($request);
    }
}
