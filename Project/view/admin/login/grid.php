<div class="login-box mx-auto">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>QuestCom</b></a>
    </div>
    <div class="card-body">
      <h2 class="login-box-msg">Login</h2>
      <form action="<?php echo $this->getUrl('loginPost','admin_login') ?>" method="post">
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input type="email" name="admin[email]" class="form-control" placeholder="Email">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" name="admin[password]" class="form-control" placeholder="Password">
        </div>
        <div class="row">
          
          <div class="col-12">
            <input type="submit" class="btn btn-success btn-block" value="Login">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
