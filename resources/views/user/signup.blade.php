@extends('user.layouts.layout')

@section('content')
      <!--Body Content-->
      <div id="page-content">
        <!--Page Title-->
        <div class="page section-header text-center">
          <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Login</h1></div>
          </div>
        </div>
        <!--End Page Title-->

        <div class="container">
          <div class="row">
            <div
              class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3"
            >
              <div class="mb-4">
                <form
                  method="post"
                  action="{{route('signup-user')}}"
                  id="CustomerLoginForm"
                  accept-charset="UTF-8"
                  class="contact-form"
                >
                <?php notifications(); ?>
                @csrf
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <label for="CustomerEmail">Email</label>
                        <input
                          type="email"
                          name="email"
                          placeholder=""
                          id="CustomerEmail"
                          class=""
                          autocorrect="off"
                          autocapitalize="off"
                          autofocus=""
                        />
                      </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <label for="CustomerPassword">Password</label>
                        <input
                          type="password"
                          value=""
                          name="password"
                          placeholder=""
                          id="CustomerPassword"
                          class=""
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div
                      class="text-center col-12 col-sm-12 col-md-12 col-lg-12"
                    >
                      <input type="submit" class="btn mb-3" value="Sign Up" />
                      <p class="mb-4">
                        <a href="{{route('login')}}" id="customer_register_link"
                          >Already have an account?</a
                        >
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--End Body Content-->
@endsection