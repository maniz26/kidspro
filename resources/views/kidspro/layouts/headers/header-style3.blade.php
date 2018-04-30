<header id="header" class="header">
  <div class="header-top bg-theme-colored sm-text-center p-0">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="widget no-border m-0">
            <ul class="list-inline font-13 sm-text-center mt-5">
              <li>
                <a class="text-white" href="#">FAQ</a>
              </li>
              <li class="text-white">|</li>
              <li>
                <a class="text-white" href="#">Help Desk</a>
              </li>
              <li class="text-white">|</li>
              <li>
                <a class="text-white" href="#">Login</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-8">
          <div class="widget m-0 pull-right sm-pull-none sm-text-center">
            <ul class="list-inline pull-right">
              <li class="mb-0 pb-0">
                <div class="top-dropdown-outer pt-5 pb-10">
                  <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i class="fa fa-shopping-cart font-13"></i> (12)</a>
                  <ul class="dropdown">
                    <li>
                      <!-- dropdown cart -->
                      <div class="dropdown-cart">
                        <table class="table cart-table-list table-responsive">
                          <tbody>
                          <tr>
                            <td><a href="#"><img alt="" src="http://placehold.it/85x85"></a></td>
                            <td><a href="#"> Product Title</a></td>
                            <td>X3</td>
                            <td>$ 100.00</td>
                            <td><a class="close" href="#"><i class="fa fa-close font-13"></i></a></td>
                          </tr>
                          <tr>
                            <td><a href="#"><img alt="" src="http://placehold.it/85x85"></a></td>
                            <td><a href="#"> Product Title</a></td>
                            <td>X2</td>
                            <td>$ 70.00</td>
                            <td><a class="close" href="#"><i class="fa fa-close font-13"></i></a></td>
                          </tr>
                          </tbody>
                        </table>
                        <div class="total-cart text-right">
                          <table class="table table-responsive">
                            <tbody>
                            <tr>
                              <td>Cart Subtotal</td>
                              <td>$170.00</td>
                            </tr>
                            <tr>
                              <td>Shipping and Handling</td>
                              <td>$20.00</td>
                            </tr>
                            <tr>
                              <td>Order Total</td>
                              <td>$190.00</td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="cart-btn text-right">
                          <a class="btn btn-theme-colored btn-xs" href="shop-cart.html"> View cart</a>
                          <a class="btn btn-dark btn-xs" href="shop-checkout.html"> Checkout</a>
                        </div>
                      </div>
                      <!-- dropdown cart ends -->
                    </li>
                  </ul>
                </div>
              </li>
              <li class="mb-0 pb-0">
                <div class="top-dropdown-outer pt-5 pb-10">
                  <a class="top-search-box has-dropdown text-white text-hover-theme-colored"><i class="fa fa-search font-13"></i> &nbsp;</a>
                  <ul class="dropdown">
                    <li>
                      <div class="search-form-wrapper">
                        <form method="get" class="mt-10">
                          <input type="text" onfocus="if(this.value =='Enter your search') { this.value = ''; }" onblur="if(this.value == '') { this.value ='Enter your search'; }" value="Enter your search" id="searchinput" name="s" class="">
                          <label><input type="submit" name="submit" value=""></label>
                        </form>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
          <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
            <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
              <li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus text-white"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-nav">
    <div class="header-nav-wrapper navbar-scrolltofixed bg-lightest">
      <div class="container">
        <nav id="menuzord-right" class="menuzord">
          <a class="menuzord-brand pull-left flip mt-5" href="javascript:void(0)">
            <img src="/kidspro/images/logo-wide.png" alt="">
          </a>
          <ul class="menuzord-menu dark">
            <!-- Main Nav -->
            {!! Packagebridge::position('position-1',$params) !!}
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>