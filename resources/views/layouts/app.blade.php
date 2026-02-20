<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playwrite+HU:wght@100..400&family=Playwrite+IS:wght@100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- MDB icon -->
    <link rel="icon" href="{{ asset('img/pathlab_logo.jpg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playwrite+HU:wght@100..400&family=Playwrite+IS:wght@100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>                                        

<body>                         

    <div class="content">
        @yield('content')
    </div>

    <!-- MDB -->
    <script src="{{ asset('js/mdb.umd.min.js') }}"></script>


    <!-- {{-- fullscreen --}} -->
    <script>
        const fullscreenBtn = document.getElementById('fullscreen-btn');
      
        // Check localStorage on page load
        window.addEventListener('DOMContentLoaded', () => {
          if (localStorage.getItem('isFullscreen') === 'true') {
            fullscreenBtn.innerHTML = '<i class="fas fa-compress"></i>';
          } else {
            fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
          }
        });
      
        fullscreenBtn.addEventListener('click', () => {
          if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().then(() => {
              fullscreenBtn.innerHTML = '<i class="fas fa-compress"></i>';
              localStorage.setItem('isFullscreen', 'true');
            }).catch(err => {
              console.error(`Error attempting to enable full-screen mode: ${err.message}`);
            });
          } else {
            document.exitFullscreen().then(() => {
              fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
              localStorage.setItem('isFullscreen', 'false');
            }).catch(err => {
              console.error(`Error attempting to exit full-screen mode: ${err.message}`);
            });
          }
        });
      
        document.addEventListener('fullscreenchange', () => {
          if (!document.fullscreenElement) {
            fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
            localStorage.setItem('isFullscreen', 'false');
          }
        });
    </script>

    <!-- Search bar -->
    <script>
        document.getElementById("franchiseSearch").addEventListener("keyup", function() {
        let input = this.value.toLowerCase(); // Get the search value in lowercase
        let cards = document.querySelectorAll("#franchiseList .col-md-4"); // Select all franchise cards
    
        cards.forEach(card => {
            let name = card.querySelector(".card-title").innerText.toLowerCase();
            let location = card.querySelector(".card-text").innerText.toLowerCase();
    
            // Show or hide based on search input
            if (name.includes(input) || location.includes(input)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
    </script>

    <!-- Toggle password visibility -->
    <script>
        document.querySelector(".toggle-password").addEventListener("click", function () {
        let passwordField = document.getElementById("password");
        let icon = this.querySelector("i");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
    </script>


</body>

</html>