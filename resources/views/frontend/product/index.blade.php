@extends('layouts.app')

@section('content')
<!--Jumbotron-->
<div class="jumbotron rounded-0">
  <div class="container">
  <div class="row">
    <div class="col-md-12 text-muted text-center">
      <h5 class="mb-3">
        &nbsp;
        <i class="fa fa-credit-card"></i>
        <b>{{ __('PRODUCTS') }}</b>
      </h5>
      <hr>
    </div>
  </div>

    <form action="{{ route('product.index') }}" method="GET">
      <div class="row">
        <div class="col-md-3">
            <select name="category" class="form-control" id="category">
                <option value="">-- {{ __('Select Category') }} --</option>
                @foreach($categories as $category)
                  <option value="{{ $category->name }}" {{ app('request')->input('category') == $category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="word" value="{{ app('request')->input('word') }}" placeholder="{{ __('Search in category') }}" aria-label="Search Product">
        </div>
        <div class="col-md-2">
            <input id="min-price" type="number" value="{{ app('request')->input('min_price') }}" class="form-control" name="min_price" placeholder="{{ __('Min Price') }}" aria-label="Min">
        </div>
        <div class="col-md-2">
            <input id="max-price" type="number" value="{{ app('request')->input('max_price') }}" class="form-control" name="max_price" placeholder="{{ __('Max Price') }}" aria-label="Max">
        </div>
        <div class="col-md-2">
          <input type="submit" value="{{ __('Search') }}" class="btn btn-primary btn-block btn-flat">
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Jumbotron -->

{{-- Grafik product --}}
<div class="container">
    <div class="row" style="margin-top:30px; ">
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>

        {{-- <div class="col-md-12">
            <h2 class="flot"><i class="fa fa-pie-chart" aria-hidden="true"></i></h2>
                <h1>Grafik Product</h1>
                <small class="ash">Data product yang paling sering dilihat</small><br>
            <dl>
            <dt>
                Total Performance
            </dt>
                <dd class="percentage percentage-11"><span class="text">Item 1: 11.33%</span></dd>
                <dd class="percentage percentage-49"><span class="text">Item 2: 49.77%</span></dd>
                <dd class="percentage percentage-16"><span class="text">Item 3: 16.09%</span></dd>
                <dd class="percentage percentage-5"><span class="text">Item 4: 5.41%</span></dd>
                <dd class="percentage percentage-2"><span class="text">Item 5: 1.62%</span></dd>
                <dd class="percentage percentage-2"><span class="text">Item 6: 2%</span></dd>
            </dl>
        </div> --}}
    </div>
</div>

<div class="container wrapper mt-5">
  <div class="row">
      <div class="col-md-12">
        <div class="row">
          @foreach($products as $product)
            <div class="col-md-4 mb-5">
              @include('component.product_thumbnail')
            </div>
          @endforeach
        </div>
      </div>
  </div>
</div>
@stop

@section('script')
<script>
    var data = [];
      @foreach ($viewed as $item)
          data.push({label: '{{ $item->product->name }}', y:{{ $item->total }} })
      @endforeach
    console.log(data);
    window.onload = function () {

        //Better to construct options first and then pass it as a parameter
        var options = {
            animationEnabled: true,
            title: {
                text: "Pencarian Populer"
            },
            axisY:{
                title: "Jumlah Pencarian",
                includeZero: false
            },
            axisX:{
                title: "Nama Barang",
                includeZero: false
            },
            data: [{
                // Change type to "doughnut", "line", "splineArea", etc.
                type: "column",
                dataPoints: data
            }]
        };

        $("#chartContainer").CanvasJSChart(options);
    }
</script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
@endsection
