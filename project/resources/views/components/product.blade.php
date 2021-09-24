<div class="products-columns__item">
  <div class="products-columns__item__title-product">
      <a href='{{url("/product/$product->id")}}' class="products-columns__item__title-product__link">{{$product->name}}</a>
  </div>
  <div class="products-columns__item__thumbnail">
      <a href='{{url("/product/$product->id")}}' class="products-columns__item__thumbnail__link">
        <img src='{{asset("img/$product->image")}}' alt="Preview-image" class="products-columns__item__thumbnail__img">
      </a>
  </div>
  <div class="products-columns__item__description">
      <span class="products-price">{{$product->price}}</span>
      <a onclick="showForm(this)" data-id="{{$product->id}}" class="btn btn-blue">Купить</a>
  </div>
</div>