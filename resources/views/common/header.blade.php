<header id="header" header-mobile-toggle class="primary-background">
    <div class="grid mx-l">

        <div>
            <a href="{{ url('/') }}" class="logo">
                @if(setting('app-logo', '') !== 'none')
                    <img class="logo-image" src="{{ setting('app-logo', '') === '' ? url('/logo.png') : url(setting('app-logo', '')) }}" alt="Logo">
                @endif
                @if (setting('app-name-header'))
                    <span class="logo-text">{{ setting('app-name') }}</span>
                @endif
            </a>
            <div class="mobile-menu-toggle hide-over-l">@icon('more')</div>
        </div>

        <div class="header-search hide-under-l">
            @if (hasAppAccess())
            <form action="{{ url('/search') }}" method="GET" class="search-box">
                <button id="header-search-box-button" type="submit">@icon('search') </button>
                <input id="header-search-box-input" type="text" name="term" tabindex="2" placeholder="{{ trans('common.search') }}" value="{{ isset($searchTerm) ? $searchTerm : '' }}">
            </form>
            @endif
        </div>

        <div class="text-right">
            <div class="header-links">
                <div class="links text-center">
                    @if (hasAppAccess())
                        <a class="hide-over-l" href="{{ url('/search') }}">@icon('search'){{ trans('common.search') }}</a>
                        @if(userCanOnAny('view', \BookStack\Entities\Bookshelf::class) || userCan('bookshelf-view-all') || userCan('bookshelf-view-own'))
                            <a href="{{ url('/shelves') }}">@icon('bookshelf'){{ trans('entities.shelves') }}</a>
                        @endif
                        <a href="{{ url('/books') }}">@icon('books'){{ trans('entities.books') }}</a>
                        @if(signedInUser() && userCan('settings-manage'))
                            <a href="{{ url('/settings') }}">@icon('settings'){{ trans('settings.settings') }}</a>
                        @endif
                        @if(signedInUser() && userCan('users-manage') && !userCan('settings-manage'))
                            <a href="{{ url('/settings/users') }}">@icon('users'){{ trans('settings.users') }}</a>
                        @endif
                    @endif

                    @if(!signedInUser())
                        @if(setting('registration-enabled', false))
                            <a href="{{ url('/register') }}">@icon('new-user') {{ trans('auth.sign_up') }}</a>
                        @endif
                        <a href="{{ url('/login') }}">@icon('login') {{ trans('auth.log_in') }}</a>
                    @endif
                </div>
                @if(signedInUser())
                    <?php $currentUser = user(); ?>
                    <div class="dropdown-container" dropdown>
                        <span class="user-name hide-under-l" dropdown-toggle>
                            <img class="avatar" src="{{$currentUser->getAvatar(30)}}" alt="{{ $currentUser->name }}">
                            <span class="name">{{ $currentUser->getShortName(9) }}</span> @icon('caret-down')
                        </span>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ url("/user/{$currentUser->id}") }}">@icon('user'){{ trans('common.view_profile') }}</a>
                            </li>
                            <li>
                                <a href="{{ url("/settings/users/{$currentUser->id}") }}">@icon('edit'){{ trans('common.edit_profile') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}">@icon('logout'){{ trans('auth.logout') }}</a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>

    </div>
</header>