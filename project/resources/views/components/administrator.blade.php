<style>
    .admin{
        display: flex;
    }
    .admin__section{
        width: 33%;
    }
    .list{
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .list__item{
        list-style: none;
    }
    .form{
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
        width: fit-content;
    }
    .add-form{
        margin-bottom: 20px;
    }

    button{
        align-self: flex-end;
    }

    textarea{
        resize: none;
        height: 100px;
    }
</style>

<div class="admin">
    <div class="admin__section">
        <h2>Categories</h2>
        <form method="POST" class="form add-form" action="{{url('/home/addCat')}}">
            @csrf
            <input type="text" name="name" placeholder="name category"/>
            <textarea name="desc" placeholder="description"></textarea>
            <button type="submit">Add</button>
        </form>
        <ul class="list">
            @foreach($categories as $category)
                <li class="list__item">
                    <form class="form upd-form" method="POST" action='{{url("/home/updateCat/$category->id")}}'>
                        @csrf
                        <input type="text" name="name" value="{{$category->name}}">
                        <textarea type="text" name="desc">{{$category->description}}</textarea>
                        <button type="submit">Save</button>
                    </form>
                    <a href='{{url("/home/deleteCat/$category->id")}}'>Удалить</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="admin__section">
        <h2>Products</h2>
        <form method="POST" class="form add-form" enctype="multipart/form-data" action="{{url('/home/addProd')}}">
            @csrf
            <input type="text" name="name" placeholder="name">
                <input type="text" name="price" placeholder="price">
                <select name="cat">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                </select>
                <textarea type="text" name="desc" placeholder="description"></textarea>
            <div>
                <input type="file" name="file" accept="image/png, image/gif, image/jpeg">
                <button type="submit">Add</button>
            </div>
        </form>
        <ul class="list">
            @foreach($products as $product)
                <li class="list__item">
                    <form class="form upd-form" method="POST" enctype="multipart/form-data" action='{{url("/home/updateProd/$product->id")}}'>
                        @csrf
                        <input type="text" name="name" placeholder="name" value="{{$product->name}}">
                        <input type="text" name="price" placeholder="price" value="{{$product->price}}">
                        <select name="cat">
                            @foreach ($categories as $category)
                                @if ($category->id === $product->category)
                                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                                @else 
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <textarea type="text" name="desc">{{$product->description}}</textarea>
                        <div>
                            <input type="file" name="file" accept="image/png, image/gif, image/jpeg">
                            <button type="submit">Save</button>
                        </div>
                    </form>
                    <a href='{{url("/home/deleteProd/$product->id")}}'>Удалить</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="admin__section">
        <h2>Orders</h2>
        <form method="POST" class="form add-form" action="{{url('/home/changeMail')}}">
            @csrf
            <input placeholder="orders mail" value="{{$mail}}" name="email" type="text">
            <button type="submit">Save</button>
        </form>
        @if(count($orders) > 0)
        <table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Product</th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <th>{{$order->id}}</th>
                <th>{{$order->email}}</th>
                <th>{{DB::table('products')->where('id', $order->product)->first()->name}}</th>
            </tr>
            @endforeach
        </table>
        @endif
    </div>
</div>