<?php

$id = $url[1];

$sql = "SELECT * FROM users_notes WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <link rel="stylesheet" href="/assets/css/style.css?ran=<?php echo rand(1, 100) ?>">
</head>
<body>
    <header>
        <ul class="sukak-mu-dae">
            <li><a class="active" href="https://dae.lol/#home">Home</a></li>
            <li style="float:right"><a href="/logout">Logout</a></li>
        </ul>
    </header>
    <div class="form-edit">
        <h2>Update Kegiatannya cuy</h2>
        <span></span>
        <form onsubmit="return editKegiatan()">
            <div class="form-field">
                <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

                <label for="title">Nama Kegiatan</label>
                <input type="text" name="title" id="title" value="<?php echo $row['title'] ?>">

                <label for="lokasi">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="<?php echo $row['lokasi'] ?>">

                <label for="timeStart">Tanggal Mulai</label>
                <input type="datetime-local" name="timeStart" id="timeStart" class="event-time-from" value="<?php echo date('Y-m-d\TH:i', strtotime($row['timeStart'])) ?>">

                <label for="timeEnd">Tanggal Selesai</label>
                <input type="datetime-local" name="timeEnd" id="timeEnd" class="event-time-from" value="<?php echo date('Y-m-d\TH:i', strtotime($row['timeEnd'])) ?>">

                <label for="level-select">Level</label>
                <select name="level" id="level-select" class="event-level">
                    <option value="0" <?php echo $row['level'] == 0 ? 'selected' : '' ?>>Biasa</option>
                    <option value="1" <?php echo $row['level'] == 1 ? 'selected' : '' ?>>Sedang</option>
                    <option value="2" <?php echo $row['level'] == 2 ? 'selected' : '' ?>>Sangat Penting</option>
                </select>

                <div style="margin-top: 15px;">
                    <a href="/" class="button form-sub">Kembali</a>
                    <button class="button form-sub" id="iyakok">Simpan</button>
                </div>                    
            </div>
        </form>
    </div>

    <script>
        let message = document.getElementsByTagName("span")[0];

        function editKegiatan() {
            window.event.preventDefault();
            let iniID = document.getElementById("id");
            let title = document.getElementById("title");
            let lokasi = document.getElementById("lokasi");
            let timeStart = document.getElementById("timeStart");
            let timeEnd = document.getElementById("timeEnd");
            let level = document.getElementById("level-select");
            
            message.innerHTML = "";

            if (title.value === "") {
                message.innerHTML = "Nama Kegiatan tidak boleh kosong";
                return;
            }

            if (lokasi.value === "") {
                message.innerHTML = "Lokasi tidak boleh kosong";
                return;
            }
            
            if (!timeStart.value || !timeEnd.value) {
                message.innerHTML = "Tanggal tidak boleh kosong";
                return;
            }
            
            if (level.value === "") {
                message.innerHTML = "Level tidak boleh kosong";
                return;
            }

            var data = {
                id: iniID.value,
                title: title.value,
                lokasi: lokasi.value,
                timeStart: timeStart.value,
                timeEnd: timeEnd.value,
                level: level.value,
            };

            if (message.innerHTML === "") {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/api/edit-kegiatan", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        const response = JSON.parse(xhr.response);
                        if (response.status === 1) {
                            // message.innerHTML = "Berhasil mengedit kegiatan";
                            alert(response.message);
                            window.location.href = `/`;
                        } else {
                            // message.innerHTML = "Gagal mengedit kegiatan";
                            alert(response.message);
                        }
                    }
                }
                xhr.send(JSON.stringify(data));
            }
        }
    </script>
</body>
</html>
