<!DOCTYPE html>
<html>
    <script type="text/javascript">
        var store_name = 'TrustedMart';
        document.title = store_name;
        document.write("<center><h1>", store_name, "</h1></center>");
    </script>

    <?php
        ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR');

        include 'connection.php';
        $conn = OpenCon();

        if (mysqli_connect_errno()) {
            echo "Unable to connect to server " . mysqli_connect_error();
            exit;
        }

        session_start();
        $username = $_SESSION['username'];
        $oldpass = $_POST['oldpassword'];
        $newpass = $_POST['newpassword'];
        $confirmpass = $_POST['confirmpassword'];

        $query = "SELECT password FROM userss WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo 'Invalid Username or Login Session<br>';
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit;
        }

        $row = mysqli_fetch_assoc($result);
        $mypass = $row['password'];

        if ($mypass == $oldpass) {
            if ($newpass == $confirmpass) {
                $update_query = "UPDATE userss SET password = ? WHERE user_id = ?";
                $stmt_update = mysqli_prepare($conn, $update_query);
                mysqli_stmt_bind_param($stmt_update, "ss", $newpass, $username);
                if (mysqli_stmt_execute($stmt_update)) {
                    echo '<script>alert("Password updated successfully")</script>';
                    echo '<meta http-equiv="refresh" content="0;url=ehome.php">';
                } else {
                    echo 'Error updating password: ' . mysqli_error($conn) . '<br>';
                }
                mysqli_stmt_close($stmt_update);
            } else {
                echo 'New Password and Confirm Password Field Mismatch<br>';
                echo '<meta http-equiv="refresh" content="0;url=ehome.php">';
            }
        } else {
            echo 'Invalid Old Password<br>';
            echo '<meta http-equiv="refresh" content="0;url=ehome.php">';
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    ?>
</html>