<!-- Page Header -->
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Djillali TIGUERCHA</h1>
                    <span class="subheading">En mode apprentissage intensif</span>
                </div>
            </div>
        </div>
    </div>
</header>



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            <form action="" method="post" name="sentMessage" id="contactForm" novalidate>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>UserName</label>
                        <input type="text" name = "login" class="form-control" placeholder="userName" id="userName" required data-validation-required-message="Please enter your userName.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>UserName</label>
                        <input type="text" name = "password" class="form-control" placeholder="password" id="password" required data-validation-required-message="Please enter your pass.">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>


                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Connexion</button>
                </div>
            </form>


        </div>
    </div>
</div>