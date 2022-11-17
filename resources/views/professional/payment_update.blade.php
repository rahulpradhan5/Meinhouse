<head>
    <meta charset="utf-8">
    <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        section.pricing {
    background: #007bff;
    background: linear-gradient(to right, #0062E6, #33AEFF);
  }
  .pricing .card {
    border: none;
    border-radius: 1rem;
    transition: all 0.2s;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
  }
  .pricing hr {
    margin: 1.5rem 0;
  }
  .pricing .card-title {
    margin: 0.5rem 0;
    font-size: 0.9rem;
    letter-spacing: .1rem;
    font-weight: bold;
  }
  .pricing .card-price {
    font-size: 3rem;
    margin: 0;
  }
  .pricing .card-price .period {
    font-size: 0.8rem;
  }
  .pricing ul li {
    margin-bottom: 3rem;
  }
  .pricing .text-muted {
    opacity: 0.7;
  }
  .pricing .btn {
    font-size: 80%;
    border-radius: 5rem;
    letter-spacing: .1rem;
    font-weight: bold;
    padding: 1rem;
    opacity: 0.7;
    transition: all 0.2s;
  }
  /* Hover Effects on Card */
  @media (min-width: 992px) {
    .pricing .card:hover {
      margin-top: -.25rem;
      margin-bottom: .25rem;
      box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
    }
    .pricing .card:hover .btn {
      opacity: 1;
    }
  }
    </style>
  </head>
  <body>
  <section class="pricing py-5">
    <div class="container">
        <h2 class="text-center">Choose Your Package</h2>
      <div class="row" style="margin-top: 65px;">
        <!-- Free Tier -->

        <div class="col-lg-6">
          <div class="card mb-5 mb-lg-0">
            <div class="card-body">

              <h6 class="card-price text-center">Monthly</h6>
              <hr>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Membership monthly charges<span class="period" style="float:right;
      color: #fda12b;font-weight: bold;">$00.00</span></li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Per Additional service charges<span class="period" style="float:right;
      color: #fda12b;font-weight: bold;">$ {{$monthly_amount}}</span></li>
                <hr>
                <li style="list-style-type: none;">Total amount payable<span class="period" style="float:right;font-weight: bold;color: #fda12b;">$ {{$total_monthly}}</span></li>
              </ul>
              <form action="{{route('payment.update.make')}}" method="POST" name="pay">
                  @csrf
                  <input type="hidden" name="amount" id="amount" value="{{$total_yearly}}">
                  <input type="hidden" name="id" id="id" value="{{$pro_detail_id}}">
                  <button type="submit" class="btn btn-block btn-primary text-uppercase">Pay Now</button>
              </form>
            </div>
          </div>
        </div>
        <!-- Plus Tier -->
        <div class="col-lg-6">
          <div class="card mb-5 mb-lg-0">
            <div class="card-body">
              <!--<h5 class="card-title text-muted text-uppercase text-center">Plus</h5>-->
              <h6 class="card-price text-center">Yearly</h6>
              <hr>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Membership yearly charges<span class="period" style="float:right;
      color: #fda12b;font-weight: bold;">$00.00</span></li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Per Additional service charges<span class="period" style="float:right;
      color: #fda12b;font-weight: bold;">$ {{$yearly_amount}}</span></li>
                <hr>
                <li style="list-style-type: none;">Total amount payable<span class="period" style="float:right;font-weight: bold;color: #fda12b;">$ {{$total_yearly}}</span></li>
              </ul>
              <form action="{{route('payment.update.make')}}" method="POST" name="pay">
                  @csrf
                  <input type="hidden" name="amount" id="amount" value="{{$total_yearly}}">
                  <input type="hidden" name="id" id="id" value="{{$pro_detail_id}}">
                  <button type="submit" class="btn btn-block btn-primary text-uppercase">Pay Now</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </body>
