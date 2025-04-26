<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
</head>

<body>
    <h2>Change Your Password</h2>

    <form method="post" action="changePassword">
        <label for="current_password">Current Password:</label><br>
        <input type="password" id="current_password" name="current_password" required><br>

        <label for="new_password">New Password:</label><br>
        <input type="password" id="new_password" name="new_password" required><br>

        <label for="confirm_password">Confirm New Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <input type="submit" value="Change Password">
        <a href="profile">Cancel</a>
    </form>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success']; ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

</body>

</html>