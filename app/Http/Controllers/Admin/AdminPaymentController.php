<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments = DB::table('pembayaran as pb')
            ->leftJoin(
                'course_registrations as pd',
                'pd.id',
                '=',
                'pb.course_registration_id'
            )
            ->leftJoin(
                'users as usr',
                'usr.id',
                '=',
                'pd.user_id'
            )
            ->select([
                'pb.id as id_pembayaran',
                DB::raw('COALESCE(usr.name, pd.name) as student'),
                'pd.program as program',
                'pb.amount as jumlah',
                'pb.payment_method as metode_pembayaran',
                'pb.status',
                'pb.paid_at as tanggal_bayar',
            ])
            ->orderByDesc('pb.id')
            ->get();

        return view('admin.payments_index', compact('payments'));
    }
}