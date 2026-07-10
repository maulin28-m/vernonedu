import { useEffect, useState } from "react";
import { ArrowLeft, CheckCircle2, Clock3, BookOpen, Trophy, CalendarDays, X } from "lucide-react";
import { Link, useParams } from "react-router-dom";

const API_URL = import.meta.env.VITE_API_URL;

export default function MyCourseDetail() {
  const { slug } = useParams();
  const [course, setCourse] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [selectedMateri, setSelectedMateri] = useState(null);
  const [fileUrl, setFileUrl] = useState("");
  const [submitting, setSubmitting] = useState(false);

  useEffect(() => {
    fetchCourse();
  }, [slug]);

  const fetchCourse = async () => {
    try {
      setLoading(true);
      const token = localStorage.getItem("token");
      const res = await fetch(`${API_URL}/my-courses/${slug}`, {
        headers: { Authorization: `Bearer ${token}` },
      });
      if (!res.ok) throw new Error("Gagal memuat detail course");
      const data = await res.json();
      setCourse(data);
      
      // Update selectedMateri state if it's currently open
      if (selectedMateri) {
          const updated = data.materis.find(m => m.id === selectedMateri.id);
          if(updated) setSelectedMateri(updated);
      }
    } catch (err) {
      console.error(err);
      setError("Tidak dapat memuat detail course");
    } finally {
      setLoading(false);
    }
  };

  const submitTugas = async (e) => {
    e.preventDefault();
    if (!fileUrl) return;
    
    try {
      setSubmitting(true);
      const token = localStorage.getItem("token");
      const res = await fetch(`${API_URL}/my-courses/materi/${selectedMateri.id}/submit-tugas`, {
        method: "POST",
        headers: {
          Authorization: `Bearer ${token}`,
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({ file_url: fileUrl })
      });
      if (res.ok) {
        setFileUrl("");
        fetchCourse();
      }
    } catch (err) {
      console.error(err);
    } finally {
      setSubmitting(false);
    }
  };

  if (loading && !course) {
    return (
      <div className="rounded-3xl border border-[#E8D9F0] bg-white p-14 text-center shadow-sm">
        <div className="mx-auto h-12 w-12 animate-spin rounded-full border-4 border-[#E8D9F0] border-t-[#7A5C92]" />
        <p className="mt-5 text-sm text-gray-500">Memuat detail course...</p>
      </div>
    );
  }

  if (error) {
    return (
      <div className="rounded-3xl border border-red-200 bg-white p-14 text-center shadow-sm">
        <p className="font-medium text-red-500">{error}</p>
      </div>
    );
  }
  
  if (selectedMateri) {
      return (
          <div className="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500">
              <div className="rounded-[2rem] border border-[#E8D9F0] bg-white p-8 lg:p-12 shadow-sm">
                  <button onClick={() => setSelectedMateri(null)} className="inline-flex items-center gap-2 rounded-2xl bg-[#F4ECF9] px-4 py-2 text-sm font-semibold text-[#7A5C92] transition hover:bg-[#E8D9F0] mb-8">
                      <ArrowLeft className="h-4 w-4" /> Kembali ke Daftar Materi
                  </button>
                  
                  <div className="flex items-center gap-4 mb-6">
                      <div className={`flex h-16 w-16 items-center justify-center rounded-2xl ${selectedMateri.status === "selesai" ? "bg-green-100" : "bg-[#F4ECF9]"}`}>
                          {selectedMateri.status === "selesai" ? <CheckCircle2 className="h-8 w-8 text-green-600" /> : <BookOpen className="h-8 w-8 text-[#7A5C92]" />}
                      </div>
                      <div>
                          <p className="text-sm font-semibold uppercase tracking-wide text-[#7A5C92]">Materi {selectedMateri.urutan}</p>
                          <h1 className="text-3xl font-bold text-gray-800">{selectedMateri.judul}</h1>
                      </div>
                  </div>
                  
                  <div className="prose prose-purple max-w-none mb-12 text-gray-600" dangerouslySetInnerHTML={{__html: selectedMateri.konten || "<p>Belum ada konten materi.</p>"}}></div>
                  
                  <div className="rounded-3xl bg-[#FCFAFD] border border-[#E8D9F0] p-8">
                      <h3 className="text-xl font-bold text-gray-800 mb-2">Instruksi Tugas</h3>
                      <p className="text-gray-600 mb-6">{selectedMateri.tugas || "Tidak ada instruksi khusus."}</p>
                      
                      {selectedMateri.status === "selesai" ? (
                          <div className="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-2xl text-green-700 font-medium">
                              <CheckCircle2 className="h-6 w-6" />
                              Anda telah mengumpulkan tugas dan menyelesaikan materi ini!
                          </div>
                      ) : (
                          <form onSubmit={submitTugas} className="flex flex-col sm:flex-row gap-4">
                              <input 
                                type="url" 
                                required 
                                value={fileUrl}
                                onChange={(e) => setFileUrl(e.target.value)}
                                placeholder="Masukkan Link Google Drive / File Anda di sini" 
                                className="flex-1 rounded-2xl border border-gray-300 px-5 py-3 focus:border-[#7A5C92] focus:outline-none focus:ring-1 focus:ring-[#7A5C92]"
                              />
                              <button 
                                type="submit" 
                                disabled={submitting}
                                className="rounded-2xl bg-[#7A5C92] px-8 py-3 font-semibold text-white transition hover:bg-[#614975] disabled:opacity-50"
                              >
                                  {submitting ? "Mengirim..." : "Kumpulkan Tugas"}
                              </button>
                          </form>
                      )}
                  </div>
              </div>
          </div>
      );
  }

  return (
    <div className="space-y-8 animate-in fade-in duration-500">
      {/* HERO */}
      <div className="overflow-hidden rounded-[2rem] bg-gradient-to-r from-[#DFD0EB] via-[#E8D9F0] to-[#EDE0F5] shadow-sm">
        <div className="grid gap-8 lg:grid-cols-[1.2fr,420px]">
          {/* LEFT */}
          <div className="p-8 lg:p-10">
            <Link to="/dashboard" className="inline-flex items-center gap-2 rounded-2xl bg-white/70 px-4 py-2 text-sm font-semibold text-[#7A5C92] transition hover:bg-white">
              <ArrowLeft className="h-4 w-4" /> Kembali
            </Link>
            <h1 className="mt-6 text-4xl font-extrabold leading-tight text-gray-800">{course?.title}</h1>
            <p className="mt-5 max-w-2xl text-sm leading-relaxed text-gray-600">{course?.description}</p>
            <div className="mt-8 flex flex-wrap gap-3">
              <div className="rounded-2xl bg-white/70 px-4 py-2 text-sm font-semibold text-[#7A5C92]">{course?.usia}</div>
              <div className="rounded-2xl bg-white/70 px-4 py-2 text-sm font-semibold text-[#7A5C92]">{course?.total_materi} Materi</div>
            </div>
          </div>
          {/* RIGHT */}
          <div className="flex items-center justify-center p-8 lg:p-10">
            <div className="w-full rounded-[2rem] bg-white/70 p-8 shadow-sm backdrop-blur">
              <div className="flex items-center justify-between">
                <div>
                  <p className="text-sm font-semibold text-[#7A5C92]">Total Progress</p>
                  <h2 className="mt-2 text-5xl font-extrabold text-gray-800">{course?.progress || 0}%</h2>
                </div>
                <div className="flex h-16 w-16 items-center justify-center rounded-3xl bg-[#F4ECF9]">
                  <Trophy className="h-8 w-8 text-[#7A5C92]" />
                </div>
              </div>
              <div className="mt-6 h-4 overflow-hidden rounded-full bg-[#EDE0F5]">
                <div className="h-full rounded-full bg-[#7A5C92] transition-all duration-500" style={{ width: `${course?.progress || 0}%` }} />
              </div>
              <div className="mt-5 flex items-center justify-between text-sm">
                <p className="text-gray-500">Materi Selesai</p>
                <p className="font-bold text-[#7A5C92]">{course?.materi_selesai} / {course?.total_materi}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* LIST MATERI */}
      <div className="rounded-[2rem] border border-[#E8D9F0] bg-white p-8 shadow-sm">
        <div className="mb-8 flex items-center justify-between">
          <div>
            <h2 className="text-2xl font-bold text-gray-800">Progress Materi</h2>
            <p className="mt-1 text-sm text-gray-500">Semua progress pembelajaran Anda.</p>
          </div>
          <div className="rounded-2xl bg-[#F4ECF9] px-4 py-2 text-sm font-semibold text-[#7A5C92]">{course?.materis?.length || 0} Materi</div>
        </div>

        <div className="space-y-5">
          {course?.materis?.length > 0 ? (
            course.materis.map((materi, index) => (
              <div key={materi.id} onClick={() => setSelectedMateri(materi)} className="flex flex-col gap-6 rounded-[2rem] border border-[#E8D9F0] bg-[#FCFAFD] p-6 transition hover:shadow-md lg:flex-row lg:items-center lg:justify-between cursor-pointer group">
                <div className="flex items-start gap-5">
                  <div className={`flex h-14 w-14 items-center justify-center rounded-2xl ${materi.status === "selesai" ? "bg-green-100" : "bg-[#F4ECF9]"}`}>
                    {materi.status === "selesai" ? <CheckCircle2 className="h-7 w-7 text-green-600" /> : <BookOpen className="h-7 w-7 text-[#7A5C92]" />}
                  </div>
                  <div>
                    <p className="text-xs font-semibold uppercase tracking-wide text-[#7A5C92]">Materi {index + 1}</p>
                    <h3 className="mt-1 text-xl font-bold text-gray-800 group-hover:text-[#7A5C92] transition-colors">{materi.judul}</h3>
                    <p className="mt-2 max-w-3xl text-sm leading-relaxed text-gray-500">{materi.deskripsi || "Materi pembelajaran untuk meningkatkan kemampuan peserta."}</p>
                  </div>
                </div>
                <div className="flex flex-col items-start gap-3 lg:items-end">
                  <div className={`inline-flex items-center gap-2 rounded-2xl px-4 py-2 text-sm font-semibold transition ${materi.status === "selesai" ? "bg-green-100 text-green-700" : "bg-[#E8D9F0] text-[#7A5C92] group-hover:bg-[#7A5C92] group-hover:text-white"}`}>
                    <CheckCircle2 className="h-4 w-4" />
                    {materi.status === "selesai" ? "Selesai" : "Buka Materi"}
                  </div>
                  <div className="flex items-center gap-2 text-xs text-gray-400">
                    <CalendarDays className="h-4 w-4" />
                    {materi.tanggal ? materi.tanggal : "Belum ada aktivitas"}
                  </div>
                </div>
              </div>
            ))
          ) : (
            <div className="rounded-3xl border border-dashed border-[#DFD0EB] p-14 text-center">
              <p className="text-gray-500">Belum ada materi tersedia.</p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
