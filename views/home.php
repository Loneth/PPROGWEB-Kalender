<?php
if (!isset($_SESSION['id'])) {
    header("Location: /login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $_SESSION['title'] ?></title>
    <link rel="stylesheet" href="/assets/css/style.css?ran=<?php echo rand(1, 100) ?>">
</head>

<body>
    <header>
        <ul class="sukak-mu-dae">
            <li><a class="active" href="#home">Home</a></li>
            <li><a href="#news">News</a></li>
            <li><a href="#contact">Contact</a></li>
            <li style="float:right"><a href="#about">About</a></li>
        </ul>
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <button class="button form-sub" id="iyakok">Sign In</button>
                    <!-- Modal content -->
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <form action="login.php" method="POST">
                                <div class="form-field">
                                    <label for="kegiatan">Nama Kegiatan</label>
                                    <input type="text" name="kegiatan" id="kegiatan" autofocus>

                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi">

                                    <label for="timeStart">Tanggal Mulai</label>
                                    <input type="datetime-local" name="timeStart" id="timeStart" class="event-time-from" />

                                    <label for="timeEnd">Tanggal Selesai</label>
                                    <input type="datetime-local" name="timeEnd" id="timeEnd" class="event-time-from" />

                                    <label for="level-select">Level</label>
                                    <select name="level" id="level-select" class="event-level">
                                        <option value="0" selected>Biasa</option>
                                        <option value="1">Sedang</option>
                                        <option value="2">Sangat Penting</option>
                                    </select>
                                </div>
                            </form>
                            <div style="margin-top: 15px;">
                                <button class="button form-sub" id="simpan">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="today-date">
                        <div class="event-day"></div>
                        <div class="event-date"></div>
                    </div>
                    <div class="events"></div>
                </div>

                <div class="col-md-8">
                    <div id="idx-calendar">
                        <div id="calendar-control">
                            <div id="monthNow">Januari 2014</div>
                            <div id="nextMonth"></div>
                            <div id="prevMonth"></div>
                        </div>
                        <div id="dayNames">
                            <ul>
                                <li>Minggu</li>
                                <li>Senin</li>
                                <li>Selasa</li>
                                <li>Rabu</li>
                                <li>Kamis</li>
                                <li>Jum'at</li>
                                <li>Sabtu</li>
                            </ul>
                        </div>
                        <div id="daysNum"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        var eventDay = document.querySelector(".event-day");
        var eventDate = document.querySelector(".event-date");

        var btnAddEvent = document.getElementById("iyakok");
        // var addEventWrapper = document.querySelector(".add-event-wrapper ");
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        var addEventSubmit = document.getElementById("simpan");
        var eventsContainer = document.querySelector(".events");

        var date = new Date();
        var month = date.getMonth();
        var year = date.getFullYear();

        var monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];

        var dayNames = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu",
        ];

        var dataArr = [];

        initData();

        function initData() {
            fetch('/api/load-data', {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    for (let i = 0; i < data.length; i++) {
                        dataArr.push(data[i]);
                    }
                    init();
                });
        }

        function init() {
            var monthNow = new Date().getMonth();
            var yearNow = new Date().getFullYear();

            var nextMonth = month + 1;
            var prevMonth = month - 1;
            var day = 0;

            if ((month == monthNow) && (year == yearNow)) {
                var day = new Date().getDate();
            }

            var htmlContent = "";
            var FebNumberOfDays = "";
            var counter = 1;
            var Nameday = 1;

            if (month == 1) {
                if ((year % 100 != 0) && (year % 4 == 0) || (year % 400 == 0)) {
                    FebNumberOfDays = 29;
                } else {
                    FebNumberOfDays = 28;
                }
            }

            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var monthNum = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
            var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday"];
            var dayPerMonth = ["31", "" + FebNumberOfDays + "", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31"]
            var nextDate = new Date(nextMonth + ' 1 ,' + year);
            var weekdays = nextDate.getDay();
            var weekdays2 = weekdays
            var numOfDays = dayPerMonth[month];

            while (weekdays > 0) {
                htmlContent += "<li style='padding:1 0 0;'></li>";
                weekdays--;
            }

            while (counter <= numOfDays) {
                if (weekdays2 > 6) {
                    weekdays2 = 0;
                    htmlContent += "</ul><ul>";
                }
                if (counter == day) {
                    htmlContent += "<li class='dayNow'>" + counter + "</li>";
                    getDay(counter);
                    updateEvents(new Date(year, month, counter));
                    Nameday = counter;
                } else {
                    htmlContent += "<li class='hari'>" + counter + "</li>";
                }
                weekdays2++;
                counter++;
            }

            document.getElementById("monthNow").innerHTML = monthNames[month] + " " + year;
            document.getElementById("daysNum").innerHTML = "<ul id=" + monthNum[month] + " class=" + year + ">" + htmlContent + "</ul>";
            onClick();
        }

        function onClick() {
            const days = document.querySelectorAll(".hari");
            days.forEach((hari) => {
                hari.addEventListener("click", (event) => {
                    getDay(event.target.innerHTML);
                });
            });
        }

        function getDay(tanggal) {
            const day = new Date(year, month, tanggal);
            const dayName = dayNames[day.getDay()];
            eventDay.innerHTML = dayName;
            eventDate.innerHTML = tanggal + " " + monthNames[month] + " " + year;
            updateEvents(day);
        }

        document.getElementById("nextMonth").onclick = function() {
            var idmonth = document.getElementById("daysNum");
            var oldMonth = idmonth.getElementsByTagName("ul")[0].id;

            year = idmonth.getElementsByTagName("ul")[0].className;
            month = Number(oldMonth);

            if (month == 12) {
                month = 0;
                year = Number(year) + 1
            }
            init();
        }

        document.getElementById("prevMonth").onclick = function() {
            var idmonth = document.getElementById("daysNum");
            var oldMonth = idmonth.getElementsByTagName("ul")[0].id;

            year = idmonth.getElementsByTagName("ul")[0].className;
            month = Number(month) - 1;

            if (month < 0) {
                month = 11;
                year = Number(year) - 1
            }
            init();
        }

        btnAddEvent.addEventListener("click", () => {
            modal.style.display = "block";
        });

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        addEventSubmit.addEventListener("click", async () => {
            var eventTitle = document.getElementById("kegiatan");
            var eventLokasi = document.getElementById("lokasi");
            var eventTimeStart = document.getElementById("timeStart");
            var eventTimeEnd = document.getElementById("timeEnd");
            var eventLevel = document.getElementById("level-select");

            if (
                eventTitle.value == "" || 
                eventLokasi.value == "" ||
                eventTimeStart.value == "" ||
                eventTimeEnd.value == "" ||
                eventLevel.value == ""
            ) {
                alert("Inputan tidak boleh kosong!");
                return;
            }

            if (new Date(eventTimeStart.value) >= new Date(eventTimeEnd.value)) {
                alert("Tanggal mulai tidak boleh lebih besar atau sama dengan Tanggal selesai!")
                return;
            }

            var data = {
                title: eventTitle.value,
                lokasi: eventLokasi.value,
                timeStart: eventTimeStart.value,
                timeEnd: eventTimeEnd.value,
                level: eventLevel.value,
            }
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/add-kegiatan", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    const response = JSON.parse(xhr.response)
                    alert(response.message)
                    if (response.status == 1) window.location.href = "/";
                }
            };
            xhr.send(JSON.stringify(data));
        });

        function updateEvents(tanggal) {
            let events = "";
            let format = "";
            dataArr.forEach((event) => {
                let iyaudah = new Date(event.timeStart);
                if (
                    ((tanggal.getDay() == iyaudah.getDay()) &&
                    (tanggal.getMonth() == iyaudah.getMonth()) &&
                    (tanggal.getFullYear() == iyaudah.getFullYear()))
                ) {
                    let level = "";

                    switch (level) {
                        case 0:
                            level = "Sedang";
                            break;
                    }

                    events += `
                        <div class="event">
                            <a href="/edit/${event.id}">
                                <div class="title">
                                    <h3>${event.title}</h3>
                                </div>
                                <div class="iya-tanggal">
                                    <p>${event.timeStart}</p>
                                </div>
                            </a>
                        </div>
                    `;
                }
            });

            if (events == "") {
                events = `<h3> Tidak ada kegiatan </h3>`;
            }

            eventsContainer.innerHTML = events;
        }
    </script>
</body>

</html>