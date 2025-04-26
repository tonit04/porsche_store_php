<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
</head>

<body>
    <h2>Edit Your Profile</h2>

    <form method="post" action="profileUpdate">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>"
            required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"
            required><br>

        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name"
            value="<?php echo htmlspecialchars($user['full_name']); ?>"><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"><br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address"><?php echo htmlspecialchars($user['address']); ?></textarea><br>

        <input type="submit" value="Update Profile">
        <a href="profile">Cancel</a>
    </form>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</body>

</html>