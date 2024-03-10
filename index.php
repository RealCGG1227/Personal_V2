<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

     <title>Cyril's Personal Website - A Profile HTML Page</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/all.min.css">
     <link rel="stylesheet" href="css/owl.carousel.min.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-ben-resume-style.css">

</head>

<body data-spy="scroll" data-target="#navbarNav" data-offset="50">

<?php
    if(isset($_POST["cf-email"])){
        $Email = $_POST["cf-email"];
        $FirstName = $_POST["cf-name"];
        $Comment = $_POST["cf-message"];

        $errors = array();

        // Validate if all fields are empty
        if ( empty($Email) || empty($FirstName) || empty($Comment)) {
            array_push($errors, "All fields are required");
        }
        // Validate if the email is valid
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Email is not valid");
        }

        // Database connection
        require_once "database.php";

        // Insert user data into the database
        $sql = "INSERT INTO user_comment(comment) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $Comment);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'> Comment Saved! </div>";
        } else {
            echo "<div class='alert alert-danger'>Cannot save comment...</div>";
        }
      
    }
    ?>

    <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="#">
                MainPage
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="#intro" class="nav-link smoothScroll">Introduction</a>
                    </li>

                    <li class="nav-item">
                        <a href="#about" class="nav-link smoothScroll">About Me</a>
                    </li>

                    <li class="nav-item">
                        <a href="#blog" class="nav-link smoothScroll">Blogs</a>
                    </li>

                    <li class="nav-item">
                        <a href="#faq" class="nav-link smoothScroll">FAQ's</a>
                    </li>

                    <li class="nav-item">
                      <a href="#contact" class="nav-link smoothScroll">Contact</a>
                  </li>
                </ul>

                <div class="mt-lg-0 mt-3 mb-4 mb-lg-0">
                    <a class="custom-btn btn" href="Resume/Adolar_Resume.docx" download="Adolar_Resume.docx">Download CV</a>
                    <a class="custom-btn btn" href="logout.php">Log-out</a>
                </div>
            </div>

        </div>
    </nav>


    <!-- HERO -->
    <section class="hero d-flex flex-column justify-content-center align-items-center" id="intro">

         <div class="container">
            <div class="row">

                  <div class="mx-auto col-lg-5 col-md-5 col-10">
                      <img src="images/cy.png" class="img-fluid" alt="Ben Resume HTML Template">
                  </div>

                   <div class="d-flex flex-column justify-content-center align-items-center col-lg-7 col-md-7 col-12">
                        <div class="hero-text">

                            <h1 class="hero-title">👋Hi i'm Cy!, an IT221 Student</h1>

                            <a href="https://discord.gg/fH3ZYeskfK" class="email-link">
                                Join the Wolfy's Corp™
                            </a>
                          
                        </div>
                    </div>

            </div>
        </div>
    </section>


    <section class="about section-padding" id="about">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-12">
                    <h3 class="mb-4">About Me 🫐</h3>
                    <p>Quote: "There's no perfect on anything, and theres no such same thing. Everything is different"</p>

                    <p>A 2nd Year IT Student From NU-FV that knowledgeable enough on Hardware and not much on Software and loves apple devices, also who's behind a fictional charater named Wolfy Blue, Wolfy blue is an Anthromorphic animal also called as Furry.</p>

                    <p>Wolfy formerly known as Wolfy Blue and Blue Wolfy, a White Wolf fictional Anthromorphic animal character created by Cyril Back in 2019</p>

                    <ul class="mt-4 mb-5 mb-lg-0 profile-list list-unstyled">
                        <li><strong>Full Name :</strong> Cyril D. Adolar </li>
                        <li><strong>Email :</strong> cyril.adolar01@gmail.com</li>
                    </ul>
                </div>

                <div class="col-lg-5 mx-auto col-md-6 col-12">
                    <img src="images/cy2.jpg" height="200px" class="about-image img-fluid" alt="Ben's Resume HTML Template">
                </div>

            </div>
            <div class="row about-third">
            	<div class="col-lg-4 col-md-4 col-12">
                <h3>Achievments</h3>
                <p>Most Generous Grade 4 & 5 </p>
                <p>1st Runner Up [Mr. STRS] </p>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                <h3>Skills</h3>
                <p>Troubleshooting Devices</p>
                <p>Gaming</p>
                <p>Driving [4 wheel Vehicle]</p>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                </div>
            </div>
        </div>
    </section>


    <!-- BLOG -->
    <section class="gallery section-padding" id="blog">

    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Gallery</title>
      <style>
        .gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 50px;
    }

    .gallery-item {
        flex: 0 0 calc(33.33% - 20px);
        max-width: calc(33.33% - 20px);
        text-align: center;
    }

    .gallery-item img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    
    .gallery-item:nth-child(3) img {
        max-width: 50%; 
    }

    .description {
        text-align: center;
        margin-top: 20px;
    }
      </style>
    </head>
    <body>
      <div class="description">
        <h3>BLOGS</h3>
        <h6>Photo's From PhiliFUR2023</h6>
      </div>
      <div class="gallery">
        <div class="gallery-item">
          <img src="images/testimonials/furries.jpg" alt="Photo 1">
        </div>
        <div class="gallery-item">
          <img src="images/testimonials/PhiliFUR_log.png" alt="Photo 2">
        </div>
        <div class="gallery-item">
          <img src="images/testimonials/cam.png" alt="Photo 3">
        </div>
        <div class="gallery-item">
          <img src="images/testimonials/proto.jpg" alt="Photo 4">
        </div>
        <div class="gallery-item">
          <img src="images/testimonials/proto2.jpg" alt="Photo 5">
        </div>
        <div class="gallery-item">
          <img src="images/testimonials/stalls.jpg" alt="Photo 6">
        </div>
      </div>
    </body>
    </html>
    
        
 </section>
    


     <!-- FAQ -->
     <section class="faq section-padding" id="faq">
        
        <div class="container">
            
            <div class="row">

                <div class="col-lg-12 col-12">

                    <h3 class="mb-5">Frequently Asked Questions</h3>

                    <div class="accordion" id="accordionExample">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              What is this Personal Website is all about?
                            </button>
                          </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">
                            <p>This "Personal Website" been created, to let other's see what this all about the person (Cyril)</p>
                        
                          </div>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              What is a Furry?
                            </button>
                          </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <div class="card-body">
                            <p>Furry or Furries are the people who are interested in animals that has human qualities. Others created their own Persona or what we call Fursona.</p>
                          </div>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header" id="headingThree">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Who's Wolfy?
                            </button>
                          </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                          <div class="card-body">
                            <p>Wolfy aka Wolfy Blue🫐🐾 is a White fur, Blue-greenish hair with pink nose Wolf that has been Created by Cyril since 2019, a fictional Anthromorphic Animal that also currently living on The Sims 4 World. also a part of a furry community in the Philippines.</p>
                          </div>
                        </div>
                      </div>

                    <div class="card">
                        <div class="card-header" id="headingFour">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              Why i can't See some emojis?
                            </button>
                          </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                          <div class="card-body">
                            <p>Too see some of the Emojis, make sure ur using a latest OS of Windows or MacOS</p>
                          </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingFive">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              Where can i contact Wolfy aka Cyril?
                            </button>
                          </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                          <div class="card-body">
                            <p>You can leave a message through these Social links and put your feedback below ^^.</p>
                          </div>
                        </div>
                    </div>

                </div>

           	 </div><!-- col -->
        	</div><!-- row -->
        </div><!-- container -->
    </section>


   
     <section class="contact section-padding pt-0" id="contact">
      
      <div class="container">
        <div class="row">
           

          <div class="col-lg-6 col-md-6 col-12">
            <form action="index.php" method="POST" class="contact-form webform"  role="form">
              <h6>Feedback</h6>
                <div class="form-group d-flex flex-column-reverse">
                    <input type="text" class="form-control" name="cf-name" id="cf-name" placeholder="Your Name">
                   
                    <label for="cf-name" class="webform-label">Full Name</label>
                </div>

                <div class="form-group d-flex flex-column-reverse">
                    <input type="email" class="form-control" name="cf-email" id="cf-email" placeholder="Your Email">

                    <label for="cf-email" class="webform-label">Your Email</label>
                </div>

                <div class="form-group d-flex flex-column-reverse">
                    <textarea class="form-control" rows="5" name="cf-message" id="cf-message" placeholder="Your Message"></textarea>

                    <label for="cf-message" class="webform-label">Message</label>
                </div>

                <button type="submit" class="form-control" id="submit-button" name="submit">Send</button>
            </form>
          </div>

            <div class="mx-auto col-lg-4 col-md-6 col-12">
                <h3 class="my-4 pt-4 pt-lg-0">Socials</h3>

                <ul class="social-links mt-2">
                    <li><a href="https://facebook.com/WolfyBlu" rel="noopener" class="fab fa-facebook"></a></li>
                    <li><a href="https://twitter.com/Blue_Wulfy" rel="noopener" class="fab fa-x-twitter"></a></li>
                    <li><a href="https://www.instagram.com/cy_adolar/" rel="noopener" class="fab fa-instagram"></a></li>
                    <li><a href="https://www.linkedin.com/in/cyril-adolar-751b75253/" rel="noopener" class="fab fa-linkedin"></a></li>
                    <li><a href="https://steamcommunity.com/id/WolfBlueUwU/" rel="noopener" class="fab fa-steam"></a></li>
                    <li><a href="https://discord.gg/fH3ZYeskfK" rel="noopener" class="fab fa-discord"></a></li>
                </ul>
                
              <p class="copyright-text mt-5 pt-3">© 2024 a Wolfy Corp™. All rights reserved.</p>
                
               
            </div>

        </div>
      </div>
    </section>
     <!-- SCRIPTS -->
     <script src="js/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>