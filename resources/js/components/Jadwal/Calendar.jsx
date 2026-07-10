import FullCalendar from "@fullcalendar/react";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGridPlugin from "@fullcalendar/timegrid";
import idLocale from "@fullcalendar/core/locales/id";

export default function Calendar({ events = [], onEventClick }) {
  return (
    <div className="bg-white rounded-xl shadow p-4">
      <FullCalendar
        plugins={[dayGridPlugin, interactionPlugin, timeGridPlugin]}
        initialView="dayGridMonth"
        height={500}
        locale={idLocale}

        headerToolbar={{
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridDay",
        }}

        events={events}

        eventTimeFormat={{
          hour: "2-digit",
          minute: "2-digit",
          hour12: false,
        }}
        
        displayEventTime={true}
        
        eventContent={(info) => {
          let timeString = "";
          if (info.event.start) {
            const hours = String(info.event.start.getHours()).padStart(2, '0');
            const minutes = String(info.event.start.getMinutes()).padStart(2, '0');
            timeString = `${hours}.${minutes}`;
          }

          return (
            <div 
              className="flex flex-col overflow-hidden text-[11px] text-gray-800 p-1 px-1.5 border-l-2 rounded-sm" 
              style={{ 
                borderLeftColor: info.event.extendedProps?.color || 'blue', 
                backgroundColor: info.event.extendedProps?.color === 'red' ? '#fee2e2' : info.event.extendedProps?.color === 'gray' ? '#f3f4f6' : '#eff6ff' 
              }}
            >
              <span className="font-bold truncate" style={{ color: info.event.extendedProps?.color === 'red' ? '#991b1b' : info.event.extendedProps?.color === 'gray' ? '#374151' : '#1e40af' }}>{info.event.title}</span>
              <span className="text-[10px]" style={{ color: info.event.extendedProps?.color === 'red' ? '#b91c1c' : info.event.extendedProps?.color === 'gray' ? '#4b5563' : '#3b82f6' }}>{timeString}</span>
            </div>
          );
        }}

        // ✅ klik event (pakai extendedProps dari backend)
        eventClick={(info) => {
          info.jsEvent.preventDefault();

          const tanggal =
            info.event.extendedProps?.tanggal ||
            info.event.startStr.split("T")[0];

          if (onEventClick) {
            onEventClick(tanggal);
          }
        }}

        // ✅ klik tanggal kosong
        dateClick={(info) => {
          if (onEventClick) {
            onEventClick(info.dateStr);
          }
        }}
      />
    </div>
  );
}
