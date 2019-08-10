<style>
  .form-boundary{
    position: relative;
    width: 40%;
    top: 50px;
    border-radius: 10px;
    padding-top: 4%; 
  }
</style>

<div class="container panel panel-default form-boundary">
  <form class="form-horizontal" method="POST" action="Login">
    <div class="form-group">
      <label class="control-label col-md-2 col-md-offset-2" for="userName">帳號</label>
      <div class="col-md-6">
        <input type="text" class="form-control" id="userName" name="account" placeholder="請輸入帳號">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2 col-md-offset-2" for="pwd">密碼</label>
      <div class="col-md-6"> 
        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="請輸入密碼">
      </div>
    </div>
    <div class="form-group"> 
      <div class="col-md-offset-8 col-md-2">
        <button type="submit" class="btn btn-primary">確認</button>
      </div>
    </div>
  </form>
</div>
