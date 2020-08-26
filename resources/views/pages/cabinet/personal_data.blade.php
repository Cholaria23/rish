<!-- <div class="tab-pane" id="tab_personal_data"> -->
    <div class="tab-pane-flex" id="tab_personal_data">
        <div class="tab-pane-item personal_block">
            <h2 class="title-tab-cabinet blue-title mobile-title">@lang('cabinet.tab_menu.personal_data')</h2>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <span class="item-caption">@lang('cabinet.personal_data.gender')</span>
                </div>
                <div>
                    <div class="radio" style="margin-top: 0;">
                        <input id="m" type="radio" class='hide input-hidden user_radio' name="gender" data-field='gender' value='m' {{ ($user->gender == 'm') ? 'checked' : '' }} />
                        <label for="m" class="radio-label">
                            @lang('cabinet.personal_data.man')
                        </label>
                    </div>
                    <div class="radio">
                        <input id="w" type="radio" class='hide input-hidden user_radio' name="gender" data-field='gender' value='w' {{ ($user->gender == 'w') ? 'checked' : '' }}/>
                        <label for="w" class="radio-label">
                            @lang('cabinet.personal_data.woman')
                        </label>
                    </div>
                </div>
            </div>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <span class="item-caption">@lang('cabinet.personal_data.last_name')</span>
                </div>
                <div>
                    <a class="editable" title="Редактировать личные данные" data-field="last_name" data-emptytext="@lang('cabinet.personal_data.last_name')" href="">{{ $user->last_name }}</a>
                    <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <span class="item-caption">@lang('cabinet.personal_data.first_name')</span>
                </div>
                <div>
                    <a class="editable" title="Редактировать личные данные" data-field="first_name" data-emptytext="@lang('cabinet.personal_data.first_name')" href="">{{ $user->first_name }}</a>
                    <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <span class="item-caption">@lang('cabinet.personal_data.father_name')</span>
                </div>
                <div>
                    <a class="editable" title="Редактировать личные данные" data-field="father_name" data-emptytext="@lang('cabinet.personal_data.father_name')" href="">{{ $user->father_name }}</a>
                    <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <span class="item-caption">@lang('cabinet.personal_data.email')</span>
                </div>
                <div>
                    <a class="editable" title="Редактировать личные данные" data-field="email" data-emptytext="Email)" href="">{{ $user->email }}</a>
                    <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <span class="item-caption">@lang('cabinet.personal_data.phones')</span>
                </div>
                <div>
                    <div class="flex">
                        <a href='#' class='editable phone-editable' data-field='phone_1' data-emptytext="@lang('cabinet.personal_data.phone')" >{{ $user->phone_1 }}</a>
                        <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                    </div>
                    <div class="flex">
                        <a href='#' class='editable phone-editable' data-field='phone_2' data-emptytext="@lang('cabinet.personal_data.phone')" >{{ $user->phone_2 }}</a>
                        <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                    </div>
                </div>
            </div>
      <!-- Адрес доставки -->
      <!-- <p style="font-size: 20px; font-weight: normal;" class='title ttile-border'>@lang('cabinet.personal_data.my_delivery_address')</p>
        <div class="personal_block-row" style='margin-bottom: 20px;'>
            <div class='row-title'>
                <span class="item-caption">@lang('cabinet.personal_data.city')</span>
            </div>
            <div class='flex'>
              <a class="editable" title="Редактировать личные данные" data-field="city" data-emptytext="@lang('cabinet.personal_data.city')" href="">{{ $user->city }}</a>
              <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
            </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 20px;'>
            <div class='row-title'>
                <span class="item-caption">@lang('cabinet.personal_data.street')</span>
            </div>
            <div class='flex'>
                <a class="editable" title="Редактировать личные данные" data-field="street" data-emptytext="@lang('cabinet.personal_data.street')" href="">{{ $user->street }}</a>
                <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
            </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 20px;'>
            <div class='row-title'>
                <span class="item-caption">@lang('cabinet.personal_data.building')</span>
            </div>
            <div class='flex'>
                <a class="editable" title="Редактировать личные данные" data-field="building" data-emptytext="@lang('cabinet.personal_data.building')" href="">{{ $user->building }}</a>
                <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
            </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 20px;'>
            <div class='row-title'>
                <span class="item-caption">@lang('cabinet.personal_data.room')</span>
            </div>
            <div class='flex'>
                <a class="editable" title="Редактировать личные данные" data-field="room" data-emptytext="@lang('cabinet.personal_data.room')" href="">{{ $user->room }}</a>
                <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
            </div>
        </div>
        <div class='light_line'></div> -->
        <!-- Адрес доставки -->
        <!-- Альтернативный адрес доставки -->
        <!-- <p style="font-size: 20px; font-weight: normal;" class='title ttile-border'>@lang('cabinet.personal_data.my_delivery_address_alternative')</p>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <b>@lang('cabinet.personal_data.city')</b>
                </div>
                <div class='flex'>
                    <a class="editable" title="Редактировать личные данные" data-field="city_1" data-emptytext="@lang('cabinet.personal_data.city')" href="">{{ $user->city_1 }}</a>
                    <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <b>@lang('cabinet.personal_data.street')</b>
                </div>
                <div class='flex'>
                    <a class="editable" title="Редактировать личные данные" data-field="street" data-emptytext="@lang('cabinet.personal_data.street')" href="">{{ $user->street }}</a>
                    <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <b>@lang('cabinet.personal_data.building')</b>
                </div>
                <div class='flex'>
                    <a class="editable" title="Редактировать личные данные" data-field="building" data-emptytext="@lang('cabinet.personal_data.building')" href="">{{ $user->building }}</a>
                    <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
            <div class="personal_block-row" style='margin-bottom: 20px;'>
                <div class='row-title'>
                    <b>@lang('cabinet.personal_data.room')</b>
                </div>
                <div class='flex'>
                    <a class="editable" title="Редактировать личные данные" data-field="room" data-emptytext="@lang('cabinet.personal_data.room')" href="">{{ $user->room }}</a>
                    <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div> -->
            <!-- Альтернативный адрес доставки -->
            <!-- Данные организации  -->
            <!-- <div class="personal_block-row" style='margin-bottom: 10px;'>
                <div class='row-title'>
                    <b>@lang('main.entity.entity_name')</b>
                </div>
                <div class='flex'>
                    <a class="editable"
                    title="@lang('cabinet.personal_data.edit_data')"
                    data-field="entity_name"
                    data-emptytext="@lang('main.entity.entity_name')"
                    href="#"
                    >
                    {{ $user->entity_name }}
                </a>
                <a class='edit-field' href='#'><span class="glyphicon glyphicon-pencil"></span></a>
            </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.entity_address')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="entity_address"
                data-emptytext="@lang('main.entity.entity_address')"
                href="#"
                >
                {{ $user->entity_address }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.entity_fact_address')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="entity_fact_address"
                data-emptytext="@lang('main.entity.entity_fact_address')"
                href="#"
                >
                {{ $user->entity_fact_address }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.entity_code')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="entity_code"
                data-emptytext="@lang('main.entity.entity_code')"
                href="#"
                >
                {{ $user->entity_code }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.entity_bank_code')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="entity_bank_code"
                data-emptytext="@lang('main.entity.entity_bank_code')"
                href="#"
                >
                {{ $user->entity_bank_code }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.inn')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="inn"
                data-emptytext="@lang('main.entity.inn')"
                href="#"
                >
                {{ $user->inn }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.bank_account')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="bank_account"
                data-emptytext="@lang('main.entity.bank_account')"
                href="#"
                >
                {{ $user->bank_account }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.bank_name')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="bank_name"
                data-emptytext="@lang('main.entity.bank_name')"
                href="#"
                >
                {{ $user->bank_name }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.entity_registration_number')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="entity_registration_number"
                data-emptytext="@lang('main.entity.entity_registration_number')"
                href="#"
                >
                {{ $user->entity_registration_number }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div>
        <div class="personal_block-row" style='margin-bottom: 10px;'>
            <div class='row-title'>
                <b>@lang('main.entity.entity_registration_date')</b>
            </div>
            <div class='flex'>
                <a class="editable"
                title="@lang('cabinet.personal_data.edit_data')"
                data-field="entity_registration_date"
                data-emptytext="@lang('main.entity.entity_registration_date')"
                href="#"
                >
                {{ $user->entity_registration_date }}
            </a>
            <a class='edit-field' href='#'>
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
        </div>
        </div> -->
        <!-- Данные организации  -->

        </div>
        {{-- Смена пароля --}}
        @include('pages.cabinet.data_editing')
        {{--Смена пароля  --}}

    </div>
<!-- </div> -->



{{-- <div class="item_wrap">
    <div class="item_title">
        @lang('cabinet.personal_data.login')
    </div>
    <div class='editable' data-field="login">
        {{$user->login}}
    </div>
</div>
<div class="item_wrap">
    <div class="item_title">
        @lang('cabinet.personal_data.note')
    </div>
    <div class='editable' data-field="note">
        {{$user->note}}
    </div>
</div>
<div class="item_wrap">
    <div class="item_title">
        @lang('cabinet.personal_data.birthdate')
    </div>
    <div class='editable' data-field="birthdate">
        {{$user->birthdate}}
    </div>
</div>
<div class="item_wrap">
    <div class="item_title">
        @lang('cabinet.personal_data.country')
    </div>
    <div class='editable' data-field="country">
        {{$user->country}}
    </div>
</div> --}}
