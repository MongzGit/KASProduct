<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* CSS Styling.. its me Mongezi, my niga your form/file */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reset-container {
            background: #fff;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Di LAS</h2>
        <h2>Reset Your Password</h2>
        <form id="resetForm" action="reset_password" method="GET">
            <!-- Input for email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Verification email *" required>
            <!-- Input for new password -->
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter new password *" required>
            
            <!-- Input for confirm password -->
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password *" required>
            
            <!-- Hidden input for the token -->
            <input type="hidden" id="token" name="token" value="">

            <!-- Submit button -->
            <button type="submit">Reset Password</button>
        </form>
    </div>
    <script>
        // JavaScript functionality
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token'); // Extract token from the URL

        if (token) {
            // alert(`Token received: ${token}`);
            // alert('Resetting password!');
            // Populate the hidden token input field
            document.getElementById('token').value = token;
        } else {
            // Alert the user if the token is missing or invalid
            // alert(`Token received: ${token}`);
            // alert('Invalid or missing token! Please check the reset link.');
            // Optionally hide the form if the token is invalid
            document.getElementById('resetForm').style.display = 'none';
        }
    </script>
</body>
</html>
