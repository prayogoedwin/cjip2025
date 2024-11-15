<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Pages;

use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource;
use App\Models\Kepeminatan\Kepeminatan;
use App\Models\Kepeminatan\Perusahaan;
use App\Models\Kepeminatan\TemplateEmail;
use App\Models\User;
use App\Services\EmailConfigService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class CreateKepeminatan extends CreateRecord
{
    protected static string $resource = KepeminatanResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        $emailConfigService = new EmailConfigService();
        $local_plan = $data['local_plan'] ? 1 : 0;
        $local_exis = $data['local_exis'] ? 1 : 0;
        $foreign_plan = $data['foreign_plan'] ? 1 : 0;
        $foreign_exis = $data['foreign_exis'] ? 1 : 0;

        $nilai_investasi = $data['nilai_investasi_dollar'] ? $data['input_investasi_dollar'] : null;
        $nilai_investasi_rupiah = $data['nilai_investasi_rupiah'] ? $data['input_investasi_rupiah'] : null;

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'jabatan' => $data['jabatan'],
            'no_hp' => $data['no_hp']
        ]);
        $role = Role::where('name', 'perusahaan')->first();
        $user->syncRoles($role->id);
        $perusahaan = Perusahaan::create([
            'user_id' => $user->id,
            'nama_perusahaan' => $data['nama_perusahaan'],
            'jenis_usaha' => $data['jenis_usaha'],
            'alamat_perusahaan' => $data['alamat_perusahaan'],
            'negara_asal' => $data['negara_asal'],
            'induk_perusahaan' => $data['induk_perusahaan']
        ]);
        $pengajuan = Kepeminatan::create([
            'user_id' => $user->id,
            'rencana_bidang_usaha' => $data['rencana_bidang_usaha'],
            'prefensi_lokasi' => $data['prefensi_lokasi'],
            'status_investasi' => $data['status_investasi'],
            'nilai_investasi' => $nilai_investasi,
            'nilai_investasi_rupiah' => $nilai_investasi_rupiah,
            'local_plan' => $local_plan,
            'local_exis' => $local_exis,
            'local_worker_plan' => $data['local_worker_plan'],
            'local_worker_exis' => $data['local_worker_exis'],
            'foreign_plan' => $foreign_plan,
            'foreign_exis' => $foreign_exis,
            'foreign_worker_plan' => $data['foreign_worker_plan'],
            'foreign_worker_exis' => $data['foreign_worker_exis'],
            'deskripsi_proyek' => $data['deskripsi_proyek'],
            'jadwal_proyek' => $data['jadwal_proyek'],
            'status_id' => $data['status_id']
        ]);
        // dd($pengajuan);

        if ($data['send_notification'] == true) {
            $emailConfigService->applyEmailConfig('kepeminatan');
            $templateEmail = TemplateEmail::where('id', $data['status_id'])->first();
            $subject = $templateEmail->subject;
            $message = [
                'name' => $data['name'],
                'message' => $templateEmail->content
            ];
            $email = $data['email'];
            Mail::send('emails.email', ['customMessage' => $message], function ($message) use ($email, $subject) {
                $message->to($email)
                    ->subject($subject);
            });
        }

        return $pengajuan;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
