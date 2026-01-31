@php @endphp
@extends('theme')
@section('title', 'Главная')
@section('content')
    <div class="align-items-center" id="user-info">
        <div class="row">
            <div class="col-6">
                <h2>{{ auth()->user()->name }}</h2>
                <p>Моя ссылка: {{ config('app.url') . '/register/' . auth()->user()->referral_link }}</p>
            </div>
            <div class="col-2">
                <div class="balance text-end">
                    <p>Мой баланс</p>
                    <p>{{ auth()->user()->balance }} руб.</p>
                </div>
            </div>
            <div class="col-4">
                <h5>Пополнить баланс</h5>
                <form action="{{ route('balance.deposit') }}" method="post">
                    @csrf

                    <div class="mb-2 d-flex gap-2">
                        <input type="number" name="amount" id="amount" class="form-control"
                               placeholder="Введите пополняемую сумму">
                        @error('amount') <p class="text text-danger">{{ $message }}</p> @enderror
                        <button type="submit" class="btn btn-success">Пополнить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="slots">
        <div class="slots__header">
            <h2>Слоты</h2>
            <p>Доступно для покупки:{{ 3 - $slots->count() }}</p>
            <form action="{{ route('slots.store') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Купить слот</button>
            </form>
        </div>
        <div class="container text-center">
            <div class="row align-items-start gap-4">
                @foreach($slots as $slot)
                    <div class="col slot">
                        {{ $slot?->user->name ?? 'Пустой слот'}}
                    </div>
                @endforeach
            </div>
        </div>
        @error('slot')
        <div class="mt-3 alert alert-danger">{{ $message }}</div> @enderror
    </div>

    <hr/>

    <div class="" id="balance-history">
        <h2>История баланса</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Действие</th>
                <th class="text-end">Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach(auth()->user()->activityLogs as $log)
                <tr>
                    @if($log->balance >= 0)
                        <td class="text text-success">{{ $log->type->label() }}</td>
                        <td class="text text-end text-success">+{{ $log->balance }} ₽</td>
                    @else
                        <td class="text text-danger">{{ $log->type->label() }}</td>
                        <td class="text text-end text-danger">{{ $log->balance }} ₽</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <h2>Мои рефералы</h2>
    @foreach($referrals as $first)
        <div class="referral-tree">
            <details class="referral-tree__item referral-tree__item--level-1">
                <summary class="referral-tree__summary referral-tree__summary--level-1">
                    <span class="referral-tree__name">{{ $first->name }}</span>
                    <span class="referral-tree__count">{{ $first->children->count() }}</span>
                </summary>
                @if($first->children->isNotEmpty())
                    <div class="referral-tree__content">
                        @foreach($first->children as $second)
                            <details class="referral-tree__item referral-tree__item--level-2">
                                <summary class="referral-tree__summary referral-tree__summary--level-2">
                                    <span class="referral-tree__name">{{ $second->name }}</span>
                                    <span class="referral-tree__count">{{ $second->children->count() }}</span>
                                </summary>
                                @if($second->children->isNotEmpty())
                                    <div class="referral-tree__content">
                                        @foreach($second->children as $third)
                                            <div class="referral-tree__item referral-tree__item--level-3">
                                                <div class="referral-tree__summary referral-tree__summary--level-3">
                                                    <span class="referral-tree__name">{{ $third->name }}</span>
                                                    <span
                                                        class="referral-tree__count">{{ $third->children->count() }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </details>
                        @endforeach
                    </div>
                @endif
            </details>
        </div>
    @endforeach
    @if($referrals->isEmpty())
        <h3 class="text-center">Рефералов пока нет</h3>
    @endif
@endsection
