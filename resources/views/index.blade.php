@extends('theme')
@section('title', 'Главная')
@section('content')
    <div class="align-items-center" id="user-info">
        <div class="row">
            <div class="col-6">
                <h1>{{ auth()->user()->name }}</h1>
                <p>Моя ссылка: {{ config('app.url') . '/register/' . auth()->user()->referral_link }}</p>
            </div>
            <div class="col-6">
                <div class="balance">
                    <p>Мой баланс</p>
                    <div class="balance__info row align-items-center">
                        <p class="col-6">{{ auth()->user()->balance }} руб.</p>
                        <button type="submit" class="col-6 btn btn-success">
                            Пополнить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="" id="slots">
        <h2>Слоты</h2>
        <div class="row row-col-3 gap-2">
            <form class="col slot" action="{{ route('slots.store') }}" method="post">
                @csrf
                <button type="submit">Слот 1</button>
            </form >
            <form class="col slot" action="{{ route('slots.store') }}" method="post">
                @csrf
                <h3>Слот 2</h3>
            </form >
            <form class="col slot" action="{{ route('slots.store') }}" method="post">
                @csrf
                <h3>Слот 3</h3>
            </form >
        </div>
    </div>
    <hr />
    <div class="" id="balance-history">
        <h2>История баланса</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Действие</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Пополнение баланса с карты</td>
                <td class="text-success">+1000</td>
            </tr>
            <tr>
                <td>Пополнение баланса с карты</td>
                <td class="text-success">+1000</td>
            </tr>
            <tr>
                <td>Пополнение баланса с карты</td>
                <td class="text-success">+1000</td>
            </tr>
            <tr>
                <td>Покупка слота</td>
                <td class="text-danger">-350</td>
            </tr>
            <tr>
                <td>Начисление от реферала</td>
                <td class="text-success">+150</td>
            </tr>
            <tr>
                <td>Покупка слота</td>
                <td class="text-danger">-350</td>
            </tr>
            <tr>
                <td>Пополнение баланса с карты</td>
                <td class="text-success">+1000</td>
            </tr>
            </tbody>
        </table>
    </div>
    <hr />
    <h2>Пополнить баланс</h2>
    <form action="{{ route('profile.balance') }}" method="post">
        @csrf
        @method('PATCH')
        <input type="number" name="amount" class="form-control" placeholder="Введите пополняемую сумму">
        <button type="submit" class="btn btn-success">Пополнить</button>
    </form>

@endsection
