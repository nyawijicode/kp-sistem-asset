<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetIn;
use App\Models\AssetOut;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function aset()
    {
        $assets = Asset::orderBy('nama_aset')->get();

        $pdf = Pdf::loadView('laporan.aset', compact('assets'));
        return $pdf->stream('laporan-daftar-aset.pdf');
    }

    public function assetMasuk()
    {
        $items = AssetIn::with(['asset', 'user'])->orderByDesc('tanggal')->get();

        $pdf = Pdf::loadView('laporan.aset-masuk', compact('items'));
        return $pdf->stream('laporan-aset-masuk.pdf');
    }

    public function assetKeluar()
    {
        $items = AssetOut::with(['asset', 'user'])->orderByDesc('tanggal')->get();

        $pdf = Pdf::loadView('laporan.aset-keluar', compact('items'));
        return $pdf->stream('laporan-aset-keluar.pdf');
    }
}
