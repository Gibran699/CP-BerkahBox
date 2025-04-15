<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\User;
use App\Mail\ReminderEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDonationReminder extends Command
{
    protected $signature = 'donation:reminder';
    protected $description = 'Kirim email pengingat donasi kepada donatur';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{
    $hariIni = Carbon::now('Asia/Jakarta'); 
        $targetHari = Carbon::now('Asia/Jakarta')->isThursday() 
            ? Carbon::now('Asia/Jakarta') 
            : Carbon::now('Asia/Jakarta')->next(Carbon::THURSDAY);

    // dd($hariIni, $targetHari);

    if ($hariIni->isSameDay($targetHari)) {
    $program = Program::where('nama_program', 'Sedekah Jum\'at Rutin')->first();
        if ($program) {
            $donaturList = User::where('role', 'user')
                ->whereHas('donasi_pembayaran', function ($query) use ($program) {
                    $query->where('id_program_donasi', $program->id_program_donasi);
                })->get();

            foreach ($donaturList as $donatur) {
                Mail::to($donatur->email)->send(new ReminderEmail($donatur, $program));
            }

            $this->info('Email pengingat telah dikirim ke semua donatur.');
        } else {
            $this->error('Program donasi Sedekah Jum\'at Rutin tidak ditemukan.');
        }
    } else {
        $this->info('Hari ini bukan jadwal pengiriman pengingat.');
    }
}

}
