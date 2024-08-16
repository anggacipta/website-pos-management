<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Warga;
use App\Service\FonnteService;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    protected $fonnteService;

    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }

    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month');
        $status = $request->input('status');
        $search = $request->input('search');

        $query = Warga::with(['pembayaran' => function($query) use ($year, $month, $status) {
            $query->where('tahun', $year);
            if ($month) {
                $query->where('bulan', $month);
            }
            if ($status !== null) {
                $query->where('status', $status);
            }
        }]);

        if ($search) {
            $query->where('nama', 'like', "%$search%");
        }

        $wargas = $query->paginate(10);

        return view('dashboard.admin.pembayaran.index', compact('wargas', 'year', 'month', 'status'));
    }

    public function create()
    {
        $wargas = Warga::all();
        return view('dashboard.admin.pembayaran.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'bulan' => 'required|string',
            'tahun' => 'required|string',
            'jumlah' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        // Check if the payment already exists
        $pembayaran = Pembayaran::where('warga_id', $request->warga_id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        if ($pembayaran) {
            // Update existing payment
            $pembayaran->update($request->all());
        } else {
            // Create new payment
            $pembayaran = Pembayaran::create($request->all());
        }

        // Send notification to warga
        $warga = Warga::find($request->warga_id);
        $message = "Pembayaran bulan $request->bulan tahun $request->tahun sebesar Rp. $request->jumlah berhasil dibayarkan.";
        $this->fonnteService->sendMessage($warga->no_hp, $message);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dibayarkan.');
    }

}
