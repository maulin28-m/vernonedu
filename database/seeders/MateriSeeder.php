<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        $subPrograms = DB::table('sub_programs')->get();

        foreach ($subPrograms as $subProgram) {

            $materis = [];

            // =========================================
            // HABIT BUILDING
            // =========================================
            if ($subProgram->name === 'Habit Building') {

                $dataMateri = [
                    [
                        'judul' => 'Membangun Kebiasaan Positif',
                        'deskripsi' => 'Pengenalan pentingnya kebiasaan positif dalam kehidupan sehari-hari.'
                    ],
                    [
                        'judul' => 'Disiplin dan Tanggung Jawab',
                        'deskripsi' => 'Belajar disiplin waktu dan tanggung jawab terhadap tugas kecil.'
                    ],
                    [
                        'judul' => 'Kebiasaan Membaca',
                        'deskripsi' => 'Membangun budaya literasi dan membaca setiap hari.'
                    ],
                    [
                        'judul' => 'Manajemen Waktu Dasar',
                        'deskripsi' => 'Belajar mengatur waktu bermain, belajar, dan istirahat.'
                    ],
                    [
                        'judul' => 'Berpikir Positif',
                        'deskripsi' => 'Melatih pola pikir positif dalam menghadapi masalah.'
                    ],
                    [
                        'judul' => 'Kejujuran dalam Kehidupan',
                        'deskripsi' => 'Menanamkan nilai integritas dan kejujuran sejak dini.'
                    ],
                    [
                        'judul' => 'Kerja Sama Tim',
                        'deskripsi' => 'Belajar bekerja sama melalui permainan dan aktivitas kelompok.'
                    ],
                    [
                        'judul' => 'Empati dan Kepedulian',
                        'deskripsi' => 'Melatih rasa peduli terhadap keluarga dan teman.'
                    ],
                    [
                        'judul' => 'Mengelola Emosi',
                        'deskripsi' => 'Belajar mengenali dan mengontrol emosi dasar.'
                    ],
                    [
                        'judul' => 'Kebiasaan Hidup Sehat',
                        'deskripsi' => 'Membangun kebiasaan menjaga kesehatan tubuh.'
                    ],
                    [
                        'judul' => 'Berani Berbicara',
                        'deskripsi' => 'Melatih kepercayaan diri berbicara di depan orang lain.'
                    ],
                    [
                        'judul' => 'Growth Mindset Dasar',
                        'deskripsi' => 'Memahami bahwa kemampuan dapat berkembang dengan latihan.'
                    ],
                    [
                        'judul' => 'Menyelesaikan Masalah',
                        'deskripsi' => 'Belajar mencari solusi sederhana terhadap masalah sehari-hari.'
                    ],
                    [
                        'judul' => 'Belajar Konsisten',
                        'deskripsi' => 'Melatih konsistensi dalam menjalankan kebiasaan baik.'
                    ],
                    [
                        'judul' => 'Mini Project Karakter',
                        'deskripsi' => 'Menerapkan kebiasaan positif dalam proyek sederhana.'
                    ],
                    [
                        'judul' => 'Evaluasi dan Presentasi',
                        'deskripsi' => 'Review perkembangan kebiasaan dan presentasi hasil belajar.'
                    ],
                ];

            }

            // =========================================
            // MINDSET & CHARACTER BUILDING
            // =========================================
            elseif ($subProgram->name === 'Mindset & Character Building') {

                $dataMateri = [
                    [
                        'judul' => 'Pengenalan Growth Mindset',
                        'deskripsi' => 'Memahami bahwa kemampuan bisa dilatih. Ubah kata "Saya tidak bisa" menjadi "Saya belum bisa".',
                        'konten' => '<p><strong>Mindset</strong> adalah cara kita memandang kemampuan diri sendiri.</p><ul><li><strong>Fixed Mindset:</strong> Percaya bahwa kecerdasan tidak bisa diubah. Takut gagal.</li><li><strong>Growth Mindset:</strong> Percaya bahwa kemampuan bisa dilatih. Melihat kegagalan sebagai peluang belajar.</li></ul><p>Tugas Anda hari ini: Ganti kalimat <i>"Saya tidak bisa"</i> menjadi <i>"Saya belum bisa"</i>.</p>'
                    ],
                    [
                        'judul' => 'Self Awareness',
                        'deskripsi' => 'Mengenali kelebihan, kelemahan, serta emosi diri sendiri sebagai fondasi untuk berkembang.',
                        'konten' => '<p>Kesadaran diri adalah fondasi untuk berkembang. Sebelum kita bisa memimpin orang lain, kita harus mengenali diri sendiri.</p><ul><li>Apa kekuatan utamamu?</li><li>Apa kelemahan yang harus kamu perbaiki?</li><li>Emosi apa yang sering sulit kamu kontrol?</li></ul><p>Kenali dirimu, maka kamu akan tahu arah mana yang harus dituju.</p>'
                    ],
                    [
                        'judul' => 'Membangun Kepercayaan Diri',
                        'deskripsi' => 'Melatih keberanian untuk tampil, bersuara, dan mengambil keputusan tanpa takut salah.',
                        'konten' => '<p>Kepercayaan diri bukan berarti tidak pernah merasa takut. Kepercayaan diri adalah berani melangkah <strong>meskipun</strong> merasa takut.</p><ul><li>Berhenti membandingkan diri dengan orang lain.</li><li>Fokus pada proses belajar, bukan pada penilaian orang lain.</li><li>Berani mengambil keputusan tanpa takut salah.</li></ul>'
                    ],
                    [
                        'judul' => 'Komunikasi Efektif',
                        'deskripsi' => 'Belajar menyampaikan ide dengan jelas, tepat sasaran, dan mudah dipahami orang lain.',
                        'konten' => '<p>Berbicara itu mudah, tapi berkomunikasi butuh keterampilan.</p><ul><li><strong>Jelas:</strong> Sampaikan inti pikiranmu tanpa berbelit-belit.</li><li><strong>Tepat Sasaran:</strong> Sesuaikan bahasa dengan siapa kamu berbicara.</li><li><strong>Mudah Dipahami:</strong> Pastikan lawan bicaramu menangkap pesan yang benar.</li></ul>'
                    ],
                    [
                        'judul' => 'Leadership Dasar',
                        'deskripsi' => 'Membangun sikap kepemimpinan yang berani mengambil tanggung jawab, dimulai dari diri sendiri.',
                        'konten' => '<p>Kepemimpinan sejati tidak selalu tentang gelar atau jabatan. Kepemimpinan adalah tentang <strong>mengambil tanggung jawab</strong>.</p><p>Pemimpin yang baik dimulai dari memimpin dirinya sendiri: disiplin waktu, berani mengakui kesalahan, dan memberikan contoh yang baik untuk orang di sekitarnya.</p>'
                    ],
                    [
                        'judul' => 'Critical Thinking',
                        'deskripsi' => 'Melatih pola pikir kritis dan analitis agar tidak mudah menelan informasi mentah-mentah.',
                        'konten' => '<p>Di era digital, informasi sangat mudah didapatkan. Namun, tidak semua informasi itu benar.</p><ul><li>Jangan mudah menelan informasi mentah-mentah.</li><li>Selalu tanyakan <i>"Mengapa?"</i> dan <i>"Dari mana sumbernya?"</i>.</li><li>Pisahkan antara fakta dan sekadar opini orang.</li></ul>'
                    ],
                    [
                        'judul' => 'Problem Solving',
                        'deskripsi' => 'Fokus mencari solusi, bukan mencari alasan atau menyalahkan keadaan saat menghadapi masalah.',
                        'konten' => '<p>Saat menghadapi masalah, tipe orang terbagi menjadi dua:</p><ol><li>Fokus mencari siapa yang salah (Playing Victim).</li><li>Fokus mencari bagaimana solusinya (Problem Solver).</li></ol><p>Latihlah dirimu untuk selalu menjadi tipe yang kedua. Masalah adalah ujian yang akan membuat mentalmu naik kelas.</p>'
                    ],
                    [
                        'judul' => 'Time Management',
                        'deskripsi' => 'Mengatur prioritas kegiatan penting dan membangun disiplin untuk mengalahkan rasa malas.',
                        'konten' => '<p>Waktu adalah aset yang paling berharga karena tidak bisa diulang.</p><ul><li>Kerjakan hal yang <strong>penting dan mendesak</strong> terlebih dahulu.</li><li>Gunakan aturan 2 menit: Jika ada tugas yang bisa diselesaikan dalam 2 menit, kerjakan sekarang juga, jangan ditunda!</li></ul><p>Lawan rasa malas dengan kedisiplinan.</p>'
                    ],
                    [
                        'judul' => 'Public Speaking',
                        'deskripsi' => 'Menguasai teknik dasar berbicara di depan umum dengan meyakinkan dan percaya diri.',
                        'konten' => '<p>Banyak orang lebih takut berbicara di depan umum daripada menghadapi bahaya fisik. Padahal, ini adalah keterampilan yang sangat penting.</p><ul><li>Kuasai materi yang akan kamu sampaikan.</li><li>Perhatikan postur tubuh (body language) dan kontak mata.</li><li>Latihan di depan cermin sebelum tampil.</li></ul>'
                    ],
                    [
                        'judul' => 'Agility Mindset',
                        'deskripsi' => 'Melatih ketangguhan mental agar cepat beradaptasi dan bangkit dari kegagalan.',
                        'konten' => '<p>Dunia berubah dengan sangat cepat. Jika kita kaku, kita akan tertinggal.</p><p><i>Agility</i> (ketangkasan) adalah kemampuan untuk cepat beradaptasi dengan perubahan, fleksibel dalam berpikir, dan tidak mudah menyerah saat strategi awal gagal.</p>'
                    ],
                    [
                        'judul' => 'Kolaborasi Tim',
                        'deskripsi' => 'Menurunkan ego pribadi dan belajar bekerja sama dengan orang lain demi tujuan bersama.',
                        'konten' => '<p>Sukses sejati jarang dicapai sendirian. Kita butuh kerja sama tim.</p><ul><li>Turunkan ego pribadi demi tujuan bersama.</li><li>Hargai setiap pendapat, meskipun berbeda dengan pandanganmu.</li><li>Jadilah anggota tim yang bisa diandalkan.</li></ul>'
                    ],
                    [
                        'judul' => 'Empati dan Emotional Intelligence',
                        'deskripsi' => 'Mendengarkan untuk memahami perasaan orang lain, bukan sekadar menunggu giliran bicara.',
                        'konten' => '<p>Empati berarti mampu menempatkan diri pada posisi orang lain.</p><p>Dengarkan orang lain untuk <strong>memahami perasaan mereka</strong>, bukan sekadar menunggu giliranmu berbicara. Kecerdasan emosional (EQ) seringkali lebih menentukan kesuksesan daripada kecerdasan intelektual (IQ).</p>'
                    ],
                    [
                        'judul' => 'Goal Setting',
                        'deskripsi' => 'Menentukan target masa depan yang jelas dan menyusun langkah nyata untuk mewujudkannya.',
                        'konten' => '<p>Mimpi tanpa rencana hanyalah sebuah angan-angan.</p><p>Gunakan prinsip <strong>SMART</strong> dalam membuat tujuan:</p><ul><li><strong>S</strong>pecific (Jelas)</li><li><strong>M</strong>easurable (Bisa diukur)</li><li><strong>A</strong>chievable (Mungkin dicapai)</li><li><strong>R</strong>elevant (Sesuai dengan dirimu)</li><li><strong>T</strong>ime-bound (Ada batas waktunya)</li></ul>'
                    ],
                    [
                        'judul' => 'Personal Branding',
                        'deskripsi' => 'Menunjukkan karakter dan kebiasaan positif agar menjadi pribadi yang dapat dipercaya.',
                        'konten' => '<p>Personal branding adalah apa yang orang katakan tentang kamu saat kamu tidak ada di ruangan.</p><ul><li>Karakter apa yang ingin kamu tunjukkan ke dunia?</li><li>Apakah kamu dikenal sebagai orang yang jujur, tepat waktu, dan pekerja keras?</li></ul><p>Jaga reputasi dan integritasmu setiap saat.</p>'
                    ],
                    [
                        'judul' => 'Project Character Building',
                        'deskripsi' => 'Praktik langsung menerapkan seluruh materi mindset dan karakter ke dalam proyek nyata.',
                        'konten' => '<p>Teori tanpa praktik adalah sia-sia. Di tahap ini, kamu harus menerapkan semua nilai mindset dan karakter yang sudah dipelajari ke dalam proyek nyata.</p><p>Saatnya membuktikan ketangguhan, kerja sama tim, dan kepemimpinanmu di lapangan.</p>'
                    ],
                    [
                        'judul' => 'Final Presentation & Evaluation',
                        'deskripsi' => 'Mempresentasikan hasil proyek, menguji kepercayaan diri, dan mengevaluasi perkembangan karakter.',
                        'konten' => '<p>Momen untuk merefleksikan seluruh perjalanan belajarmu.</p><ul><li>Apa hal terbesar yang kamu pelajari?</li><li>Kebiasaan buruk apa yang berhasil kamu tinggalkan?</li><li>Kebiasaan baik apa yang akan terus kamu bawa ke depan?</li></ul><p>Presentasikan perjalananmu dengan penuh kebanggaan!</p>'
                    ],
                ];

            }

            // =========================================
            // DEFAULT UNTUK SUB PROGRAM LAIN
            // =========================================
            else {

                $dataMateri = [];

                for ($i = 1; $i <= 16; $i++) {
                    $dataMateri[] = [
                        'judul' => 'Pertemuan ' . $i,
                        'deskripsi' => 'Materi pembelajaran pertemuan ke-' . $i,
                    ];
                }
            }

            // =========================================
            // INSERT KE DATABASE
            // =========================================
            foreach ($dataMateri as $index => $materi) {

                $materis[] = [
                    'sub_program_id' => $subProgram->id,
                    'judul' => $materi['judul'],
                    'deskripsi' => $materi['deskripsi'],
                    'konten' => $materi['konten'] ?? null,
                    'urutan' => $index + 1,
                    'created_at' => now(),
                ];
            }

            DB::table('materis')->insert($materis);
        }
    }
}
