<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;
use Illuminate\Bus\Batch;
use App\Jobs\ImportSimike;
use App\Models\Simike\Report;
use App\Models\SiMike\RulesSimike;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class SimikeController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function import(Request $request)
    {
        Log::info('Import request received');

        try {
            // Perform validation
            $request->validate([
                'importFilePath' => 'required|file|mimes:xlsx,csv',
                'tahun' => 'required|integer',
                'triwulan' => 'required|integer',
                'periode_start' => 'required|date',
                'periode_end' => 'required|date',
            ]);

            Log::info('Request validation passed');


            // Automatically fetch rules and kabkota from the authenticated user
            $kabkotaId = auth()->user()->kabkota->id;
            $rulesId = RulesSimike::where('is_active', true)->first();


            // Handle file upload
            if ($request->hasFile('importFilePath')) {
                $file = $request->file('importFilePath');
                $filePath = $file->storeAs('public/Si Mike/dpmptsp kabupaten wonogiri/mitra desa', $file->getClientOriginalName());

                Log::info('File uploaded successfully: ' . $filePath);
            } else {
                Log::error('File upload failed');
                return response()->json(['message' => 'File upload failed.'], 400);
            }

            // Prepare data for batch processing
            $data = [
                'importFilePath' => $filePath,
                'kabkota' => $kabkotaId,
                'tahun' => $request->input('tahun'),
                'triwulan' => $request->input('triwulan'),
                'periode_start' => $request->input('periode_start'),
                'periode_end' => $request->input('periode_end'),
                'rules_id' => $rulesId->id,
            ];

            Log::info('Data prepared for batch processing', $data);

            // Dispatch the batch
            $batch = Bus::batch([
                new ImportSimike($data['importFilePath'], $data['kabkota'], $data['tahun'], $data['triwulan'], $data['periode_start'], $data['periode_end'], $data['rules_id']),
            ])->then(function (Batch $batch) use ($data) {
                // This callback is invoked after the batch has finished processing
                Log::info('Batch finished processing');
                $this->storeReport($data);
            })->catch(function (Batch $batch, Throwable $e) {
                // This callback is invoked if any of the jobs in the batch fail
                Log::error('Batch failed: ' . $e->getMessage());
            })->dispatch();

            if ($batch) {
                Log::info('Batch dispatched successfully with ID: ' . $batch->id);
                return response()->json(['message' => 'Validation passed and batch dispatched successfully.', 'batch_id' => $batch->id], 200);
            } else {
                Log::error('Failed to dispatch batch');
                return response()->json(['message' => 'Failed to dispatch batch.'], 500);
            }
        } catch (ValidationException $e) {
            Log::error('Validation failed: ', $e->errors());
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Exception caught: ' . $e->getMessage());
            return response()->json(['message' => 'Server error.'], 500);
        }
    }

    protected function storeReport(array $data)
    {
        $report = Report::create([
            'user_id' => \auth()->user()->id,
            'triwulan' => $data['triwulan'],
            'tahun' => $data['tahun'],
            'periode_start' => $data['periode_start'],
            'periode_end' => $data['periode_end'],
            'bulan' => Carbon::parse($data['periode_start'])->month,
        ]);

        $recipient = auth()->user();

        Notification::make()
            ->title('*Import Finished* ' . '(' . $recipient->kabkota->nama . ')')
            ->body(
                'Import data *SIMIKE* pada periode ' .
                    Carbon::parse($data['periode_start'])->toDateString() . ' hingga ' .
                    Carbon::parse($data['periode_end'])->toDateString() . ' telah berhasil'
            )
            ->sendToDatabase($recipient);
    }

    public function checkImportStatus($batchId)
    {
        $batch = Bus::findBatch($batchId);

        if (!$batch) {
            return response()->json(['message' => 'Batch not found.'], 404);
        }

        return response()->json([
            'id' => $batch->id,
            'name' => $batch->name,
            'total_jobs' => $batch->totalJobs,
            'pending_jobs' => $batch->pendingJobs,
            'failed_jobs' => $batch->failedJobs,
            'processed_jobs' => $batch->processedJobs(),
            'progress' => $batch->progress(),
            'status' => $batch->finished() ? 'finished' : 'processing',
        ], 200);
    }
}
