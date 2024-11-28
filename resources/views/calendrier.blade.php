<x-app-layout>
    <div id="calendar" class="w-[80vw] h-[80vh]">
        </div>
        <form class="hidden" action="{{ route('calender.store') }}" method="post" >
            @csrf
            <input type="datetime-local" name="start" id="start">
            <input type="datetime-local" name="end" id="end">
            <input type="text" value="{{ Auth::user()->name }}" name="user">
            <button id="submitEvent" type="submit">submit</button>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', async function() {
                let response = await axios.get("/calendar/create")
                let events = response.data.events
        
                let nowDate = new Date()
                let day = nowDate.getDate()
                let month = nowDate.getMonth() + 1
                let hours = nowDate.getHours()
                let minutes = nowDate.getMinutes()
                let minTimeAllowed =
                    `${nowDate.getFullYear()}-${month < 10 ? "0"+month : month}-${day < 10 ? "0"+day : day}T${hours < 10 ? "0"+hours : hours}:${minutes < 10 ? "0"+minutes : minutes}:00`
                start.min = minTimeAllowed;
        
        
                var myCalendar = document.getElementById('calendar');
        
        
                var calendar = new FullCalendar.Calendar(myCalendar, {
        
                    headerToolbar: {
                        left: 'dayGridMonth,timeGridWeek,timeGridDay',
                        center: 'title',
                        right: 'listMonth,listWeek,listDay'
                    },
        
        
                    views: {
                        listDay: { // Customize the name for listDay
                            buttonText: 'Day Events',
        
                        },
                        listWeek: { // Customize the name for listWeek
                            buttonText: 'Week Events'
                        },
                        listMonth: { // Customize the name for listMonth
                            buttonText: 'Month Events'
                        },
                        timeGridWeek: {
                            buttonText: 'Week', // Customize the button text
                        },
                        timeGridDay: {
                            buttonText: "Day",
                        },
                        dayGridMonth: {
                            buttonText: "Month",
                        },
        
                    },
        
        
                    initialView: "timeGridWeek", // initial view  =   l view li kayban  mni kan7ol l  calendar
                    slotMinTime: "09:00:00", // min  time  appear in the calendar
                    slotMaxTime: "19:00:00", // max  time  appear in the calendar
                    nowIndicator: true, //  indicator  li kaybyen  l wa9t daba   fin  fl calendar
                    selectable: true, //   kankhali l user  i9ad  i selectioner  wast l calendar
                    selectMirror: true, //  overlay   that show  the selected area  ( details  ... )
                    selectOverlap: false, //  nkhali ktar mn event f  nfs  l wa9t  = e.g:   5 nas i reserviw nfs lblasa  f nfs l wa9t
                    weekends: true, // n7ayed  l weekends    ola nkhalihom 
        
        
                    // events  hya  property dyal full calendar
                    //  kat9bel array dyal objects  khass  i kono jayin 3la chkl  object fih  start  o end  7it hya li kayfahloha
                    events: events,
        
                    selectAllow: (info) => {
        
                        return info.start >= nowDate;
                    },
        
                    select: (info) => {
        
        
                        if (info.end.getDate() - info.start.getDate() > 0 && !info.allDay ) {
                            return
                        }
        
                        console.log(info);
                        if (info.allDay) {
                            start.value = info.startStr+" 09:00:00"
                            end.value = info.startStr+" 19:00:00"   
                            
                        }else{     
                            start.value = info.startStr.slice(0, info.startStr.length - 6)
                            end.value = info.endStr.slice(0, info.endStr.length - 6)   
                        }
        
                        submitEvent.click()
                    }
        
        
        
                });
        
                calendar.render();
            })
        </script>
</x-app-layout>