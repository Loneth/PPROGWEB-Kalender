<?php

$id = $url[1];
if (!$id) {
    header("Location: /");
    exit;
}

$sql = "DELETE FROM users_notes WHERE id='$id'";
// $result = mysqli_query($conn, $sql);

// header("Location: /");
// exit;

if (mysqli_query($conn, $sql)) {
    // echo "Record deleted successfully";
    echo `
        <script>
            alert("Record deleted successfully");
        </script>
    `;
    header("Location: /");
    
    // echo `
    //     <script>
    //         alert("Record deleted successfully");
    //         window.location.replace("/");
    //     </>
    // `;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
    // echo `
    //     <script>
    //         alert("Error deleting record");
    //         window.location.replace("/");
    //     </script>
    // `;
}
?>
