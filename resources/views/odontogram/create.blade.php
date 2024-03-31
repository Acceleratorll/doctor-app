@extends('layouts.main')

@section('header')
<h1 class="m-0">
    ODONTOGRAM
</h1>
@endsection

@section('container')
<div class="container">
    <div id="rcorners1">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif($message =  Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @endif
        <form action="{{ route('admin.reservation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @foreach ($teeths as $teeth)
                <div class="col-md-3">
                    <div class="select-btn {{ $teeth->fdi }}">
                        <span class="btn-text" data-original-text="{{ $teeth->fdi }}">{{ $teeth->fdi }}</span>
                        <span class="arrow-dwn">
                            <i class="fa-solid fa-chevron-down"></i>
                        </span>
                    </div>
                    <ul class="list-items">
                        @foreach ($symbols as $symbol)
                        <li class="item">
                            <span class="checkbox">
                                <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text">{{ $symbol->short }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </form>
    </div>
</div>

@section('css')    
    <style>
        .select-btn{
            display: flex;
            height: 50px;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            margin-bottom: 5px;
            border-radius: 8px;
            cursor: pointer;
            background-color: #343a40;
            box-shadow: 0 1px 1px #6c757d;
        }
        .select-btn .btn-text{
            font-size: 17px;
            font-weight: 400;
            color: #fff;
        }
        .select-btn .arrow-dwn{
            display: flex;
            height: 21px;
            width: 21px;
            color: #fff;
            font-size: 14px;
            border-radius: 50%;
            background: #6e93f7;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .select-btn.open .arrow-dwn{
            transform: rotate(-180deg);
        }
        .list-items{
            position: relative;
            margin-top: 15px;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            display: none;
            flex-wrap: wrap;
            justify-content: center;
        }
        .item {
            margin: 10px; /* Adjust spacing between items */
            text-align: center; /* Center text */
        }
        .select-btn.open ~ .list-items{
            display: block;
        }
        .list-items .item{
            display: flex;
            align-items: center;
            list-style: none;
            height: 50px;
            cursor: pointer;
            transition: 0.3s;
            padding: 0 15px;
            border-radius: 8px;
        }
        .list-items .item:hover{
            background-color: #434549;
        }
        .item .item-text{
            font-size: 16px;
            font-weight: 400;
            color: #ffffff;
        }
        .item .checkbox{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 16px;
            width: 16px;
            border-radius: 4px;
            margin-right: 12px;
            border: 1.5px solid #c0c0c0;
            transition: all 0.3s ease-in-out;
        }
        .item.checked .checkbox{
            background-color: #4070f4;
            border-color: #4070f4;
        }
        .checkbox .check-icon{
            color: #fff;
            font-size: 11px;
            transform: scale(0);
            transition: all 0.2s ease-in-out;
        }
        .item.checked .check-icon{
            transform: scale(1);
        }
    </style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#sidebarcollapse').on('click',function(){
            $('#sidebar').toggleClass('active');
        });

        $('.s2').select2();
        $('.select-box').select2();
    });

    document.addEventListener("DOMContentLoaded", function() {
        const selectBtns = document.querySelectorAll(".select-btn");

        selectBtns.forEach(selectBtn => {
            const items = selectBtn.nextElementSibling.querySelectorAll(".item");
            const originalText = selectBtn.querySelector(".btn-text").innerText;

            selectBtn.addEventListener("click", () => {
                selectBtn.classList.toggle("open");
                const listItems = selectBtn.nextElementSibling;
                listItems.style.display = listItems.style.display === 'flex' ? 'none' : 'flex';
            });

            items.forEach(item => {
                const itemsContainer = selectBtn.nextElementSibling;
                const itemText = item.querySelector(".item-text").innerText;

                item.addEventListener("click", () => {
                    item.classList.toggle("checked");
                    updateSelectedText(selectBtn, originalText);
                    rearrangeItems(itemsContainer);
                });
            });
        });
    });

    function rearrangeItems(container) {
        const items = Array.from(container.querySelectorAll(".item"));
        const checkedItems = items.filter(item => item.classList.contains("checked"));
        const uncheckedItems = items.filter(item => !item.classList.contains("checked"));

        container.innerHTML = '';
        checkedItems.forEach(item => container.appendChild(item));
        uncheckedItems.forEach(item => container.appendChild(item));
    }

    function updateSelectedText(selectBtn, originalText) {
        const checkedItems = selectBtn.nextElementSibling.querySelectorAll(".checked");
        const selectedText = Array.from(checkedItems).map(item => item.querySelector('.item-text').innerText).join(', ');
        const btnText = selectBtn.querySelector(".btn-text");

        if (checkedItems.length > 0) {
            btnText.innerText = `${originalText} | ${selectedText}`;
        } else {
            btnText.innerText = originalText;
        }
    }
    
    var dropdown = document.getElementsByClassName("dropdown-btn");
    for (var i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            } else {
            dropdownContent.style.display = "block";
            }
        });
    }
</script>
@endsection
@endsection
