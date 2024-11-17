<!-- Modal -->
<div class='modal fade' id='loginModal' tabindex='-1' aria-labelledby='loginModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='loginModalLabel'>Login to Forumify</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>

      <form action="/partials/_loginHandle.php" method="post">
        <div class='modal-body'>
          <div class="mb-3">
            <label for="loginEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="loginPassword">
          </div>
          <button type="submit" class="btn btn-success w-100">Login</button>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        </div>
      </form>

    </div>
  </div>
</div>