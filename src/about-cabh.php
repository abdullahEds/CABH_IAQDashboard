
<!-- Header-->
<?php include 'partials/header.php' ?>


<!-- /#header -->
<style>
        /* Add margin to the top of the "PARTNERS" section */
        .partners-section {
            margin-top: 40px;
            margin-left: 30px;
            margin-right: 30px; /* Adjust the margin as needed */
        }
        .partner-logo {
            display: inline-block;
            max-width: 100%;
            height: auto;
            max-height: 150px;
            vertical-align: middle;
        }
        .donor-logo {
            display: block;
            max-width: 80%; /* Allows the image to grow up to double its original width */
            height: auto;
        }
        .col-lg-4 {
            text-align: center;
            margin-bottom: 50px; /* Add margin bottom to create gap between images */
        }
        .smaller {
            max-height: 120px; /* Adjust the height for smaller size */
        }
        /* Center the last two partner sections */
        .last-partners-section {
            margin-top: 40px;
        }

        .last-partners-section .col-lg-4 {
            width: 60%;
            margin-bottom: 50px;
        }

        .last-partners-section .col-lg-4:last-child {
            margin-bottom: 0;
        }

        .last-partners-section .partner-logo {
            max-width: 100%;
            height: auto;
            max-height: 150px;
            vertical-align: middle;
            margin-bottom: 20px;
        }

        .last-partners-section .partner-description {
            margin-bottom: 20px;
        }

        #grey {
            background-color: #f3f3f3; /* Light grey background color */
            padding: 0px; /* Add padding to the div */
            margin-left: 150px; /* Margin on the left side */
            margin-right: 180px; /* Margin on the right side */
            border-radius: 10px;
        }

        #grey .about-content {
            padding: 2px; /* Add padding to the content inside the div */
        }

        #grey p {
            color: black; 
            
        }

        #grey img {
            max-width: 56%; /* Set maximum width for images */
            height: 50px; /* Maintain aspect ratio */
        }
        .content-wrapper {
            margin-top: -55px;;
            
    background-color: #f0f0f0; /* Replace with your desired color */
    padding: 0px; /* Adjust padding as needed */
        }
        #more1 {
            display: none; /* Initially hide the extra text */
        }
        #more2 {
            display: none; /* Initially hide the extra text */
        }
        #more3 {
            display: none; /* Initially hide the extra text */
        }
        #more4 {
            display: none; /* Initially hide the extra text */
        }
        #more5 {
            display: none; /* Initially hide the extra text */
        }
        #more6 {
            display: none; /* Initially hide the extra text */
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
    
    /* Active button style */
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
    .align{
        text-align: justify;
    }

    ul {
            list-style-type: disc; /* or any other bullet style */
            margin-left: 165px;
        }
    li{
        text-align: left;
    }



    </style>
<body style="margin-top : 6px;">
<div class="content-wrapper" >
<div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <div class="row justify-content-center"> <!-- Centering the content -->
                <div class="row">
                    <div class="section-heading col-lg-12 text-center">
                        <h2 style ="margin:0;"> ABOUT CABH </h2> 
                    </div>
                </div>
                <!-- <div style="background-color: #f2f2f2; padding: 18px;"> -->
                <div class="row" id="grey" style="background-color: #D9D9D9;">
                    <div class="col-lg-6 about-bg" style="margin-top: 10px;">
                        <div class="about-content" style=" text-align: justify;">
                            <p style="color: black; ">
                                <b>Cleaner Air and Better Health (CABH)</b> is a five-year (2021 to 2026) project supported by the United States Agency for
                                International Development.<p> It aims to strengthen air pollution mitigation and reduce exposure to
                                air pollution in India by establishing evidence-based models for better air quality management. </p><p>
                                The project is being implemented by a consortium led by the Council on Energy, Environment and Water 
                                and includes Asar Social Impact Advisors, Environmental Design Solutions, Enviro Legal Defence Firm, and Vital 
                                Strategies. </p>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 "></div>
                    <div class="col-lg-3 text-center align-self-center ">
                        <img src="../images/CABH Logo Black box.jpg" alt="CABH Logo" style="max-width: 160%; height: auto;">
                    </div>
                </div>
                 <!-- </div> -->

                <!----------------------------------------- Donor Section --------------------------------------->

                <div class="row partners-section">
                    <div class="col-lg-12 text-center" style="margin-bottom: 20px;">
                    <!-- <h4 class="heading-about" style="font-weight: 600;">DONOR</h4> -->
                    </div>
                    <!-- <div class="col-lg-12 text-center"> <!-- Adjusted for the logo alignment -->
                        <!-- <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 text-center">
                                <img class="partner-logo" src="../images/ceew.png" alt="CEEW Logo">
                                <div class="partner-description" style="margin-top: 20px;">
                                    <p style="color: black; margin-left:60px;  margin-right:70px;">The United States Agency for International Development (USAID) is 
                                         the US government’s premier international development agency and a catalytic actor driving
                                         development results across the world. USAID works to help lift lives, build communities, 
                                         and advance democracy. Its work advances US national security and economic prosperity, 
                                         demonstrates American generosity, and helps countries with their development journey. 
                                         In India, USAID is collaborating with the country’s growing human and financial resources
                                         through partnerships that catalyse innovation and entrepreneurship to solve critical local
                                         and global development challenges.

                                         USAID’s air quality programming aims to mitigate and reduce ambient and household air pollution
                                         to reduce adverse health impacts, advance climate change mitigation and adaptation, and promote
                                           inclusive, sustainable development. It is supporting the Cleaner Air and Better Health (CABH) 
                                           project to enable and frame policies and programmes to match the needs of target populations, 
                                           with a focus on gender inclusion.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  -->

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Logo section (centered within left half) -->
                            <div class="d-flex justify-content-center align-items-center" style="height: 50vh; margin-top: -130px;">
                                <!-- <img class="img-fluid donor-logo" src="../images/usaid-logo.png" alt="USAID Logo"> -->
                                <a href="https://www.usaid.gov/india" target="_blank" style="text-decoration: none;">
                                    <img class="img-fluid donor-logo" src="../images/usaid-logo.png" alt="USAID Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <!-- Text section (right half) -->
                            <div class="partner-description">
                                <p class="align"style="color: black; margin-top: -110px; margin-left: 160px; margin-right: 160px; ">
                                The United States Agency for International Development (USAID) is the US government’s premier international development agency and a catalytic actor driving development results across the world. USAID works to help lift lives, build communities, and advance democracy. Its work advances US national security and economic prosperity, demonstrates American generosity, and helps countries with their development journey.<span  id="dots">..</p> 
                                 
                                <p class="align"style="color: black;  margin-left: 160px; margin-right: 160px; "> </span><span id="more1"> In India, 
                                 USAID is collaborating with the country’s growing human and financial resources through partnerships that catalyse innovation and entrepreneurship to solve critical local and global development challenges.

USAID’s air quality programming aims to mitigate and reduce ambient and household air pollution to reduce adverse health impacts, advance climate change mitigation and adaptation, and promote inclusive, sustainable development. It is supporting the Cleaner Air and Better Health (CABH) project to enable and frame policies and programmes to match the needs of target populations, with a focus on gender inclusion.
                                    
</p>
<p style="margin-left: 430px; margin-right: 160px;">
        <a href="https://www.usaid.gov/india" target="_blank" style="color: #0396c7; text-decoration: none;">www.usaid.gov/india</a> | 
        <a href="https://twitter.com/usaid_india" target="_blank" style="color: #0396c7; text-decoration: none;">@usaid_india</a>
    </p></span>
                                <button onclick="myFunction()" class="btn" id="myBtn" style="margin-left: 510px">Read more</button>
                            </div>
                            
                        </div>
                    </div>
                </div>




                <!-- </div> -->

                <!----------------------------------------- Partners Section --------------------------------------->
                <div class="row partners-section">
                    <div class="col-lg-12 text-center" style="margin-bottom: 20px;">
                        <h4 class="heading-about" style="font-weight: 600;"> THE CONSORTIUM </h4>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <!-- <img class="partner-logo smaller" src="../images/The-consortium-1-image.png" alt="CEEW Logo" style="max-width: 100px; height: auto; margin-left: 60px;"> -->
                        <a href="https://www.ceew.in" target="_blank" style="text-decoration: none;">
        <img class="partner-logo smaller" src="../images/The-consortium-1-image.png" alt="CEEW Logo" style="max-width: 100px; height: auto; margin-left: 60px;">
    </a>
                        <div class="partner-description" style="margin-top: 20px;">
                            <p class="align" style="color: black; margin-left:60px;">The Council on Energy, Environment and Water is one of Asia’s leading not-for-profit policy research institutions and among the world’s top climate think tanks.<span id="dots1">..</span> <span id="more2"> The Council uses  data, integrated analysis, and strategic outreach to explain -- and change -- the use, reuse, and misuse of resources. The CABH project consortium is led by the Council which is focusing on emissions mitigation, market based approaches and nudge experiments and overall project management.
                            </span></p>
                            <p style="margin-left: 60px;">
                                <a href="https://www.ceew.in" target="_blank" style="color: #0396c7; text-decoration: none;">www.ceew.in</a> | 
                                <a href="https://twitter.com/CEEWIndia" target="_blank" style="color: #0396c7; text-decoration: none;">@CEEWIndia</a>
                            </p>
                            <button onclick="myFunction1()" class="btn" id="myBtn1" style="margin-left: 60px;">Read more</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <img class="partner-logo" src="../images/eds_logo.gif" alt="EDS Logo" style="width: 120px;">
                        <div class="partner-description" style="margin-top: 20px;">
                            <p class="align" style="color: black; margin-right:30px; margin-left:30px;">Environmental Design Solutions (EDS), a sustainability advisory firm focusing on the built environment, has a wide range of experience in the design <span id="dots2">...</span> <span id="more3">, development, and implementation of large-scale programmes both in terms of project investments as well as bundled initiatives for energy efficiency and climate change measures. As a part of the CABH project, EDS is leading the work on improving indoor air quality in built environments, including the development of this real-time indoor air quality dashboard.
                            </span></p>
                            <p style="margin-left: 30px; margin-right: 30px;">
                                <a href="https://www.edsglobal.com" target="_blank" style="color: #0396c7; text-decoration: none;">www.edsglobal.com</a> | 
                                <a href="https://www.linkedin.com/company/environmental-design-solutions/" target="_blank" style="color: #0396c7; text-decoration: none;">@EDS_India</a>
                            </p>
                            <button onclick="myFunction2()" class="btn" id="myBtn2">Read more</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <img class="partner-logo smaller" src="../images/asar.png" alt="ASAR Logo" style="width: 120px; margin-right: 60px;">
                        <div class="partner-description" style="margin-top: 30px;">
                            <p class="align" style="color: black; margin-right:70px;">Asar Social Impact Advisors is a start up in the social and environmental impact space in India. Our focus is the climate challenge and opportunity facing India today.<span id="dots3">..</span> <span id="more4"> Our solutions are predicated on the understanding that the systemic and transformative changes we require can only be catalysed by collaborative problem solving. Asar plays the role of a backbone organisation for the Clean Air Collective, the largest collaborative network of civil society organisations across States in India. 
                            </span></p>
                            <p style="margin-right:70px;">
                            <a href="https://www.asar.co.in" target="_blank" style="color: #0396c7; text-decoration: none;">www.asar.co.in</a> 
                            </p>
                            <button onclick="myFunction3()" class="btn" id="myBtn3" style="margin-right: 60px;">Read more</button>
                        </div>
                    </div>  
                </div>
                
                <!---------------------------------------- Last two partner sections ---------------------------------------->
                <div class="row last-partners-section justify-content-center" style="margin-top: 1px;">
                    <div class="col-lg-4  text-center">
                        <img class="partner-logo" src="../images/The-consortium-4-image.png" alt="Vital Logo" style="width: 140px;">
                        <div class="partner-description">
                            <p class="align" style="color: black; margin-left: 30px; margin-right: 40px; ">Vital Strategies believes every person should be protected by an equitable and effective public health system. We partner with governments, communities <span id="dots4">...</span> <span id="more5"> and organizations around the world to reimagine public health so that health is supported in all the places we live, work and play. The result is millions of people living longer, healthier lives.
                            </span>
                            </p>
                        </div>
                        <p style="margin-left: 30px; margin-right: 40px;"> 
                                <a href="https://vitalstrategies.org" target="_blank" style="color: #0396c7; text-decoration: none;">www.vitalstrategies.org</a> | 
                                <a href="https://twitter.com/VitalStrat" target="_blank" style="color: #0396c7; text-decoration: none;">@VitalStrat</a>
                        </p>
                        <button onclick="myFunction4()" class="btn" id="myBtn4">Read more</button>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img class="partner-logo smaller" src="../images/ELDF Logo_cropped.jpg" alt="ELDF Logo" style="height: 40px;">
                        <div class="partner-description">
                            <p class="align" style="color: black; margin-left: 30px; margin-right: 40px;">Enviro-Legal Defence Firm (ELDF) is India’s first environmental law firm, and has dealt with multiple landmark environmental cases, including on air pollution <span id="dots5">...</span> <span id="more6"> that have shaped the legal discourse  on air quality management across India. ELDF leads the CABH Project consortium as the legal arm and is engaged in  identifying regulatory reforms, and developing a comprehensive legal structure to support pollution control boards.
                             </span></p>
                             <p style="margin-left: 30px; margin-right: 40px;">
                                    <a href="https://www.eldfindia.com" target="_blank" style="color: #0396c7; text-decoration: none;">www.eldfindia.com</a> | 
                                    <a href="https://twitter.com/ELDFINDIA" target="_blank" style="color: #0396c7; text-decoration: none;">@ELDFINDIA</a>
                             </p>
                            <button onclick="myFunction5()" class="btn" id="myBtn5">Read more</button>
                        </div>
                    
                    </div>
                </div><br>

                </div> <!-- Closing the existing row here -->

                <!------------------------- Starting a new row for the Contact section ------------------------------>
                <!-- <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about" style="font-weight: 600;"> CONTACT </h4>
                    </div>
                    <div class="row" style="margin-left:165px; margin-right: 155px; margin-top:10px; Background-color: #D9D9D9; padding-top: 30px;border-radius: 10px;">
                        <div class="col-lg-4 text-center" style="margin-top: 20px; ">
                            <div class="partner-description">
                                <p style="color: black; text-align: left; margin-left:50px;">
                                    <b>Lakshmy Narayankutty</b><br>
                                    Program Manager- Breathein,<br>
                                    Environmental Design Solutions<br>
                                    Private Limited<br>
                                    Phone: 91-11-056-8633<br>
                                    Email: Lakshmy@edsglobal.com
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center" style="margin-top: 20px;">
                            <div class="partner-description">
                                <p style="color: black; text-align: left; margin-left:75px;">
                                    <b>Om Prakash Singh</b><br>
                                    Chief of Party, Cleaner Air and<br>
                                    Better Health Project<br>
                                    Council on Energy, Environment and Water<br>
                                    Phone: 91-11-073-3300<br>
                                    Email: omprakash.singh@ceew.in
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center" style="margin-top: 20px;">
                            <div class="partner-description">
                                <p style="color: black; text-align: left; margin-left:99px; margin-right: 20px;">
                                    <b>Soumitri Das</b><br>
                                    Project Management Specialist<br>
                                    Environment United States Agency for
                                    International Development<br>
                                    #USAID Phone: +91-11-219-8000<br>
                                    Email: sodas@usaid.gov
                                </p>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="container">
    <div class="row text-center mb-4">
        <div class="col-lg-12">
            <h4 class="heading-about" style="font-weight: 600;">CONTACT</h4>
        </div>
    </div>
    <div class="row" style="margin-left: -20px; margin-right: -20px; margin-top: 10px; background-color: #D9D9D9; padding: 30px; border-radius: 10px;">
        <div class="col-lg-4 col-md-6 text-center mb-4">
            <div class="partner-description" style="color: black; text-align: justify; margin: 0 auto;">
                <p  style="color: black">
                    <b>Gurneet Singh</b><br>
                    Director<br>
                    Environmental Design Solutions<br>
                    Private Limited<br>
                    Phone: 91-11-056-8633<br>
                    Email: gurneet@edsglobal.com
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 text-center mb-4">
            <div class="partner-description" style="color: black; text-align: justify; margin: 0 auto;">
                <p  style="color: black">
                    <b>Om Prakash Singh</b><br>
                    Chief of Party, Cleaner Air and<br>
                    Better Health Project<br>
                    Council on Energy, Environment and Water<br>
                    Phone: 91-11-073-3300<br>
                    Email: omprakash.singh@ceew.in
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 text-center mb-4">
            <div class="partner-description" style="color: black; text-align: justify; margin: 0 auto;">
                <p  style="color: black">
                    <b>Soumitri Das</b><br>
                    Team Lead (Environment)<br>
                    United States Agency for
                    International Development<br>
                    Phone: +91-11-219-8000<br>
                    Email: sodas@usaid.gov
                </p>
            </div>
        </div>
    </div>
</div>


                 <!------------------------------------- Starting a new row for the Legal section --------------------------------------->
                 <div class="row" style="margin-top: 30px;">
                    <div class="col-lg-12 text-center">
                        <h4 class="heading-about" style="font-weight: 600;"> Terms of Use agreement </h4>
                    </div>
                    <div class="col-lg-12 text-center" style="margin-top: 20px;">
                        <div class="partner-description">
                            <p style="color: black;  text-align: justify; margin-left: 147px; margin-right: 147px;">
                            This portal has been put out in the public domain with the intent of improving public health. The data herein is intended to advance policies and action towards reducing ambient and household air pollution. By using information on this portal, the user/s agree to:
                               
                            </p>
                            <ul>
                                <li>Acknowledge the intellectual property rights of the authors,</li>
                                <li>Properly attribute the data source in any use or reproduction of the information contained on this portal (refer Suggested Citation), and</li>
                                <li>Non-commercial use of data.</li>
                            </ul>
                            <p style="color: black;  text-align: justify; margin-left: 147px; margin-right: 147px;"><b>Disclaimer</b><br>
                            This portal is made possible by the generous support of the American people through the United States Agency for International Development (USAID). It has been prepared under the Cleaner Air and Better Health (CABH) project [Cooperative Agreement 72038621CA00010]. The contents do not necessarily reflect the views of USAID or the United States Government, or the Council on Energy, Environment and Water (CEEW).</p>
                            <p style="color: black;  text-align: justify; margin-left: 147px; margin-right: 147px;">This dashboard is developed by Environmental Design Solutions Private Limited (EDS). It is a culmination of best efforts of technical experts in the indoor air quality and, data acquisition and monitoring domain. Since data acquisition and monitoring are complex operations susceptible to missing data, hardware failure, and other systemic challenges, there may be unexpected outcomes. By using information from this portal, the user agrees to indemnify, defend, and hold harmless EDS and its partners against any and all claims, losses, damages, liabilities, costs, and expenses (including attorneys’ fees) arising out of or related to,
                            </p>
                            <ul>
                                <li>user’s use of this portal in violation of these legal terms or any applicable law,</li>
                                <li>user’s infringement of any intellectual property or other rights of any third party, or,</li>
                                <li>user’s negligence or wilful misconduct.</li>
                            </ul>

                            <p style="color: black;  text-align: justify; margin-left: 147px; margin-right: 147px;"><b>Acknowledgement</b><br>
                            This portal uses outdoor air quality information from various public sources including (but not limited to) those of Central Pollution Control Board (CPCB), Delhi Pollution Control Committee (DPCC) and others. 
                            </p>
                            <p style="color: black;  text-align: justify; margin-left: 147px; margin-right: 147px;"><b>Suggested Citation</b><br>
                                MLA (9th Edition): Environmental Design Solutions Private Limited [EDS]. IAQ Dashboard. 2024, iaq-dashboard.edsglobal.com. 
                            </p>
                        </div>
                    </div>  
                </div>

            </div>
        </div>
        <!-- .animated -->
    </div>
</div>
<!-- Content -->

    <!-- /.content -->
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
function myFunction4() {
  var dots = document.getElementById("dots4");
  var moreText = document.getElementById("more5");
  var btnText = document.getElementById("myBtn4");

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
function myFunction5() {
  var dots = document.getElementById("dots5");
  var moreText = document.getElementById("more6");
  var btnText = document.getElementById("myBtn5");

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
document.querySelectorAll('.btn').forEach(button => {
      button.addEventListener('click', function() {
        document.querySelectorAll('.btn').forEach(btn => btn.classList.remove('active')); // Remove 'active' from all buttons
        this.classList.add('active'); // Add 'active' to the clicked button
      });
    });
</script>

    <div class="clearfix"></div>
<!-- Footer -->
<?php include 'partials/footer.php' ?>
<!-- /#footer -->