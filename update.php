<?php
include 'config.php';

$StudentID = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE StudentID = $StudentID");
$students = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $dob = $_POST["DateOfBirth"];
    $Gender = $_POST["Gender"];

    // Update data
    $sql = "UPDATE students SET FirstName = '$FirstName', LastName = '$LastName', DateOfBirth = '$dob', Gender = '$Gender' WHERE StudentID = $StudentID";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST" action="">
        FirstName: <input type="text" name="FirstName" value="<?php echo htmlspecialchars($students['FirstName']); ?>" required><br><br>
        LastName: <input type="text" name="LastName" value="<?php echo htmlspecialchars($students['LastName']); ?>" required><br><br>
        DateOfBirth: <input type="date" name="DateOfBirth" value="<?php echo htmlspecialchars($students['DateOfBirth']); ?>" required><br><br>
        Gender:<br>
        <input type="radio" name="Gender" value="Male" <?php if ($students['Gender'] == 'Male') echo 'checked'; ?>> Male<br>
        <input type="radio" name="Gender" value="Female" <?php if ($students['Gender'] == 'Female') echo 'checked'; ?>> Female<br><br>
        <button type="submit">Update students</button>
    </form>
</body>
</html>
