<?php include "commun/head.php" ?>
<?php include "commun/header.php" ?>


<div class="row d-flex justify-content-center">
  <div class="col-6 ">
    <div class="col-auto">
      <label for="inputPassword6" class="col-form-label">Password</label>
    </div>
    <div class="col-auto">
      <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
    </div>
    <div class="col-auto ">
      <span id="passwordHelpInline" class="form-text ">
        Must be 8-20 characters long.
      </span>
    </div>

    <div>
      <button class="btn btn-primary mt-3 " type="submit">Submit form</button>
    </div>
  </div>
</div>
<?php include "commun/footer.php" ?>