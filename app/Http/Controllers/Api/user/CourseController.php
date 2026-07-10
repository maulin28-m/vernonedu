<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Peserta;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class CourseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MY COURSES
    |--------------------------------------------------------------------------
    */

    public function myCourses(Request $request)
    {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | PESERTA
        |--------------------------------------------------------------------------
        */

        $peserta = Peserta::where(
            'log_user_id',
            $user->id
        )->first();

        if (! $peserta) {

            return response()->json([]);

        }

        /*
        |--------------------------------------------------------------------------
        | TRANSACTION SUCCESS
        |--------------------------------------------------------------------------
        */

        $transactions = Transaction::with([
                'subProgram.materis'
            ])

            ->where('user_id', $user->id)

            ->whereIn('transaction_status', [
                'settlement',
                'capture',
            ])

            ->latest()

            ->get();

        $peserta->load('materis');

        /*
        |--------------------------------------------------------------------------
        | FORMAT
        |--------------------------------------------------------------------------
        */

        $courses = $transactions

            ->filter(fn ($trx) =>
                $trx->subProgram
            )

            ->map(function ($trx) use ($peserta) {

                $subProgram =
                    $trx->subProgram;

                /*
                |--------------------------------------------------------------------------
                | TOTAL MATERI
                |--------------------------------------------------------------------------
                */

                $totalMateri =
                    $subProgram
                        ->materis
                        ->count();

                /*
                |--------------------------------------------------------------------------
                | MATERI SELESAI
                |--------------------------------------------------------------------------
                */

                $materiSelesai = $peserta->materis
                    ->where('sub_program_id', $subProgram->id)
                    ->where('pivot.status', 'selesai')
                    ->count();

                /*
                |--------------------------------------------------------------------------
                | PROGRESS
                |--------------------------------------------------------------------------
                */

                $progress = $totalMateri > 0 
                    ? round(($materiSelesai / $totalMateri) * 100) 
                    : 0;

                return [

                    'transaction_id' =>
                        $trx->id,

                    'id' =>
                        $subProgram->id,

                    'title' =>
                        $subProgram->name,

                    'slug' =>
                        $subProgram->slug,

                    'description' =>
                        $subProgram->description,

                    'usia' =>
                        $subProgram->usia,

                    'harga' =>
                        $subProgram->harga,

                    'image_url' =>
                        $subProgram->image_url,

                    'payment_type' =>
                        $trx->payment_type,

                    'transaction_status' =>
                        $trx->transaction_status,

                    'total_materi' =>
                        $totalMateri,

                    'materi_selesai' =>
                        $materiSelesai,

                    'progress' =>
                        $progress,

                    'created_at' =>
                        $trx->created_at,

                ];

            })

            /*
            |--------------------------------------------------------------------------
            | UNIQUE COURSE
            |--------------------------------------------------------------------------
            */

            ->unique('id')

            ->values();

        return response()->json(
            $courses
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL COURSE
    |--------------------------------------------------------------------------
    */

    public function showMyCourse(
        Request $request,
        $slug
    ) {

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | PESERTA
        |--------------------------------------------------------------------------
        */

        $peserta = Peserta::where(
            'log_user_id',
            $user->id
        )->first();

        if (! $peserta) {

            return response()->json([
                'message' =>
                    'Peserta tidak ditemukan'
            ], 404);

        }

        /*
        |--------------------------------------------------------------------------
        | COURSE
        |--------------------------------------------------------------------------
        */

        $subProgram = $peserta

            ->subPrograms()

            ->where(
                'slug',
                $slug
            )

            ->with([
                'materis'
            ])

            ->first();

        if (! $subProgram) {

            return response()->json([
                'message' =>
                    'Course tidak ditemukan'
            ], 404);

        }

        $peserta->load('materis');

        /*
        |--------------------------------------------------------------------------
        | MATERI + STATUS
        |--------------------------------------------------------------------------
        */

        $materis = $subProgram
            ->materis

            ->sortBy('urutan')

            ->values()

            ->map(function (
                $materi
            ) use ($peserta) {

                $progress = $peserta->materis->firstWhere('id', $materi->id);
                $hasSubmitted = \App\Models\TugasSubmission::where('peserta_id', $peserta->id)
                    ->where('materi_id', $materi->id)->exists();

                return [
                    'id' => $materi->id,
                    'judul' => $materi->judul,
                    'deskripsi' => $materi->deskripsi,
                    'konten' => $materi->konten,
                    'tugas' => $materi->tugas,
                    'urutan' => $materi->urutan,
                    'status' => $progress?->pivot?->status ?? 'proses',
                    'tanggal' => $progress?->pivot?->tanggal,
                    'has_submitted' => $hasSubmitted,
                ];

            });

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $totalMateri =
            $subProgram
                ->materis
                ->count();

        /*
        |--------------------------------------------------------------------------
        | MATERI SELESAI
        |--------------------------------------------------------------------------
        */

        $materiSelesai =
            $materis
                ->where(
                    'status',
                    'selesai'
                )
                ->count();

        /*
        |--------------------------------------------------------------------------
        | PROGRESS
        |--------------------------------------------------------------------------
        */

        $progress = $totalMateri > 0
            ? round(($materiSelesai / $totalMateri) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'id' =>
                $subProgram->id,

            'title' =>
                $subProgram->name,

            'slug' =>
                $subProgram->slug,

            'description' =>
                $subProgram->description,

            'usia' =>
                $subProgram->usia,

            'harga' =>
                $subProgram->harga,

            'image_url' =>
                $subProgram->image_url,

            'progress' =>
                $progress,

            'total_materi' =>
                $totalMateri,

            'materi_selesai' =>
                $materiSelesai,

            'materis' =>
                $materis,

        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | UPDATE PROGRESS MATERI
    |--------------------------------------------------------------------------
    */

    public function updateProgress(Request $request, $id)
    {
        $user = $request->user();
        $peserta = \App\Models\Peserta::where('log_user_id', $user->id)->first();

        if (!$peserta) {
            return response()->json(['message' => 'Peserta tidak ditemukan'], 404);
        }

        $materi = \App\Models\Materi::find($id);
        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        $progress = $peserta->materis()->where('materi_id', $id)->first();
        $newStatus = 'selesai';

        if ($progress) {
            $newStatus = $progress->pivot->status === 'selesai' ? 'proses' : 'selesai';
            $peserta->materis()->updateExistingPivot($id, [
                'status' => $newStatus,
                'tanggal' => now()->toDateString()
            ]);
        } else {
            $peserta->materis()->attach($id, [
                'status' => $newStatus,
                'tanggal' => now()->toDateString()
            ]);
        }

        if ($newStatus === 'selesai' && $peserta->isSubProgramCompleted($materi->sub_program_id)) {
            // Cek apakah sertifikat sudah pernah dibuat
            $exists = \App\Models\Certificate::where('peserta_id', $peserta->id)
                ->where('sub_program_id', $materi->sub_program_id)
                ->exists();

            if (!$exists) {
                // Buat sertifikat draft secara otomatis
                \App\Models\Certificate::create([
                    'peserta_id' => $peserta->id,
                    'sub_program_id' => $materi->sub_program_id,
                    'status' => 'draft',
                ]);
            }
        }

        return response()->json(['message' => 'Progress diperbarui', 'status' => $newStatus]);
    }

    public function submitTugas(Request $request, $id)
    {
        $request->validate([
            'file_url' => 'required|string',
        ]);

        $user = $request->user();
        $peserta = \App\Models\Peserta::where('log_user_id', $user->id)->first();

        if (!$peserta) {
            return response()->json(['message' => 'Peserta tidak ditemukan'], 404);
        }

        $materi = \App\Models\Materi::find($id);
        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        // Simpan submission
        \App\Models\TugasSubmission::updateOrCreate(
            ['peserta_id' => $peserta->id, 'materi_id' => $id],
            ['file_url' => $request->file_url]
        );

        // Tandai selesai
        $peserta->materis()->syncWithoutDetaching([
            $id => ['status' => 'selesai', 'tanggal' => now()->toDateString()]
        ]);

        // Cek jika mencapai 100% (logic sama dengan updateProgress)
        if ($peserta->isSubProgramCompleted($materi->sub_program_id)) {
            $exists = \App\Models\Certificate::where('peserta_id', $peserta->id)
                ->where('sub_program_id', $materi->sub_program_id)
                ->exists();

            if (!$exists) {
                \App\Models\Certificate::create([
                    'peserta_id' => $peserta->id,
                    'sub_program_id' => $materi->sub_program_id,
                    'status' => 'draft',
                ]);
            }
        }

        return response()->json(['message' => 'Tugas berhasil dikumpulkan dan ditandai selesai', 'status' => 'selesai']);
    }
}
