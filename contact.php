<?php require "structure/header.php" ?>

<script language="javascript">
    document.title = "Contact";
</script>

<!-- Wrapper container -->
<div class="container py-4" style="width: 75%;">

  <!-- Bootstrap 5 starter form -->
  <form id="contactForm">

    <!-- Name input -->
    <div class="mb-3">
      <label class="form-label" for="nom"><strong>Nom</strong></label>
      <input class="form-control" id="nom" type="text" placeholder="Nom" data-sb-validations="exige" />
      <div class="invalid-feedback" data-sb-feedback="nom:exige">Nom est exige.</div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="prenom"><strong>Prenom</strong></label>
      <input class="form-control" id="prenom" type="text" placeholder="Prenom" data-sb-validations="exige" />
      <div class="invalid-feedback" data-sb-feedback="prenom:exige">Prenom est exige.</div>
    </div>
    
    <!-- Email address input -->
    <div class="mb-3">
      <label class="form-label" for="emailAddress"><strong>Email Address</strong></label>
      <input class="form-control" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="exige, email" />
      <div class="invalid-feedback" data-sb-feedback="emailAddress:exige">Email Address est exige.</div>
      <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email n'est pas valide.</div>
    </div>

    <!-- Message input -->
    <div class="mb-3">
      <label class="form-label" for="message"><strong>Message</strong></label>
      <textarea class="form-control" maxlength="300" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="exige"></textarea>
      <div class="invalid-feedback" data-sb-feedback="message:exige">Message est exige.</div>
    </div>

    <!-- Form submissions success message -->
    <div class="d-none" id="submitSuccessMessage">
      <div class="text-center mb-3">Transmission réussie!</div>
    </div>

    <!-- Affichage message erreur  -->
    <div class="d-none" id="submitErrorMessage">
      <div class="text-center text-danger mb-3">Erreur d'envoi de message!</div>
    </div>

    <!-- Form submit button -->
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Envoi</button>
    </div>

  </form>

</div>


<?php require "structure/footer.php" ?>
