<style>
    .popup{
        position: fixed;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 20;
        display: none;
    }

    .popup__form{
        background: #d0e26c;
        opacity: 1;
        position: relative;
        display: flex;
        flex-direction: column;
        padding: 20px;
        gap: 20px;
        justify-content: center;
        align-items: center;
        z-index: 30;
        height: 400px;
        width: 400px;
        border-radius: 5px;
        box-shadow: 0 0 6px black;
    }
</style>

<a onclick="closeForm();" id="popup" class="popup">
    <form onclick="event.stopPropagation()" id="popupForm" class="popup__form" method="POST" action="">
        @csrf
        <div style="text-align:center;">Нажмите подтвердить и укажите адрес email,<br> вскоре с вами свяжуться для покупки</div>
        <input type="email" name="email" value="{{$auth->email ?? ''}}">
        <button type="submit">Подтвердить</button>
    </form>
</a>