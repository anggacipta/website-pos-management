<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Service\FonnteService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    protected $fonnteService;

    public function __construct(FonnteService $fonnteService)
    {
        $this->fonnteService = $fonnteService;
    }

    public function index()
    {
        $wargas = Warga::all();
        return view('dashboard.admin.warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('dashboard.admin.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:wargas,nik|max:16',
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date_format:m/d/Y',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|max:15',
        ]);

        $wargaData = $request->all();

        $wargaData['tanggal_lahir'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_lahir)->format('Y-m-d');

        Warga::create($wargaData);
        return redirect()->route('warga.index')->with('success', 'Warga created successfully.');
    }

    public function edit($id)
    {
        $warga = Warga::find($id);
        return view('dashboard.admin.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|max:16',
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $warga = Warga::find($id);
        $wargaData = $request->all();

        $wargaData['tanggal_lahir'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_lahir)->format('Y-m-d');

        $warga->update($wargaData);
        return redirect()->route('warga.index')->with('success', 'Warga updated successfully.');
    }

    public function destroy($id)
    {
        $warga = Warga::find($id);
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Warga deleted successfully.');
    }

    public function sendReminder($id)
    {
        $warga = Warga::find($id);
        $message = "Hello $warga->nama, this is a reminder message.";
        $this->fonnteService->sendMessage($warga->no_hp, $message);

        return redirect()->route('warga.index')->with('success', 'Reminder message sent successfully.');
    }
}
