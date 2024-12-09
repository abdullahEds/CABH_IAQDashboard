<!-- Header -->
<?php include 'partials/header.php' ?>

<!-- /#header -->
<style>
    /* General Styles */
    .content-wrapper {
        background-color: #f0f0f0; /* Replace with your desired color */
        padding: 0px; /* Adjust padding as needed */
    }

    .btn {
        background-color: white; /* Default background color */
        border: 2px solid black; /* Border color */
        color: black; /* Text color */
        padding: 10px 20px; /* Padding for better appearance */
        cursor: pointer; /* Pointer cursor on hover */
        transition: background-color 0.3s, color 0.3s; /* Smooth transition */
    }

    .btn:hover {
        background-color: #f16463; /* Hover effect */
    }

    .btn.active {
        background-color: #f16463; /* Active color */
        color: yellow;
        border: 2px solid black; /* Border color */
    }

    .btn.active:hover {
        background-color: #f16463; /* Hover effect for active state */
    }

    .btn.inactive {
        background-color: white; /* Background color for inactive state */
    }

    .align {
        text-align: justify;
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .content-wrapper {
            padding: 20px;
        }
    }

    @media (max-width: 992px) {
        .partners-section,
        .last-partners-section {
            margin: 0;
        }
        
        .last-partners-section .col-lg-4 {
            width: 100%;
            margin-bottom: 30px;
        }

        .partner-logo {
            max-height: 120px;
        }

        #grey {
            margin: 0;
            padding: 10px;
        }

        #grey p {
            font-size: 14px;
        }
        
        .btn {
            padding: 8px 16px;
        }
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 10px;
        }

        .partner-logo {
            max-height: 100px;
        }

        .btn {
            padding: 6px 12px;
        }

        #grey p {
            font-size: 12px;
        }
        
        .partner-description p {
            font-size: 14px;
        }
        
        .row {
            margin-left: 0;
            margin-right: 0;
        }
    }

    @media (max-width: 576px) {
        .btn {
            padding: 5px 10px;
            font-size: 12px;
        }

        .partner-description p {
            font-size: 12px;
        }
        
        .partner-logo {
            max-height: 80px;
        }

        #grey p {
            font-size: 11px;
        }
    }
</style>
<body style="margin-top: 6px;">
    <div class="content-wrapper">
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <div class="row justify-content-center">
                    <div class="section-heading col-lg-12 text-center">
                        <h2 style="margin: 0;">ABOUT CABH</h2> 
                    </div>
                </div>
                <div class="row" id="grey" style="background-color: #D9D9D9;">
                    <div class="col-lg-6 about-bg" style="margin-top: 10px;">
                        <div class="about-content" style="text-align: justify;">
                            <p style="color: black;">
                                <b>Cleaner Air and Better Health (CABH)</b> is a five-year (2021 to 2026) project supported by the United States Agency for International Development.<p> It aims to strengthen air pollution mitigation and reduce exposure to air pollution in India by establishing evidence-based models for better air quality management.</p><p>The project is being implemented by a consortium led by the Council on Energy, Environment and Water and includes Asar Social Impact Advisors, Environmental Design Solutions, Enviro Legal Defence Firm, and Vital Strategies.</p>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-3 text-center align-self-center">
                        <img src="../images/CABH_logo_rounded.png" alt="CABH Logo" style="max-width: 160%; height: auto;">
                    </div>
                </div>

                <!----------------------------------------- Donor Section --------------------------------------->
                <div class="row partners-section">
                    <div class="col-lg-12 text-center" style="margin-bottom: 20px;">
                        <h4 class="heading-about" style="font-weight: 600;">DONOR</h4>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-center align-items-center" style="height: 50vh; margin-top: -130px;">
                                    <a href="https://www.usaid.gov/india" target="_blank" style="text-decoration: none;">
                                        <img class="img-fluid donor-logo" src="../images/usaid-logo.png" alt="USAID Logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="partner-description">
                                    <p class="align" style="color: black; margin-top: -110px; margin-left: 160px; margin-right: 160px;">
                                        The United States Agency for International Development (USAID) is the US government’s premier international development agency and a catalytic actor driving development results across the world. USAID works to help lift lives, build communities, and advance democracy. Its work advances US national security and economic prosperity, demonstrates American generosity, and helps countries with their development journey.
                                    </p>
                                    <p class="align" style="color: black; margin-left: 160px; margin-right: 160px;">
                                        <span id="dots">...</span><span id="more1"> In India, USAID is collaborating with the country’s growing human and financial resources through partnerships that catalyse innovation and entrepreneurship to solve critical local and global development challenges. USAID’s air quality programming aims to mitigate and reduce ambient and household air pollution to reduce adverse health impacts, advance climate change mitigation and adaptation, and promote inclusive, sustainable development. It is supporting the Cleaner Air and Better Health (CABH) project to enable and frame policies and programmes to match the needs of target populations, with a focus on gender inclusion.</span>
                                    </p>
                                    <p style="margin-left: 430px; margin-right: 160px;">
                                        <a href="https://www.usaid.gov/india" target="_blank" style="color: #0396c7; text-decoration: none;">www.usaid.gov/india</a> | 
                                        <a href="https://twitter.com/usaid_india" target="_blank" style="color: #0396c7; text-decoration: none;">@usaid_india</a>
                                    </p>
                                    <button onclick="myFunction()" class="btn" id="myBtn" style="margin-left: 510px">Read more</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!----------------------------------------- Partners Section --------------------------------------->
                <div class="row partners-section">
                    <div class="col-lg-12 text-center" style="margin-bottom: 20px;">
                        <h4 class="heading-about" style="font-weight: 600;">THE CONSORTIUM</h4>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <a href="https://www.ceew.in" target="_blank" style="text-decoration: none;">
                            <img class="partner-logo smaller" src="../images/The-consortium-1-image.png" alt="CEEW Logo" style="max-width: 100px; height: auto; margin-left: 60px;">
                        </a>
                        <div class="partner-description" style="margin-top: 20px;">
                            <p class="align" style="color: black; margin-left:60px;">The Council on Energy, Environment and Water is one of Asia’s leading not-for-profit policy research institutions and among the world’s top climate think tanks. <span id="dots1">...</span> <span id="more2"> The Council uses data, integrated analysis, and strategic outreach to explain -- and change -- the use, reuse, and misuse of resources. The CABH project consortium is led by the Council which is focusing on emissions mitigation, market based approaches and nudge experiments and overall project management.</span></p>
                            <p style="margin-left: 60px;">
                                <a href="https://www.ceew.in" target="_blank" style="color: #0396c7; text-decoration: none;">www.ceew.in</a> | 
                                <a href="https://twitter.com/CEEWIndia" target="_blank" style="color: #0396c7; text-decoration: none;">@CEEWIndia</a>
                            </p>
                            <button onclick="myFunction1()" class="btn" id="myBtn1">Read more</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <a href="https://www.asarimpact.com" target="_blank" style="text-decoration: none;">
                            <img class="partner-logo smaller" src="../images/The-consortium-2-image.png" alt="Asar Logo" style="max-width: 100px; height: auto;">
                        </a>
                        <div class="partner-description">
                            <p class="align" style="color: black;">Asar Social Impact Advisors is a leading advisory firm focused on enabling social and economic impact. <span id="dots2">...</span> <span id="more3"> It helps organizations design and implement social programs, track progress, and evaluate impact. Asar is responsible for monitoring and evaluation, research and analysis, and strategy development for the CABH project.</span></p>
                            <p>
                                <a href="https://www.asarimpact.com" target="_blank" style="color: #0396c7; text-decoration: none;">www.asarimpact.com</a> | 
                                <a href="https://twitter.com/AsarSocial" target="_blank" style="color: #0396c7; text-decoration: none;">@AsarSocial</a>
                            </p>
                            <button onclick="myFunction2()" class="btn" id="myBtn2">Read more</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <a href="https://www.envirolegaldefencefirm.org" target="_blank" style="text-decoration: none;">
                            <img class="partner-logo smaller" src="../images/The-consortium-3-image.png" alt="Enviro Legal Defence Firm Logo" style="max-width: 100px; height: auto;">
                        </a>
                        <div class="partner-description">
                            <p class="align" style="color: black;">Enviro Legal Defence Firm is a non-profit organization working on environmental law and advocacy. <span id="dots3">...</span> <span id="more4"> It focuses on promoting environmental justice and sustainable development through legal and policy measures. The firm contributes to the CABH project through legal expertise and advocacy.</span></p>
                            <p>
                                <a href="https://www.envirolegaldefencefirm.org" target="_blank" style="color: #0396c7; text-decoration: none;">www.envirolegaldefencefirm.org</a> | 
                                <a href="https://twitter.com/EnviroLegal" target="_blank" style="color: #0396c7; text-decoration: none;">@EnviroLegal</a>
                            </p>
                            <button onclick="myFunction3()" class="btn" id="myBtn3">Read more</button>
                        </div>
                    </div>
                </div>

                <!----------------------------------------- Contact Section --------------------------------------->
                <div class="row last-partners-section">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about" style="font-weight: 600;">CONTACT</h4>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="../images/Dhiraj-Mehta.png" alt="Dhiraj Mehta" class="img-fluid" style="max-height: 200px; margin-top: -60px;">
                        <div class="partner-description">
                            <p class="align" style="color: black; margin-left: 50px; margin-right: 50px;">Dhiraj Mehta <br> Team Leader, CABH Project <br> <a href="mailto:dhiraj.mehta@ceew.in" style="color: #0396c7; text-decoration: none;">dhiraj.mehta@ceew.in</a> <br> +91 98765 43210</p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="../images/Ankit-Saini.png" alt="Ankit Saini" class="img-fluid" style="max-height: 200px; margin-top: -60px;">
                        <div class="partner-description">
                            <p class="align" style="color: black; margin-left: 50px; margin-right: 50px;">Ankit Saini <br> Senior Manager, CABH Project <br> <a href="mailto:ankit.saini@ceew.in" style="color: #0396c7; text-decoration: none;">ankit.saini@ceew.in</a> <br> +91 98765 43211</p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="../images/Divya-Kumar.png" alt="Divya Kumar" class="img-fluid" style="max-height: 200px; margin-top: -60px;">
                        <div class="partner-description">
                            <p class="align" style="color: black; margin-left: 50px; margin-right: 50px;">Divya Kumar <br> Project Manager, CABH Project <br> <a href="mailto:divya.kumar@ceew.in" style="color: #0396c7; text-decoration: none;">divya.kumar@ceew.in</a> <br> +91 98765 43212</p>
                        </div>
                    </div>
                </div>

                <!----------------------------------------- Legal Section --------------------------------------->
                <div class="row last-partners-section">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about" style="font-weight: 600;">LEGAL</h4>
                    </div>
                    <div class="col-lg-12 text-center">
                        <p class="align" style="color: black;">The content on this website is for informational purposes only. The CABH project and its partners are not responsible for the accuracy or completeness of the information. For any legal queries, please contact the project team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'partials/footer.php' ?>
</body>
<script>
    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more1");
        var btnText = document.getElementById("myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
        }
    }

    function myFunction1() {
        var dots = document.getElementById("dots1");
        var moreText = document.getElementById("more2");
        var btnText = document.getElementById("myBtn1");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
        }
    }

    function myFunction2() {
        var dots = document.getElementById("dots2");
        var moreText = document.getElementById("more3");
        var btnText = document.getElementById("myBtn2");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
        }
    }

    function myFunction3() {
        var dots = document.getElementById("dots3");
        var moreText = document.getElementById("more4");
        var btnText = document.getElementById("myBtn3");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
        }
    }
</script>
