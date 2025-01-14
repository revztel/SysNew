<!DOCTYPE html>
<html>
<head>
  <title>Auto Login</title>
</head>
<body>
  <form id="loginForm" name="login" action="http://192.168.180.1/login" method="post">
    <!-- The "dst" is the page the MikroTik router shows after login -->
    <input type="hidden" name="dst" value="http://192.168.180.1/status" />

    <!-- Hidden fields that we'll fill from the URL params -->
    <input type="hidden" id="username" name="username" value="" />
    <input type="hidden" id="password" name="password" value="" />
  </form>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
      // Read the "username" and "password" from the URL.
      const urlParams = new URLSearchParams(window.location.search);
      const user = urlParams.get('username');
      const pass = urlParams.get('password');

      // If we have both, auto-fill and submit to the router
      if (user && pass) {
          document.getElementById('username').value = user;
          document.getElementById('password').value = pass;
          document.getElementById('loginForm').submit();
      } else {
          // If the params are missing, show some error or manual login form
          alert('Username or password missing. Please check your URL or contact support.');
      }
  });
  </script>
</body>
</html>
