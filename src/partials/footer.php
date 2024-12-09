<!-- Footer Section -->
<footer class="site-footer">
    <div class="footer-inner bg-green">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <!-- Left side: Developed by EDS -->
                <div class="col-md-6">
                    Developed by 
                    <a href="https://www.edsglobal.com/" style="color:white;"><b>Environmental Design Solutions Private Limited</b></a>
                    <!-- <span style="color: #2fb996;"> &copy; 2018 Ela Admin</span> -->
                </div>
                <!-- Right side: Links and social icons -->
                <div class="col-md-6 text-md-right">
                    <!-- <span style="color:#2fb996;">Designed by <a href="https://colorlib.com" style="color:#2fb996;">Colorlib</a></span> -->
                    <a href="https://www.facebook.com/Environmental.Design.Solutions/" class="fa fa-facebook" style="padding:5px;"></a>
                    <a href="https://twitter.com/edsglobal?lang=en" class="fa fa-twitter" style="padding:5px;"></a>
                    <a href="https://www.linkedin.com/company/environmental-design-solutions/" class="fa fa-linkedin" style="padding:5px;"></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Styles -->
<style>
    .site-footer {
        padding: 20px 0;
        background-color: #2fb996; /* Adjust to match .bg-green or your desired color */
        color: #fff;
        width: 100%;
        position: relative;
    }
    .footer-inner {
        max-width: 100%;
        margin: 0;
        padding: 0 15px; /* Padding to add some space inside */
    }
    .container-fluid {
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
    }
    .fa-facebook, .fa-twitter, .fa-linkedin {
        color: #fff;
        text-decoration: none;
        font-size: 18px; /* Adjust as needed */
    }
    .fa-facebook:hover, .fa-twitter:hover, .fa-linkedin:hover {
        color: #2fb996; /* Adjust as needed */
    }
</style>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuBtn = document.querySelector("#mobile-menu-btn");
        const mobileMenu = document.querySelector(".mobile-menu");

        mobileMenuBtn.addEventListener("click", () => {
            if (mobileMenu.style.display === "none" || !mobileMenu.style.display) {
                mobileMenu.style.display = "flex";
                mobileMenuBtn.textContent = "Close";
            } else {
                mobileMenu.style.display = "none";
                mobileMenuBtn.textContent = "Menu";
            }
        });
    });
</script>
