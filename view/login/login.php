<div class="container">

        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="../assets/img/user.png" />
            <p id="profile-name" class="profile-name-card"></p>

            <form class="form-signin"  method="post" action="?c=Login&a=IniciarSesion" enctype="multipart/form-data">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Clave" required>
                <div id="remember" class="checkbox">
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Iniciar Sesion</button>
            </form><!-- /form -->
        </div>
