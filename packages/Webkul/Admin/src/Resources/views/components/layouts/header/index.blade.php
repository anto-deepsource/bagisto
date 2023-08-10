@php $admin = auth()->guard('admin')->user(); @endphp

<header class="flex justify-between items-center px-[16px] py-[10px] bg-white border-b-[1px] border-gray-300 sticky top-0 z-10">
    <div class="flex gap-[16px]">
        <a
            href="{{ route('admin.dashboard.index') }}" 
            class="place-self-start -mt-[4px]"            
        >
            <img src="{{ bagisto_asset('images/logo.png') }}">
        </a>

        <form class="flex items-center max-w-[445px]">
            <label 
                for="organic-search" 
                class="sr-only"
            >
                @lang('admin::app.components.layouts.header.search')
            </label>

            <div class="relative w-full">
                <div class="icon-search text-[22px] absolute left-[12px] top-[6px] flex items-center pointer-events-none"></div>

                <input 
                    type="text" 
                    class="bg-white border border-gray-300 rounded-lg block w-full px-[40px] py-[5px] leading-6 text-gray-400 transition-all hover:border-gray-400"
                    placeholder="@lang('admin::app.components.layouts.header.mega-search')" 
                    required=""
                >

                <button 
                    type="button" 
                    class="absolute icon-camera top-[12px] right-[12px] flex items-center pr-[12px] text-[22px]"
                >
                </button>
            </div>
        </form>
    </div>

    <div class="flex gap-[4px] items-center">
        <a 
            href="{{ route('shop.home.index') }}" 
            target="_blank"
            class="mt-[6px]"
        >
            <span 
                class="icon-store p-[6px] rounded-[6px] text-[24px] cursor-pointer transition-all hover:bg-gray-100"
                title="@lang('admin::app.components.layouts.header.visit-shop')"
            >
            </span>
        </a>

        <span 
            class="icon-notification p-[6px] bg-gray-100 rounded-[6px] text-[24px] text-red cursor-pointer transition-all" 
            title="@lang('admin::app.components.layouts.header.notifications')"
        >
        </span>

         {{-- Admin profile --}}
         <x-admin::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
            <x-slot:toggle>
                @if ($admin->image)
                    <div class="profile-info-icon">
                        <img
                            src="{{ $admin->image_url }}"
                            class="max-w-[36px] max-h-[36px] rounded-[6px]"
                        />
                    </div>
                @else
                    <div class="profile-info-icon">
                        <span class="px-[8px] py-[6px] bg-blue-400 rounded-full text-white font-semibold cursor-pointer leading-6">
                            {{ substr($admin->name, 0, 1) }}
                        </span>
                    </div>
                @endif
            </x-slot:toggle>

            {{-- Admin Dropdown --}}
            <x-slot:content class="!p-[0px]">
                <div class="grid gap-[10px] p-[20px] pb-0">
                    {{-- Version --}}
                    <p class="text-gray-400">
                        @lang('admin::app.layouts.app-version', ['version' => 'v' . core()->version()])
                    </p>

                    {{-- Title --}}
                    <p class="py-1 text-[16px] text-gray-500">
                        @lang('admin::app.layouts.account-title')
                    </p>
                </div>

                <div class="grid gap-[4px] mt-[10px] pb-[10px]">
                    <a
                        class="px-5 py-2 text-[16px] text-gray-800 hover:bg-gray-100 cursor-pointer"
                        href="{{ route('admin.account.edit') }}"
                    >
                        @lang('admin::app.layouts.my-account')
                    </a>

                    {{--Admin logout--}}
                    <x-shop::form
                        method="DELETE"
                        action="{{ route('admin.session.destroy') }}"
                        id="adminLogout"
                    >
                    </x-shop::form>

                    <a
                        class="px-5 py-2 text-[16px] text-gray-800 hover:bg-gray-100 cursor-pointer"
                        href="{{ route('admin.session.destroy') }}"
                        onclick="event.preventDefault(); document.getElementById('adminLogout').submit();"
                    >
                        @lang('admin::app.layouts.logout')
                    </a>
                </div>
            </x-slot:content>
        </x-admin::dropdown>
    </div>
</header>