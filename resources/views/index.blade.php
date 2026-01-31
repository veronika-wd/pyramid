@php use App\Enums\LogTypeEnum; @endphp
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

                    <div class="mb-2 d-flex justify-content-between align-items-start gap-2">
                        <div class="w-100">
                            <input type="number" name="amount" id="amount" class="form-control"
                                   placeholder="Введите пополняемую сумму">
                            @error('amount') <p class="text text-danger">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Пополнить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="slots">
        <div class="slots__header">
            <h2>Слоты</h2>
            <p>Доступно для покупки: {{ 3 - $slots->count() }}</p>
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

    <div id="balance-history">
        <h2>История баланса</h2>

        <form class="w-50 my-3 d-flex gap-2">
            <select name="type" id="type" class="form-select">
                <option value="" hidden>Все</option>
                @foreach(LogTypeEnum::cases() as $type)
                    <option value="{{ $type }}" {{ request()->get('type') === $type->value ? 'selected' : '' }}>
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-success">Найти</button>
            <a href="{{ url()->current() }}" class="btn btn-danger">Сбросить</a>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th>Действие</th>
                <th class="text-end">Сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activityLogs as $activityLog)
                <tr>
                    @if($activityLog->balance >= 0)
                        <td class="text text-success">{{ $activityLog->type->label() }}</td>
                        <td class="text text-end text-success">+{{ $activityLog->balance }} ₽</td>
                    @else
                        <td class="text text-danger">{{ $activityLog->type->label() }}</td>
                        <td class="text text-end text-danger">{{ $activityLog->balance }} ₽</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <h2>Мои рефералы</h2>
    @if($referrals->isNotEmpty())
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
    @else
        <h3 class="text-center">Рефералов пока нет</h3>
    @endif
@endsection
