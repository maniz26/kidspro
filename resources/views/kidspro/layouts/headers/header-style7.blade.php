<!-- Header -->
<header id="header" class="header">
  <div class="header-top p-0 bg-theme-color-blue xs-text-center">
    <div class="container pt-0 pb-0">
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="widget no-border sm-pull-none sm-text-center mt-10 mb-10 m-0">
            <ul class="list-inline">
              <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>
              <li>
                <a href="#" class="font-12 text-white text-uppercase">Call us today!</a>
                <h5 class="font-14 text-white m-0"> +(012) 345 6789</h5>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="widget no-border sm-pull-none sm-text-center mt-10 mb-10 m-0">
            <ul class="list-inline">
              <li><i class="fa fa-clock-o text-theme-colored font-36 mt-5 sm-display-block"></i></li>
              <li>
                <a href="#" class="font-12 text-white text-uppercase">We are open!</a>
                <h5 class="font-13 text-white m-0"> Mon-Fri 8:00-16:00</h5>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4 col-md-4">
          <div class="widget no-border m-0">
            <div class="search-form-wrapper">
              <form id="searchform" class="mt-10" method="get">
                <input class="" type="text" name="s" id="searchinput" value="Enter your search" onblur="if(this.value == '') { this.value ='Enter your search'; }" onfocus="if(this.value =='Enter your search') { this.value = ''; }"  >
                <label>
                  <input type="submit" value="" name="submit">
                </label>
              </form>
            </div>
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