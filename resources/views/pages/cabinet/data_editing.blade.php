<div class="tab-pane-item password-block">
    <h2 class="title-tab-cabinet blue-title mobile-title">@lang('cabinet.tab_menu.reset_password')</h2>
    <form id="change_password_form" class="form-password">
        <div class='modal-row-p'>
            <div class="input-name required">@lang('cabinet.old_pass')</div>
            <input name='old_password' id='old_password' type='text' class='form-control input-sm' required />
        </div>
        <div class='modal-row-p'>
            <div class="input-name required">@lang('cabinet.new_pass')</div>
            <a title="Сгенерировать" class='text-link link-mini' href="#" id='generate_password'>@lang('cabinet.genegate')</a>
            <input name='password' id='password' type='text' class='form-control input-sm' required />
        </div>
        <div class='modal-row-p'>
            <div class="input-name required">@lang('cabinet.new_pass_again')</div>
            <input name='password_again' id='password_again' type='text' class='form-control input-sm' required />
        </div>
        <div class="good-item-price">
            <button id="change_password" class="btn-green ">@lang('cabinet.save')</button>
        </div>
    </form>
</div>
