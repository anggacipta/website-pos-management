<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
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

    // app/Http/Controllers/Admin/PembayaranController.php

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
            $pemasukan = Pemasukan::where('pembayaran_id', $pembayaran->id)
                ->first();

            if ($pemasukan) {
                // Update existing payment
                $pembayaran->update($request->all());
                // Redirect to the index page
                return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.')
                    ->with('warning', 'Pemasukan ini sudah tercatat.');
            } else {
                // Update existing payment
                $pembayaran->update($request->all());
                // Make new pemasukan
                Pemasukan::create([
                    'pembayaran_id' => $pembayaran->id,
                    'jumlah' => $request->jumlah,
                ]);
                // Send notification to warga
                $warga = Warga::find($request->warga_id);
                $message = "Pembayaran bulan $request->bulan tahun $request->tahun sebesar Rp. $request->jumlah berhasil dibayarkan.";
                $this->fonnteService->sendMessage($warga->no_hp, $message);
                // Redirect to the index page
                return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
            }
        } else {
            // Create new payment
            $pembayaran = Pembayaran::create($request->all());
            Pemasukan::create([
                'pembayaran_id' => $pembayaran->id,
                'jumlah' => $request->jumlah,
            ]);
            // Send notification to warga
            $warga = Warga::find($request->warga_id);
            $message = "Pembayaran bulan $request->bulan tahun $request->tahun sebesar Rp. $request->jumlah berhasil dibayarkan.";
            $this->fonnteService->sendMessage($warga->no_hp, $message);

            return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dibayarkan.');
        }
    }

}
