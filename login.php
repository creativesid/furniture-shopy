<?php 
require('top.php');
if(isset($_SESSION['USER_LOGIN'])){
  ?>
  <script>
    window.location.href = 'index.php'
  </script>
  <?php
}
?>

<section class="htc__contact__area ptb--100 bg__white">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="contact-form-wrap mt--60">
          <div class="col-xs-12">
            <div class="contact-title">
              <h2 class="title__line--6">Login</h2>
            </div>
          </div>
          <div class="col-xs-12">
            <form id="contact-form" method="post">
              <div class="single-contact-form">
                <div class="contact-box name">
                  <input
                    type="text"
                    name="l_email"
                    id="l_email"
                    placeholder="Your email*"
                    style="width: 100%"
                  />
                </div>
              </div>
              <div class="single-contact-form">
                <div class="contact-box name">
                  <input
                    type="text"
                    name="l_password"
                    id="l_password"
                    placeholder="Your Password*"
                    style="width: 100%"
                  />
                </div>
              </div>

              <div class="contact-btn">
                <button type="button" onclick="login()" class="fv-btn">Login</button>
              </div>
            </form>
            <div class="form-output">
            <h2 class="form-messege text-danger" id="l_form-messege"></h2>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="contact-form-wrap mt--60">
          <div class="col-xs-12">
            <div class="contact-title">
              <h2 class="title__line--6">Register</h2>
            </div>
          </div>
          <div class="col-xs-12">
            <form id="contact-form" action="#" method="post">
              <div class="single-contact-form">
                <div class="contact-box name">
                  <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Your Name*"
                    style="width: 100%"
                  />
                </div>
              </div>
              <div class="single-contact-form">
                <div class="contact-box name">
                  <input
                    type="text"
                    name="email"
                    id="email"
                    placeholder="Your Email*"
                    style="width: 100%"
                  />
                </div>
              </div>
              <div class="single-contact-form">
                <div class="contact-box name">
                  <input
                    type="text"
                    name="mobile"
                    id="mobile"
                    placeholder="Your Mobile*"
                    style="width: 100%"
                  />
                </div>
              </div>
              <div class="single-contact-form">
                <div class="contact-box name">
                  <input
                    type="text"
                    name="password"
                    id="password"
                    placeholder="Your Password*"
                    style="width: 100%"
                  />
                </div>
              </div>

              <div class="contact-btn">
                <button type="button" onclick="register()" class="fv-btn">Register</button>
              </div>
            </form>
            <div class="form-output">
              <h2 class="form-messege text-danger" id="form-messege"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php require('footer.php')?>