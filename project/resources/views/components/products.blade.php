<div class="content-main__container">
    <div class="products-columns">
      @foreach ($products as $product)
        <x-product :product="$product"/>
      @endforeach
    </div>
</div>