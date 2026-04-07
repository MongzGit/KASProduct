<!-- resources/views/delete.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
</head>
<body>
    <h2>Delete Your Account</h2>
    <p>Click below to permanently delete your account.</p>

    <form method="POST" action="{{ route('user.delete') }}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="token" value="{{ $token }}">
        <button type="submit">Delete My Account</button>
    </form>
</body>
</html>