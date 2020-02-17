<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบบริหารจัดการเว็บไซต์ | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    
    <!-- Smoke -->
    <link rel="stylesheet" href="bootstrap/css/smoke.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../"><b> <img src="dist/img/en.jpg"   alt="en"   height="130" width="130" > </b></a>
      </div>
     
    
      
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">เข้าสู่ระบบบริหารจัดการโรงงานขยะ</p>
        <form id="form1" method="post">
          <div class="form-group has-feedback">
              <input id="userName" type="text" class="form-control" placeholder="Username"  name="userName" smk-text="กรุณากรอก userName" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input input type="password" class="form-control" placeholder="Password" name="userPassword" smk-text="กรุณากรอก Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-6">
                <a href="../" class="btn btn-default btn-block btn-flat">กลับหน้าเว็บไซต์</a>
            </div><!-- /.col -->
             <div class="col-xs-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าระบบ</button>
            </div><!-- /.col -->
          </div>
        </form>

       
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <script src="bootstrap/js/smoke.min.js"></script>
    
    <script>
       $(document).ready(function(){
           
        $("#userName").focus();
        
        $('#form1').on("submit",function(e) {
          
             if ($('#form1').smkValidate()) {

              $.ajax({
                url: 'login_go.php',
                method: "POST",
                data: $("#form1").serialize(),
                dataType: "JSON",
                success: function(data) {
                    
                    console.log(data);
                    if (data.status === "danger") {
                                        $.smkAlert({text: data.message , type: data.status});
                                        $('#form1').smkClear();
                                        $("#userName").focus();
                                    } else if(data.status === "success") {
                                        $(location).attr('href', 'index.php'); 
                                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
            })
              
                 /* $.post("login_go.php", $("#form1").serialize() )
                                .done(function( data ) {
                                  console.log(data.status);
                                    if (data.status === "danger") {
                                        $.smkAlert({text: data.message , type: data.status});
                                        $('#form1').smkClear();
                                        $("#userName").focus();
                                    } else if(data.status === "success") {
                                        $(location).attr('href', 'index.php'); 
                                    }
                                });  */                      
                  e.preventDefault();
             }
             e.preventDefault();
        });
        
      });
    </script>
  </body>
</html>
