<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title', 'Health Axis')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+HU:wght@100..400&family=Playwrite+IS:wght@100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="icon" href="{{ asset('img/Health.ico') }}" type="image/x-icon" />
    @stack('styles')
</head>                                        

<body>                         

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init(); // Initialize animations
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // --- 1. Fullscreen Toggle ---
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            if (fullscreenBtn) { // Null check added
                if (localStorage.getItem('isFullscreen') === 'true') {
                    fullscreenBtn.innerHTML = '<i class="fas fa-compress"></i>';
                } else {
                    fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
                }

                fullscreenBtn.addEventListener('click', () => {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen().then(() => {
                            fullscreenBtn.innerHTML = '<i class="fas fa-compress"></i>';
                            localStorage.setItem('isFullscreen', 'true');
                        }).catch(err => console.error(`Error enabling full-screen: ${err.message}`));
                    } else {
                        document.exitFullscreen().then(() => {
                            fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
                            localStorage.setItem('isFullscreen', 'false');
                        }).catch(err => console.error(`Error exiting full-screen: ${err.message}`));
                    }
                });

                document.addEventListener('fullscreenchange', () => {
                    if (!document.fullscreenElement) {
                        fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
                        localStorage.setItem('isFullscreen', 'false');
                    }
                });
            }

            // --- 2. Franchise Search ---
            const franchiseSearch = document.getElementById("franchiseSearch");
            if (franchiseSearch) { // Null check added
                franchiseSearch.addEventListener("keyup", function() {
                    let input = this.value.toLowerCase();
                    let cards = document.querySelectorAll("#franchiseList .col-md-4");
            
                    cards.forEach(card => {
                        let name = card.querySelector(".card-title")?.innerText.toLowerCase() || "";
                        let location = card.querySelector(".card-text")?.innerText.toLowerCase() || "";
            
                        if (name.includes(input) || location.includes(input)) {
                            card.style.display = "block";
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
            }

            // --- 3. Toggle Password Visibility ---
            const togglePassword = document.querySelector(".toggle-password");
            if (togglePassword) { // Null check added
                togglePassword.addEventListener("click", function () {
                    let passwordField = document.getElementById("password");
                    if (!passwordField) return;

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
            }

        });
    </script>

    @stack('scripts')
</body>
</html>