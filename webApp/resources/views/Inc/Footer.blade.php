<!--Copyright Section-->
    <section id="copyright-section" class="py-3 text-center text-light">
        <div class="container">
          <div class="row">
            <div class="col">
              <p class="lead mb-0">Copyright <?php echo date('Y'); ?> &copy; by Shak Ziaur Rahman Tito</p>
            </div>
          </div>
        </div>
    </section>

    <?php

        use App\Models\User;
        if (Session::get('s_user_id')) {
          $userheaderid = Session::get('s_user_id');
        }else if(Cookie::get('c_user_id')){
          $userheaderid = Cookie::get('c_user_id');
        }

        $userheader = User::where("id", $userheaderid)->first();
        if ($userheader['status'] == 0) {
          if (Cookie::get('cookie_login') == 1) {
            Cookie::queue('cookie_login',"",-60);
            Cookie::queue('c_user_id',"",-60);
            return redirect("/login");
          }else if(Session::get('session_login') == 1){
              Session::forget('session_login');
              Session::forget('s_user_id');
              return redirect("/login");
          }

        }

    ?>
  </body>
</html>